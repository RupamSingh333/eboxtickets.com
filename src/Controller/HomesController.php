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
use LDAP\Result;
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

class HomesController extends AppController
{


	public  function _setPassword($password)
	{
		return (new DefaultPasswordHasher)->hash($password);
	}


	public function beforeFilter(Event $event)
	{
		$this->loadComponent('Email');
		$this->Auth->allow(['contactus', 'privacy', 'mpesaonline', 'mpesaonlinestatus', 'index', 'checkticket', 'upcomingevent', 'dashboardmyevent', 'pastevent', 'posteventsec', 'eventdetail', 'bookticket', 'loctions', 'usersearch', 'upcomingeventsearch', 'aboutus', 'contact', 'faq', 'mpesacheck', 'addcomp', 'viewcomp', 'findticketdetail', 'postevents', 'committee', 'company', 'page1', 'page2', 'page3', 'page4']);
		$this->loadComponent('Email');
	}

	public function contactus()
	{
		$this->loadModel('Users');
		$this->loadModel('Contactus');
		$this->loadmodel('Templates');

		if ($this->request->is(['post', 'put'])) {

			if (isset($_POST['g-recaptcha-response'])) {
				$captcha = $_POST['g-recaptcha-response'];
			}
			$secretKey = "6LeB9HAiAAAAAP7Dp8Km2ozGm42nFObhMTXA7syu";
			$ip = $_SERVER['REMOTE_ADDR'];
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
			$response = file_get_contents($url);
			$responseKeys = json_decode($response, true);
			if ($responseKeys["success"]) {
			} else {

				$this->Flash->error(__('Captcha entry is incorrect, try again'));
				return $this->redirect(['action' => 'contactus']);
			}

			$contact_new = $this->Contactus->newEntity();
			$this->request->data['name'] = ucwords(strtolower($this->request->data['name']));
			$this->request->data['email'] = $this->request->data['email'];
			$this->request->data['event'] = $this->request->data['event'];
			$this->request->data['subject'] = $this->request->data['subject'];
			$this->request->data['description'] = ucwords(strtolower($this->request->data['description']));
			$contact = $this->Contactus->patchEntity($contact_new, $this->request->data);

			if ($res = $this->Contactus->save($contact)) {
				$profile = $this->Templates->find('all')->where(['Templates.id' => 25])->first();
				$subject = $profile['subject'];
				$from = $profile['from'];
				$fromname = $profile['fromname'];
				$name = $res['name'];
				$email = $res['email'];
				$to  = $email;
				$formats = $profile['description'];
				$message1 = str_replace(array('{Name}', '{Email}', '{Event}', '{Subject}', '{Description}'), array($name, $this->request->data['email'], $this->request->data['event'], $this->request->data['subject'], $this->request->data['description']), $formats);

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
				$mail = $this->Email->send($to, $subject, $message);
				$this->Flash->success(__('Thanks for reaching out to us. We will contact you as soon as possible'));
				return $this->redirect(['controller' => 'homes', 'action' => 'contactus']);
			} else {
				$this->Flash->error(__('Contactus form not submit something error.'));
				return $this->redirect(['controller' => 'homes', 'action' => 'contactus']);
			}
		}
	}
	public function privacy()
	{
	}

	public function dashboard()
	{
	}
	/**
	 * Displays a view
	 *
	 * @param array ...$path Path segments.
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
	 */

	/*   Home function start */

	public function mpesaonline($mobilenew = '', $businesscode = '')
	{
		/*
		$this->autoRender=false;

		$user_mobile=$mobilenew;
		$customer_phone =$user_mobile;
		$accountno ="test";
		$transactiondesc = "Test Payment Transaction";
		$amount= '1';
		//$business_code= '372222'; 
		$business_code= $businesscode;
		$curl_post_data = array(
		//Fill in the request parameters with valid values
		'customer_phone' => ''.$customer_phone.'',
		'accountno' => ''.$accountno.'',
		'transactiondesc' => ''.$transactiondesc.'',
		'amount' => ''.$amount.'',
		'business_code' => ''.$business_code.''
			);                            
		$data_string = json_encode($curl_post_data);
		//echo $data_string; echo "<br>";
		$username='MPesaSTK';
		$password='STK@2019!#';
		$url = 'https://198.154.230.163/~coopself/mpesastkapi/index.php';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($curl, CURLOPT_USERPWD, $username . ":" .$password);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // ask for results to De retrained
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		$curl_response =  curl_exec($curl);
		$curl_response = strip_tags($curl_response);
		$character = json_decode($curl_response);

		if($character->CheckoutRequestID){
		$check = $this->mpesaonlinestatus($character->CheckoutRequestID,$business_code);
		if($check==0){
		return false;
		}else{
		return true;
		}
		}else{
		return false;
		}
		*/
	}

	public function mpesaonlinestatus($mobilenew = '', $totalamt = '')
	{
		$this->autoRender = false;

		$customer_phone = $mobilenew;
		$accountno = $mobilenew;
		$transactiondesc = "Flashticket Payment Transaction";
		$amount = $totalamt;
		$business_code = '372222';
		$curl_post_data = array(
			//Fill in the request parameters with valid values
			'customer_phone' => '' . $customer_phone . '',
			'accountno' => '' . $accountno . '',
			'transactiondesc' => '' . $transactiondesc . '',
			'amount' => '' . $amount . '',
			'business_code' => '' . $business_code . ''
		);
		$data_string = json_encode($curl_post_data);
		$username = 'MPesaSTK';
		$password = 'STK@2019!#';
		$url = 'http://flashticket.co-opselfservice.com/mpesastkapi/index.php';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // ask for results to De retrained
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		$curl_response =  curl_exec($curl);
		//echo $curl_response; die;
		if ($curl_response) {
			return true;
		} else {
			return false;
		}
	}

	public function index()
	{

		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Countries');
		$date = date("Y-m-d");
		$admin_info = $this->Users->get(1);

		$upcoming_event = $this->Event->find('all')->contain(['Countries', 'Company'])->where(['Event.date_to >=' => $date, 'Event.status' => 'Y', 'Event.admineventstatus' => 'Y'])->order(['Event.date_to' => 'ASC'])->limit('15')->group(['Event.date_to' => 'MONTH(Event.date_to)'])->toarray();
		// pr($upcoming_event);exit;

		$slider_event = $this->Event->find('all')->contain(['Countries', 'Company'])->where(['Event.date_to >=' => $date, 'Event.status' => 'Y', 'Event.featured' => 'Y', 'Event.admineventstatus' => 'Y'])->order(['Event.date_to' => 'ASC'])->toarray();
		
		$this->set('event', $upcoming_event);
		$this->set(compact('slider_event','admin_info'));
		
		// $upcoming_event = $this->Event->find('all')->where(['Event.date_to >=' => $date, 'Event.status' => 'Y', 'Event.featured' => 'Y'])->contain(['Users'])->order(['Event.id' => 'DESC'])->limit('3')->toarray();
		// pr($upcoming_event);exit;

		// $date = date("Y-m-d H:i:s");
		// $upcoming_event_details = $this->Event->find('all')->where(['Event.date_to >=' => $date, 'Event.status' => 'Y'])->contain(['Users'])->order(['Event.id' => 'DESC'])->limit('3')->toarray();
		// $this->set('eventupcoming', $upcoming_event_details);


		// $trem = $this->Users->find('all')->where(['Users.role_id' => 1])->order(['Users.id' => 'DESC'])->first();
		// $this->set('trem', $trem);


	}

	//Search events
	public function usersearch()
	{
		$this->loadModel('Event');
		$this->loadModel('Countries');
		$this->loadModel('Event');
		$date = date("Y-m-d");
		$eventserach = trim($this->request->data['search']);

		if (!empty($this->request->data['search'])) {
			$upcoming_event = $this->Event->find('all')->contain(['Countries', 'Company'])->where(['Event.name LIKE' => '%' . trim($this->request->data['search']) . '%', 'Event.date_to >=' => $date, 'Event.status' => 'Y', 'Event.admineventstatus' => 'Y'])->order(['Event.date_to' => 'ASC'])->group(['Event.date_to' => 'MONTH(Event.date_to)'])->toarray();
			// pr($upcoming_event);exit;
		} else {
			$upcoming_event = $this->Event->find('all')->contain(['Countries', 'Company'])->where(['Event.date_to >=' => $date, 'Event.status' => 'Y', 'Event.admineventstatus' => 'Y'])->order(['Event.date_to' => 'ASC'])->group(['Event.date_to' => 'MONTH(Event.date_to)'])->toarray();
		}

		$this->set('event', $upcoming_event);
		$this->set('eventsearch', $eventserach);
	}

	public function checkticket()
	{
	}

	public function upcomingevent()
	{


		$query = $this->request->query['search'];
		//pr($query);die;
		$this->set('keyword', $this->request->query['search']);
		$this->loadModel('Event');
		$event = $this->Event->find('all')->where(['Event.name LIKE' => '%' . $query . '%'])->order(['Event.id' => 'DESC'])->first();
		//pr($event );die;
		$this->set('event', $event);
	}

	public function findticketdetail()
	{
		$this->loadModel('Eventdetail');
		$this->loadModel('Ticket');

		$ids = $this->request->data['evntid'];
		$ticketid = $this->request->data['id'];

		$event_org = $this->Eventdetail->find('all')->select(['price', 'quantity'])->where(['Eventdetail.id' => $ticketid])->first();
		$this->set('event_org', $event_org);
		//pr($event_org); die;
		if ($event_org) {
			echo json_encode($event_org);
		} else {
			$event_org['success'] = 0;
			echo json_encode($event_org);
		}
		die;
	}

	public function findquantitydetail()
	{
		$this->loadModel('Eventdetail');
		$this->loadModel('Ticket');

		$ids = $this->request->data['evntid'];
		$ticketid = $this->request->data['id'];

		$user_balance = $this->Ticket->find();
		$res = $user_balance->select(['sum' => $user_balance->func()->sum('Ticket.ticket_buy')])->where(['Ticket.event_ticket_id' => $ticketid])->first();
		$total = $res->sum; //your total sum result

		$event_org = $this->Eventdetail->find('all')->select(['quantity'])->where(['Eventdetail.id' => $ticketid])->first();
		$totalquntity = $event_org['quantity'];

		$eventall = $totalquntity - $total;
		//pr($ticketid); die;
		//$eventall = $this->Ticket->find('all')->select(['ticket_buy'])->where(['Ticket.event_ticket_id' =>$ticketid])->toarray();

		$this->set('eventall', $eventall);
		if ($eventall) {
			echo json_encode($eventall);
		} else {
			$eventall['success'] = 0;
			echo json_encode($eventall);
		}
		die;
	}

	public function seatcheck()
	{
		$this->loadModel('Event');

		$eventid = $this->request->data['id'];
		$seatnumber = $this->request->data['seat'];
		$eventseatcheck = $this->Event->find('all')->where(['Event.id' => $eventid])->order(['Event.id' => 'DESC'])->first();
		if ($eventseatcheck['no_of_seats'] >= $seatnumber) {

			echo 0;
			die;
		} else {
			echo 1;
			die;
		}
	}

	public function checkemail()
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$name = $this->request->data['name'];
		$email = $this->request->data['email'];
		$phone = $this->request->data['mobile'];

		//pr($check_count); die;
		if (!empty($email)) {
			$check_count = $this->Users->find('all')->where(['Users.email LIKE ' => $email])->count();
			echo $check_count;
			die;
		}
		if (!empty($phone)) {
			$check_count = $this->Users->find('all')->where(['Users.mobile LIKE ' => $phone])->count();
			echo $check_count;
			die;
		}
	}

	//Post event step - 3
	public function ticketdetails($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->loadModel('Addons');
		$user_id = $this->request->session()->read('Auth.User.id');

		if (!empty($id)) {
			$session = $this->request->session();
			$session->delete('ticketdetails');
			$eventDetails = $this->Event->find('all')->contain('Eventdetail')->where(['Event.id' => $id])->first();
			// pr($eventDetails);exit;
			$addons = $this->Addons->find('all')->where(['event_id' => $id, 'status' => 'Y'])->toarray();
			$this->set('addons', $addons);
			$this->set('eventDetails', $eventDetails);
			$this->set('getId', $id);
		}

		$company = $this->Company->find('list', [
			'keyField' => 'id',
			'valueField' => 'name'
		])->where(['status' => 'Y'])->toArray();

		$this->set('company', $company);

		if ($this->request->is(['post', 'put'])) {

			$request_data = $this->request->data;
			// pr($request_data);exit;
			$session = $this->request->session();
			$session->write('ticketdetails', $request_data);
			if ($id) {
				return $this->redirect(['action' => 'questions/' . $id]);
			} else {

				return $this->redirect(['action' => 'questions']);
			}
		}
	}

	//Post event step - 4
	public function questions($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->loadModel('Question');
		$user_id = $this->request->session()->read('Auth.User.id');

		if (!empty($id)) {
			$session = $this->request->session();
			$session->delete('questions');
			$eventDetails = $this->Eventdetail->find('all')->contain('Question')->where(['Eventdetail.eventid' => $id])->toarray();
			// pr($eventDetails);exit;
			$this->set('eventDetails', $eventDetails);
			$this->set('getId', $id);
		}

		$company = $this->Company->find('list', [
			'keyField' => 'id',
			'valueField' => 'name'
		])->where(['status' => 'Y'])->toArray();

		$this->set('company', $company);

		if ($this->request->is(['post', 'put'])) {

			// pr($this->request->data);exit;
			$session = $this->request->session();
			$session->write('questions', $this->request->data);
			if ($id) {
				return $this->redirect(['action' => 'committee/' . $id]);
			} else {

				return $this->redirect(['action' => 'committee']);
			}
		}
	}

	public function committee($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->loadModel('Question');
		$user_id = $this->request->session()->read('Auth.User.id');

		if ($this->request->is(['post', 'put'])) {
			$session = $this->request->session();
			$session->write('questions', $this->request->data);
			if ($id) {
				return $this->redirect(['action' => 'settings/' . $id]);
			} else {
				return $this->redirect(['action' => 'settings']);
			}
		}
	}

	//Post event complete step - 5
	public function settings($id = null)
	{

		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->loadModel('Question');
		$this->loadModel('Addons');

		$user_id = $this->request->session()->read('Auth.User.id');

		$company = $this->Company->find('list', [
			'keyField' => 'id',
			'valueField' => 'name'
		])->where(['status' => 'Y'])->toArray();

		$this->set('company', $company);

		if (isset($id) && !empty($id)) {
			$session = $this->request->session();
			$session->delete('settings');
			// $addevent = $this->Event->get($id);
			$eventDetails = $this->Event->find('all')->contain('Eventdetail')->where(['Event.id' => $id])->first();
			$this->set('getId', $id);
			$this->set('eventDetails', $eventDetails);
		} else {
			$addevent = $this->Event->newEntity();
		}

		if ($this->request->is(['post', 'put'])) {

			$session = $this->request->session();
			$session->write('settings', $this->request->data);
			$event_details['event_org_id'] = $user_id;
			$event_details['name'] =  ucfirst(strtolower($_SESSION['postevent']['name']));
			$event_details['desp'] = $_SESSION['postevent']['desp'];
			$event_details['date_from'] = date('Y-m-d H:i:s', strtotime($_SESSION['postevent']['date_from']));
			$event_details['date_to'] = date('Y-m-d H:i:s', strtotime($_SESSION['postevent']['date_to']));
			$event_details['feat_image'] = $_SESSION['postevent']['feat_image'];
			$event_details['featured'] = 'Y';
			$event_details['location'] = $_SESSION['postevent']['location'];
			$event_details['company_id'] = $_SESSION['postevent']['company_id'];
			$event_details['country_id'] = $_SESSION['postevent']['country_id'];
			$event_details['slug'] = SITE_URL . 'event/' . $_SESSION['postevent']['slug'];
			// $event_details['hidden_homepage'] = $_SESSION['postevent']['hidden_homepage'];
			// $event_details['hidden_company'] = $_SESSION['postevent']['hidden_company'];
			// $event_details['online_payments'] = $_SESSION['postevent']['online_payments'];
			// $event_details['committee_payment'] = $_SESSION['postevent']['committee_payments'];
			$event_details['ticket_limit'] = $_SESSION['settings']['ticket_limite'];
			$event_details['approve_timer'] = $_SESSION['settings']['approve_timer'];
			$event_details['sale_start'] = date('Y-m-d H:i:s', strtotime($_SESSION['settings']['sale_start']));
			$event_details['sale_end'] = date('Y-m-d H:i:s', strtotime($_SESSION['settings']['sale_end']));
			//Event data save
			$addeventdata = $this->Event->patchEntity($addevent, $event_details);

			if ($addeventsave = $this->Event->save($addeventdata)) {

				// Questions Save 
				if (!empty($_SESSION['questions']['type'])) {

					$newquestion = $this->Question->newEntity();
					$question_details['type'] = $_SESSION['questions']['type'][0];
					$question_details['event_id'] = $addeventsave['id'];
					$question_details['name'] = ucfirst(strtolower($_SESSION['questions']['name'][0]));
					$question_details['question'] = ucfirst(strtolower($_SESSION['questions']['question'][0]));
					$question_details['items'] = implode(',', $_SESSION['questions']['items']);
					$newquestion_save = $this->Question->patchEntity($newquestion, $question_details);
					$result3 = $this->Question->save($newquestion_save);
				}

				// Ticket details save 
				if ($result3) {
					$question_id = $result3->id;
				}

				foreach ($_SESSION['ticketdetails']['title'] as $key => $value) {

					if ($_SESSION['questions']['ticketquestion'][$key] == $value) {
						$ticket_details['question_id'] = $question_id;
					}

					$pro_details = $this->Eventdetail->newEntity();
					$ticket_details['userid'] = $user_id;
					$ticket_details['eventid'] = $addeventsave['id'];
					$ticket_details['title'] = ucfirst(strtolower($value));
					$ticket_details['type'] = $_SESSION['ticketdetails']['type'][$key];
					$ticket_details['price'] = $_SESSION['ticketdetails']['price'][$key];
					$ticket_details['count'] = $_SESSION['ticketdetails']['count'][$key];
					$ticket_details['hidden'] = $_SESSION['ticketdetails']['hidden'][$key];
					$event_detail = $this->Eventdetail->patchEntity($pro_details, $ticket_details);
					$result1 = $this->Eventdetail->save($event_detail);
				}

				// Addons save 
				if (!empty($_SESSION['ticketdetails']['addon_name'])) {

					foreach ($_SESSION['ticketdetails']['addon_name'] as $key => $addon_value) {

						$newaddons = $this->Addons->newEntity();
						$addons_details['event_id'] = $addeventsave['id'];
						$addons_details['name'] = ucfirst(strtolower($_SESSION['ticketdetails']['addon_name'][$key]));
						$addons_details['price'] = $_SESSION['ticketdetails']['addon_price'][$key];
						$addons_details['count'] = $_SESSION['ticketdetails']['addon_count'][$key];
						$addons_details['hidden'] = $_SESSION['ticketdetails']['addon_hidden'][$key];
						$addons_details['description'] = ucfirst(strtolower($_SESSION['ticketdetails']['addon_desc'][$key]));

						$event_detail = $this->Addons->patchEntity($newaddons, $addons_details);
						$result2 = $this->Addons->save($event_detail);
					}
				}
			}
			$this->Flash->success(__('' . $addeventsave['name'] . ' has been saved.'));
			return $this->redirect(['action' => 'myevent']);
		}
	}
	public function page1($id = null)
	{
	}

	public function page2($id = null)
	{
	}

	public function page3($id = null)
	{
	}

	public function page4($id = null)
	{
	}

	public function company($id = null)
	{

		$this->loadModel('Company');
		$user_id = $this->request->session()->read('Auth.User.id');
		if ($this->request->is(['post', 'put'])) {

			if (!empty($this->request->data['name'])) {
				$addcompany = $this->Company->newEntity();
				$reqData['user_id'] = $user_id;
				$reqData['name'] = $this->request->data['name'];
				$savecompany = $this->Company->patchEntity($addcompany, $reqData);
				$savecompany = $this->Company->save($savecompany);
				$this->Flash->success(__('' . $savecompany['name'] . ' has been saved.'));
				return $this->redirect(['controller' => 'event', 'action' => 'postevent']);
			}
			$this->Flash->error(__('Please enter company name'));
			return $this->redirect(['controller' => 'event', 'action' => 'postevent']);
		}
	}

	public function vieweventdet($id = null)
	{
	}

	//Post Event start 
	public function posteventbackup($id = null)
	{

		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$user_id = $this->request->session()->read('Auth.User.id');

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

		if (isset($id) && !empty($id)) {

			$addevent = $this->Event->get($id);
		} else {

			$addevent = $this->Event->newEntity();
		}

		$this->request->data['name'] = ucwords($this->request->data['name']);

		if ($this->request->is(['post', 'put'])) {
			pr($this->request->data);
			exit;
			$this->Eventdetail->deleteAll(['Eventdetail.eventid' => $id]);

			$this->request->data['event_org_id'] = $user_id;
			$this->request->data['date_from'] = date('Y-m-d H:i:s', strtotime($this->request->data['date_from']));
			$this->request->data['date_to'] = date('Y-m-d H:i:s', strtotime($this->request->data['date_to']));
			$imagefilename = $this->request->data['feat_image']['name'];
			if ($imagefilename) {
				$imagefiletype = $this->request->data['feat_image']['type'];
				$item = $this->request->data['feat_image']['tmp_name'];
				$ext =  end(explode('.', $imagefilename));
				$name = md5(time() . $item);
				$imagename = $name . '.' . $ext;
				$this->request->data['feat_image'] = $imagename;
				if (move_uploaded_file($item, IMAGE_PATH . $imagename)) {
					$this->request->data['feat_image'] = $imagename;
				}
			} else {
				$this->request->data['feat_image'] = $addevent['feat_image'];
			}

			$addevent = $this->Event->patchEntity($addevent, $this->request->data);

			if ($addevent = $this->Event->save($addevent))

				$record_id = $addevent->id;
			$this->loadmodel('Templates');

			$profile = $this->Templates->find('all')->where(['Templates.id' => EVENTADD])->first();



			$user = $this->Users->find('all')->order(['Users.id' => 'ASC'])->toarray();
			$subject = $profile['subject'];
			$from = $profile['from'];
			$fromname = $profile['fromname'];
			$eventname = $addevent['name'];
			$name =  $this->request->session()->read('Auth.User.name');

			$date = $addevent['date_from'];
			$dates = $addevent['date_to'];
			$seats = $addevent['no_of_seats'];
			$price = $addevent['amount'];
			$address = $addevent['location'];
			$to = $user[0]['email'];
			$to1 = $this->request->session()->read('Auth.User.email');
			$url = SITE_URL . "homes/eventdetail/" . $record_id;
			$formats = $profile['description'];
			$site_url = SITE_URL;
			$message1 = str_replace(array('{EventName}', '{Name}', '{Date}', '{Dates}', '{Seats}', '{Price}', '{Address}', '{site_url}', '{Url}'), array($eventname, $name, $date, $dates, $seats, $price, $address, $site_url, $url), $formats);
			$message = stripslashes($message1);
			//echo $message ; die;
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
			';	//die;
			// echo $message; die;
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ' . $fromname . ' <' . $from . '>' . "\r\n";
			$emailcheck = mail($to, $subject, $message, $headers);
			$emailcheck = mail($to1, $subject, $message, $headers);
			/*   sending email end */ {
				$price = $this->request->data['price'];
				for ($i = 0; $i < count($price); $i++) {
					$pro_details = $this->Eventdetail->newEntity();
					$saveDetail['userid'] = $user_id;
					$saveDetail['eventid'] = $addevent['id'];
					$saveDetail['title'] = $this->request->data['title'][$i];
					$saveDetail['price'] = $this->request->data['price'][$i];
					$saveDetail['quantity'] = $this->request->data['quantity'][$i];


					$event_detail = $this->Eventdetail->patchEntity($pro_details, $saveDetail);
					//pr($event_detail); die;
					$result = $this->Eventdetail->save($event_detail);
				}


				$this->Flash->success(__('' . $addevent['name'] . ' has been saved.'), 3000);

				return $this->redirect(['action' => 'myevent']);
			}
		}
		$this->set('addevent', $addevent);
	}

	//Post event end

	//Event name keyword search in fee report
	public function loctions()
	{
		$this->loadModel('Event');
		//pr($this->request->data); die;
		//pr($this->request->data); die;
		$stsearch = $this->request->data['fetch'];
		//pr($stsearch);die;
		$i = $this->request->data['i'];
		$usest = array('Event.name LIKE' => $stsearch . '%', 'Event.status' => 'Y', 'Event.admineventstatus' => 'Y');
		$searchst = $this->Event->find('all', array('conditions' => $usest));
		foreach ($searchst as $value) {
			echo '<li onclick="cllbck(' . "'" . $value['name'] . "'" . ',' . "'" . $value['id'] . "'" . ',' . "'" . $i . "'" . ')"><a href="#">' . $value['name'] . '</a></li>';
		}

		die;
	}

	public function bookticket()
	{
		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Eventdetail');
		if ($this->request->is(['post', 'put'])) {
			//pr($this->request->data); die;
			$user_id = $this->request->session()->read('Auth.User.id');
			//pr($user_id); die;
			$eventid = $this->request->data['event_id'];
			$data_event_qr = $this->Event->find('all')->where(['Event.id' => $eventid])->first();

			$ticketda = $this->Event->find('all')->where(['Event.id' => $eventid, 'Event.event_org_id' => $user_id])->first();
			//pr($ticketda); die;
			if ($ticketda) {
				$this->Flash->error(__('Event organiser not able to buy his own event ticket.'));
				return $this->redirect(['controller' => 'homes', 'action' => 'eventdetail/' . $this->request->data['event_id']]);
			} else {
				$userTable = TableRegistry::get('Users');
				if ($user_id == '') {
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
					//pr($profess); die;
					$this->Auth->setUser($profess);
				} else {
					$user_id = $this->request->session()->read('Auth.User.id');
					$profess = $this->Users->find('all')->where(['id' => $user_id])->first();
				}
				/*
				if($this->request->data['mobile']){
				$user_mobile = $this->request->data['mobile'];
				//$user_mobile = "254721491491";
				}else{
				//$user_mobile = "254721491491";
				$user_mobile=$this->request->session()->read('Auth.User.mobile');
				}
				$chekc = $this->mpesaonlinestatus($user_mobile,$this->request->data['totalamt']);

				*/


				//$connection = ConnectionManager::get('db2'); 
				//$connectmpesa =$connection->execute("SELECT count(*) as res, amount FROM `transactions_573314` WHERE MPESA_REF_ID='".$this->request->data['code']."'")->fetch('assoc');
				if ($profess) {
					$this->loadModel('Payment');
					$paymentnew = $this->Payment->newEntity();
					$amount = $eve['amount'] * $quantity;
					$fn['user_id'] = $profess['id'];
					$fn['event_id'] = $this->request->data['event_id'];
					$fn['mpesa'] = $this->request->data['code'];
					$fn['amount'] = $connectmpesa['amount'];
					$payment = $this->Payment->patchEntity($paymentnew, $fn);
					$payment = $this->Payment->save($payment);

					//pr($this->request->data); die;
					$ticketbook = $this->Ticket->newEntity();
					$customerdata = $this->Users->find('all')->where(['id' => $setuserdata])->first();
					//pr($customerdata); die;
					// $ticketdataa= $this->Eventdetail->find('all')->order(['Eventdetail.id']=>DESC)->first();
					// pr($ticketdata); die;
					$romm = $this->request->data['ticket_buy'];
					$this->request->data['cust_id'] = $profess['id'];
					$this->request->data['event_id'] = $this->request->data['event_id'];
					$this->request->data['ticket_buy'] = $this->request->data['ticket_buy'];
					$this->request->data['amount'] = $this->request->data['totalamt'];
					$ticketbook = $this->Ticket->patchEntity($ticketbook, $this->request->data);
					$ticketbook = $this->Ticket->save($ticketbook);
					$lastticketid = $ticketbook->id;
					if ($ticketbook) {
						for ($i = 1; $i <= $romm; $i++) {
							$ticketdetail = $this->Ticketdetail->newEntity();
							$ticketdata = $this->Ticket->find('all')->where(['id' => $lastticketid])->first();
							$this->request->data['tid'] = $ticketdata['id'];
							$this->request->data['user_id'] = $this->request->data['cust_id'];
							$ticketdetail = $this->Ticketdetail->patchEntity($ticketdetail, $this->request->data);
							$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);
							$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
							$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
							$ticketdetail = $this->Ticketdetail->save($Packff);
							$ticketqrimages = $this->qrcodepro($this->request->data['cust_id'], $ticketdetail['ticket_num'], $data_event_qr['event_org_id']);
							$Pack = $this->Ticketdetail->get($ticketdetail['id']);
							$Pack->qrcode = $ticketqrimages;
							$this->Ticketdetail->save($Pack);
						}
						$event = $this->Event->find('all')->where(['Event.id' => $this->request->data['event_id']])->contain(['Users'])->order(['Event.id' => 'DESC'])->first();
						$date = $event['date_from'];
						$dates = $event['date_to'];
						$user = $this->request->session()->read('Auth.User.name');
						$name = $event['name'];
						$quantity = $ticketcustomer['ticket_buy'];
						$totale = $ticketdetailvvv['totalamt'];
						$location = $event['location'];
						$password = $ranpassword;
						$this->loadmodel('Templates');
						$profile = $this->Templates->find('all')->where(['Templates.id' => PURCHASE])->first();
						$subject = $profile['subject'];
						$from = $profile['from'];
						$fromname = $profile['fromname'];
						$to  = $this->request->session()->read('Auth.User.email');
						$formats = $profile['description'];
						$site_url = SITE_URL;
						$message1 = str_replace(array('{User}', '{Name}', '{Date}', '{Dates}', '{Totale}', '{Quantity}', '{Location}', '{Password}', '{site_url}'), array($user, $name, $date, $dates, $totale, $quantity, $location, $password, $site_url), $formats);
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

					// $mobile = $this->request->data['mobile'];
					// $customer_phone = '254' . substr($mobile, 1);
					// $transactiondesc = "Flashticket Payment Transaction";
					// $amount = $this->request->data['totalamt'];
					// $business_code = '372222';

					// $curl_post_data = array(
					// 	//Fill in the request parameters with valid values
					// 	'customer_phone' => '' . $customer_phone . '',
					// 	'accountno' => '' . $mobile . '',
					// 	'transactiondesc' => '' . $transactiondesc . '',
					// 	'amount' => '' . $amount . '',
					// 	'business_code' => '' . $business_code . ''
					// );

					// $data_string = json_encode($curl_post_data);
					// //echo $data_string; echo "<br>";

					// $username = "MPesaSTK";
					// $password = "STK@2019!#";
					// $url = 'https://198.154.230.163/~coopself/mpesastkapi/index.php';
					// $curl = curl_init();
					// curl_setopt($curl, CURLOPT_URL, $url);
					// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					// curl_setopt($curl, CURLOPT_POST, true);
					// curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
					// curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
					// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ask for results to be returned
					// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
					// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
					// $curl_response = curl_exec($curl);

					$tt = "#event_tkt_dtl";

					$this->Flash->success(__('Your request to pay KES' . $this->request->data['totalamt'] . ' for eboxtickets event for ' . $this->request->data['name'] . ' has been successfully received. You will be taken to MPESA Shortly on your phone'));
					return $this->redirect(['controller' => 'tickets', 'action' => 'myticket']);
					//return $this->redirect(['controller' => 'tickets','action'=>'myticket/'.$this->request->data['event_id']]);			

				} else {
					$this->Flash->error(__('Sorry your ticket not booked Check Mpesa !!!'));
					return $this->redirect(['controller' => 'homes', 'action' => 'eventdetail/' . $this->request->data['event_id']]);
				}
			}
		}
	}

	public function mpesacheck()
	{
		$connection = ConnectionManager::get('db2');
		$connectmpesa = $connection->execute("SELECT count(*) as res, amount FROM `transactions_573314` WHERE MPESA_REF_ID='" . $this->request->data['mpesa'] . "'")->fetch('assoc');
		$this->loadModel('Payment');
		if ($connectmpesa['res'] > 0) {
			$customerdata = $this->Payment->find('all')->where(['Payment.mpesa' => $this->request->data['mpesa']])->first();

			if ($customerdata) {
				echo "4";
				die;
			} else {
				echo "7";
				die;
			}
		} else {
			echo "0";
			die;
		}
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

	//view sold tickets..
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

	// View Complementary user ticket...
	public function viewcomp($id = null)
	{

		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$this->loadModel('Ticketdetail');
		//pr($this->request->data); die;
		$user_id = $this->request->session()->read('Auth.User.id');

		$comptickets = $this->Ticket->find('all')->contain(['Ticketdetail', 'Users'])->where(['Ticket.event_id' => $id, 'Ticket.event_admin' => '1'])->order(['Ticket.id' => DESC])->toarray();
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

			$data_event_qr = $this->Event->find('all')->where(['Event.id' => $id])->first();
			$ticketda = $this->Event->find('all')->where(['Event.id' => $id])->first();
			$ticketdata = $this->Ticket->find('all')->where(['event_id' => $id, 'mobile' => $this->request->data['mobile']])->first();


			$existsuser = $this->Users->find('all')->where(['mobile' => $this->request->data['mobile']])->first();
			if ($ticketdata) {
				$this->Flash->error(__('Ticket already share to this user'));
				return $this->redirect(['action' => 'myevent']);
			} else {
				if ($existsuser == '') {
					$existsuseremailid = $this->Users->find('all')->where(['email' => $this->request->data['email']])->count();
					if ($existsuseremailid > 0) {
						$this->Flash->error(__('Email id or mobile number already exists'));
						return $this->redirect(['action' => 'myevent']);
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
						$ticketqrimages = $this->qrcodepro($this->request->data['cust_id'], $ticketdetail['ticket_num'], $data_event_qr['event_org_id']);
						$Pack = $this->Ticketdetail->get($ticketdetail['id']);
						$Pack->qrcode = $ticketqrimages;
						$this->Ticketdetail->save($Pack);


						$event = $this->Event->find('all')->where(['Event.id' => $this->request->data['event_id']])->contain(['Users'])->order(['Event.id' => 'DESC'])->first();
						$date = $event['date_from'];
						$dates = $event['date_to'];
						$user = $this->request->session()->read('Auth.User.name');
						$name = $event['name'];
						$quantity = $ticketcustomer['ticket_buy'];
						$totale = $ticketdetailvvv['totalamt'];
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
						$message1 = str_replace(array('{User}', '{Name}', '{Date}', '{Dates}', '{Totale}', '{Quantity}', '{Location}', '{Password}', '{site_url}'), array($user, $name, $date, $dates, $totale, $quantity, $location, $password, $site_url), $formats);
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
					return $this->redirect(['action' => 'myevent']);
					//return $this->redirect(['controller' => 'tickets','action'=>'myticket/'.$this->request->data['event_id']]);			

				} else {
					$this->Flash->error(__('Sorry your ticket not booked Check Mpesa !!!'));
					return $this->redirect(['action' => 'index']);
				}
			}
		}
	}

	public function qrcodepro($user_id, $name, $event_org_id)
	{
		$dirname = 'temp';
		$PNG_TEMP_DIR = WWW_ROOT . 'qrimages' . DS . $dirname . DS;
		//$PNG_WEB_DIR = 'temp/';
		// pr($PNG_TEMP_DIR);
		// die;
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);
		$filename = $PNG_TEMP_DIR . 'test.png';
		$name = $user_id . "," . $name . "," . $event_org_id;
		$errorCorrectionLevel = 'M';
		$matrixPointSize = 4;

		$filename = $PNG_TEMP_DIR . 'test' . md5($name . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
		\QRcode::png($name, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		//display generated file
		$qrimagename = basename($filename);
		return $qrimagename;
	}

	public function aboutus()
	{

		$this->loadModel('Static');
		$static = $this->Static->find('all')->order(['Static.id' => 'DESC'])->toarray();
		//pr($static); die;
		$this->set('static', $static);
	}

	public function contact()
	{
		$this->loadModel('Static');
		$static = $this->Static->find('all')->order(['Static.id' => 'DESC'])->toarray();
		//pr($static); die;
		$this->set('static', $static);
	}

	public function faq()
	{
		$this->loadModel('Static');
		$static = $this->Static->find('all')->order(['Static.id' => 'DESC'])->toarray();
		//pr($static); die;
		$this->set('static', $static);
	}
}
