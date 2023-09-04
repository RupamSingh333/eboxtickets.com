<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\View\CommanHelper;
use Cake\View\Exception\MissingTemplateException;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Network\Email\Email;
use Cake\Datasource\ConnectionManager;
use Cake\Validation\Validator;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
include(ROOT . DS . "vendor" . DS  . "phpqrcode" . DS . "qrlib.php");

class EventController extends AppController
{

	public  function _setPassword($password)
	{
		return (new DefaultPasswordHasher)->hash($password);
	}

	public function index($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Eventdetail');
		$this->loadModel('Users');
		$this->loadModel('Currency');
		$this->viewBuilder()->layout('admin');

		// if ($id == "all") {
		// 	$this->request->session()->delete('req_data');
		// 	return $this->redirect(['action' => 'index']);
		// }

		$req_data = $this->request->getQueryParams();
		if (!empty($req_data)) {
			$req_data = $this->request->session()->read("req_data");
			$datefrom = $req_data['date_from'];
			$dateto = $req_data['date_to'];
			$eventname1 = $req_data['eventname'];
			$Organiser = $req_data['orgasiger'];
			$eventname = trim($eventname1, " ");
			$cond = [];
		} else {
			// $this->request->session()->delete('req_data');
			// return $this->redirect(['action' => 'index']);
		}

		$session = $this->request->session();
		$session->delete('cond');
		if (!empty($datefrom)) {
			$cond['DATE(Event.date_from) >='] = date('Y-m-d', strtotime($datefrom));
		}

		if (!empty($dateto)) {
			$cond['DATE(Event.date_to) <='] = date('Y-m-d', strtotime($dateto));
		}
		if (!empty($eventname)) {
			$cond['Event.name LIKE'] = '%' . $eventname . '%';
			$this->set('eventname', $eventname);
		}
		if (!empty($Organiser)) {
			$cond['Users.name LIKE'] = '%' . $Organiser . '%';
			$this->set('Organiser', $Organiser);
		}

		$admin_info = $this->Users->get(1);

		if (!empty($cond)) {
			$event_array = $this->Event->find('all')->where([$cond, 'Event.status !=' => 'D', 'Users.status' => 'Y'])->contain(['Eventdetail', 'Users', 'Currency'])->order(['Event.id' => 'DESC']);
		} else {
			$event_array = $this->Event->find('all')->where(['Event.status !=' => 'D', 'Users.status' => 'Y'])->contain(['Eventdetail', 'Users', 'Currency'])->order(['Event.id' => 'DESC']);
		}

		$event = $this->paginate($event_array)->toarray();
		$this->set('event', $event);
		$this->set('admin_info', $admin_info);

		if ($this->request->is(['post', 'put'])) {
			// pr($this->request->data);exit;
			if (!empty($this->request->data['forFreeEvent']) && !empty($this->request->data['forPaidEvent'])) {
				$admin_info->forFreeEvent = $this->request->data['forFreeEvent'];
				$admin_info->forPaidEvent = $this->request->data['forPaidEvent'];
			} else if (!empty($this->request->data['forPaidEvent'])) {
				$admin_info->forPaidEvent = $this->request->data['forPaidEvent'];
				$admin_info->forFreeEvent = 'N';
			} else if (!empty($this->request->data['forFreeEvent'])) {
				$admin_info->forFreeEvent = $this->request->data['forFreeEvent'];
				$admin_info->forPaidEvent = 'N';
			} else if (empty($this->request->data['forFreeEvent']) && empty($this->request->data['forPaidEvent'])) {
				$admin_info->forFreeEvent = 'N';
				$admin_info->forPaidEvent = 'N';
			}
			$this->Users->save($admin_info);
			$this->Flash->success(__('Approval setting update successfully'));
		}
	}

	public function search()
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$admin_info = $this->Users->get(1);
		$req_data = $this->request->data;
		$this->request->session()->write('req_data', $req_data);
		$datefrom = $req_data['date_from'];
		$dateto = $req_data['date_to'];
		$eventname1 = $req_data['eventname'];
		$Organiser = $req_data['orgasiger'];
		$eventname = trim($eventname1, " ");
		$cond = [];

		$session = $this->request->session();
		$session->delete('cond');
		if (!empty($datefrom)) {
			$cond['DATE(Event.date_from) >='] = date('Y-m-d', strtotime($datefrom));
		}
		if (!empty($dateto)) {
			$cond['DATE(Event.date_to) <='] = date('Y-m-d', strtotime($dateto));
		}
		if (!empty($eventname)) {
			$cond['Event.name LIKE'] = '%' . $eventname . '%';
			$this->set('eventname', $eventname);
		}
		if (!empty($Organiser)) {
			$cond['Users.name LIKE'] = '%' . $Organiser . '%';
			$this->set('Organiser', $Organiser);
		}
		if (empty($cond)) {
			return false;
		}

		$session = $this->request->session();
		$session->write('cond', $cond);

		$event_search = $this->Event->find('all')->contain(['Eventdetail', 'Users'])->where([$cond])->order(['Event.id' => 'DESC']);

		$event_search = $this->paginate($event_search)->toarray();
		$this->set('event_search', $event_search);
		$this->set('admin_info', $admin_info);
	}

	public function export()
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->viewBuilder()->setLayout('admin');
		$admin_info = $this->Users->get(1);
		$session = $this->request->getSession();
		$event = $session->read('cond');
		if ($event) {
			$order = $this->Event->find('all')->contain(['Eventdetail', 'Users', 'Currency'])->where([$event])->order(['Event.id' => 'DESC'])->toArray();
		} else {
			$order = $this->Event->find('all')->where(['Event.status !=' => 'D', 'Users.status' => 'Y'])->contain(['Eventdetail', 'Users', 'Currency'])->order(['Event.id' => 'DESC'])->toArray();
		}
		$output = "";
		$output .= 'Organiser,';
		$output .= 'Event-Name,';
		$output .= 'Date From,';
		$output .= 'Date To,';
		$output .= 'Venue,';
		$output .= 'Total Sales,';
		$output .= 'Comm(' . $admin_info['feeassignment'] . '%),';
		$output .= 'Video-Url,';
		$output .= 'Status,';
		$output .= "\n";
		$commission = 0;
		$totalAmount = 0;
		foreach ($order as $value) {
			$totalAmount = $this->Ticket->find()->select(['totalAmount' => 'SUM(Ticket.amount)'])
				->where(['Ticket.event_id' => $value['id']])->first();

			if ($value['currency']['Currency'] && ($totalAmount['totalAmount'] != 0)) {
				$commission = "$ " . $totalAmount['totalAmount'] * $admin_info['feeassignment'] / 100 . ' ' . $value['currency']['Currency'];
				$totalAmount = "$ " . $totalAmount['totalAmount'] . ' ' . $value['currency']['Currency'];
			} else {
				$totalAmount = "$ 0 USD";
				$commission = "$ 0 USD";
			}


			$output .= $value["user"]["name"] . ",";
			$output .= str_replace(',', ' ', $value["name"]) . ",";
			$output .= date('d M Y h:i A', strtotime($value['date_from'])) . ",";
			$output .= date('d M Y h:i A', strtotime($value['date_to'])) . ",";
			$output .= str_replace(',', ' ', $value["location"]) . ",";
			$output .= $totalAmount . ",";
			$output .= $commission . ",";
			$output .= $value["video_url"] . ",";
			$output .= $value["status"] . ",";
			$output .= "\r\n";
		}
		$filename = "Event_" . date('d-m-Y') . ".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename=' . $filename);
		echo $output;
		die;
		$session->delete('cond');
		$this->redirect($this->referer());
	}

	public function getstaff($id)
	{

		$this->loadModel('Users');
		$this->loadModel('Event');

		$getemployee = $this->Users->find('all')->where(['Users.parent_id' => $id])->order(['Users.id' => 'DESC']);
		$destination = $this->paginate($getemployee)->toarray();
		// pr($destination);exit;
		$this->set('employee', $destination);
		
	}

	public function eventdetail($id)
	{
		$this->loadModel('Event');
		$this->loadModel('Eventdetail');
		$this->loadModel('Currency');
		$this->viewBuilder()->layout('admin');
		$evntdetail =  $this->Event->find('all')->contain(['Eventdetail', 'Currency'])->where(['Event.id' => $id])->first();
		// pr($evntdetail);die;
		$this->set('evntdetail', $evntdetail);
	}

	public function seatcheck()
	{
		$this->loadModel('Event');

		$eventid = $this->request->data['id'];
		$seatnumber = $this->request->data['seat'];
		$eventseatcheck = $this->Event->find('all')->where(['Event.id' => $eventid])->first();
		if ($eventseatcheck['no_of_seats'] >= $seatnumber) {

			echo 0;
			die;
		} else {
			echo 1;
			die;
		}
	}

	public function add()
	{

		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->viewBuilder()->layout('admin');
		$uid = $this->Auth->user('id');

		$country = $this->Countries->find('list', [
			'keyField' => 'id',
			'valueField' => 'CountryName'
		])->where(['status' => 'Y'])->toArray();

		$company = $this->Company->find('list', [
			'keyField' => 'id',
			'valueField' => 'name'
		])->where(['status' => 'Y'])->toArray();

		$this->set('country', $country);
		$this->set('company', $company);

		$event_org_list = $this->Users->find('list')->where(['Users.status' => 'Y', 'Users.role_id' => 2])->order(['Users.created' => 'ASC'])->toarray();
		$this->set('event_org_list', $event_org_list);
		$addevent = $this->Event->newEntity();
		$this->request->data['name'] = ucwords($this->request->data['name']);
		if ($this->request->is(['post', 'put'])) {
			$date_from = str_replace("/", "-", $this->request->data['date_from']);
			$this->request->data['date_from'] = date('Y-m-d H:i:s', strtotime($date_from));
			$date_to = str_replace("/", "-", $this->request->data['date_to']);
			$this->request->data['date_to'] = date('Y-m-d H:i:s', strtotime($date_to));
			$imagefilename = $this->request->data['feat_image']['name'];
			$imagefiletype = $this->request->data['feat_image']['type'];
			$item = $this->request->data['feat_image']['tmp_name'];
			$ext =  end(explode('.', $imagefilename));
			$name = md5(time($imagefiletype));
			$imagename = $name . '.' . $ext;
			$this->request->data['feat_image'] = $imagename;
			$this->request->data['status'] = 'Y';
			if (move_uploaded_file($item, "images/eventimages" . $imagename)) {
				$this->request->data['feat_image'] = $imagename;
			}

			$addevent = $this->Event->patchEntity($addevent, $this->request->data);

			if ($addevent = $this->Event->save($addevent)) {

				$price = $this->request->data['price'];
				for ($i = 0; $i < count($price); $i++) {
					$pro_details = $this->Eventdetail->newEntity();
					$saveDetail['userid'] = $uid;
					$saveDetail['eventid'] = $addevent['id'];
					$saveDetail['title'] = $this->request->data['title'][$i];
					$saveDetail['price'] = $this->request->data['price'][$i];
					$saveDetail['quantity'] = $this->request->data['quantity'][$i];

					$event_detail = $this->Eventdetail->patchEntity($pro_details, $saveDetail);
					$result = $this->Eventdetail->save($event_detail);
					if ($result) {
						$result = $this->Event->save($event_detail);
					} else {
					}
				}

				require_once 'Firebase.php';
				require_once 'Push.php';
				$_POST['title'] = 'New Event Added in Flashticket';
				$_POST['text'] = $addevent['name'];
				$push = null;
				$push = new \Push(
					$_POST['title'],
					$_POST['text']
				);
				//getting the push from push object
				$mPushNotification = $push->getPush();

				$device = $this->Users->find('all')->where(['Users.token IS NOT' => NULL])->toarray();
				foreach ($device as $devicetok) {
					$toke[] = $devicetok['token'];
				}

				//creating firebase class object 
				$firebase = new \Firebase();

				//sending push notification and displaying result 
				$firebase->send($toke, $mPushNotification);

				$this->Flash->success(__('' . ucwords($addevent['name']) . ' has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
		}
	}

	public function viewsold($id = null)
	{

		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$this->loadModel('Ticketdetail');
		//pr($this->request->data); die;
		$user_id = $this->request->session()->read('Auth.User.id');

		$comptickets = $this->Ticket->find('all')->contain(['Ticketdetail', 'Users'])->where(['Ticket.event_id' => $id, 'Ticket.event_admin' => '0'])->toarray();
		//pr($comptickets); die;
		$this->set('comptickets', $comptickets);
	}

	// Add Complementary user ticket...
	public function viewcomp($id = null)
	{

		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$this->loadModel('Ticketdetail');
		//pr($this->request->data); die;
		$user_id = $this->request->session()->read('Auth.User.id');

		$comptickets = $this->Ticket->find('all')->contain(['Ticketdetail', 'Users'])->where(['Ticket.event_id' => $id, 'Ticket.event_admin' => '1'])->toarray();
		//pr($comptickets); die;
		$this->set('comptickets', $comptickets);
	}

	// Add Complementary user ticket...
	public function addcomp($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$this->loadModel('Ticketdetail');
		if ($this->request->is(['post', 'put'])) {
			//pr($this->request->data); die;
			$user_id = $this->request->session()->read('Auth.User.id');
			//pr($user_id); die;
			$ticketda = $this->Event->find('all')->where(['Event.id' => $id])->first();
			$ticketdata = $this->Ticket->find('all')->where(['event_id' => $id, 'mobile' => $this->request->data['mobile']])->first();
			//pr($ticketda); die;
			$existsuser = $this->Users->find('all')->where(['mobile' => $this->request->data['mobile']])->first();

			if ($ticketdata) {
				$this->Flash->error(__('Ticket already share to this user'));
				return $this->redirect(['action' => 'index']);
			} else {
				if ($existsuser == '') {
					$existsuseremailid = $this->Users->find('all')->where(['email' => $this->request->data['email']])->count();
					if ($existsuseremailid > 0) {
						$this->Flash->error(__('Email id or mobile number already exists'));
						return $this->redirect(['action' => 'index']);
					}
					$customeruser = $this->Users->newEntity();
					$user_data['name'] = $this->request->data['name'];
					$user_data['email'] = $this->request->data['email'];
					$user_data['mobile'] = $this->request->data['mobile'];
					$user_data['role_id'] = CUSTOMERROLE;
					$ranpassword = $this->randomPassword();
					$user_data['confirm_pass'] = $ranpassword;
					$user_data['password'] = $this->_setPassword($ranpassword);
					$customeruser = $this->Users->patchEntity($customeruser, $user_data);
					/*sending email start */
					$this->loadmodel('Templates');
					$profile = $this->Templates->find('all')->where(['Templates.id' => ORGANISER])->first();
					$subject = $profile['subject'];
					$from = $profile['from'];
					$fromname = $profile['fromname'];
					$name = $customeruser['name'];
					$email = $customeruser['email'];
					$password = $customeruser['confirm_pass'];
					$to  = $email;
					$formats = $profile['description'];
					$site_url = SITE_URL;
					$message1 = str_replace(array('{Name}', '{Email}', '{Password}', '{site_url}', '{Useractivation}'), array($name, $email, $password, $site_url), $formats);
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

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: ' . $fromname . ' <' . $from . '>' . "\r\n";
					$emailcheck = mail($to, $subject, $message, $headers);
					/*   sending email end */
					$customeruser = $this->Users->save($customeruser);
					$profess = $this->Users->find('all')->where(['id' => $customeruser['id']])->first();
				} else {

					$profess = $this->Users->find('all')->where(['id' => $existsuser['id']])->first();
				}

				if ($profess) {


					//pr($this->request->data); die;
					$ticketbook = $this->Ticket->newEntity();
					$customerdata = $this->Users->find('all')->where(['id' => $setuserdata])->first();

					$this->request->data['cust_id'] = $profess['id'];
					$this->request->data['event_id'] = $id;
					$this->request->data['event_admin'] = 1;
					$ticketbook = $this->Ticket->patchEntity($ticketbook, $this->request->data);
					$ticketbook = $this->Ticket->save($ticketbook);
					$lastticketid = $ticketbook->id;

					if ($ticketbook) {

						$ticketdetail = $this->Ticketdetail->newEntity();
						$ticketdata = $this->Ticket->find('all')->where(['id' => $lastticketid])->first();
						$this->request->data['tid'] = $ticketdata['id'];
						$this->request->data['user_id'] = $this->request->data['cust_id'];

						$ticketdetail = $this->Ticketdetail->patchEntity($ticketdetail, $this->request->data);
						$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

						$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
						$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
						$ticketdetail = $this->Ticketdetail->save($Packff);
						$ticketqrimages = $this->qrcodepro($this->request->data['cust_id'], $ticketdetail['ticket_num']);
						$Pack = $this->Ticketdetail->get($ticketdetail['id']);
						$Pack->qrcode = $ticketqrimages;
						$this->Ticketdetail->save($Pack);


						$event = $this->Event->find('all')->where(['Event.id' => $this->request->data['event_id']])->contain(['Users'])->order(['Event.id' => 'DESC'])->first();
						$date = $event['date_from'];
						$dates = $event['date_to'];
						$user = $this->request->session()->read('Auth.User.name');
						$name = $event['name'];
						$location = $event['location'];
						$password = $ranpassword;
						$this->loadmodel('Templates');
						$profile = $this->Templates->find('all')->where(['Templates.id' => TICKETCOMPLI])->first();
						$subject = $profile['subject'];
						$from = $profile['from'];
						$fromname = $profile['fromname'];
						$to  = $this->request->data['email'];
						$formats = $profile['description'];
						$site_url = SITE_URL;
						$message1 = str_replace(array('{User}', '{Name}', '{Date}', '{Dates}', '{Totale}', '{Quantity}', '{Location}', '{Password}', '{site_url}'), array($user, $name, $date, $dates, $location, $password, $site_url), $formats);
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
						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: ' . $fromname . ' <' . $from . '>' . "\r\n";
						$emailcheck = mail($to, $subject, $message, $headers);
					}

					$this->Flash->success(__('Complementary ticket has been shared'));
					return $this->redirect(['action' => 'index']);
					//return $this->redirect(['controller' => 'tickets','action'=>'myticket/'.$this->request->data['event_id']]);			

				} else {
					$this->Flash->error(__('Sorry your ticket not booked Check Mpesa !!!'));
					return $this->redirect(['action' => 'index']);
				}
			}
		}
	}

	public function qrcodepro($user_id, $name)
	{
		$dirname = 'temp';
		$PNG_TEMP_DIR = WWW_ROOT . 'qrimages' . DS . $dirname . DS;
		//$PNG_WEB_DIR = 'temp/';
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);
		$filename = $PNG_TEMP_DIR . 'test.png';
		$name = $user_id . "," . $name;
		$errorCorrectionLevel = 'M';
		$matrixPointSize = 4;

		$filename = $PNG_TEMP_DIR . 'test' . md5($name . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
		\QRcode::png($name, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		//display generated file
		$qrimagename = basename($filename);
		return $qrimagename;
	}

	public function randomPassword()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 6; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	public function edit($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->viewBuilder()->layout('admin');
		$uid = $this->Auth->user('id');

		$country = $this->Countries->find('list', [
			'keyField' => 'id',
			'valueField' => 'CountryName'
		])->where(['status' => 'Y'])->toArray();

		$company = $this->Company->find('list', [
			'keyField' => 'id',
			'valueField' => 'name'
		])->where(['status' => 'Y'])->toArray();

		$this->set('country', $country);
		$this->set('company', $company);


		$evntdetail = $this->Event->find('all')->contain(['Eventdetail'])->where(['Event.id' => $id])->order(['Event.id' => 'DESC'])->first();
		$this->set('evntdetail', $evntdetail);

		$event_org_list = $this->Users->find('list')->where(['Users.status' => 'Y', 'Users.role_id' => 2])->order(['Users.created' => 'ASC'])->toarray();
		$this->set('event_org_list', $event_org_list);
		$event = $this->Event->get($id);
		$this->set('event', $event);
		$event_user = $event['event_org_id'];
		$event_organizer = $this->Users->find('all')->where(['Users.status' => 'Y', 'Users.role_id' => 2, 'Users.id' => $event_user])->first();
		$this->set('event_organizer', $event_organizer);
		if ($this->request->is(['post', 'put'])) {
			//pr($this->request->data);die;
			$this->Eventdetail->deleteAll(['Eventdetail.eventid' => $id]);

			$date_from = str_replace("/", "-", $this->request->data['date_from']);
			$this->request->data['date_from'] = date('Y-m-d H:i:s', strtotime($date_from));
			//$this->request->data['date_from']=date('Y-m-d H:i:s',strtotime($date_from));
			$date_to = str_replace("/", "-", $this->request->data['date_to']);
			$this->request->data['date_to'] = date('Y-m-d H:i:s', strtotime($date_to));
			//pr($this->request->data);die;
			$imagefilename = $this->request->data['feat_image']['name'];
			$item = $this->request->data['feat_image']['tmp_name'];
			$ext =  end(explode('.', $imagefilename));
			$name = md5(time($filename));
			$imagename = $name . '.' . $ext;
			if (!empty($imagefilename)) {

				$this->request->data['feat_image'] = $imagename;
				if (move_uploaded_file($item, "imagess/" . $imagename)) {
					$this->request->data['feat_image'] = $imagename;
				}
			} else {
				$this->request->data['feat_image'] = $event->feat_image;
			}
			$event = $this->Event->patchEntity($event, $this->request->data);
			//pr($event); die;
			if ($editevent = $this->Event->save($event)) {

				$price = $this->request->data['price'];
				//pr($price); die;
				//echo count($price); die;
				for ($i = 0; $i < count($price); $i++) {
					$pro_details = $this->Eventdetail->newEntity();
					$saveDetail['userid'] = $uid;
					$saveDetail['eventid'] = $editevent['id'];
					$saveDetail['title'] = $this->request->data['title'][$i];
					$saveDetail['price'] = $this->request->data['price'][$i];
					$saveDetail['quantity'] = $this->request->data['quantity'][$i];


					$event_detail = $this->Eventdetail->patchEntity($pro_details, $saveDetail);
					//pr($event_detail); die;
					$result = $this->Eventdetail->save($event_detail);
				}


				$this->Flash->success(__('' . ucwords($event['name']) . ' has been updated Successfully.'));
				return $this->redirect(['action' => 'index']);
			}
		}
	}

	public function delete($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Eventdetail');
		$event_data = $this->Event->get($id);
		$evntid = $event_data['id'];
		$eventinfo = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $evntid])->toarray();
		if ($eventinfo) {
			if (count($eventinfo) > 0) {
				foreach ($eventinfo as $key => $value) {
					$this->Eventdetail->deleteAll(['Eventdetail.id' => $value['id']]);
				}
			}
		}
		$ticketTable = TableRegistry::get('Ticket');
		$exists = $ticketTable->exists(['event_id' => $event_data['id']]);
		if ($exists) {
			$this->Flash->error(__('' . ucwords($event_data['name']) . ' has not been deleted because this event have entry in some manager'));
			return $this->redirect($this->referer());
		} else {
			if ($this->Event->delete($event_data)) {
				$this->Flash->success(__('' . ucwords($event_data['name']) . ' has been deleted successfully.'));
				return $this->redirect($this->referer());
			}
		}
	}

	public function findevent()
	{
		$id = $this->request->data['id'];
		$this->loadModel('Users');
		$this->viewBuilder()->layout('admin');
		$event_org = $this->Users->find('all')->select(['Users.email', 'Users.mobile'])->where(['Users.id' => $id])->first();
		if ($event_org) {
			echo json_encode($event_org);
		} else {
			$event_org['success'] = 0;
			echo json_encode($event_org);
		}
		die;
	}

	public function uploadimage()
	{
		//pr($this->request->data);die;
		$errorImgFile = "./img/img_upload_error.jpg";
		$temp = explode(".", $_FILES["file"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		$destinationFilePath = SITE_URL . 'imagess/' . $newfilename;
		if (!move_uploaded_file($_FILES['file']['tmp_name'], "imagess/" . $newfilename)) {
			echo $errorImgFile;
		} else {
			echo $destinationFilePath;
		}
		die;
	}

	public function event_info($id = null)
	{
		//print_r($id); die; 
		$this->loadModel('Event');
		$event_data = $this->Event->find('all')->contain(['Users'])->where(['Event.id' => $id])->order(['Event.id' => 'DESC'])->first();
		$this->set('event_data', $event_data);
	}


	public function status($id, $status)
	{
		$this->loadModel('Event');
		//pr($status);die;
		if (isset($id) && !empty($id)) {
			$event_org = $this->Event->get($id);
			$event_org->admineventstatus = $status;
			$event_org->status = $status;
			//$event_org->featured = $status;
			if ($this->Event->save($event_org)) {
				$this->Flash->success(__('' . ucwords($event_org['name']) . ' status has been updated.'));
				return $this->redirect($this->referer());
			}
		}
	}

	public function featuredstatus($id, $status)
	{
		$this->loadModel('Event');
		$this->autoRender = false;
		//pr($status);die;
		if (isset($id) && !empty($id)) {
			$event_org = $this->Event->get($id);
			$event_org->featured = $status;
			$this->Event->save($event_org);
			return $this->redirect($this->referer());
		}
	}

	public function venue($id = null)
	{
		/*$this->loadModel('Event');
            $venue_detail = $this->Event->get($id);
            $this->set('venue_detail', $venue_detail);*/
	}

	public function organiser_search()
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$stsearch = $this->request->data['fetch'];
		$usest = array(
			'Users.name LIKE' => $stsearch . '%',
			'Users.status' => 'Y',
			'Users.role_id !=' => 1
		);
		$searchst = $this->Users->find('all', array('conditions' => $usest));

		foreach ($searchst as $value) {
			echo '<li onclick="searchbck(' . "'" . $value['name'] . "'" . ',' . "'" . $value['id'] . "'" . ')"><a href="#">' . $value['name'] . '</a></li>';
		}

		die;
	}
}
