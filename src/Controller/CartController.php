<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\View\CommanHelper;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Datasource\ConnectionManager;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
include(ROOT . DS . "vendor" . DS  . "phpqrcode" . DS . "qrlib.php");
include(ROOT . DS . "vendor" . DS  . "PHPMailer/" . DS . "PHPMailerAutoload.php");

class CartController extends AppController
{



	public  function _setPassword($password)
	{
		return (new DefaultPasswordHasher)->hash($password);
	}

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Email');
	}


	public function beforeFilter(Event $event)
	{

		// $this->Auth->allow(['contactus', 'privacy', 'mpesaonline', 'mpesaonlinestatus', 'index', 'checkticket', 'upcomingevent', 'dashboardmyevent', 'pastevent', 'posteventsec', 'eventdetail', 'bookticket', 'loctions', 'usersearch', 'upcomingeventsearch', 'aboutus', 'contact', 'faq', 'mpesacheck', 'addcomp', 'viewcomp', 'findticketdetail']);

		$this->Auth->allow(['index', 'checkout', 'buyticket', 'cartdelete', 'finalcheckout']);
	}

	public function index($id = null)
	{
		$this->loadModel('Cart');
		$this->loadModel('Package');
		$this->loadModel('Currency');
		$this->loadModel('Packagedetails');
		$user_id = $this->request->session()->read('Auth.User.id');

		$cart_data = $this->Cart->find('all')->contain(['Event' => ['Currency'], 'Eventdetail'])->where(['Cart.user_id' => $user_id, 'Cart.status' => 'Y', 'Cart.package_id IS NULL'])->order(['Cart.user_id' => 'ASC'])->toarray();
		$this->set('cart_data', $cart_data);

		$cart_data_packages = $this->Cart->find()
			->contain([
				'Event' => ['Currency'],
				'Package' => ['Packagedetails' => 'Eventdetail']
			])
			->where([
				'Cart.user_id' => $user_id,
				'Cart.package_id IS NOT NULL',
				'Cart.status' => 'Y'
			])
			->order(['Cart.user_id' => 'ASC'])
			->toArray();
		// pr($cart_data_packages);exit;

		$this->set('cart_data_packages', $cart_data_packages);

		$cart_data_comitee = $this->Cart->find('all')->contain(['Event' => ['Currency'], 'Eventdetail', 'Users'])->where(['Cart.user_id' => $user_id, 'Cart.status !=' => 'Y'])->order(['Cart.user_id' => 'ASC'])->toarray();
		$this->set('cart_data_comitee', $cart_data_comitee);
	}

	public function buyticket($id = null)
	{
		$this->loadModel('Cart');
		$this->loadModel('Event');
		$this->loadModel('Eventdetail');
		$this->loadModel('Cartquestiondetail');
		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Templates');
		$this->loadModel('Cartaddons');
		$this->loadModel('Orders');
		$this->loadModel('Package');
		$this->loadModel('Currency');
		$this->loadModel('Packagedetails');

		$user_id = $this->request->session()->read('Auth.User.id');
		$event_id = $id;

		if ($this->request->is(['post', 'put'])) {

			// pr($this->request->data);
			// exit;

			$getevent = $this->Event->get($event_id);
			$user_check = $this->Users->get($user_id);

			//mobile verify validation
			if ($user_check['is_mob_verify'] == 'N') {
				$this->Flash->error(__('Mobile Number is not verified'));
				return $this->redirect(['controller' => 'Event', 'action' => $getevent['slug']]);
				die;
			}

			//profile validation
			if (empty($user_check['profile_image'])) {
				$this->Flash->error(__('Your profile image is not uploaded kindly upload !'));
				// return $this->redirect(['controller' => 'Event', 'action' => $getevent['slug']]);
				return $this->redirect(['controller' => 'Users', 'action' => 'updateprofile']);
				die;
			}

			//pr($getevent); die;
			$ticket_limit = $getevent['ticket_limit'];
			$check = $this->Cart->find('all')->where(['user_id' => $user_id, 'event_id' => $event_id])->count();

			if ($check >= $ticket_limit) {
				$this->Flash->error(__('You have requested more tickets than your ticket limit for this event.'));
				return $this->redirect(['controller' => 'Event', 'action' => $getevent['slug']]);
			}


			// >>>>>>>>>>>>>>>>>>>>>>>>>>>>Remove Package data >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			$deltepackage = $this->Cart->find('all')->where(['user_id' => $user_id, 'event_id' => $event_id, 'package_id IS NOT NULL'])->toarray();

			if (!empty($deltepackage[0])) {
				$this->Cart->deleteAll(['Cart.event_id' => $event_id, 'Cart.user_id' => $user_id, 'package_id IS NOT NULL']);
			}


			// >>>>>>>>>>>>>>>>>>>>>>>>>>>For package add to Cart >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			// pr($this->request->data);
			if ($this->request->data['package_details']) {

				$packageTicketCount = $this->Ticket->find('all')
					->where(['cust_id' => $user_id, 'event_id' => $event_id])
					->group(['package_id'])
					->count();

				// // check user buy limit 
				if ($packageTicketCount >= $getevent['ticket_limit']) {
					$this->Flash->error(__('You have reached the Package limit for this event. Please remove them from your cart or choose other packages.'));
					return $this->redirect($this->referer());
				}


				// Cart Empty
				$cart_data = $this->Cart->find('all')->where(['Cart.event_id' => $event_id, 'Cart.user_id' => $user_id])->count();

				if ($cart_data > 0) {
					$this->Cart->deleteAll(['Cart.event_id' => $event_id, 'Cart.user_id' => $user_id]);
					$this->Cartquestiondetail->deleteAll(['user_id' => $user_id, 'event_id' => $event_id]);
					$this->Cartaddons->deleteAll(['Cartaddons.user_id' => $user_id, 'Cartaddons.event_id' => $event_id]);
				}

				$digits = 10;
				$left = 0;
				foreach ($this->request->data['package_details'] as $packageId => $packageCount) {

					if (!empty($packageCount)) {

						for ($p = 0; $p < $packageCount; $p++) {

							$packLimit = $this->Package->find('all')
								->where([
									'Package.id' => $packageId
								])
								->first();

							$packageTicketCount = $this->Ticket->find('all')
								->where(['cust_id' => $user_id, 'package_id' => $packageId])
								->group(['order_id'])
								->count();

							// check package limit 
							if ($packageTicketCount >= $packLimit['package_limit']) {
								$this->Flash->error(__($packLimit['name'] . 'package is currently sold out and cannot be added to the cart.'));
								return $this->redirect($this->referer());
							}

							// package limit over request 
							$left = $packLimit['package_limit'] - $packageTicketCount;
							if ($packageCount > $left) {
								$errorMessage = "There are only $left $packLimit[name] package(s) available for sale. You cannot request more than $left package(s).";
								$this->Flash->error(__($errorMessage));
								return $this->redirect($this->referer());
							}


							$randomnumber = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
							$package_data_set['user_id'] = $user_id;
							$package_data_set['event_id'] = $event_id;
							$package_data_set['package_id'] = $packageId;
							$package_data_set['no_tickets'] = '1'; //$ticketcount;
							$package_data_set['ticket_type'] = 'package';
							$package_data_set['status'] = 'Y';
							$package_data_set['serial_no'] = $randomnumber;
							$package_data_set['description'] = $this->request->data['package_descriptions'];
							$insertdata = $this->Cart->patchEntity($this->Cart->newEntity(), $package_data_set);
							$this->Cart->save($insertdata);
						}
					}
				}

				$this->Flash->success(__('Package added to Cart'));
				return $this->redirect(['action' => 'index']);
			}
			// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Package add end>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


			//Quantity validation tickets start
			$ticketpur = 0;
			$message_ticket_error = [];
			foreach ($this->request->data['ticket_count'] as $ticket_id => $ticketcount) {
				$ticketdetails = $this->Eventdetail->get($ticket_id);

				$totalticket_purchased = $this->Ticket->find('all')->select(['sum' => 'SUM(Ticket.ticket_buy)'])->where(['Ticket.event_ticket_id' => $ticket_id, 'Ticket.event_id' => $this->request->data['event_id']])->first();

				$totaltticket_count =  $ticketdetails['count'];

				//$cart_purchased_data = $this->Cart->find('all')->select(['sum' => 'SUM(Cart.no_tickets)'])->where(['Cart.ticket_id' => $ticket_id, 'Cart.event_id' => $this->request->data['event_id']])->first();
				//echo $totalticket_purchased['sum']."test<br>";
				//die;
				//$cart_purchased_data['sum'];
				$total_purchase_request = $totalticket_purchased['sum'] + $ticketcount;
				if ($ticketdetails['type'] == "open_sales") {
					if ($total_purchase_request <= $totaltticket_count) {
						//$ticketpur = 0;
					} else {
						$remaining_tickets =  $totaltticket_count  - $totalticket_purchased['sum'];
						$message_ticket_error[] = $ticketdetails['title'] . ' ' . $remaining_tickets . ' ticket left';
						$ticketpur = 1;
					}
				}
			}

			if ($ticketpur == 1) {
				foreach ($message_ticket_error as $key => $value) {
					$this->Flash->error(__($value));
				}
				return $this->redirect(['controller' => 'Event', 'action' => $getevent['slug']]);
			}
			//Qunatity validation tickets end

			foreach ($this->request->data['ticket_count'] as $ticket_id => $ticketcount) {

				if (!empty($ticketcount)) {

					$ticketdetails = $this->Eventdetail->get($ticket_id);
					// pr($ticketdetails);die;
					if ($ticketdetails['type'] == 'open_sales') {
						$type = 'opensale';
						$status = 'Y';
					} else {
						$status = 'N';
						$type = 'committesale';
						$commitee_user_id = $this->request->data['commitee_user_id'];
						if (empty($commitee_user_id)) {
							$this->Flash->error(__('Please select any committee Users.'));
							return $this->redirect(['controller' => 'Event', 'action' => $getevent['slug']]);
						}
					}

					// add question reply
					for ($i = 0; $i < $ticketcount; $i++) {

						$c = $i + 1;
						$dynamic = 'question' . str_replace(' ', '_', $ticketdetails['title']) . '_' . $c;
						$dynamic_question_id = 'questionid' . str_replace(' ', '_', $ticketdetails['title']) . '_' . $c;
						// pr($dynamic_question_id);die;
						$digits = 10;
						$randomnumber = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
						foreach ($this->request->data[$dynamic] as $questionid => $value) {

							$newquestiondetails = $this->Cartquestiondetail->newEntity();
							$questiondata['user_id'] = $user_id;
							$questiondata['question_id'] = $this->request->data[$dynamic_question_id][$questionid];
							$questiondata['event_id'] = $event_id;
							$questiondata['ticket_id'] = $ticket_id;
							$questiondata['user_reply'] = $value;
							$questiondata['serial_no'] = $randomnumber;
							$addquestionnew = $this->Cartquestiondetail->patchEntity($newquestiondetails, $questiondata);
							$this->Cartquestiondetail->save($addquestionnew);
						}

						// add ticket in cart 
						$newcart = $this->Cart->newEntity();
						$reqdata['user_id'] = $user_id;
						$reqdata['event_id'] = $event_id;
						$reqdata['ticket_id'] = $ticket_id;
						$reqdata['no_tickets'] = "1"; //$ticketcount;
						$reqdata['ticket_type'] = $type;
						$reqdata['status'] = $status;
						$reqdata['description'] = $this->request->data['commitee_message'];
						$reqdata['commitee_user_id'] = $commitee_user_id;
						$reqdata['serial_no'] = $randomnumber;
						$insertdata = $this->Cart->patchEntity($newcart, $reqdata);
						$ok = $this->Cart->save($insertdata);
						// $allId[]=$ok['id'];
					}
				}
			}

			// send mail for ecommittee user start	
			if (!empty($this->request->data['commitee_user_id'])) {

				$com_name = $this->Users->get($this->request->data['commitee_user_id']);

				$committeename = $com_name['name'] . ' ' . $com_name['lname'];
				$requestername = $user_check['name'] . ' ' . $user_check['lname'];
				$eventname = ucwords(strtolower($getevent['name']));
				$url = SITE_URL . 'committee/pending';
				$site_url = SITE_URL;
				$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 26])->first();
				$from = $emailtemplate['fromemail'];
				$to = $com_name['email'];
				$subject = $emailtemplate['subject'] . ': ' . $requestername . ' for ' . $eventname;
				$formats = $emailtemplate['description'];

				$message1 = str_replace(array('{EventName}', '{RequesterName}', '{CommitteeName}', '{URL}', '{SITE_URL}'), array($eventname, $requestername, $committeename, $url, $site_url), $formats);
				$message = stripslashes($message1);
				$message = '<!DOCTYPE HTML>
				<html>			
				<head>
					<meta http-equiv="Content-Type " content="text/html; charset=utf-8 ">
					<title>Untitled Document</title>
					<style>
						p {
							margin: 9px 0px;
							line-height: 24px;
						}
					</style>			
				</head>			
				<body style="background:#d8dde4; padding:15px;">' . $message1 . '</body></html>';
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: <' . $from . '>' . "\r\n";
				if ($event_id != 49) {
					$mail = $this->Email->send($to, $subject, $message);
					//  send mail complete

					// send watsappmessage start 
					$message = "*Eboxtickets: Incoming Request*%0AHi $committeename,%0A%0AYou just received a request from *" . $requestername . "* for *" . $eventname . '* Event' . "%0A%0ARegards,%0A%0AEboxtickets.com";
					$numwithcode = $com_name['mobile'];
					$this->whatsappmsg($numwithcode, $message);
					// send watsappmessage start 
				}
			}

			$this->Flash->success(__('Tickets added to Cart'));
			return $this->redirect(['action' => 'index']);
		}

		// if ($this->request->is(['post', 'put'])) {
		// 	// pr($this->request->data);die;

		// 	foreach ($this->request->data['ticket_count'] as $ticket_id => $ticketcount) {

		// 		if (!empty($ticketcount)) {
		// 			$ticketdetails = $this->Eventdetail->get($ticket_id);

		// 			// if ($ticketdetails['type'] == 'open_sales') {
		// 			// 	$type = 'opensale';
		// 			// } else {
		// 			// 	$type = 'committesale';
		// 			// 	$commitee_user_id = $this->request->data['commitee_user_id'];
		// 			// }

		// 			for ($i = 0; $i < $ticketcount; $i++) {
		// 				$c = $i + 1;
		// 				$dynamic = 'question' . $ticketdetails['title'] . '_' . $c;
		// 				$dynamic_question_id = 'questionid' . $ticketdetails['title'] . '_' . $c;
		// 				// pr($dynamic_question_id);

		// 				foreach ($this->request->data[$dynamic] as $questionid => $value) {

		// 					// $questiondata['user_id']=$user_id;
		// 					// $questiondata['question_id']=$this->request->data[$dynamic_question_id][$questionid];
		// 					// $questiondata['event_id']=$event_id;
		// 					// $questiondata['ticket_id']=$ticket_id;
		// 					// $questiondata['user_reply']=$value;


		// 					$newquestiondetails = $this->Cartquestiondetail->newEntity();
		// 					$questiondata['user_id'] = $user_id;
		// 					$questiondata['question_id'] = $this->request->data[$dynamic_question_id][$questionid];
		// 					$questiondata['event_id'] = $event_id;
		// 					$questiondata['ticket_id'] = $ticket_id;
		// 					$questiondata['user_reply'] = $value;
		// 					$addquestionnew = $this->Cartquestiondetail->patchEntity($newquestiondetails, $questiondata);
		// 					$addquestionnewsave = $this->Cartquestiondetail->save($addquestionnew);
		// 				}

		// 				// add ticket in cart 
		// 				//  $newcart = $this->Cart->newEntity();
		// 				//  $reqdata['user_id'] = $user_id;
		// 				//  $reqdata['event_id'] = $event_id;
		// 				//  $reqdata['ticket_id'] = $ticket_id;
		// 				//  $reqdata['no_tickets'] = $ticketcount;
		// 				//  $reqdata['ticket_type'] = $type;
		// 				//  $reqdata['commitee_user_id'] = $commitee_user_id;
		// 				//  $insertdata = $this->Cart->patchEntity($newcart, $reqdata);
		// 				//  $result = $this->Cart->save($insertdata);
		// 			}

		// 			// pr($ticketdetails['title']);exit;


		// 			// if ($ticketdetails['type']=='open_sales') {
		// 			// 	$type = 'opensale';
		// 			// } else {
		// 			// 	$type = 'committesale';
		// 			// 	$commitee_user_id=$this->request->data['commitee_user_id'];
		// 			// }
		// 			// if (!empty($ticketcount)) {

		// 			// 	for ($i = 0; $i < $ticketcount; $i++) {

		// 			// 		$newcart = $this->Cart->newEntity();
		// 			// 		$reqdata['user_id'] = $user_id;
		// 			// 		$reqdata['event_id'] = $event_id;
		// 			// 		$reqdata['ticket_id'] = $ticket_id;
		// 			// 		$reqdata['no_tickets'] = $ticketcount;
		// 			// 		$reqdata['ticket_type'] = $type;
		// 			// 		$reqdata['commitee_user_id'] =$commitee_user_id;
		// 			// 		$insertdata = $this->Cart->patchEntity($newcart, $reqdata);
		// 			// 		$result = $this->Cart->save($insertdata);
		// 			// 	}
		// 			// }
		// 		}
		// 	}
		// 	// exit;

		// 	$this->Flash->success(__('Add tickets into the cart'));
		// 	return $this->redirect(['action' => 'index']);
		// }
	}

	public function checkout($id = null)
	{
		$this->loadModel('Cart');
		$this->loadModel('Addons');
		$this->loadModel('Event');
		$this->loadModel('Eventdetail');
		$this->loadModel('Cartquestiondetail');
		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Package');
		$this->loadModel('Packagedetails');
		$this->loadModel('Currency');


		$user_id = $this->request->session()->read('Auth.User.id');
		$admin_fee = $this->Users->find()->where(['role_id' => 1])->first();
		$fees = $admin_fee['feeassignment'];

		if (empty($user_id)) {
			return $this->redirect(['controller' => 'Homes', 'action' => 'index']);
		}

		$user_check = $this->Users->get($user_id);

		$cart_data = $this->Cart->find('all')->contain(['Event' => ['Currency'], 'Eventdetail'])->where(['Cart.user_id' => $user_id, 'Cart.status' => 'Y', 'Cart.package_id IS NULL'])->order(['Cart.user_id' => 'ASC'])->toarray();

		$cart_data_packages = $this->Cart->find()
			->contain([
				'Event' => ['Currency'],
				'Package' => ['Packagedetails' => 'Eventdetail']
			])
			->where([
				'Cart.user_id' => $user_id,
				'Cart.package_id IS NOT NULL',
				'Cart.status' => 'Y'
			])
			->order(['Cart.user_id' => 'ASC'])
			->toArray();



		$addondata = $this->Cart->find('all')->contain(['Event' => ['Currency']])->where(['Cart.user_id' => $user_id, 'Cart.status' => 'Y', 'Cart.package_id IS NULL'])->group(['Event.id'])->toarray();


		// $addondata = $this->Cart->find('all')->contain(['Event' => ['Currency']])->where(['Cart.user_id' => $user_id, 'Cart.status' => 'Y'])->group(['Event.id'])->toarray();


		if ($user_check['is_mob_verify'] == 'N') {
			$this->Flash->error(__('Mobile Number is not verified'));
			return $this->redirect(['controller' => 'cart', 'action' => 'index']);
			die;
		}

		//profile validation
		if (empty($user_check['profile_image'])) {
			$this->Flash->error(__('Your profile image is not uploaded kindly upload !'));
			// return $this->redirect(['controller' => 'cart', 'action' => 'index']);
			return $this->redirect(['controller' => 'Users', 'action' => 'updateprofile']);
			die;
		}

		// $addon_data = $this->Addons->find('all')->contain(['Event'])->where(['event_id'=>1,'status'=>'Y'])->toarray();
		// pr($addon_data);exit;
		$this->set(compact('user_id', 'fees', 'cart_data_packages'));
		$this->set('cart_data', $cart_data);
		$this->set('addondata', $addondata);
	}

	// Checkout step -1
	public function processingpayment()
	{
		$this->viewBuilder()->layout(false);
		$this->loadModel('Orders');
		$this->loadModel('Ticket'); // tblticket_book
		$this->loadModel('Cartaddons');
		$this->loadModel('Addons');
		$this->loadModel('Addonsbook');
		$this->loadModel('Cart');
		$this->loadModel('Eventdetail');
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Payment');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Questionbook');
		$this->loadModel('Cartquestiondetail');
		$this->loadModel('Package');
		$this->loadModel('Packagedetails');
		$this->loadModel('Currency');
		$this->loadModel('Templates');


		$user = $this->request->session()->read('Auth.User');
		$admin_fee = $this->Users->find()->where(['role_id' => 1])->first();
		$fees = $admin_fee['feeassignment'];

		if ($this->request->is(['post', 'put'])) {
			$user_id = $this->request->session()->read('Auth.User.id');
			$user_check = $this->Users->get($user_id);
			$date = date("Y-m-d H:i:s");
			//all validations start

			//mobile verify validation
			if ($user_check['is_mob_verify'] == 'N') {
				$this->Flash->error(__('Mobile Number is not verified'));
				return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
				die;
			}

			//profile image validation
			if (empty($user_check['profile_image'])) {
				$this->Flash->error(__('Your profile image is not uploaded kindly upload !'));
				// return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
				return $this->redirect(['controller' => 'Users', 'action' => 'updateprofile']);
				die;
			}

			$messagesingleticket_purchase = [];
			$checkalsingleticket_purchase = 0;

			$messageindividualticket_purchase = [];
			$checkalindividualticket_purchase = 0;

			$messagesingleaddon_purchase = [];
			$checkaladdon_purchase = 0;

			$message_sold_out = [];
			$message_sold = 0;

			$cart_data = $this->Cart->find('all')->contain(['Event' => ['Currency'], 'Eventdetail'])->where(['Cart.user_id' => $user_id, 'Cart.status' => 'Y'])->order(['Cart.user_id' => 'ASC'])->toarray();
			// pr($this->request->data);
			// die;

			// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< For Package Start >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			$totalPackageAmount = $this->request->data['totalamount'];
			$packageIds = $this->request->data['packageIds'];
			// pr($packageIds);exit;

			$cart_packages_data = $this->Cart->find()
				->contain([
					'Event' => ['Currency'],
					'Package' => ['Packagedetails' => 'Eventdetail']
				])
				->where([
					'Cart.user_id' => $user_id,
					'Cart.package_id IS NOT NULL',
					'Cart.status' => 'Y'
				])
				->order(['Cart.id' => 'ASC'])
				->toArray();

			$errorMessage = [];
			$ticketLimitReached = false;

			foreach ($cart_packages_data as $key => $cart_packages_det) {

				$cust_pack_buy = $this->Ticket->find('all')
					->where([
						'cust_id' => $user_id,
						'event_id' => $cart_packages_det['event_id'],
					])
					->group(['order_id', 'package_id'])
					->count();

				if ($cust_pack_buy >= $cart_packages_det['event']['ticket_limit']) {
					$ticketLimitReached = true;
					continue; 
				}

				if ($cust_pack_buy >= $cart_packages_det['package']['package_limit']) {
					$this->Flash->error(__($cart_packages_det['package']['name'] . 'package is currently sold out and cannot be added to the cart.'));
					return $this->redirect($this->referer());
				}

				$left = $cart_packages_det['package']['package_limit'] - $cust_pack_buy;
				if ($cart_packages_det['no_tickets'] > $left) {
					$errorMessage = "There are only $left $cart_packages_det[package][name] package(s) available for sale. You cannot request more than $left package(s).";
					$this->Flash->error(__($errorMessage));
					return $this->redirect($this->referer());
				}
			}

			// Check if ticket limit reached
			if ($ticketLimitReached) {
				$errorMessage[] = "You have reached the Package limit for this event. Please remove them from your cart or choose other packages.";
			}

			// If any package is sold out or ticket limit exceeded, redirect to checkout page with the appropriate message
			if (!empty($errorMessage)) {
				$this->Flash->error(implode("<br>", $errorMessage));
				return $this->redirect($this->referer());
			}


			if (!empty($cart_packages_data[0])) {

				$TotalAmount = 0;
				$ordersummary = '';
				$ordersummarywtsapp = '';
				$conversionRate = $cart_packages_data[0]['event']['currency']['conversion_rate'];
				$packageId = $cart_packages_data[0]->package_id;
				$orderdata['adminfee'] = $fees;
				$orderdata['user_id'] = $user_id;
				$orderdata['total_amount'] = sprintf('%.2f', $totalPackageAmount);
				// $orderdata['total_amount'] = sprintf('%.2f', $cart_packages_data[0]['package']['grandtotal'] * $conversionRate);
				$orderdata['RRN'] = '229817895625';
				$orderdata['IsoResponseCode'] = 00;
				$orderdata['OrderIdentifier'] = '4C3E0B4D-6914-B2AD-0C51-AB222A0FCRRR';
				$orderdata['OriginalTrxnIdentifier'] = '4C3E0B4D-6914-B2AD-0C51-AB222A0FCRRR';
				$orderdata['TransactionIdentifier'] = '25ad9819-9652-4692-a969-17e419777888';
				$orderdata['TransactionType'] = 3;
				$orderdata['Approved'] = 1;
				$orderdata['package_id'] = $packageId;
				$orderdata['description'] = $cart_packages_data[0]['description'];
				$orderdata['paymenttype'] = "Online";
				$orderdata['created'] = $date;
				$patchOrder = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);

				if ($saveOrders = $this->Orders->save($patchOrder)) {
					$packageDetails = '';

					foreach ($cart_packages_data as $cart_pac_id => $cart_packages_details) {
						$packageDetails = $cart_packages_details->package->packagedetails;
						foreach ($packageDetails as $packageDetail) {
							for ($i = 0; $i < $packageDetail['qty']; $i++) {
								$currenny = $this->Currency->get($cart_packages_details['event']['currency']['id']);
								$fn['user_id'] = $user_id;
								$fn['event_id'] = $cart_packages_details['event_id'];
								$fn['amount'] =  $packageDetail['eventdetail']['price'];
								$fn['created'] = $date;
								$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
								$this->Payment->save($payment);

								$ticketbook['order_id'] = $saveOrders->id;
								$ticketbook['event_id'] = $cart_packages_details['event_id'];
								$ticketbook['event_ticket_id'] = $packageDetail['eventdetail']['id'];
								$ticketbook['cust_id'] = $user_id;
								$ticketbook['ticket_buy'] = 1;
								$ticketbook['currency_rate'] = $currenny['conversion_rate'];
								$ticketbook['amount'] = $packageDetail['eventdetail']['price'];
								$ticketbook['mobile'] = $user_check['mobile'];
								$ticketbook['created'] = $date;
								$ticketbook['adminfee'] = $fees;
								$ticketbook['package_id'] = $packageDetail['package_id'];

								$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
								$lastinsetid = $this->Ticket->save($insertticketbook);

								$ticketdetaildata['tid'] = $lastinsetid['id'];
								$ticketdetaildata['user_id'] = $user_id;
								$ticketdetaildata['package_id'] = $packageDetail['package_id'];
								$ticketdetaildata['created'] = $date;
								$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
								$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

								$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
								$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
								$ticketdetail = $this->Ticketdetail->save($Packff);

								// Here QR Code generate with the ticket number evenId organiser id and packageId
								$ticketqrimages = $this->qrcodepro($user_id, $ticketdetail['ticket_num'], $cart_packages_details['event']['event_org_id'], $packageDetail['package_id']);
								$Pack = $this->Ticketdetail->get($ticketdetail['id']);
								$Pack->qrcode = $ticketqrimages;
								$this->Ticketdetail->save($Pack);

								$TotalAmount = $currenny['Currency_symbol'] . sprintf('%0.2f', $packageDetail['eventdetail']['price'] * $currenny['conversion_rate']) . ' TTD';

								$eventname = ucwords(strtolower($cart_packages_details['event']['name']));
								$ticket_name = $packageDetail['eventdetail']['title'];
								$ordersummary .= '<p> <strong style="display: flex;"><span style="width: 60%; display:inline-block;font-size: 14px;font-weight: 400;">' . $eventname . ' (' . $ticket_name . ')</span><span style="width: 10%; display:inline-block;font-weight: 400;font-size: 14px;">:</span><span style="width: 30%; color:#464646; font-size:14px;font-weight: 400;">' . $TotalAmount . '</span></strong></p>';
								$ordersummarywtsapp .= '%0A %0A' . $eventname . ' (' . $ticket_name . ')' . $TotalAmount . '  %0A';
							}
						}
					}

					// send email to admin and event organiser 
					$requestername = $user_check['name'] . ' ' . $user_check['lname'];
					$url = SITE_URL . 'tickets/myticket';
					$site_url = SITE_URL;
					$paymentType = 'Online';
					$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 30])->first();
					$from = $emailtemplate['fromemail'];
					$to = $user_check['email'];
					$GrandTotalAmount = $currenny['Currency_symbol'] . sprintf('%0.2f', $patchOrder['total_amount']) . ' TTD';
					// $cc = $from;
					$GrandTotalIncludingFee = $patchOrder['total_amount'] * $fees / 100 + $patchOrder['total_amount'];
					$subject = $emailtemplate['subject'] . ': ' . $eventname;
					$formats = $emailtemplate['description'];

					$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{PaymentType}', '{TotalAmount}', '{OrderSummary}'), array($eventname, $requestername, $url, $site_url, $paymentType, $GrandTotalIncludingFee, $ordersummary), $formats);

					$message = stripslashes($message1);
					$message = '<!DOCTYPE HTML>
					<html>                
					<head>
						<meta http-equiv="Content-Type " content="text/html; charset=utf-8 ">
						<title>Untitled Document</title>
						<style>
							p {
								margin: 9px 0px;
							}
						</style>                
					</head>                
					<body style="background:#d8dde4; padding:15px;">' . $message1 . '</body></html>';
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: <' . $from . '>' . "\r\n";

					// send mail complete 
					$mail = $this->Email->send($to, $subject, $message);
					$message = "*Eboxtickets: Payment Complete*%0AHi $requestername,%0A%0AYour payment was received for " . $ordersummarywtsapp . " ticket.%0ANo payment details were required.%0A%0ARegards,%0AEboxtickets.com";
					$numwithcode = $user_check['mobile'];
					// $this->whatsappmsg($numwithcode, $message);
					// send watsappmessage start 
					$this->Cart->deleteAll(['Cart.user_id' => $user_id]);
					$this->Flash->success(__('Your Ticket has been booked'));
					return $this->redirect(['controller' => 'Tickets', 'action' => 'myticket']);

					// order data save end	
				}
			} else {
				$this->Flash->error(__('Your shopping cart is empty. Please add items to proceed with the checkout process.'));
				return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
			}


			// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< For Package End >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>





			if (empty($cart_data)) {
				$this->Flash->error(__('Your shopping cart is empty. Please add items to proceed with the checkout process.'));
				return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
			} else {

				$findaddon_cart = $this->Cartaddons->find('all')->where(['Cartaddons.user_id' => $user_id])->order(['Cartaddons.id' => 'ASC'])->toarray();

				//Addons
				foreach ($findaddon_cart as $findaddon_value) {

					$addons_data = $this->Addons->find('all')->where(['Addons.id' => $findaddon_value['addon_id']])->order(['Addons.id' => 'ASC'])->first();
					$addon_count_total = $addons_data['count'];

					$findaddon_cart_count = $this->Cartaddons->find('all')->where(['Cartaddons.user_id' => $user_id, 'Cartaddons.addon_id' => $findaddon_value['addon_id']])->order(['Cartaddons.id' => 'ASC'])->count();


					$addons_purchase_count = $this->Addonsbook->find('all')->where(['Addonsbook.addons_id' => $findaddon_value['addon_id']])->order(['Addons.id' => 'ASC'])->count();
					$total_addon_cart_count = $findaddon_cart_count + $addons_purchase_count;
					//echo $total_addon_cart_count." ggg". $addon_count_total; die;
					if ($total_addon_cart_count < $addon_count_total) {
					} else {
						$remaiingaddons  = $addon_count_total - $addons_purchase_count;
						if ($remaiingaddons <= 0) {
							$messagesingleaddon_purchase[] = "Addons sold out";
						} else {
							$messagesingleaddon_purchase[] = "You will purchase only " . $remaiingaddons . " " . $addons_data['name'];
						}
						$checkaladdon_purchase = 1;
					}
				}
				//Ticket
				foreach ($cart_data as $cart_value) {
					$getevent = $this->Event->get($cart_value['event_id']);
					$ticket_id = $cart_value['ticket_id'];
					$ticket_limit = $getevent['ticket_limit'];
					$ticketdetails = $this->Eventdetail->get($ticket_id);

					if ($ticketdetails['sold_out'] == 'Y') {
						$message_sold_out[] = $ticketdetails['title'] . " ticket is Sold Out";
						$message_sold = 1;
					}

					$sale_end = date('Y-m-d H:i:s', strtotime($getevent['sale_end']));

					if (strtotime($sale_end) >= strtotime($date)) {
					} else {
						$this->Flash->error(__('Ticket sales for ' . $getevent['name'] . ' event are currently closed.'));
						return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
						die;
					}

					//check single event ticket count start
					$check = $this->Cart->find('all')->where(['user_id' => $user_id, 'event_id' => $cart_value['event_id']])->count();

					$totalticket_purchased = $this->Ticket->find('all')->select(['sum' => 'SUM(Ticket.ticket_buy)'])->where(['Ticket.event_id' => $cart_value['event_id'], 'Ticket.cust_id' => $user_id])->first();

					$total_all_ticket_purchase = $totalticket_purchased['sum'] + $check;

					if ($total_all_ticket_purchase <= $ticket_limit) {
					} else if ($total_all_ticket_purchase >= $ticket_limit) {
						$messagesingleticket_purchase[] = "You have requested more tickets than your ticket limit for this event.";
						$checkalsingleticket_purchase = 1;
					} else {
						$messagesingleticket_purchase[] = "You have completed your limit for " . $ticketdetails['title'] . " ticket";
						$checkalsingleticket_purchase = 1;
					}

					//check single event ticket count end

					//individual ticket count start
					$totalticket_purchased_individual = $this->Ticket->find('all')->select(['sum' => 'SUM(Ticket.ticket_buy)'])->where(['Ticket.event_id' => $cart_value['event_id'], 'Ticket.event_ticket_id' => $ticket_id])->first();
					$total_individual_all_ticket_purchase =  $totalticket_purchased_individual['sum'];
					$all_sub = $total_individual_all_ticket_purchase;

					$ticketdetails_count  = $ticketdetails['count'];

					if ($ticketdetails['type'] == "open_sales") {
						if ($all_sub < $ticketdetails_count) {
						} else {
							$messageindividualticket_purchase[] = $ticketdetails['title'] . " ticket has Sold Out";
							$checkalindividualticket_purchase = 1;
						}
					}
				}
			}

			if ($message_sold == 1) {
				$message_sold_out =  array_unique($message_sold_out);
				foreach ($message_sold_out as $key => $value) {
					$this->Flash->error(__($value));
				}
				return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
			}

			if ($checkaladdon_purchase == 1) {
				$messagesingleaddon_purchase =  array_unique($messagesingleaddon_purchase);
				foreach ($messagesingleaddon_purchase as $key => $value) {
					$this->Flash->error(__($value));
				}
				return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
			}

			if ($checkalsingleticket_purchase == 1) {
				$messagesingleticket_purchase =  array_unique($messagesingleticket_purchase);
				foreach ($messagesingleticket_purchase as $key => $value) {
					$this->Flash->error(__($value));
				}
				return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
			}

			if ($checkalindividualticket_purchase == 1) {
				$messageindividualticket_purchase =  array_unique($messageindividualticket_purchase);
				foreach ($messageindividualticket_purchase as $key => $value) {
					$this->Flash->error(__($value));
				}
				return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
			}
			//all validation end

			//cart total price
			$admin_fee = $this->Users->find()->where(['role_id' => 1])->first();
			$fees = $admin_fee['feeassignment'];

			$event_price_checkout = 0;
			$event_price_checkout_fee = 0;
			foreach ($cart_data as $key => $value) {
				// pr($value);exit;
				if ($value['event']['currency']['id'] == 1) {
					$event_price_checkout += $value['eventdetail']['price'] * $value['event']['currency']['conversion_rate'];
					$event_price_checkout_fee += $this->cal_percentage($fees, $value['eventdetail']['price'] * $value['event']['currency']['conversion_rate']);
				} else {
					$event_price_checkout += $value['eventdetail']['price'];
					$event_price_checkout_fee += $this->cal_percentage($fees, $value['eventdetail']['price']);
				}
			}

			// echo $event_price_checkout_fee; die;
			//addons total price
			$findaddon = $this->Cartaddons->find('all')->contain(['Addons'])->where(['Cartaddons.user_id' => $user['id'], 'Cartaddons.status' => 'Y'])->order(['Cartaddons.id' => 'ASC'])->toarray();
			$event_price_addons = 0;
			$event_price_addons_fee = 0;

			foreach ($findaddon as $chck_key => $chck_addondetail) {
				if ($value['event']['currency']['id'] == 1) {
					$event_price_addons +=  $chck_addondetail['addon']['price'] * $value['event']['currency']['conversion_rate'];
					$event_price_addons_fee +=  $this->cal_percentage($fees, $chck_addondetail['addon']['price'] * $value['event']['currency']['conversion_rate']);
				} else {
					$event_price_addons +=  $chck_addondetail['addon']['price'];
					$event_price_addons_fee +=  $this->cal_percentage($fees, $chck_addondetail['addon']['price']);
				}
			}

			$cart_total_checkout =  $event_price_checkout + $event_price_checkout_fee + $event_price_addons + $event_price_addons_fee;
			// pr($cart_total_checkout);exit;


			//payment processing start
			//pr($this->request->data); die;
			$file_path = "/var/www/html/eboxtickets.com/webroot/logs/powertranz.txt";
			$post_data = json_encode($this->request->data) . "\n\n";
			file_put_contents($file_path, $post_data, FILE_APPEND | LOCK_EX);

			$cart_total_checkout = sprintf('%0.2f', $cart_total_checkout);
			$card_holder_name = $this->request->data['holdername'];
			$card_number = $this->request->data['cardnumber'];
			$card_monthyear = $this->request->data['expiry_year'] . $this->request->data['monthyear'];
			$cardcvv = $this->request->data['cvv'];

			$header = [
				'Accept:application/json',
				'PowerTranz-PowerTranzId:' . POWERTRANZID,
				'PowerTranz-PowerTranzPassword:' . POWERTRANZPASSWORD,
				'Content-Type:application/json'
			];

			$guid  =  $this->createGUID();
			$user_id = $this->request->session()->read('Auth.User.id');
			$user_check = $this->Users->get($user_id);
			$request_data = [
				"TransactionIdentifier" => $guid,
				"TotalAmount" => $cart_total_checkout,
				"CurrencyCode" => CURRENCYCODE,
				"ThreeDSecure" => true,
				"Source" => [
					"CardPan" => $card_number,
					"CardCvv" => $cardcvv,
					"CardExpiration" => $card_monthyear,
					"CardholderName" => $card_holder_name
				],
				"OrderIdentifier" => $guid,
				"BillingAddress" => [
					"FirstName" => $user_check['name'],
					"LastName" => $user_check['lname'],
					"Line1" => '',
					"Line2" => '',
					"City" => '',
					"State" => '',
					"PostalCode" => '',
					"CountryCode" => '',
					"EmailAddress" => $user_check['email'],
					"PhoneNumber" => $user_check['mobile'],
				],
				"AddressMatch" => false,
				"ExtendedData" => [
					"ThreeDSecure" => [
						"ChallengeWindowSize" => 4,
						"ChallengeIndicator" => "02"
					],
					"MerchantResponseUrl" => SITE_URL . "cart/paymentProcessing"
				]
			];
			$request_json_data =   json_encode($request_data);
			//echo $request_json_data; die;
			//die;
			// sleep(20);
			$login_user_id = $this->request->session()->read('Auth.User.id');
			$url = PAYMENTURL . "spi/auth";
			// echo $url; die;
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => 0,
				CURLOPT_ENCODING => "",
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 40,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $request_json_data,
				CURLOPT_HTTPHEADER => $header
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);	//die;
			//pr($response); die;	
			// if ($err) {
			// 	echo "cURL Error #:" . $err; die;
			//   } else { 
			// 	echo $response; die;
			//   }
			$this->set('response', $response);

			$file_path = "/var/www/html/eboxtickets.com/webroot/logs/powertranz.txt";
			file_put_contents($file_path, $response, FILE_APPEND | LOCK_EX);

			$profess = $this->Users->find('all')->where(['id' => $login_user_id])->first();
			$this->Auth->setUser($profess);
		}
	}

	// Checkout step -2
	public function paymentProcessing()
	{
		$this->loadModel('Orders');
		$this->loadModel('Ticket'); // tblticket_book
		$this->loadModel('Cartaddons');
		$this->loadModel('Addons');
		$this->loadModel('Addonsbook');
		$this->loadModel('Cart');
		$this->loadModel('Eventdetail');
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Payment');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Questionbook');
		$this->loadModel('Cartquestiondetail');
		$this->loadModel('Currency');
		$this->loadModel('Templates');
		// pr($this->request->data); die;
		$user_id = $this->request->session()->read('Auth.User.id');
		//echo $user_id; die;
		$date = date("Y-m-d H:i:s");
		// die;
		$response_data = json_decode($this->request->data['Response']);
		$file_path = "/var/www/html/eboxtickets.com/webroot/logs/powertranz.txt";
		$log .= json_encode($this->request->data) . "\n\n";
		file_put_contents($file_path, $log, FILE_APPEND | LOCK_EX);


		//pr($response_data); die;
		$transaction_identifier = $response_data->TransactionIdentifier;
		$total_amount = $response_data->TotalAmount;
		$currency_code = $response_data->CurrencyCode;
		$cardbrand = $response_data->CardBrand;
		$repsonse_message = $response_data->ResponseMessage;
		$order_identifier  = $response_data->OrderIdentifier;
		$iso_response_code = $response_data->IsoResponseCode;
		$spi_token  = $response_data->SpiToken;

		$header = [
			'Content-Type:application/json'
		];
		//pr($response_data); die;
		//echo $iso_response_code;
		if ($iso_response_code  == "3D0") {
			$request_data = $spi_token;
			$request_json_data =   json_encode($request_data); //die;
			//echo $request_json_data; die;

			$url = PAYMENTURL . "spi/payment";
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => 0,
				CURLOPT_ENCODING => "",
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 40,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $request_json_data,
				CURLOPT_HTTPHEADER => $header
			));
			$paymentresponse = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			//}

			$logpayment_response .= json_encode($paymentresponse) . "\n\n";
			file_put_contents($file_path, $logpayment_response, FILE_APPEND | LOCK_EX);

			$payment_response =  json_decode($paymentresponse);
			// pr($payment_response); die;
			if ($payment_response->IsoResponseCode == "00") {

				$header_capture = [
					'Accept:application/json',
					'PowerTranz-PowerTranzId:' . POWERTRANZID,
					'PowerTranz-PowerTranzPassword:' . POWERTRANZPASSWORD,
					'Content-Type:application/json'
				];


				//  pr($this->request->data); die;
				$request_data = [
					"TransactionIdentifier" => $payment_response->TransactionIdentifier,
					"TotalAmount" => $payment_response->TotalAmount,
					"ExternalIdentifier" => null,
				];

				$request_json_data_capture =   json_encode($request_data); //die;
				//echo $request_json_data; die;

				$url = PAYMENTURL . "capture";
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_FOLLOWLOCATION => 0,
					CURLOPT_ENCODING => "",
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 40,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => $request_json_data_capture,
					CURLOPT_HTTPHEADER => $header_capture
				));
				$response_capture = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);


				$logpayment_capture = $response_capture . "\n\n";
				$logpayment_capture .= "===============================";
				file_put_contents($file_path, $logpayment_capture, FILE_APPEND | LOCK_EX);

				$checkout_response_capture = json_decode($response_capture);
				if ($checkout_response_capture->IsoResponseCode == 0) {
					//pr($checkout_response_capture); die;
					//order save
					$user_id = $this->request->session()->read('Auth.User.id');
					$user_check = $this->Users->get($user_id);
					$admin_fee = $this->Users->find()->where(['role_id' => 1])->first();
					$fees = $admin_fee['feeassignment'];
					$orderdata['adminfee'] = $fees;
					$orderdata['user_id'] = $user_id;
					$orderdata['total_amount'] = sprintf('%.2f', $checkout_response_capture->TotalAmount);
					$orderdata['RRN'] = $checkout_response_capture->RRN;
					$orderdata['IsoResponseCode'] = $checkout_response_capture->IsoResponseCode;
					$orderdata['OrderIdentifier'] = $checkout_response_capture->OrderIdentifier;
					$orderdata['OriginalTrxnIdentifier'] = $checkout_response_capture->OriginalTrxnIdentifier;
					$orderdata['TransactionIdentifier'] = $checkout_response_capture->TransactionIdentifier;
					$orderdata['TransactionType'] = $checkout_response_capture->TransactionType;
					$orderdata['Approved'] = $checkout_response_capture->Approved;
					//$orderdata['card_holder_name'] = $this->request->data['holdername'];
					//$orderdata['card_number'] = $this->request->data['cardnumber'];
					//$orderdata['month_year'] = $this->request->data['monthyear'];
					$orderdata['paymenttype'] = "Online";
					$orderdata['created'] = $date;

					$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);

					if ($saveorders = $this->Orders->save($insertdata)) {

						$cart_data = $this->Cart->find('all')->contain(['Event', 'Eventdetail'])->where(['Cart.user_id' => $user_id, 'Cart.status' => 'Y'])->order(['Cart.id' => 'ASC'])->toarray();

						$TotalAmount = 0;
						$ordersummary = '';
						$ordersummarywtsapp = '';
						if (!empty($cart_data)) {
							foreach ($cart_data as $key => $value) {
								$currenny = $this->Currency->get($value['event']['payment_currency']);
								$fn['user_id'] = $user_id;
								$fn['event_id'] =  $value['event_id'];
								$fn['mpesa'] = null;
								$fn['amount'] =  $value['eventdetail']['price'];
								$fn['created'] = $date;
								$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
								$this->Payment->save($payment);

								$ticketbook['order_id'] = $saveorders->id;
								$ticketbook['event_id'] = $value['event_id'];
								$ticketbook['event_ticket_id'] = $value['ticket_id'];
								$ticketbook['cust_id'] = $user_id;
								$ticketbook['ticket_buy'] = 1;
								$ticketbook['currency_rate'] = $currenny['conversion_rate'];
								$ticketbook['amount'] = $value['eventdetail']['price'];
								$ticketbook['mobile'] = $user_check['mobile'];
								$ticketbook['committee_user_id'] = $value['commitee_user_id'];
								$ticketbook['created'] = $date;
								$ticketbook['adminfee'] = $fees;
								$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
								$lastinsetid = $this->Ticket->save($insertticketbook);

								$ticketdetaildata['tid'] = $lastinsetid['id'];
								$ticketdetaildata['user_id'] = $user_id;
								$ticketdetaildata['created'] = $date;
								$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
								$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

								$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
								$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
								$ticketdetail = $this->Ticketdetail->save($Packff);

								$ticketqrimages = $this->qrcodepro($user_id, $ticketdetail['ticket_num'], $value['event']['event_org_id']);
								$Pack = $this->Ticketdetail->get($ticketdetail['id']);
								$Pack->qrcode = $ticketqrimages;
								$this->Ticketdetail->save($Pack);

								$questiondetail = $this->Cartquestiondetail->find('all')->where(['Cartquestiondetail.serial_no' => $value['serial_no']])->toarray();

								foreach ($questiondetail as $keyid => $questionreply) {
									$bookquestion['order_id'] = $saveorders['id'];
									$bookquestion['ticketdetail_id'] = $ticketdetail['id'];
									$bookquestion['question_id'] = $questionreply['question_id'];
									$bookquestion['event_id'] = $questionreply['event_id'];
									$bookquestion['user_id'] = $questionreply['user_id'];
									$bookquestion['user_reply'] = $questionreply['user_reply'];
									$bookquestion['created'] = $date;
									$savequestionbook = $this->Questionbook->patchEntity($this->Questionbook->newEntity(), $bookquestion);
									$this->Questionbook->save($savequestionbook);
								}

								$TotalAmount = $currenny['Currency_symbol'] . sprintf('%0.2f', $value['eventdetail']['price']) . ' ' . $currenny['Currency'];
								$eventname = ucwords(strtolower($value['event']['name']));
								$ticket_name = $value['eventdetail']['title'];
								$ordersummary .= '<p> <strong style="display: flex;"><span style="width: 60%; display:inline-block;font-size: 14px;font-weight: 400;">' . $eventname . ' (' . $ticket_name . ')</span><span style="width: 10%; display:inline-block;font-weight: 400;font-size: 14px;">:</span><span style="width: 30%; color:#464646; font-size:14px;font-weight: 400;">' . $TotalAmount . '</span></strong></p>';
								$ordersummarywtsapp .= '%0A %0A' . $eventname . ' (' . $ticket_name . ')' . $TotalAmount . '  %0A';
								// delete from cart
								$this->Cartquestiondetail->deleteAll(['Cartquestiondetail.serial_no' => $value['serial_no']]);
								$this->Cart->deleteAll(['Cart.id' => $value['id']]);
							}

							// send email to admin and event organiser 
							$requestername = $user_check['name'] . ' ' . $user_check['lname'];
							$url = SITE_URL . 'tickets/myticket';
							$site_url = SITE_URL;
							$paymentType = 'Online';
							$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 30])->first();
							$from = $emailtemplate['fromemail'];
							$to = $user_check['email'];
							$GrandTotalAmount = $currenny['Currency_symbol'] . sprintf('%0.2f', $checkout_response_capture->TotalAmount) . ' ' . $currenny['Currency'];
							// $cc = $from;
							$subject = $emailtemplate['subject'] . ': ' . $eventname;
							$formats = $emailtemplate['description'];

							$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{PaymentType}', '{TotalAmount}', '{OrderSummary}'), array($eventname, $requestername, $url, $site_url, $paymentType, $GrandTotalAmount, $ordersummary), $formats);

							$message = stripslashes($message1);
							$message = '<!DOCTYPE HTML>
							 <html>                
							 <head>
								 <meta http-equiv="Content-Type " content="text/html; charset=utf-8 ">
								 <title>Untitled Document</title>
								 <style>
									 p {
										 margin: 9px 0px;
									 }
								 </style>                
							 </head>                
							 <body style="background:#d8dde4; padding:15px;">' . $message1 . '</body></html>';
							$headers = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= 'From: <' . $from . '>' . "\r\n";
							if ($value['event']['id'] != 49) {

								$mail = $this->Email->send($to, $subject, $message);
								// send mail complete 

								// send watsappmessage start 
								$message = "*Eboxtickets: Payment Complete*%0AHi $requestername,%0A%0AYour payment was received for " . $ordersummarywtsapp . " ticket.%0ANo payment details were required.%0A%0ARegards,%0AEboxtickets.com";
								$numwithcode = $user_check['mobile'];
								$this->whatsappmsg($numwithcode, $message);
							}
							// send watsappmessage start 

						}
						$findaddon = $this->Cartaddons->find('all')->contain(['Addons'])->where(['Cartaddons.user_id' => $user_id, 'Cartaddons.status' => 'Y'])->order(['Cartaddons.id' => 'ASC'])->toarray();

						if (!empty($findaddon)) {

							foreach ($findaddon as $key => $addondetail) {
								$addondata['addons_id'] = $addondetail['addon_id'];
								$addondata['order_id'] = $saveorders->id;
								$addondata['price'] = $addondetail['addon']['price'];
								$addondata['created'] = $date;
								$insertaddondata = $this->Addonsbook->patchEntity($this->Addonsbook->newEntity(), $addondata);
								$this->Addonsbook->save($insertaddondata);
								$this->Cartaddons->deleteAll(['Cart.id' => $addondetail['id']]);
							}
						}
					}

					$this->Flash->success(__('Your Ticket has been booked'));
					return $this->redirect(['controller' => 'Tickets', 'action' => 'myticket']);

					// order data save end		
				} else {
					$this->Flash->error(__('Invalid Details'));
					return $this->redirect(['controller' => 'cart', 'action' => 'index']);
				}
			} else {
				$this->Flash->error(__('Something went wrong please try again'));
				return $this->redirect(['controller' => 'cart', 'action' => 'index']);
			}
		} else {
			$this->Flash->error(__('Invalid Card Details'));
			return $this->redirect(['controller' => 'cart', 'action' => 'index']);
		}
	}

	public function addonsadd($id = null)
	{
		$this->loadModel('Cartaddons');
		$user_id = $this->request->session()->read('Auth.User.id');
		if (isset($this->request->data['addon_id']) && $this->request->data['addon_count']) {
			$newaddonsadd = $this->Cartaddons->newEntity();
			$data['event_id'] = $this->request->data['event_id'];
			$data['addon_id'] = $this->request->data['addon_id'];
			$data['user_id'] = $user_id;
			$addnewaddons = $this->Cartaddons->patchEntity($newaddonsadd, $data);
			$this->Cartaddons->save($addnewaddons);
			$this->Flash->success(__('Addon has been add in your order.'));
			return $this->redirect(['action' => 'checkout']);
		} else {
			$this->Flash->error(__('Something went wrong.'));
			return $this->redirect(['action' => 'checkout']);
		}
	}

	public function cal_percentage($num_amount, $num_total)
	{
		$count1 = $num_total * $num_amount / 100;
		$count = number_format($count1, 2);
		return $count;
	}

	public function createGUID()
	{
		if (function_exists('com_create_guid')) {
			return com_create_guid();
		} else {

			mt_srand((float)microtime() * 10000);
			//optional for php 4.2.0 and up.
			$set_charid = strtoupper(md5(uniqid(rand(), true)));
			$set_hyphen = chr(45);
			$set_uuid = substr($set_charid, 0, 8) . $set_hyphen . substr($set_charid, 8, 4) . $set_hyphen . substr($set_charid, 12, 4) . $set_hyphen . substr($set_charid, 16, 4) . $set_hyphen . substr($set_charid, 20, 12);
			return $set_uuid;
		}
	}

	public function summernote()
	{
		$this->viewBuilder()->layout(false);
	}

	// public function finalcheckout($id = null)
	// {
	// 	$this->loadModel('Orders');
	// 	$this->loadModel('Ticket'); // tblticket_book
	// 	$this->loadModel('Cartaddons');
	// 	$this->loadModel('Addons');
	// 	$this->loadModel('Addonsbook');
	// 	$this->loadModel('Cart');
	// 	$this->loadModel('Eventdetail');
	// 	$this->loadModel('Event');
	// 	$this->loadModel('Users');
	// 	$this->loadModel('Payment');
	// 	$this->loadModel('Ticketdetail');
	// 	$this->loadModel('Questionbook');
	// 	$this->loadModel('Cartquestiondetail');

	// 	$user = $this->request->session()->read('Auth.User');

	// 	if ($this->request->is(['post', 'put'])) {
	// 		$user_id = $this->request->session()->read('Auth.User.id');
	// 		$user_check = $this->Users->get($user_id);
	// 		$date = date("Y-m-d h:i:s a");
	// 		//all validations start

	// 		//mobile verify validation
	// 		if ($user_check['is_mob_verify'] == 'N') {
	// 			$this->Flash->error(__('Mobile Number is not verified'));
	// 			return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
	// 			die;
	// 		}

	// 		//profile image validation
	// 		if (empty($user_check['profile_image'])) {
	// 			$this->Flash->error(__('Image Not uploaded'));
	// 			return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
	// 			die;
	// 		}

	// 		$messagesingleticket_purchase = [];
	// 		$checkalsingleticket_purchase = 0;

	// 		$messageindividualticket_purchase = [];
	// 		$checkalindividualticket_purchase = 0;

	// 		$messagesingleaddon_purchase = [];
	// 		$checkaladdon_purchase = 0;

	// 		$message_sold_out = [];
	// 		$message_sold = 0;

	// 		$cart_data = $this->Cart->find('all')->contain(['Event' => ['Currency'], 'Eventdetail'])->where(['Cart.user_id' => $user_id, 'Cart.status' => 'Y'])->order(['Cart.user_id' => 'ASC'])->toarray();
	// 		if (empty($cart_data)) {
	// 			$this->Flash->error(__('Cart value is empty'));
	// 			return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
	// 		} else {

	// 			$findaddon_cart = $this->Cartaddons->find('all')->where(['Cartaddons.user_id' => $user_id])->order(['Cartaddons.id' => 'ASC'])->toarray();

	// 			foreach ($findaddon_cart as $findaddon_value) {

	// 				$addons_data = $this->Addons->find('all')->where(['Addons.id' => $findaddon_value['addon_id']])->order(['Addons.id' => 'ASC'])->first();
	// 				$addon_count_total = $addons_data['count'];

	// 				$findaddon_cart_count = $this->Cartaddons->find('all')->where(['Cartaddons.user_id' => $user_id, 'Cartaddons.addon_id' => $findaddon_value['addon_id']])->order(['Cartaddons.id' => 'ASC'])->count();


	// 				$addons_purchase_count = $this->Addonsbook->find('all')->where(['Addonsbook.addons_id' => $findaddon_value['addon_id']])->order(['Addons.id' => 'ASC'])->count();
	// 				$total_addon_cart_count = $findaddon_cart_count + $addons_purchase_count;
	// 				//echo $total_addon_cart_count." ggg". $addon_count_total; die;
	// 				if ($total_addon_cart_count < $addon_count_total) {
	// 				} else {
	// 					$remaiingaddons  = $addon_count_total - $addons_purchase_count;
	// 					if ($remaiingaddons <= 0) {
	// 						$messagesingleaddon_purchase[] = "Addons sold out";
	// 					} else {
	// 						$messagesingleaddon_purchase[] = "You will purchase only " . $remaiingaddons . " " . $addons_data['name'];
	// 					}
	// 					$checkaladdon_purchase = 1;
	// 				}
	// 			}

	// 			foreach ($cart_data as $cart_value) {
	// 				$getevent = $this->Event->get($cart_value['event_id']);
	// 				$ticket_id = $cart_value['ticket_id'];
	// 				$ticket_limit = $getevent['ticket_limit'];
	// 				$ticketdetails = $this->Eventdetail->get($ticket_id);

	// 				if ($ticketdetails['sold_out'] == 'Y') {
	// 					$message_sold_out[] = $ticketdetails['title'] . " ticket is Sold Out";
	// 					$message_sold = 1;
	// 				}

	// 				$sale_end = date('Y-m-d h:i:s a', strtotime($getevent['sale_end']));

	// 				if (strtotime($sale_end) >= strtotime($date)) {
	// 				} else {
	// 					$this->Flash->error(__('Ticket sales for ' . $getevent['name'] . ' event are currently closed.'));
	// 					return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
	// 					die;
	// 				}

	// 				//check single event ticket count start
	// 				$check = $this->Cart->find('all')->where(['user_id' => $user_id, 'event_id' => $cart_value['event_id']])->count();

	// 				$totalticket_purchased = $this->Ticket->find('all')->select(['sum' => 'SUM(Ticket.ticket_buy)'])->where(['Ticket.event_id' => $cart_value['event_id'], 'Ticket.cust_id' => $user_id])->first();

	// 				$total_all_ticket_purchase = $totalticket_purchased['sum'] + $check;

	// 				if ($total_all_ticket_purchase <= $ticket_limit) {
	// 				} else if ($total_all_ticket_purchase >= $ticket_limit) {
	// 					$messagesingleticket_purchase[] = "You have requested more tickets than your ticket limit for this event.";
	// 					$checkalsingleticket_purchase = 1;
	// 				} else {
	// 					$messagesingleticket_purchase[] = "You have completed your limit for " . $ticketdetails['title'] . " ticket";
	// 					$checkalsingleticket_purchase = 1;
	// 				}

	// 				//check single event ticket count end

	// 				//individual ticket count start
	// 				$totalticket_purchased_individual = $this->Ticket->find('all')->select(['sum' => 'SUM(Ticket.ticket_buy)'])->where(['Ticket.event_id' => $cart_value['event_id'], 'Ticket.event_ticket_id' => $ticket_id])->first();
	// 				$total_individual_all_ticket_purchase =  $totalticket_purchased_individual['sum'];
	// 				$all_sub = $total_individual_all_ticket_purchase;

	// 				$ticketdetails_count  = $ticketdetails['count'];

	// 				if ($ticketdetails['type'] == "open_sales") {
	// 					if ($all_sub < $ticketdetails_count) {
	// 					} else {
	// 						$messageindividualticket_purchase[] = $ticketdetails['title'] . " ticket has Sold Out";
	// 						$checkalindividualticket_purchase = 1;
	// 					}
	// 				}
	// 			}
	// 		}
	// 		if ($message_sold == 1) {
	// 			$message_sold_out =  array_unique($message_sold_out);
	// 			foreach ($message_sold_out as $key => $value) {
	// 				$this->Flash->error(__($value));
	// 			}
	// 			return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
	// 		}

	// 		if ($checkaladdon_purchase == 1) {
	// 			$messagesingleaddon_purchase =  array_unique($messagesingleaddon_purchase);
	// 			foreach ($messagesingleaddon_purchase as $key => $value) {
	// 				$this->Flash->error(__($value));
	// 			}
	// 			return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
	// 		}

	// 		if ($checkalsingleticket_purchase == 1) {
	// 			$messagesingleticket_purchase =  array_unique($messagesingleticket_purchase);
	// 			foreach ($messagesingleticket_purchase as $key => $value) {
	// 				$this->Flash->error(__($value));
	// 			}
	// 			return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
	// 		}

	// 		if ($checkalindividualticket_purchase == 1) {
	// 			$messageindividualticket_purchase =  array_unique($messageindividualticket_purchase);
	// 			foreach ($messageindividualticket_purchase as $key => $value) {
	// 				$this->Flash->error(__($value));
	// 			}
	// 			return $this->redirect(['controller' => 'cart', 'action' => 'checkout']);
	// 		}

	// 		//all validation end

	// 		// pr($this->request->data);exit;
	// 		if (!empty($this->request->data['holdername'] && $this->request->data['cardnumber'] && $this->request->data['monthyear'] && $this->request->data['totalamount'])) {

	// 			$orderdata['user_id'] = $user['id'];
	// 			$orderdata['total_amount'] = $this->request->data['totalamount'];
	// 			$orderdata['card_holder_name'] = $this->request->data['holdername'];
	// 			$orderdata['card_number'] = $this->request->data['cardnumber'];
	// 			$orderdata['month_year'] = $this->request->data['monthyear'];
	// 			$orderdata['paymenttype'] = "Online";
	// 			$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);

	// 			if ($saveorders = $this->Orders->save($insertdata)) {

	// 				$cart_data = $this->Cart->find('all')->contain(['Event', 'Eventdetail'])->where(['Cart.user_id' => $user['id'], 'Cart.status' => 'Y'])->order(['Cart.id' => 'ASC'])->toarray();

	// 				if (!empty($cart_data)) {

	// 					//payment gateway setup start

	// 					//cart total price
	// 					$admin_fee = $this->Users->find()->where(['role_id' => 1])->first();
	// 					$fees = $admin_fee['feeassignment'];

	// 					$event_price_checkout = 0;
	// 					$event_price_checkout_fee = 0;
	// 					foreach ($cart_data as $key => $value) {
	// 						$event_price_checkout += $value['eventdetail']['price'];
	// 						$event_price_checkout_fee += $this->cal_percentage($fees, $cart_value['eventdetail']['price']);
	// 					}

	// 					//echo $event_price_checkout; //die;
	// 					//addons total price
	// 					$findaddon = $this->Cartaddons->find('all')->contain(['Addons'])->where(['Cartaddons.user_id' => $user['id'], 'Cartaddons.status' => 'Y'])->order(['Cartaddons.id' => 'ASC'])->toarray();
	// 					$event_price_addons = 0;
	// 					$event_price_addons_fee = 0;

	// 					foreach ($findaddon as $chck_key => $chck_addondetail) {
	// 						$event_price_addons +=  $chck_addondetail['addon']['price'];
	// 						$event_price_addons_fee +=  $this->cal_percentage($fees, $chck_addondetail['addon']['price']);
	// 					}

	// 					$cart_total_checkout =  $event_price_checkout + $event_price_checkout_fee + $event_price_addons + $event_price_addons_fee;

	// 					// pr($this->request->data); //die;
	// 					// echo $cart_total_checkout; die;
	// 					$card_holder_name = $this->request->data['holdername'];
	// 					$card_number =  $this->request->data['cardnumber'];
	// 					$card_monthyear = $this->request->data['monthyear'];
	// 					$card_cvv = '323';
	// 					$payment_checkount_response = $this->paymentcheckout($cart_total_checkout, $card_holder_name, $card_number, $card_monthyear, $card_cvv);
	// 					//payment gateway setup end
	// 					pr($payment_checkount_response);
	// 					die;
	// 					foreach ($cart_data as $key => $value) {

	// 						$fn['user_id'] = $user['id'];
	// 						$fn['event_id'] =  $value['event_id'];
	// 						$fn['mpesa'] = null;
	// 						$fn['amount'] =  $value['eventdetail']['price'];
	// 						$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
	// 						$this->Payment->save($payment);

	// 						$ticketbook['order_id'] = $saveorders->id;
	// 						$ticketbook['event_id'] = $value['event_id'];
	// 						$ticketbook['event_ticket_id'] = $value['ticket_id'];
	// 						$ticketbook['cust_id'] = $user['id'];
	// 						$ticketbook['ticket_buy'] = 1;
	// 						$ticketbook['amount'] = $value['eventdetail']['price'];
	// 						$ticketbook['mobile'] = $user['mobile'];
	// 						$ticketbook['committee_user_id'] = $value['commitee_user_id'];
	// 						$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
	// 						$lastinsetid = $this->Ticket->save($insertticketbook);


	// 						$ticketdetaildata['tid'] = $lastinsetid['id'];
	// 						$ticketdetaildata['user_id'] = $user['id'];
	// 						$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
	// 						$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

	// 						$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
	// 						$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
	// 						$ticketdetail = $this->Ticketdetail->save($Packff);

	// 						$ticketqrimages = $this->qrcodepro($user['id'], $ticketdetail['ticket_num'], $value['event']['event_org_id']);
	// 						$Pack = $this->Ticketdetail->get($ticketdetail['id']);
	// 						$Pack->qrcode = $ticketqrimages;
	// 						$this->Ticketdetail->save($Pack);

	// 						$questiondetail = $this->Cartquestiondetail->find('all')->where(['Cartquestiondetail.serial_no' => $value['serial_no']])->toarray();

	// 						foreach ($questiondetail as $keyid => $questionreply) {
	// 							$bookquestion['order_id'] = $saveorders['id'];
	// 							$bookquestion['ticketdetail_id'] = $ticketdetail['id'];
	// 							$bookquestion['question_id'] = $questionreply['question_id'];
	// 							$bookquestion['event_id'] = $questionreply['event_id'];
	// 							$bookquestion['user_id'] = $questionreply['user_id'];
	// 							$bookquestion['user_reply'] = $questionreply['user_reply'];
	// 							$savequestionbook = $this->Questionbook->patchEntity($this->Questionbook->newEntity(), $bookquestion);
	// 							$this->Questionbook->save($savequestionbook);
	// 						}
	// 						// delete from cart
	// 						$this->Cartquestiondetail->deleteAll(['Cartquestiondetail.serial_no' => $value['serial_no']]);
	// 						$this->Cart->deleteAll(['Cart.id' => $value['id']]);
	// 					}
	// 				}


	// 				if (!empty($findaddon)) {

	// 					foreach ($findaddon as $key => $addondetail) {
	// 						$addondata['addons_id'] = $addondetail['addon_id'];
	// 						$addondata['order_id'] = $saveorders->id;
	// 						$addondata['price'] = $addondetail['addon']['price'];
	// 						$insertaddondata = $this->Addonsbook->patchEntity($this->Addonsbook->newEntity(), $addondata);
	// 						$this->Addonsbook->save($insertaddondata);
	// 						$this->Cartaddons->deleteAll(['Cart.id' => $addondetail['id']]);
	// 					}
	// 				}
	// 			}


	// 			$this->Flash->success(__('Your Ticket has been booked'));
	// 			return $this->redirect(['controller' => 'Tickets', 'action' => 'myticket']);
	// 		} else {
	// 			$this->Flash->error(__('Something went wrong.'));
	// 			return $this->redirect(['action' => 'checkout']);
	// 		}
	// 	}
	// }

	public function addondelete($id = null)
	{
		$this->loadModel('Cartaddons');
		$find = $this->Cartaddons->get($id);
		if ($this->Cartaddons->delete($find)) {

			$this->Flash->success(__('Addon has been removed from your order.'));
			return $this->redirect(['action' => 'checkout']);
		} else {
			$this->Flash->error(__('Something went wrong.'));
			return $this->redirect(['action' => 'checkout']);
		}
	}

	public function cartdelete($id = null, $serial_no = null)
	{
		$this->autoRender = false;
		$this->loadModel('Cart');
		$this->loadModel('Cartquestiondetail');
		$this->loadModel('Cartaddons');
		$find = $this->Cart->get($id);

		$event_id = $find['event_id'];
		$user_id = $find['user_id'];

		$cart_data = $this->Cart->find('all')->where(['Cart.event_id' => $event_id, 'Cart.user_id' => $user_id])->order(['Cart.user_id' => 'ASC'])->count();

		if ($cart_data  == 1) {
			$this->Cartaddons->deleteAll(['Cartaddons.user_id' => $user_id, 'Cartaddons.event_id' => $event_id]);
		}
		if ($this->Cart->delete($find)) {
			$this->Cartquestiondetail->deleteAll(['Cartquestiondetail.user_id' => $find->user_id, 'Cartquestiondetail.ticket_id' => $find->ticket_id, 'Cartquestiondetail.serial_no' => $serial_no]);

			$this->Flash->success(__('Cart item has been deleted successfully.'));
			return $this->redirect(['action' => 'index']);
		} else {
			$this->Flash->error(__('Something went wrong.'));
			return $this->redirect(['action' => 'index']);
		}
	}

	public function qrcodepro($user_id, $name, $event_org_id, $packageId = null)
	{
		$dirname = 'temp';
		$PNG_TEMP_DIR = WWW_ROOT . 'qrimages' . DS . $dirname . DS;
		//$PNG_WEB_DIR = 'temp/';
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);
		$filename = $PNG_TEMP_DIR . 'EBX.png';
		if($packageId){
			$name = $user_id . "," . $name . "," . $event_org_id . "," . $packageId;
		}else{
			$name = $user_id . "," . $name . "," . $event_org_id;
		}
		
		$errorCorrectionLevel = 'M';
		$matrixPointSize = 4;

		$filename = $PNG_TEMP_DIR . 'EBX' . md5($name . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
		\QRcode::png($name, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		//display generated file
		$qrimagename = basename($filename);
		return $qrimagename;
	}
}
