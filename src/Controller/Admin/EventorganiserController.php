<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;


class EventorganiserController extends AppController
{

	//$this->loadcomponent('Session');
	public function initialize()
	{
		//load all models
		parent::initialize();
	}
	public function index()
	{
		$this->loadModel('Users');
		$this->viewBuilder()->layout('admin');
		$event_org = $this->Users->find('all')->where(['Users.role_id' => 2])->order(['Users.id' => 'DESC']);
		$event_org = $this->paginate($event_org)->toarray();
		$this->set('event_org', $event_org);
	}

	public function add()
	{
		$this->loadModel('Users');
		$this->viewBuilder()->layout('admin');
		$email = $this->request->data['email'];
		$mobile = $this->request->data['mobile'];
		$event_org = $this->Users->find('all')->where(['Users.email' => $email])->orWhere(['Users.mobile' => $mobile])->first();

		if ($event_org) {
			$this->Flash->error(__('Event organiser already exists'));
			return $this->redirect(['action' => 'add']);
		} else {
			$addevent = $this->Users->newEntity();

			if ($this->request->is(['post', 'put'])) {

				//pr($this->request->data);die;
				$this->request->data['role_id'] = 2;
				$passwords = $this->randomPassword();
				$hasher = new DefaultPasswordHasher();
				$newpassword = $hasher->hash($passwords);

				$this->request->data['confirm_pass'] = $passwords;
				$this->request->data['password'] = $newpassword;

				$addevent = $this->Users->patchEntity($addevent, $this->request->data);

				if ($addevents = $this->Users->save($addevent)) {

					/*sending email start */
					$this->loadmodel('Templates');
					$profile = $this->Templates->find('all')->where(['Templates.id' => ORGANISER])->first();

					$subject = $profile['subject'];
					$from = $profile['from'];
					$fromname = $profile['fromname'];
					$name = $addevents['name'];
					$email = $addevents['email'];
					$password = $passwords;
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
					';	//die;
					//echo $message; die;
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//$headers .= 'To: <'.$to.'>' . "\r\n";
					$headers .= 'From: ' . $fromname . ' <' . $from . '>' . "\r\n";
					$emailcheck = mail($to, $subject, $message, $headers);
					/*   sending email end */

					$this->Flash->success(__('' . ucwords($addevent['name']) . ' has been saved.'));
					return $this->redirect(['action' => 'index']);
				}
			}
		}
	}

	public function edit($id = null)
	{
		$this->loadModel('Users');
		$this->viewBuilder()->layout('admin');

		if ($id) {
			$addevent = $this->Users->get($id);
			$this->set('addevent', $addevent);
		}
		if ($this->request->is(['post', 'put'])) {

			//pr($this->request->data);die;
			$passwords = $this->randomPassword();
			$hasher = new DefaultPasswordHasher();
			$newpassword = $hasher->hash($passwords);

			$this->request->data['confirm_pass'] = $passwords;
			$this->request->data['password'] = $newpassword;

			$this->request->data['role_id'] = 2;
			$addevent = $this->Users->patchEntity($addevent, $this->request->data);
			if ($addevents = $this->Users->save($addevent)) {

				/*sending email start */
				$this->loadmodel('Templates');
				$profile = $this->Templates->find('all')->where(['Templates.id' => ORGANISER])->first();

				$subject = $profile['subject'];
				$from = $profile['from'];
				$fromname = $profile['fromname'];
				$name = $addevents['name'];
				$email = $addevents['email'];
				$password = $passwords;
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
					';	//die;
				//echo $message; die;
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				//$headers .= 'To: <'.$to.'>' . "\r\n";
				$headers .= 'From: ' . $fromname . ' <' . $from . '>' . "\r\n";
				$emailcheck = mail($to, $subject, $message, $headers);
				/*   sending email end */

				$this->Flash->success(__('' . ucwords($addevent['name']) . ' has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
		}
	}

	//function for delete Event organiser 
	public function delete($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Event');
		$organizer_data = $this->Users->get($id);
		$eventTable = TableRegistry::get('Event');
		$exists = $eventTable->exists(['event_org_id' => $organizer_data['id']]);
		if ($exists) {
			$this->Flash->error(__('Event organiser ' . ucwords($organizer_data['name']) . ' has not been deleted because organizer have entry in some manager'));
			return $this->redirect(['action' => 'index']);
		} else {
			if ($this->Users->delete($organizer_data)) {
				$this->Flash->success(__('Event organiser ' . ucwords($organizer_data['name']) . ' has been deleted successfully.'));
				return $this->redirect(['action' => 'index']);
			}
		}
	}

	public function status($id, $status)
	{
		$this->loadModel('Users');
		//pr($status);die;
		if (isset($id) && !empty($id)) {
			if ($status == 'N') {

				$status = 'Y';
				//status update
				$event_org = $this->Users->get($id);
				$event_org->status = $status;
				//pr($event_org);die;
				if ($this->Users->save($event_org)) {
					$this->Flash->success(__('' . ucwords($event_org['name']) . ' status has been updated.'));
					return $this->redirect(['action' => 'index']);
				}
			} else {

				$status = 'N';
				//status update
				$event_org = $this->Users->get($id);
				$event_org->status = $status;
				//pr($event_org);die;
				if ($this->Users->save($event_org)) {
					$this->Flash->success(__('' . ucwords($event_org['name']) . ' status has been updated.'));
					return $this->redirect(['action' => 'index']);
				}
			}
		}
	}

	public function chek_number()
	{
		$this->loadModel('Users');
		$num = $this->request->data['addnumber'];
		$id = $this->request->data['ids'];

		if (!empty($num)) {
			$event_org = $this->Users->find('all')->where(['Users.id !=' => $id, 'Users.mobile' => $num])->first();
			echo count($event_org);
		}
		die;
	}

	public function chek_email()
	{
		$this->loadModel('Users');
		$email = $this->request->data['addemail'];
		$id = $this->request->data['ids'];

		if (!empty($email)) {
			$event_org = $this->Users->find('all')->where(['Users.id !=' => $id, 'Users.email' => $email])->first();
			echo count($event_org);
		}
		die;
	}

	public function randomPassword()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
}
