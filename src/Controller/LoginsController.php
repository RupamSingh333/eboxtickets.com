<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Datasource\ConnectionManager;
use PHPMailer\PHPMailer\PHPMailer;

include(ROOT . DS . "vendor" . DS  . "PHPMailer/" . DS . "PHPMailerAutoload.php");



class LoginsController extends AppController
{
	public function beforeFilter(Event $event)
	{
		//pr($this->request->params);
		$this->loadModel('Users');

		parent::beforeFilter($event);
		$this->loadComponent('Cookie');
		$this->loadComponent('Email');
		// Allow users to register and logout.
		// You should not add the "login" action to allow list. Doing so would
		// cause problems with normal functioning of AuthComponent.
		$this->Auth->allow(['login', 'logout', 'forgot', 'signup', 'checkemail', 'frontlogin', 'forgotcpassword', 'activation']);
	}

	public function frontlogin()
	{
		// $this->autoRender = false;
		$where = $this->request->session()->read('Auth.User');

		if ($where['id']) {
			if ($where['role_id'] == 2 && $where['status'] == 'Y') {
				$uty = $this->request->session()->read('Auth.User.role_id');
				if ($uty == '2') {
					return $this->redirect(['controller' => 'homes', 'action' => 'index']);
				}
				if ($uty == '3') {
					// return $this->redirect(['controller' => 'tickets', 'action' => 'myticket']);
					return $this->redirect(['controller' => 'homes', 'action' => 'index']);
				}
			}
		}

		if ($this->request->is('post')) {

			// pr($_POST);exit;

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
				return $this->redirect(['action' => 'frontlogin']);
			}
			// pr($this->request->data);exit;
			$this->request->data['email'] = $this->request->data['email'];
			$user = $this->Auth->identify();

			if (($user['role_id'] == 2 || $user['role_id'] == 3) && $user['status'] == 'Y') {
				$this->Auth->setUser($user);
				$uty = $this->request->session()->read('Auth.User.role_id');
				if ($uty == '2') {
					return $this->redirect(['controller' => 'homes', 'action' => 'index']);
				}
				if ($uty == '3') {
					// return $this->redirect(['controller' => 'tickets', 'action' => 'myticket']);
					return $this->redirect(['controller' => 'homes', 'action' => 'index']);
				}
			} else {
				if ($user['status'] == 'N') {
					$this->Flash->error(__(("Email verification is not complete you have recieved mail your register email")));
					return $this->redirect(['action' => 'frontlogin']);
				}
				$this->Flash->error(__(("Invalid email or password, try again")));
				return $this->redirect(['action' => 'frontlogin']);
			}
		}
	}

	public function frontlogout()
	{
		$this->Auth->logout();
		return $this->redirect(['controller' => 'home', 'action' => 'index']);
	}

	public function login()
	{
		
		$this->viewBuilder()->layout('admin/login');
		if ($this->request->is('post')) {
			
			$user = $this->Auth->identify();
			if ($user['role_id'] == 1) {
				$this->Auth->setUser($user);
				return $this->redirect(['controller' => 'admin/dashboard', 'action' => 'index']);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}

	public function logout()
	{
		$this->Auth->logout();
		return $this->redirect(['controller' => 'logins', 'action' => 'login']);
	}

	public function signup($params=null)
	{
		$this->loadModel('Users');

		$internal = $this->Users->newEntity();

		if ($this->request->is('post')) {
			$request_data = $this->request->data;
			//check email
			$check = $this->checkemail();

			if (empty($check['id'])) {
				// $name = ucfirst(strtolower($request_data['fname']));
				$this->request->data['name'] = trim(ucfirst(strtolower($request_data['fname'])));
				$this->request->data['lname'] = trim(ucwords(strtolower($request_data['lname'])));
				$this->request->data['confirm_pass'] = $request_data['password'];
				$this->request->data['role_id'] = CUSTOMERROLE;
				$this->request->data['password'] = (new DefaultPasswordHasher)->hash($this->request->data['password']);
				$this->request->data['activation_code'] = strtoupper(strtolower(substr(md5(uniqid(rand(), true)), 10, 10)));
				$this->request->data['status'] = 'N';
				$this->request->data['gender'] = ucfirst(strtolower($request_data['gender']));

				$organiser = $this->Users->patchEntity($internal, $this->request->data);
				// pr($organiser);exit;
				$res = $this->Users->save($organiser);
				if ($res) {
					/*sending email start */
					$this->loadmodel('Templates');
					$profile = $this->Templates->find('all')->where(['Templates.id' => 13])->first();

					$subject = $profile['subject'];
					$from = $profile['from'];
					$fromname = $profile['fromname'];
					$name = $res['name'] . ' ' . $res['lname'];
					$email = $res['email'];
					$activation_code = $res['activation_code'];
					$buttonname = "VERIFY YOUR EMAIL";
					$activation = 'logins/activation/' . $activation_code;
					$to  = $email;
					$formats = $profile['description'];
					$site_url = SITE_URL;
					$message1 = str_replace(array('{Name}', '{Activation}', '{buttonname}','{SITE_URL}','{From}','Fromname'), array($name, $activation, $buttonname,$site_url,$from,$fromname), $formats);

					$message = '
					<!DOCTYPE HTML>
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
					<body style="background:#d8dde4; padding:15px;">
					' . $message1 . '
					</body>
					</html>
					';
					// pr($message);exit;

					$mail = $this->Email->send($to, $subject, $message);

					$profess = $this->Users->find('all')->where(['id' => $res['id']])->first();
					// $this->Auth->setUser($profess);
					// $uty = $this->request->session()->read('Auth.User.role_id');
					if (ORGANISERROLE == '2') {
						$this->Flash->success(__('Verification mail send to your register email'));
						return $this->redirect(['controller' => 'logins', 'action' => 'signup']);
					}
					if (ORGANISERROLE == '3') {
						return $this->redirect(['controller' => 'tickets', 'action' => 'myticket']);
					}

					//return $this->redirect(['controller' => 'tickets','action'=>'myticket']);

				}
			} else {
				if ($check['status'] = 'N') {
					$this->Flash->error(__('Account verification not complete you have recieved verication email to your registerd email'));
					return $this->redirect(['action' => 'signup']);
				} else {
					$this->Flash->error(__('Email already register'));
					return $this->redirect(['action' => 'signup']);
				}
			}
		} else {
		}
	}

	public function activation($activationcode = null)
	{
		$this->loadModel('Users');
		$this->loadmodel('Templates');
		$this->Auth->logout();
		$usrinfo = $this->Users->find('all')->where(['Users.activation_code' => $activationcode])->first();
		// pr($usrinfo);exit;

		if (!empty($usrinfo['id']) > 0) {

			$updateUser = $this->Users->get($usrinfo['id']);
			$tnn['activation_code'] = '';
			$tnn['status'] = 'Y';
			$savepack = $this->Users->patchEntity($updateUser, $tnn);
			$this->Users->save($savepack);

			$useid = $this->Users->find('all')->where(['Users.id' => $usrinfo['id']])->first();
			$name = $useid['name'];
			$email = $useid['email'];
			$password = $useid['confirm_pass'];
			$site_url = SITE_URL;


			$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 24])->first();
			$from = $emailtemplate['fromemail'];
			$to = $email;
			$subject = $emailtemplate['subject'];
			$formats = $emailtemplate['description'];

			$message1 = str_replace(array('{Name}', '{Email}', '{Password}', '{SITE_URL}', '{From}'), array($name, $email, $password,$site_url,$from), $formats);
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
			$this->Flash->success(__('Your Account has been activated successfully. Your Login Credentials will be sent to your email address.'));
			return $this->redirect(SITE_URL . 'login');
		} else {
			$this->Flash->set(__('The Activation Code is invalid or expired. Kindly resubmit your request.'));
			return $this->redirect(SITE_URL . 'signup');
		}
	}

	public function checkemail()
	{
		$this->autoRender = false;
		$this->loadModel('Users');
		$name = $this->request->data['name'];
		$email = $this->request->data['email'];
		$phone = $this->request->data['mobile'];
		if (!empty($email)) {
			$check_count = $this->Users->find('all')->where(['Users.email LIKE ' => $email])->first();
			return $check_count;
		}
		if (!empty($phone)) {
			$check_count = $this->Users->find('all')->where(['Users.mobile LIKE ' => $phone])->first();
			return $check_count;
		}
	}
}
