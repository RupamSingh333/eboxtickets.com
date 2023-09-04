<?php

namespace App\Controller;

use App\Controller;
use Cake\Core\Configure;
use App\Controller\AppController;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Network\Email\Email;
use PHPMailer\PHPMailer\PHPMailer;
use Cake\Datasource\ConnectionManager;
use DateTimeImmutable;

include(ROOT . DS . "vendor" . DS  . "PHPMailer/" . DS . "PHPMailerAutoload.php");
include(ROOT . DS . "vendor" . DS  . "phpqrcode" . DS . "qrlib.php");

class TicketsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Email');
	}

	public function beforeFilter()
	{

		$this->Auth->allow(['qrcodeproticket', 'search', 'ticketshare']);
	}

	public function myticket()
	{
		$this->loadModel('Ticket');
		$this->loadModel('Ticketshare');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Committe');
		$date = date("Y-m-d");
		$user_id = $this->request->session()->read('Auth.User.id');
		$user_mob = $this->request->session()->read('Auth.User.mobile');
		// pr($user_mob);exit;

		// $currentticketbook = $this->Ticket->find('all')->contain(['Event','Ticketdetail'])->where(['Ticket.mobile' => $user_mob, 'Ticket.status' => 'Y'])->group(['Event.id'])->order(['Event.date_from' => 'DESC']);

		// $currentticketbook = $this->paginate($currentticketbook)->toarray();
		$currentticketbook = $this->Ticket->find('all')
			->contain(['Event', 'Ticketdetail'])
			->where(['OR' => [
				['Ticket.mobile' => $user_mob, 'Ticket.status' => 'Y'],
				['Ticket.cust_id' => $user_id, 'Ticket.status' => 'Y']
			]])
			->group(['Event.id'])
			->order(['Event.date_from' => 'DESC']);

		$currentticketbook = $this->paginate($currentticketbook)->toArray();

		// pr($currentticketbook); die;
		$this->set('currentticketbook', $currentticketbook);

		// $pastticketbook = $this->Ticket->find('all')->where(['Ticket.cust_id' => $user_id, 'Ticket.status' => 'Y'])->order(['Ticket.id' => 'DESC'])->toarray();

		// $this->set('pastticketbook', $pastticketbook);

		// $findtickets = $this->Ticketshare->find('all')->contain(['Ticket' => 'Event'])->where(['Ticketshare.share_mobile' => $user_mob])->order(['Ticketshare.id' => 'DESC'])->toarray();
		// $this->set('ticketrecived', $ticketrecived);
	}

	public function ticketdetails($event_id = null, $isPackage = null)
	{
		$this->loadModel('Ticket');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Ticketshare');
		$this->loadModel('Eventdetail');
		$this->loadModel('Event');
		$this->loadModel('Committe');
		$this->loadModel('Company');
		$this->loadModel('Countries');
		$this->loadModel('Questionbook');
		$this->loadModel('Users');
		$this->loadModel('Question');
		$this->loadModel('Package');
		$user_id = $this->request->session()->read('Auth.User.id');
		$user_mob = $this->request->session()->read('Auth.User.mobile');


		if (!empty($event_id)) {

			$event_get = $this->Event->find('all')->contain(['Company', 'Countries'])->where(['Event.id' => $event_id])->first();

			$all_tickets_details = $this->Ticketdetail->find('all')->contain(['Ticket' => 'Eventdetail', 'Questionbook' => 'Question'])->where(['Ticket.mobile' => $user_mob, 'Ticket.event_id' => $event_id, 'Ticket.status' => 'Y'])->order(['Ticketdetail.id' => 'DESC'])->toarray();


			$packageDetails = $this->Ticketdetail->find('all')->contain(['Ticket' => 'Eventdetail', 'Package'])->where(['Ticket.mobile' => $user_mob, 'Ticket.event_id' => $event_id, 'Ticket.status' => 'Y'])->order(['Ticket.id' => 'DESC'])->toArray();

			// // To find package details
			$allPackagesWithData = [];
			foreach ($packageDetails as $key => $value) {
				// pr($value);exit;
				$packageName = $value['package']['name'];
				$allPackagesWithData[$packageName][] = $value;
			}

			// pr($all_tickets_details);exit;
			$this->set('findtickets', $all_tickets_details);
			$this->set('allPackagesWithData', $allPackagesWithData);
			$this->set('event_get', $event_get);
			$this->set('isPackage', $isPackage);

			//ticket name update 
			if ($this->request->is(['post', 'put'])) {

				if (!empty($this->request->data['tid'] && !empty($this->request->data['name']))) {
					$getticketdetails = $this->Ticketdetail->get($this->request->data['tid']);
					if ($getticketdetails) {
						$getticketdetails->name = ucwords(strtolower($this->request->data['name']));
						$this->Ticketdetail->save($getticketdetails);

						$this->Flash->success(__('Name has been updated on the ticket'));
						return $this->redirect(['controller' => 'tickets', 'action' => 'ticketdetails/' . $event_id]);
					} else {
						$this->Flash->error(__('Ticket id not valide.'));
						return $this->redirect(['controller' => 'tickets', 'action' => 'ticketdetails/' . $event_id]);
					}
				}
				$this->Flash->error(__('Please fill name field'));
				return $this->redirect(['controller' => 'tickets', 'action' => 'ticketdetails/' . $event_id]);
			}
		} else {
			$this->Flash->error(__('No tickets found.'));
			return $this->redirect(['controller' => 'tickets', 'action' => 'myticket']);
		}
	}

	public function generatetic($id = null, $ticketname = null)
	{

		$this->viewBuilder()->layout('ajax');
		// $this->response->type('pdf');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$this->loadModel('Ticketshare');
		$user_name = $this->request->session()->read('Auth.User.name');
		// $ticketsharecheck = $this->Ticketshare->find('all')->where(['Ticketshare.tid' => $id])->order(['Ticketshare.id' => 'DESC'])->toarray();
		// foreach ($ticketsharecheck as $key => $value) {
		// 	$ticketsharedetails[]	= $value['ticket_num'];
		// }
		// if ($ticketsharedetails) {
		// $ticketgen = $this->Ticketdetail->find('all')->where(['Ticketdetail.tid' => $id, 'Ticketdetail.id NOT IN' => $ticketsharedetails])->contain(['Ticket' => ['Event']])->order(['Ticketdetail.id' => 'DESC'])->toarray();
		// } else {
		$ticketgen = $this->Ticketdetail->find('all')->where(['Ticketdetail.id' => $id])->contain(['Ticket' => ['Event']])->order(['Ticketdetail.id' => 'DESC'])->first();
		// }
		// pr($ticketgen);exit;
		$this->set(compact('id', 'user_name', 'ticketgen', 'ticketname'));
		// $this->set('ticketgen', $ticketgen);
	}

	public function ticketgen($id)
	{

		$this->viewBuilder()->layout('ajax');
		$this->response->type('pdf');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$this->loadModel('Ticketshare');
		$ticketsharecheck = $this->Ticketshare->find('all')->where(['Ticketshare.tid' => $id])->order(['Ticketshare.id' => 'DESC'])->toarray();
		foreach ($ticketsharecheck as $key => $value) {
			$ticketsharedetails[]	= $value['ticket_num'];
		}
		if ($ticketsharedetails) {
			$ticketgen = $this->Ticketdetail->find('all')->where(['Ticketdetail.tid' => $id, 'Ticketdetail.id NOT IN' => $ticketsharedetails])->contain(['Ticket' => ['Event']])->order(['Ticketdetail.id' => 'DESC'])->toarray();
		} else {
			$ticketgen = $this->Ticketdetail->find('all')->where(['Ticketdetail.tid' => $id])->contain(['Ticket' => ['Event']])->order(['Ticketdetail.id' => 'DESC'])->toarray();
		}
		$this->set('ticketgen', $ticketgen);
	}

	public function persnlticketgen($id)
	{

		$this->viewBuilder()->layout('ajax');
		$this->response->type('pdf');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$this->loadModel('Ticketshare');
		$this->loadModel('Users');


		$ticketgen = $this->Ticketdetail->find('all')->where(['Ticketdetail.id' => $id])->contain(['Ticket' => ['Event'], 'Ticketshare'])->order(['Ticketdetail.id' => 'DESC'])->first();
		//pr($ticketgen); die;
		$this->set('ticketgen', $ticketgen);

		$adminid = $this->Users->find('all')->where(['Users.role_id' => 1])->first();
		//pr($adminid); die;
		$this->set('adminid', $adminid);
	}

	public function search()
	{

		$this->loadModel('Ticket');
		$user_id = $this->request->session()->read('Auth.User.id');
		$req_data = $this->request->data;
		$datefrom = $req_data['date_from'];
		$dateto = $req_data['date_to'];
		$eventname1 = $req_data['eventname'];
		$eventname = trim($eventname1, " ");
		$cond = [];
		$session = $this->request->session();
		$session->delete('cond');
		if (!empty($datefrom)) {
			$cond['Event.date_from >='] = date('Y-m-d', strtotime($datefrom));
		}
		if (!empty($dateto)) {
			$cond['Event.date_to <='] = date('Y-m-d', strtotime($dateto));
		}
		if (!empty($eventname)) {
			$cond['Event.name LIKE'] = '%' . $eventname . '%';
		}

		$cond['Ticket.cust_id'] = $user_id;
		$session = $this->request->session();
		$session->write('cond', $cond);
		// pr($cond);die;
		$event_search = $this->Ticket->find('all')->contain(['Event'])->where([$cond])->order(['Ticket.id' => 'DESC'])->toarray();
		$this->set('event_search', $event_search);
	}

	public function ticketshare()
	{
		$this->loadModel('Ticketshare');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$ticketshare = $this->Ticketshare->find('all')->where(['Ticketshare.tid' => $tid])->toarray();


		if ($this->request->is(['post', 'put'])) {

			$ticketbook_ch = $this->Ticket->find('all')->where(['Ticket.id' => $this->request->data['tid']])->first();
			$data_event_qr = $this->Event->find('all')->where(['Event.id' => $ticketbook_ch['event_id']])->first();
			//pr($this->request->data);die;
			$shareticketnum[] = array();
			$ticketcounter = count($this->request->data['ticket_num']);
			$sharemobile = $this->request->data['mobile'];
			$sharedata = $this->Users->find('all')->where(['Users.mobile' => $sharemobile])->select(['email', 'name'])->first();

			for ($i = 0; $i < $ticketcounter; $i++) {

				$ticketshares = $this->Ticketshare->newEntity();
				$data['user_id'] = $this->request->data['user_id'];
				$data['tid'] = $this->request->data['tid'];
				$data['ticket_num'] = $this->request->data['ticket_num'][$i];
				$data['shareto'] = $sharedata['id'];
				$data['share_mobile'] = $this->request->data['mobile'];
				$uernewshare = $this->Users->find('all')->select(['id',])->where(['mobile' => $this->request->data['mobile']])->first();
				$ticketshares = $this->Ticketshare->patchEntity($ticketshares, $data);
				$ticketshares = $this->Ticketshare->save($ticketshares);
				//pr($ticketshares);
				$ticketqrimages = $this->qrcodeproticket($uernewshare['id'], "T" . $this->request->data['ticket_num'][$i], $data_event_qr['event_org_id']);
				$Pack = $this->Ticketshare->get($ticketshares['id']);
				$Pack->qrcode = $ticketqrimages;
				$this->Ticketshare->save($Pack);
				$event = $this->Event->find('all')->order(['Event.id' => 'DESC'])->first();
			}

			if ($event) {


				//code for email send to registred customer
				$date = $event['date_from'];
				$dates = $event['date_to'];
				$user = $this->request->session()->read('Auth.User.name');
				$name = $event['name'];
				$arr = $this->request->data['ticket_num'];
				$ticketsharenew = $this->Ticketdetail->find('all')->where(['Ticketdetail.id IN' => $arr])->toarray();

				foreach ($ticketsharenew as $key => $value) {
					$checkedtik[] = $value['ticket_num'];
				}
				$ticketnum =  implode(",", $checkedtik);

				$quantity = $ticketnum;

				$totale = $sharedata['name'];
				$location = $event['location'];

				$password = 12345;
				$this->loadmodel('Templates');
				$profile = $this->Templates->find('all')->where(['Templates.id' => TICKETSHARE])->first();
				$subject = $profile['subject'];
				$from = $this->request->session()->read('Auth.User.email');
				$fromname = "Flash Ticket";
				$to = $sharedata['email'];

				$formats = $profile['description'];
				$site_url = SITE_URL;
				$message1 = str_replace(array('{User}', '{Name}', '{Date}', '{Dates}', '{Totale}', '{Quantity}', '{Location}', '{site_url}'), array($user, $name, $date, $dates, $totale, $quantity, $location, $site_url), $formats);
				$message = stripslashes($message1);
				$message = '
							<!DOCTYPE HTML>
							<html>
							<head>
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
								<title>Mail</title>
							</head>
							<body style="padding:0px; margin:0px;font-family:Arial,Helvetica,sans-serif; font-size:13px;">
								' . $message1 . '
							</body>
							</html>
							';
				//die;

				// echo $message; die;
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'To: <' . $to . '>' . "\r\n";
				$headers .= 'From: ' . $fromname . ' <' . $from . '>' . "\r\n";
				//$headers .= 'Cc: tarun@doomshell.com' . "\r\n";
				$emailcheck = mail($to, $subject, $message, $headers);
			}

			//$tablename = TableRegistry::get("Ticketdetail"); 
			//$query = $tblticket_details->query();
			//$result = $query->update() ->set(['status' => '1']) ->where(['Ticketdetail.id' => 'tid']) ->execute();


		}

		$this->Flash->success(__('' . $ticketshares['name'] . 'Ticket has been share.'));
		return $this->redirect(['action' => 'myticket']);
	}

	public function qrcodeproticket($userid, $namess, $event_org_id)
	{
		$dirname = 'temp';
		$PNG_TEMP_DIR = WWW_ROOT . 'qrimages' . DS . $dirname . DS;
		//$PNG_WEB_DIR = 'temp/';
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);
		$filename = $PNG_TEMP_DIR . 'test.png';
		$name = $userid . "," . $namess . "," . $event_org_id;
		//$name=$name;
		$errorCorrectionLevel = 'M';
		$matrixPointSize = 4;

		$filename = $PNG_TEMP_DIR . 'test' . md5($name . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
		\QRcode::png($name, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		//display generated file
		$qrimagename = basename($filename);
		return $qrimagename;
	}

	public function checksharemobile()
	{
		$this->autoRender = false;
		$this->loadModel('Users');

		$phone = $this->request->data['mobile'];

		$user_id = $this->request->session()->read('Auth.User.id');
		//pr($user_id); die;

		$ticketda = $this->Users->find('all')->where(['Users.id' => $user_id, 'Users.mobile LIKE ' => $phone])->count();

		if ($ticketda) {
			echo json_encode(2);
			die;
		} else {

			if (!empty($phone)) {
				$check_count = $this->Users->find('all')->where(['Users.mobile LIKE ' => $phone])->count();
				echo $check_count;
				die;
			}
		}
	}

	public function ticketpopupshare($id, $event_id, $cust_id)
	{

		$cust_id = $this->request->data['custid'];
		$this->loadModel('Ticketdetail');
		$this->loadModel('Ticketshare');
		$this->loadModel('Event');
		$tiki = $this->request->session()->read('Auth.User.id');

		$ticketshare = $this->Ticketshare->find('all')->where(['Ticketshare.tid' => $id])->toarray();
		foreach ($ticketshare as $key => $value) {
			$checkedtik[] = $value['ticket_num'];
		}
		$this->set('checkedticket', $checkedtik);


		$tick = $this->Ticketdetail->find('all')->where(['Ticketdetail.tid' => $id])->order(['Ticketdetail.id' => 'ASC'])->toarray();

		$this->set('tick', $tick);
	}

	public function checkemail()
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$phone = $this->request->data['mobile'];
		if (!empty($phone)) {
			$check_count = $this->Users->find('all')->where(['Users.mobile LIKE ' => $phone])->count();
			echo $check_count;
			die;
		}
	}

	public function printticket($encodedata = null)
	{
		$decode = explode("/", base64_decode($encodedata));
		$ticketid = $decode[0];
		$ticketname = ucwords(str_replace('_', ' ', $decode[1]));
		$this->viewBuilder()->layout(false);
		$this->loadModel('Ticketdetail');

		$ticketgen = $this->Ticketdetail->find('all')->where(['Ticketdetail.id' => $ticketid])->contain(['Users', 'Ticket' => ['Event']])->order(['Ticketdetail.id' => 'DESC'])->first();
		$user_name = $ticketgen['user']['name'] . ' ' . $ticketgen['user']['lname'];
		$this->set(compact('id', 'user_name', 'ticketgen', 'ticketname'));
	}
	public function printalltickets($orderid = null)
	{
		$this->viewBuilder()->layout(false);

		$this->loadModel('Ticket');
		$this->loadModel('Orders');
		$this->loadModel('Addonsbook');
		$this->loadModel('Event');
		$orderid_eventid = explode("/", base64_decode($orderid));
		$orderid = $orderid_eventid[0];
		$event_id = $orderid_eventid[1];

		$orders = $this->Ticket->find('all')->contain(['Ticketdetail', 'Event', 'Orders' => ['Users'], 'Eventdetail'])->where(['Ticket.event_id' => $event_id, 'Ticket.order_id' => $orderid])->toarray();
		// pr($event_id);exit;
		// $single_order = $this->Orders->find('all')->where(['Orders.id' => $orderid])->contain(['Users'])->order(['Orders.id' => 'DESC'])->first();
		// $addons_order = $this->Addonsbook->find('all')->contain(['Addons'])->where(['Addonsbook.order_id' => $orderid])->order(['Addonsbook.id' => 'DESC'])->toarray();
		$event = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $event_id])->first();

		$this->set('order_id', $orderid);
		// $this->set('single_order', $single_order);
		// $this->set('addons_order', $addons_order);
		$this->set('orders', $orders);
		$this->set('event', $event);
	}

	public function savesingleticketname()
	{
		$this->loadModel('Ticketdetail');
		if ($this->request->is(['post', 'put'])) {
			// pr($this->request->data);exit;
			if (!empty($this->request->data['ticket_id'] && !empty($this->request->data['ticketholdername']))) {
				$getticketdetails = $this->Ticketdetail->get($this->request->data['ticket_id']);
				if ($getticketdetails) {
					$getticketdetails->name = ucwords(strtolower($this->request->data['ticketholdername']));
					$this->Ticketdetail->save($getticketdetails);
					echo json_encode('Name has been updated on the ticket');
					die;
				}
			} else {
				echo json_encode('Somthing went wrong !.');
				die;
			}
		}
	}

	//enable rsvp on the ticket
	// public function isrsvp()
	// {
	// 	$this->loadModel('Ticketdetail');
	// 	$this->loadModel('Ticket');
	// 	$this->loadModel('Event');
	// 	$this->loadModel('Attendeeslist');
	// 	$user_id = $this->request->session()->read('Auth.User.id');
	// 	if ($this->request->is(['post', 'put'])) {

	// 		$params = explode("/", $this->request->data['ticketId']);

	// 		$id = $params[0];
	// 		$rsvp = ($params[1] == 'N') ? 'Y' : 'N';
	// 		$eventid = $params[2];
	// 		if (!empty($eventid)) {
	// 			$attendeesupadate = $this->Attendeeslist->get($id);
	// 			if ($attendeesupadate) {
	// 				$attendeesupadate->is_rsvp = $rsvp;
	// 				$this->Attendeeslist->save($attendeesupadate);
	// 				if ($rsvp == 'Y') {
	// 					echo json_encode('RSVP has been Accepted Successfully');
	// 					die;
	// 				} else {
	// 					echo json_encode('RSVP has been Declined Successfully');
	// 					die;
	// 				}
	// 			}
	// 		} else if (!empty($id && $params[1] == 0)) {
	// 			$getticketdetails = $this->Ticket->get($id);
	// 			$event = $this->Event->get($getticketdetails['event_id']);

	// 			$geTicktes = $this->Ticket->find('all')->contain(['Ticketdetail'])->where(['Ticket.event_id' => $getticketdetails['event_id'], 'Ticket.cust_id' => $getticketdetails['cust_id']])->toarray();

	// 			$currentTime = date("Y-m-d H:i:s");
	// 			$request_rsvp = date('Y-m-d H:i:s', strtotime($event['request_rsvp']));

	// 			// pr($currentTime);
	// 			// pr($request_rsvp);exit;

	// 			if ($currentTime <= $request_rsvp) {

	// 				foreach ($geTicktes as $key => $value) {
	// 					$ticketdetails = $this->Ticketdetail->get($value['ticketdetail'][0]['id']);
	// 					$updatersvp = ($ticketdetails->is_rsvp == 'N') ? 'Y' : 'N';
	// 					$ticketdetails->is_rsvp = $updatersvp;
	// 					$this->Ticketdetail->save($ticketdetails);
	// 				}

	// 				if ($updatersvp == 'Y') {
	// 					echo json_encode('RSVP has been Accepted Successfully');
	// 					die;
	// 				} else {
	// 					echo json_encode('RSVP has been Declined Successfully');
	// 					die;
	// 				}
	// 			} else {
	// 				$data = ['message' => 'The time has elapsed to Accept the RSVP Invitation', 'status' => 'danger'];
	// 				echo json_encode($data);
	// 				die;
	// 			}
	// 			// if ($event['ticket']['event']['event_org_id'] != $user_id) {
	// 			// }


	// 		} else {
	// 			echo json_encode('Somthing went wrong !.');
	// 			die;
	// 		}
	// 	}
	// }
	//enable rsvp on the ticket Rupam
	public function isrsvp()
	{
		$this->loadModel('Attendeeslist');
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Ticketdetail');
		$this->autoRender = false;

		$userId = (int) $this->request->getSession()->read('Auth.User.id');

		if (!$this->request->is(['post', 'put'])) {
			return;
		}

		$ticketId = $this->request->getData('ticket_id');
		if (empty($ticketId)) {
			echo json_encode('Something went wrong!');
			return;
		}

		[$id, $rsvp, $eventId] = explode('/', $ticketId) + [null, null, null];

		if (!empty($eventId)) {
			$attendee = $this->Attendeeslist->get($id);
			if (!$attendee) {
				echo json_encode(['message' => 'Something went wrong! try after some time', 'status' => 'danger']);
				return;
			}
			$attendee->is_rsvp = ($rsvp == 'N') ? 'Y' : 'N';
			$this->Attendeeslist->save($attendee);
			echo json_encode('RSVP has been ' . (($rsvp == 'N') ? 'Declined' : 'Accepted') . ' Successfully');
			return;
		}

		if (!empty($id) && $rsvp == '0') {
			$ticket = $this->Ticket->get($id);

			$event = $this->Event->get($ticket->event_id);
			$ticketdetails = $this->Ticket->find()->contain(['Ticketdetail'])->where(['Ticket.event_id' => $ticket->event_id, 'Ticket.cust_id' => $ticket->cust_id])->order(['Ticket.id' => 'DESC'])->toarray();

			// use DateTimeImmutable; add this library top of the controller
			$currentTime = new DateTimeImmutable();
			$requestRsvpTime = new DateTimeImmutable($event->request_rsvp);
			// pr($currentTime);
			// pr($requestRsvpTime);exit;

			if ($currentTime > $requestRsvpTime) {
				echo json_encode(['message' => 'The time has elapsed to accept the RSVP invitation', 'status' => 'danger']);
				return;
			}
			$statusget = '';
			foreach ($ticketdetails as $key => $ticketDetail) {

				$getTic = $this->Ticketdetail->get($ticketDetail['ticketdetail'][0]->id);
				$statusget = $ticketDetail['ticketdetail'][0]['is_rsvp'];

				$getTic->is_rsvp = ($statusget == 'Y') ? 'N' : 'Y';
				$this->Ticketdetail->save($getTic);
			}

			echo json_encode('RSVP has been ' . (($statusget == 'Y') ? 'Declined' : 'Accepted') . ' Successfully');
			return;
		}

		echo json_encode(['message' => 'Something went wrong! try after some time', 'status' => 'danger']);
		return;
	}

	// delete free ticket particular user
	public function deleteticket()
	{
		$this->loadModel('Users');
		$this->loadModel('Templates');
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Attendeeslist');
		$this->loadModel('Orders');

		$event_id = $this->request->data['event_id'];
		$user_id = $this->request->data['user_id'];
		$attendees = $this->request->data['attendees'];

		try {
			$this->Ticket->getConnection()->begin();
			$getTickets = $this->Ticket->find('all')->contain(['Ticketdetail'])->where(['Ticket.event_id' => $event_id, 'Ticket.cust_id' => $user_id])->toArray();

			if ($attendees == 'A') {
				$this->Attendeeslist->deleteAll(['Attendeeslist.id' =>  $user_id]);
			} else if ($getTickets) {
				// pr($getTickets);exit;
				foreach ($getTickets as $key => $ticket) {

					$filepath = '/var/www/html/eboxticket/webroot/qrimages/temp/' . $ticket['ticketdetail'][0]['qrcode'];
					if (file_exists($filepath)) {
						if (unlink($filepath)) {
							// File deleted successfully
						} else {
							// Unable to delete fil
						}
					} else {
						// File does not exist
					}

					$this->Ticket->delete($this->Ticket->get($ticket['id']));
					$this->Ticketdetail->delete($this->Ticketdetail->get($ticket['ticketdetail'][0]['id']));
					// if ($key === 0) {
					// 	$this->Orders->delete($this->Orders->get($ticket['order_id']));
					// }
				}
			} else {
				throw new \Exception('No ticket found');
			}

			$this->Ticket->getConnection()->commit();
			echo json_encode('Ticket has been deleted successfully.');
		} catch (\Exception $e) {
			$this->Ticket->getConnection()->rollback();
			echo json_encode('Error: ' . $e->getMessage());
		}
		die;
	}

	public function saveimagedata()
	{
		$this->viewBuilder()->layout(false);

		$this->loadModel('Ticketdetail');

		$ticketgen = $this->Ticketdetail->find('all')->where(['Ticketdetail.id' => $this->request->data['ticket_id']])->contain(['Ticket' => ['Event']])->order(['Ticketdetail.id' => 'DESC'])->first();
		$this->set(compact('ticketgen'));
	}

	public function uploadticketimage()
	{

		$imagefilename = $this->request->data['imageNameHere']['name'];
		if ($imagefilename) {
			$itemww = $this->request->data['imageNameHere']['tmp_name'];
			// $ext = pathinfo($imagefilename, PATHINFO_EXTENSION);
			// $name = time() . md5($imagefilename);
			$imagename = $this->request->data['ticketqr'];
			if (move_uploaded_file($itemww, "eventticketimages/" . $imagename)) {
				$this->request->data['feat_image'] = $imagename;
			}
			pr($this->request->data);
			die;
		}
	}
}
