<?php

namespace App\Controller;

use App\Controller;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use PHPMailer\PHPMailer\PHPMailer;
use tidy;

include(ROOT . DS . "vendor" . DS  . "PHPMailer/" . DS . "PHPMailerAutoload.php");

class UsersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadModel('Users');
		$this->loadComponent('Email');
		$this->Auth->allow(['resetImei', 'forgetcpass', 'checkempdata', 'forgotcpassword', 'findUsername', '_setPassword', 'userdata', 'getcountrycode']);
	}

	public  function _setPassword($password)
	{
		return (new DefaultPasswordHasher)->hash($password);
	}

	public function setting()
	{
	}

	public function resetImei($mid = '', $userid = '')
	{
		$this->autoRender = false;
		$mix = explode("/", base64_decode(base64_decode($mid)));
		$id = $mix[0];
		$fkey = $mix[1];
		$user = $this->Users->find('all')->select(['id', 'fkey'])->where(['Users.id' => $id])->first();
		$usrfkey = $user['fkey'];
		if ($usrfkey == $fkey) {
			$ftyp = 1;
		} else {
			$ftyp = 0;
		}
		if ($ftyp == 1) {
			$Pack = $this->Users->get($id);
			$Pack->fkey = '';
			$Pack->imei = '';
			$this->Users->save($Pack);
			$this->Flash->success(__('password changed successfully'));
			return $this->redirect(['controller' => 'logins', 'action' => 'singup']);
		} elseif ($ftyp == 0) {
			$this->Flash->error(__('Pin Expired!!'));
			return $this->redirect(['controller' => 'logins', 'action' => 'signup']);
		}

		die;
	}

	public function checkempdataedit()
	{
		$email = $this->request->data['email'];
		$mobile = $this->request->data['mobile'];
		$id_data = $this->request->data['id_data'];
		$useremail_check = $this->Users->find('all')->where(['Users.email' => $email, 'Users.id NOT IN' => $id_data])->count();
		$usermobile_check = $this->Users->find('all')->where(['Users.mobile' => $mobile, 'Users.id NOT IN' => $id_data])->count();
		// pr($useremail_check);exit;

		if ($useremail_check > 0) {
			$response['email'] = 1;
		} else {
			$response['email'] = 0;
		}
		if ($usermobile_check > 0) {
			$response['mobile'] = 1;
		} else {
			$response['mobile'] = 0;
		}

		echo json_encode($response);
		die;
	}

	public function checkempdata()
	{

		$email = $this->request->data['email'];
		$mobile = $this->request->data['mobile'];
		$id_data = $this->request->data['id_data'];
		if ($id_data) {
			$useremail_check = $this->Users->find('all')->where(['Users.email' => $email, 'Users.id' => $id_data])->count();
			$usermobile_check = $this->Users->find('all')->where(['Users.mobile' => $mobile, 'Users.id' => $id_data])->count();
		} else {
			$useremail_check = $this->Users->find('all')->where(['Users.email' => $email])->count();
			$usermobile_check = $this->Users->find('all')->where(['Users.mobile' => $mobile])->count();
		}
		$userid_check = $this->Users->find('all')->where(['Users.id' => $id_data, 'Users.mobile' => $mobile, 'Users.email' => $email])->count();
		if ($useremail_check > 0) {
			$response['email'] = 1;
		} else {
			$response['email'] = 0;
		}
		if ($usermobile_check > 0) {
			$response['mobile'] = 1;
		} else {
			$response['mobile'] = 0;
		}

		if ($userid_check > 0) {
			$response['user_id'] = 1;
		} else {
			$response['user_id'] = 0;
		}

		echo json_encode($response);
		die;
	}


	// public function userdata()
	// {
	// 	$this->loadModel('Users');
	// 	$this->loadModel('Countries');
	// 	$this->autoRender = false;

	// 	$email = $this->request->data['email'];
	// 	$mobile = $this->request->data['mobile'];
	// 	$id_data = $this->request->data['id_data'];

	// 	if ($id_data) {
	// 		$useremail_check = $this->Users->find('all')->where(['Users.email' => $email, 'Users.id' => $id_data])->count();
	// 		$usermobile_check = $this->Users->find('all')->where(['Users.mobile' => $mobile, 'Users.id' => $id_data])->count();
	// 	} else {
	// 		$useremail_check = $this->Users->find('all')->where(['Users.email' => $email])->first();
	// 		$usermobile_check = $this->Users->find('all')->where(['Users.mobile' => $mobile])->count();
	// 	}
	// 	$userid_check = $this->Users->find('all')->where(['Users.id' => $id_data, 'Users.mobile' => $mobile, 'Users.email' => $email])->count();

	// 	if (!empty($useremail_check)) {
	// 		$response['email'] = $useremail_check;
	// 	} else {
	// 		$response['email'] = 0;
	// 	}
	// 	if ($usermobile_check > 0) {
	// 		$response['mobile'] = 1;
	// 	} else {
	// 		$response['mobile'] = 0;
	// 	}

	// 	if ($userid_check > 0) {
	// 		$response['user_id'] = 1;
	// 	} else {
	// 		$response['user_id'] = 0;
	// 	}

	// 	echo json_encode($response);
	// 	die;
	// }

	public function userdata()
	{
		$this->loadModel('Users');
		$this->autoRender = false;

		$email = $this->request->data['email'];
		$mobile = $this->request->data['mobile'];
		$id_data = $this->request->data['id_data'];

		$useremail_check = $this->Users->find()->where(['Users.email' => $email])->first();
		$usermobile_check = $this->Users->find()->where(['Users.mobile' => $mobile])->count();
		$userid_check = $this->Users->find()->where(['Users.id' => $id_data])->count();

		if (!empty($useremail_check)) {
			$response['email'] = $useremail_check;
		} else {
			$response['email'] = 0;
		}
		$response['mobile'] = $usermobile_check > 0;
		$response['user_id'] = $userid_check > 0;

		echo json_encode($response);
		die;
	}


	public function employeedelete($id, $status = null)
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$emp_id = $this->Users->get($id);
		if (!empty($status)) {
			$emp_id->is_suspend = $status;
		}
		// else{
		// 	$emp_id->is_suspend = 'Y';
		// }
		$dta = $this->Users->save($emp_id);
		// pr($dta);exit;
		if ($dta) {
			$this->Flash->success(__('Employee status has been changed successfully!!'));
			return $this->redirect(['action' => 'employee']);
		} else {
			$this->Flash->error(__('Employee not Deleted!!'));
			return $this->redirect(['action' => 'employee']);
		}
	}

	public function employee()
	{
		$id = $this->request->session()->read('Auth.User.id');
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Countries');
		$this->loadmodel('Templates');

		$cudate = date("Y-m-d H:i:s");
		$getemployee = $this->Users->find('all')->where(['Users.parent_id' => $id])->order(['Users.id' => 'DESC']);
		$destination = $this->paginate($getemployee)->toarray();
		// 'date_to >=' => $cudate,
		$allevent = $this->Event->find('all')->where(['event_org_id' => $id, 'status' => 'Y'])->toarray();
		$this->set('allevent', $allevent);
		$this->set('employee', $destination);
		$country = $this->Countries->find('list', [
			'keyField' => 'words',
			'valueField' => 'CountryName'
		])->where(['status' => 'Y'])->toArray();
		$this->set('country', $country);

		if ($this->request->is('post')) {


			if (!array_filter($this->request->data['event_id'])) {
				$this->Flash->error(__('Please choose event'));
				return $this->redirect($this->referer());
			}

			$eventId = implode(",", $this->request->data['event_id']);
			$choose = $this->Event->find('all')->select(['name'])->where(['id IN' => $this->request->data['event_id'], 'status' => 'Y'])->toarray();
			foreach ($choose as $key => $name) {
				$eventName[] = $name['name'];
			}
			$selectedEvent = implode(',', $eventName);
			$pass = substr(md5(mt_rand()), 0, 7);
			$usernew = $this->Users->newEntity();
			$this->request->data['parent_id'] = $id;
			$this->request->data['role_id'] = TICKETSCANNER;
			$this->request->data['gender'] = 'Male';
			$this->request->data['is_mob_verify'] = 'Y';
			$this->request->data['status'] = 'Y';
			$this->request->data['name'] = ucfirst($this->request->data['name']);
			$this->request->data['lname'] = ucfirst($this->request->data['lname']);
			$this->request->data['password'] = $this->_setPassword($pass);
			$this->request->data['confirm_pass'] = $pass;
			$this->request->data['eventId'] = $eventId;
			$this->request->data['mobile'] = $this->request->data['country_id'] . $this->request->data['mobile'];
			$profiles = $this->Users->patchEntity($usernew, $this->request->data);
			$savedprofile = $this->Users->save($profiles);

			$numwithcode = $profiles['mobile'];
			$fullName = ucfirst($profiles['name']) . ' ' . ucfirst($profiles['lname']);
			$email = $profiles['email'];
			$password = $profiles['confirm_pass'];

			$site_url = SITE_URL;
			$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 33])->first();
			$from = $emailtemplate['fromemail'];
			$to = $email;
			$subject = $emailtemplate['subject'];
			$formats = $emailtemplate['description'];

			$message1 = str_replace(array('{EventName}', '{Name}', '{Email}', '{Password}', '{From}', '{SITE_URL}'), array($selectedEvent, $fullName, $email, $password, $from, $site_url), $formats);
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
			$mail = $this->Email->send($to, $subject, $message);
			// send mail complete 

			// send watsappmessage start 
			$message = "*Eboxtickets: Ticket Scanning Services*%0AHello $fullName,%0A%0AYou have been selected for Ticket Scanning Services for the *$selectedEvent* Events.%0A%0AKindly login using the following Credentials on the eboxtickets App.%0A%0A*Email:-* $email%0A*Password:-* $password %0A%0ARegards,%0AEboxtickets.com";
			$this->whatsappmsg($numwithcode, $message);

			if ($savedprofile) {
				$this->Flash->success(__('Employee has been saved successfully!!'));
				return $this->redirect(['action' => 'employee']);
			}
		}
	}

	public function employeedit($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Countries');
		$this->loadmodel('Templates');
		$auth = $this->request->session()->read('Auth.User.id');
		if (!empty($id)) {
			$emp_id = $this->Users->get($id);
			$this->set('emp_id', $emp_id);
		}
		// 'date_to >=' => $cudate,
		$allevent = $this->Event->find('all')->where(['event_org_id' => $auth, 'status' => 'Y'])->toarray();
		$this->set('allevent', $allevent);

		if ($this->request->is('post')) {

			// pr($this->request->data);die; 
			if (!array_filter($this->request->data['event_id'])) {
				$this->Flash->error(__('Please choose event'));
				return $this->redirect($this->referer());
			}
			$event_Id = implode(",", $this->request->data['event_id']);
			$empData = $this->Users->get($this->request->data['emp_id']);
			$empData->name = ucfirst(str_replace(' ', '', $this->request->data['name']));
			$empData->lname = ucfirst($this->request->data['lname']);
			$empData->updateAt = $cudate;
			$empData->eventId = $event_Id;

			$choose = $this->Event->find('all')->select(['name'])->where(['id IN' => $this->request->data['event_id'], 'status' => 'Y'])->toarray();
			foreach ($choose as $key => $name) {
				$eventName[] = $name['name'];
			}
			$selectedEvent = implode(',', $eventName);


			$numwithcode = $empData['mobile'];
			$fullName = ucfirst($empData['name']) . ' ' . ucfirst($empData['lname']);
			$email = $empData['email'];
			$password = $empData['confirm_pass'];

			$site_url = SITE_URL;
			$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 33])->first();
			$from = $emailtemplate['fromemail'];
			$to = $email;
			$subject = $emailtemplate['subject'];
			$formats = $emailtemplate['description'];

			$message1 = str_replace(array('{EventName}', '{Name}', '{Email}', '{Password}', '{From}', '{SITE_URL}'), array($selectedEvent, $fullName, $email, $password, $from, $site_url), $formats);
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
			$mail = $this->Email->send($to, $subject, $message);
			// send mail complete 

			// send watsappmessage start 
			$message = "*Eboxtickets: Ticket Scanning Services*%0AHello $fullName,%0A%0AYou have been selected for Ticket Scanning Services for the *$selectedEvent* Events.%0A%0AKindly login using the following Credentials on the eboxtickets App.%0A%0A*Email:-* $email%0A*Password:-* $password %0A%0ARegards,%0AEboxtickets.com";
			$this->whatsappmsg($numwithcode, $message);

			$savedprofile = $this->Users->save($empData);
			if ($savedprofile) {
				$this->Flash->success(__('Employee has been updted successfully!!'));
				return $this->redirect(['action' => 'employee']);
			}
		}
	}

	// function used for dupicate email check:
	public function findUsername($username = null)
	{
		$username = $this->request->data['username'];
		$user = $this->Users->find('all')->where(['Users.email' => $username])->toArray();
		echo $user[0]['id'];
		die;
	}

	public function forgotcpassword()
	{
		$this->loadModel('Users');

		if ($this->request->is('post')) {

			$email = $this->request->data['email'];
			$to = $email;
			$useremail = $this->Users->find('all')->where(['Users.email' => $email])->first();
			// pr($useremail);exit;
			if (count($useremail) == 0) {
				$this->Flash->error(__('Invalid email, try again'));
				return $this->redirect(['controller' => 'users', 'action' => 'forgotcpassword']);
			} elseif ($useremail['status'] == 'N') {
				$this->Flash->error(__('Email verification is pending you have recieved your verification mail'));
				return $this->redirect(['controller' => 'users', 'action' => 'forgotcpassword']);
			} else {
				$userid = $useremail['id'];
				$name = $useremail['name'];
				$site_url = SITE_URL;
				$fkey = rand(1, 10000);

				$Pack = $this->Users->get($userid);
				$Pack->fkey = $fkey;
				$this->Users->save($Pack);
				$mid = base64_encode(base64_encode($userid . '/' . $fkey));
				$url = SITE_URL . "users/forgetcpass/" . $mid;
				$this->loadmodel('Templates');
				$profile = $this->Templates->find('all')->where(['Templates.id' => FORGOTPASSWORD])->first();
				// pr($profile);exit;
				$subject = $profile['subject'];

				$from = $profile['from'];
				$fromname = $profile['fromname'];
				$to  = $email;
				$formats = $profile['description'];
				$site_url = SITE_URL;

				$message1 = str_replace(array('{Name}', '{site_url}', '{url}'), array($name, $site_url, $url), $formats);
				$message = stripslashes($message1);
				$message = '
				<!DOCTYPE HTML>
				<html>
				<head>
				<meta http-equiv="Content-Type " content="text/html; charset=utf-8 ">
				<title>Untitled Document</title>
				</head>
				<style>
					button:focus {
						outline: none;
					}
				</style>
				<body style="background:#d8dde4; padding:15px;">
					' . $message1 . '
					</body>
					</html>
					';
				// pr($message);exit;
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: ' . $fromname . ' <' . $from . '>' . "\r\n";
				$mail = $this->Email->send($to, $subject, $message);
				$this->Flash->success(__('Forgot passowrd link sent to Your Email'));
				return $this->redirect(['controller' => 'Users', 'action' => 'forgotcpassword']);
			}
		}
	}


	public function forgetcpass($mid = null, $userid = null)
	{
		$this->loadModel('Users');
		if (!empty($userid)) {
			$id = $userid;
		} else {
			$mix = explode("/", base64_decode(base64_decode($mid)));
			$id = $mix[0];
			$fkey = $mix[1];
			$user = $this->Users->find('all')->select(['id', 'fkey'])->where(['Users.id' => $id])->first();
			// pr($mix);exit;
			$usrfkey = $user['fkey'];
			if ($usrfkey == $fkey) {
				$ftyp = 1;
			} else {
				$this->Flash->error(__('Invalid Key or Expired link'));
				// return $this->redirect(['controller' => 'logins', 'action' => 'frontlogin']);
				$ftyp = 0;
			}
			$this->set('ftyp', $ftyp);
			$this->set('usrid', $id);
		}

		if ($this->request->is('post')) {
			// pr($this->request->data); die;
			$confirmpass = $this->request->data['password'];
			$Pack = $this->Users->get($id);
			$updpass = $this->_setPassword($this->request->data['password']);
			$Pack->password = $updpass;
			$Pack->confirm_pass = $confirmpass;
			if ($this->Users->save($Pack)) {
				$Pack = $this->Users->get($id);
				$Pack->fkey = 0;
				$this->Users->save($Pack);
				$useremail = $this->Users->find('all')->where(['Users.id' => $id])->first();
				// $this->Auth->setUser($useremail);
				//$this->User->find('first',array('fields'=>array('username','name','sname'),'recursive'=>-1,'conditions'=>array('User.id'=>$id)));
				$email = $useremail['email'];
				$name = $useremail['name'];
				$password = $this->request->data['password'];
				$this->loadmodel('Templates');
				$profile = $this->Templates->find('all')->where(['Templates.id' => FORGOTPASSWORDCHANGED])->first();
				$subject = $profile['subject'];
				$from = $profile['from'];
				$fromname = $profile['fromname'];
				$to  = $email;
				$formats = $profile['description'];
				$site_url = SITE_URL;
				$message1 = str_replace(array('{Name}', '{Email}', '{Password}', '{site_url}'), array($name, $email, $password, $site_url), $formats);
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
				// $emailcheck = mail($to, $subject, $message, $headers);
				$useremail = $this->Email->send($to, $subject, $message);
				if ($useremail['role_id'] == 2) {
					$this->Flash->success(__('Password Changed Successfully'));
					// return $this->redirect(['controller' => 'homes', 'action' => 'myevent']);
					return $this->redirect(['controller' => 'logins', 'action' => 'frontlogin']);
				} else {
					$this->Flash->success(__('Password Changed Successfully'));
					return $this->redirect(['controller' => 'logins', 'action' => 'frontlogin']);
					// $this->Flash->success(__('Password Changed Successfully'));
					// return $this->redirect(['controller' => 'tickets', 'action' => 'myticket']);
				}
			}
		}
	}

	public function updateprofile()
	{

		$this->loadModel('Users');

		$user = $this->Users->get($this->Auth->user('id'));

		if (isset($user) && !empty($user)) {
			$student = $this->Users->find('all')->where(['Users.id' => $user['id']])->first();
			$this->set('userdata', $student);
		}

		if ($this->request->is(['post', 'put'])) {

			// for password
			if ($this->request->data['oldpass'] && $this->request->data['new_pass']) {

				$oldPassword = $student['confirm_pass'];
				if ($oldPassword == $this->request->data['oldpass']) {

					$this->request->data['confirm_pass'] = $this->request->data['new_pass'];
					$this->request->data['password'] = (new DefaultPasswordHasher)->hash($this->request->data['new_pass']);
					$user = $this->Users->patchEntity($user, $this->request->data());
					$this->Users->save($user);
					/*sending email start */
					// $this->loadmodel('Templates');
					// $profile = $this->Templates->find('all')->where(['Templates.id' => PASS])->first();

					// $subject = $profile['subject'];
					// $from = $profile['from'];
					// $fromname = $profile['fromname'];
					// $name = $user['name'];
					// $email = $user['email'];
					// $password = $this->request->data['confirm_pass'];
					// $to  = $email;
					// $formats = $profile['description'];
					// $site_url = SITE_URL;
					// $message1 = str_replace(array('{Name}', '{Email}', '{Password}', '{site_url}', '{Useractivation}'), array($name, $email, $password, $site_url), $formats);
					// $message = stripslashes($message1);
					// $message = '
					// <!DOCTYPE HTML>
					// <html>
					// <head>
					// <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					// <title>Mail</title>
					// </head>
					// <body style="padding:0px; margin:0px;font-family:Arial,Helvetica,sans-serif; font-size:13px;">
					// ' . $message1 . '
					// </body>
					// </html>
					// ';	//die;
					// //	echo $message; die;
					// $headers = 'MIME-Version: 1.0' . "\r\n";
					// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					// //$headers .= 'To: <'.$to.'>' . "\r\n";
					// $headers .= 'From: ' . $fromname . ' <' . $from . '>' . "\r\n";
					// $emailcheck = mail($to, $subject, $message, $headers);
					/*   sending email end */
					// $this->Auth->logout();
					$this->Flash->success(__('Your new password has been changed successfully.'));
					return $this->redirect(['action' => 'updateprofile']);
				} else {
					$this->Flash->error(__('Your old password doesnot match, try again.'));
					return $this->redirect(['action' => 'updateprofile']);
				}
			}
			// else {
			// 	$this->Flash->error(__('Your new password and confirm password doesnot match, try again.'));
			// 	return $this->redirect(['action' => 'updateprofile']);
			// }

			if ($this->request->data['fname'] || $this->request->data['lname'] ||  $this->request->data['gender'] ||  $this->request->data['dob'] || $this->request->data['emailNewsLetter'] || $this->request->data['emailRelatedEvents']) {

				if ($this->request->data['fname']) {
					$userdata['name'] = ucfirst(strtolower($this->request->data['fname']));
				}

				if ($this->request->data['lname']) {
					$userdata['lname'] = ucfirst(strtolower($this->request->data['lname']));
				}

				if ($this->request->data['gender']) {
					$userdata['gender'] = $this->request->data['gender'];
				}

				if ($this->request->data['dob']) {
					$userdata['dob'] = date('Y-m-d', strtotime($this->request->data['dob']));
				}
			}

			if (isset($this->request->data['emailNewsLetter'])) {
				$userdata['emailNewsLetter'] = 'Y';
			} else {
				$userdata['emailNewsLetter'] = 'N';
			}

			if (isset($this->request->data['emailRelatedEvents'])) {
				$userdata['emailRelatedEvents'] = 'Y';
			} else {
				$userdata['emailRelatedEvents'] = 'N';
			}

			$users = $this->Users->patchEntity($user, $userdata);

			if ($this->Users->save($users)) {
				$this->Flash->success(__('Your details have been updated successfully.'));
				return $this->redirect(['action' => 'updateprofile']);
			}
		}

		$this->set('user', $user);
	}

	public function authorize($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Countries');

		$user = $this->Users->get($this->Auth->user('id'));
		if ($user['is_mob_verify'] == 'Y') {
			return $this->redirect(['action' => 'viewprofile']);
		}

		if (isset($user) && !empty($user)) {
			$student = $this->Users->find('all')->where(['Users.id' => $this->Auth->user('id')])->first();
			$this->set('userdata', $student);
		}

		$country = $this->Countries->find('list', [
			'keyField' => 'id',
			'valueField' => 'CountryName'
		])->where(['status' => 'Y'])->toArray();
		$this->set('country', $country);

		if ($this->request->is('post')) {
			// pr($this->request->data);exit;

			$mobile_check = $this->Users->find('all')->where(['Users.mobile' => $this->request->data['mobile']])->first();

			$country = $this->Countries->get($this->request->data['country_id']);
			$numwithcode = $country['words'] . $this->request->data['mobile'];
			if (!empty($mobile_check)) {
				$this->Flash->error(__('Mobile number already verified  with other account number'));
				return $this->redirect(['action' => 'authorize']);
			}
			$reqdata = $this->request->data;
			$mob_verify_code = strtoupper(strtolower(substr(md5(uniqid(rand(), true)), 6, 6)));
			$userdata['mob_verify_code'] = $mob_verify_code;
			$userdata['mobileverifynumber'] = $numwithcode;
			$message = "*Eboxtickets Verification Code*%0AYour mobile verfication code is *" . $mob_verify_code . "*%0A%0AEnter in online to verify your phone number.";
			// $message = "Your mobile verfication code is " . $mob_verify_code;
			$users = $this->Users->patchEntity($user, $userdata);
			if ($this->Users->save($users)) {
				$this->whatsappmsg($numwithcode, $message);
				$this->Flash->success(__('You have received  your verication code in your mobile number'));
				return $this->redirect(['action' => 'activate']);
			}
		}
	}

	public function activate($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Ticket');

		$user = $this->Users->get($this->Auth->user('id'));
		// pr($user);exit;

		if (isset($user) && !empty($user)) {
			$student = $this->Users->find('all')->where(['Users.id' => $this->Auth->user('id')])->first();
			// $this->set('userdata', $student);
		}

		if ($this->request->is('post')) {
			$reqdata = $this->request->data;
			if (!empty($reqdata['is_mob_verify']) && $reqdata['is_mob_verify'] == $student['mob_verify_code']) {
				$userdata['is_mob_verify'] = 'Y';
				$userdata['mobile'] =  $user['mobileverifynumber'];
				$users = $this->Users->patchEntity($user, $userdata);
				// pr($user);exit;
				if ($savedata = $this->Users->save($users)) {

					// Update number on the all tickets
					$find_tickets = $this->Ticket->find('all')->where(['cust_id' => $student['id']])->toArray();
					if (!empty($find_tickets)) {
						foreach ($find_tickets as $ticket) {
							// Load the ticket entity by its ID
							$ticketEntity = $this->Ticket->get($ticket['id']);
							// Update the mobile number of the ticket entity
							$ticketEntity->mobile = $savedata['mobile'];
							// Save the updated ticket entity

							$this->Ticket->save($ticketEntity);
						}
					}

					// $message = "Mobile number has been verified successfully.";
					$message = "*Eboxtickets: Mobile Verification*%0A%0AYour mobile number is verified successfully.";
					$this->whatsappmsg($user['mobileverifynumber'], $message);
					$this->Flash->success(__('Mobile number has been verified successfully.'));
					return $this->redirect(['action' => 'viewprofile']);
				}
			} else {
				$this->Flash->error(__('Activation Code is invalid.'));
				return $this->redirect(['action' => 'activate']);
			}
		}
	}

	public function updateprofileimage()
	{
		$this->autoRender = false;
		$user = $this->Users->get($this->Auth->user('id'));
		if ($this->request->is('post')) {
			$imagefilename = $this->request->data['profile_image']['name'];
			$Extention = pathinfo($this->request->data['profile_image']['name'], PATHINFO_EXTENSION);
			$allowed = array('png', 'jpg', 'jpeg');
			if (!in_array($Extention, $allowed)) {
				$this->Flash->error(__('Uploaded file is not a valid image. Only JPG, PNG and JPEG files are allowed.'));
				return $this->redirect(['action' => 'updateprofile']);
			}
			if (!empty($imagefilename)) {
				$item = $this->request->data['profile_image']['tmp_name'];
				$ext =  end(explode('.', $imagefilename));
				$name = md5(time() . $item);
				$imagename = $name . '.' . $ext;
				if (move_uploaded_file($this->request->data['profile_image']['tmp_name'], 'images/Usersprofile/' . $imagename)) {
					unlink('images/Usersprofile/' . $user['profile_image']);
					$image['profile_image'] = $imagename;
					$users = $this->Users->patchEntity($user, $image);
					if ($this->Users->save($users)) {
						$this->Flash->success(__('Yours Image has been updated successfully.'));
						return $this->redirect(['action' => 'updateprofile']);
					}
					$this->Flash->error(__('Profile Image uploaded successfully.'));
					return $this->redirect(['action' => 'updateprofile']);
				} else {
					$this->Flash->error(__('Yours Image not updated.'));
					return $this->redirect(['action' => 'updateprofile']);
				}
			}
		}
	}

	public function viewprofile($id = null)
	{
		$this->loadModel('Users');
		$user_id = $this->request->session()->read('Auth.User.id');
		$userData = $this->Users->get($user_id);
		$this->set('userData', $userData);
	}

	public function login($value = '')
	{
		$this->redirect(SITE_URL);
	}

	public function logins()
	{
		$this->viewBuilder()->layout('admin/login');
		if ($this->request->is('post')) {
			//($this->request->data);
			$user = $this->Auth->identify();
			// pr($user); die;
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect(['controller' => 'admin/dashboard', 'action' => 'index']);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}

	public function getcountrycode()
	{
		$this->loadModel('Countries');

		if (!empty($this->request->data['country_id'])) {
			$countrycode = $this->Countries->find('all')->where(['Countries.id' => $this->request->data['country_id']])->first();
		} else {
			$countrycode = 0;
		}
		//$countrycode_data['country_words']  = $countrycode['words']; 
		echo json_encode($countrycode);
		die;
	}
}
