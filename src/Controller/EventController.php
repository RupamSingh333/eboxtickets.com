<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Datasource\ConnectionManager;
use LDAP\Result;
use PHPMailer\PHPMailer\PHPMailer;
use Cake\Routing\Router;
use Cake\Validation\Validator;
use Cake\Utility\Text;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
include(ROOT . DS . "vendor" . DS  . "phpqrcode" . DS . "qrlib.php");
include(ROOT . DS . "vendor" . DS  . "PHPMailer/" . DS . "PHPMailerAutoload.php");
include '../vendor/PHPExcel/Classes/PHPExcel.php';
include '../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';
class EventController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Email');
	}

	public function beforeFilter()
	{

		$this->Auth->allow(['index', 'upcomingevent', 'pastevent', 'eventdetail', 'upcomingeventsearch', '_setPassword', 'selfregistration']);
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
	public  function _setPassword($password)
	{
		return (new DefaultPasswordHasher)->hash($password);
	}
	public function eventdetail($slug = null, $user_id = null)
	{

		$this->loadModel('Event');
		$this->loadModel('Committe');
		$this->loadModel('Users');
		$this->loadModel('Orders');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->loadModel('Ticket');
		$this->loadModel('Package');
		$this->loadModel('Addons');
		$this->loadModel('Packagedetails');
		$this->loadModel('Committeeassignticket');

		$uid = $this->Auth->user('id');
		$authEmail = $this->Auth->user('email');
		$date = date("Y-m-d H:i:s");

		$event = $this->Event->find('all')->contain(['Currency'])->where(['Event.slug' => $slug])->first();

		$country = $this->Countries->find('list', [
			'keyField' => 'id',
			'valueField' => 'CountryName'
		])->where(['status' => 'Y'])->toArray();
		$this->set('country', $country);

		$id = $event['id'];
		$this->set('authid', $uid);
		$this->set('authEmail', $authEmail);
		if (isset($user_id)) {
			$this->set('selectedcommitte_user', $user_id);
		}

		$committe_user = $this->Committe->find('all')->contain(['Users'])->where(['Committe.event_id' => $id, 'Committe.status' => 'Y'])->order(['Users.name' => 'ASC'])->toarray();
		$this->set('committe_user', $committe_user);

		$event_ticket_type = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id, 'Eventdetail.hidden' => 'Y', 'Eventdetail.type !=' => 'comps'])->order(['Eventdetail.id' => 'ASC'])->toarray();

		$package_type = $this->Package->find('all')->where(['Package.event_id' => $id, 'Package.hidden' => 'N'])->contain(['Packagedetails' => 'Eventdetail'])->order(['Package.id' => 'ASC'])->toarray();


		$this->set('event_ticket_type', $event_ticket_type);
		$this->set('package_type', $package_type);

		$user_id = $this->request->session()->read('Auth.User.id');
		if ($user_id) {
			$userDatas = $this->Users->find('all')->where(['id' => $user_id])->first();
			$this->set('userDatas', $userDatas);
		} else {
			//$this->Flash->error(__('You must have an eboxtickets eTickets account to purchase tickets.'));
		}

		$event = $this->Event->find('all')->where(['Event.id' => $id,])->contain(['Currency', 'Users', 'Eventdetail', 'Company'])->first();
		$sale_end = date('Y-m-d H:i:s', strtotime($event['sale_end']));

		if (strtotime($sale_end) >= strtotime($date)) {
		} else {
			if ($event['is_free'] == 'Y') {
				// $this->Flash->error(__('This is an invite only Event.'));
			} else {
				$this->Flash->error(__('Ticket sales for this event are currently closed.'));
			}
		}

		$totalticket = $this->Ticket->find('all')
		->select(['sum' => 'SUM(Ticket.ticket_buy)'])
		->where(['Ticket.cust_id' => $user_id, 'Ticket.event_id' => $id,'package_id IS NULL'])
		->first();

		$this->set('event', $event);
		$this->set('totalticket', $totalticket);
	}

	public function upcomingevent()
	{
		$this->loadModel('Event');
		$date = date("Y-m-d");
		$upcoming_event = $this->Event->find('all')->contain(['Countries', 'Company'])->where(['Event.date_to >=' => $date, 'Event.status' => 'Y', 'Event.admineventstatus' => 'Y'])->order(['Event.date_to' => 'ASC'])->limit('15')->group(['Event.date_to' => 'MONTH(Event.date_to)'])->toarray();
		$this->set('event', $upcoming_event);
	}

	//Event name keyword search in fee report
	public function loctionsearch()
	{
		$this->loadModel('Event');
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

	public function upcomingeventsearch()
	{
		$this->loadModel('Event');
		$this->loadModel('Countries');
		$date = date("Y-m-d H:i:s");
		//pr($this->request->data); //die;
		if (!empty($this->request->data['search'])) {
			$upcoming_event = $this->Event->find('all')->contain(['Countries', 'Company'])->where(['Event.name LIKE' => '%' . trim($this->request->data['search']) . '%', 'Event.date_to >=' => $date, 'Event.status' => 'Y'])->order(['Event.date_to' => 'ASC'])->limit('15')->group(['Event.date_to' => 'MONTH(Event.date_to)'])->toarray();
		} else {
			$upcoming_event = $this->Event->find('all')->contain(['Countries', 'Company'])->where(['Event.date_to >=' => $date, 'Event.status' => 'Y', 'Event.admineventstatus' => 'Y'])->order(['Event.date_to' => 'ASC'])->limit('15')->group(['Event.date_to' => 'MONTH(Event.date_to)'])->toarray();
		}
		$this->set('searchquery',  trim($this->request->data['search']));
		$this->set('event', $upcoming_event);
	}

	public function eventstatus($id = null, $status = null)
	{
		$this->loadModel('Event');
		$user_data_event = $this->Event->get($id);
		$user_data_event->status = $status;
		$this->Event->save($user_data_event);
		$this->Flash->success(__('Event status has been updated successfully.'));
		return $this->redirect(['controller' => 'event', 'action' => 'myevent']);
	}

	public function activationevent($id = null, $status = null)
	{
		$this->loadModel('Event');
		$user_data_event = $this->Event->get($id);
		$user_data_event->status = $status;
		$this->Event->save($user_data_event);
		$this->Flash->success(__('Event status has been updated successfully.'));
		return $this->redirect(['action' => 'generalsetting/' . $id]);
	}

	public function postevent($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->loadModel('Currency');
		$user_id = $this->request->session()->read('Auth.User.id');
		$admin_info = $this->Users->get(1);
		// pr($admin_info);exit;
		$country = $this->Countries->find('list', [
			'keyField' => 'id',
			'valueField' => 'CountryName'
		])->where(['status' => 'Y'])->toArray();

		$lateventid = $this->Event->find('all')->order(['id' => 'desc'])->first();
		$currency = $this->Currency->find('list', ['keyField' => 'id', 'valueField' => 'Currency'])->toarray();
		$this->set('currency', $currency);
		$company = $this->Company->find('list', [
			'keyField' => 'id',
			'valueField' => 'name'
		])->where(['status' => 'Y', 'user_id' => $user_id])->toArray();

		$this->set('lateventid', $lateventid['id'] + 1);
		$this->set('country', $country);
		$this->set('company', $company);

		if ($this->request->is(['post', 'put'])) {
			// pr($this->request->data);exit;

			$addevent = $this->Event->newEntity();
			$session = $this->request->session();
			$session->write('postevent', $this->request->data);

			// for admin approval 
			$forFreeEvent = ($admin_info['forFreeEvent'] == 'N') ? 'Y' : 'N';
			$forPaidEvent = ($admin_info['forPaidEvent'] == 'N') ? 'Y' : 'N';

			if (empty($this->request->data['name']) || empty($this->request->data['company_id']) || empty($this->request->data['country_id']) || empty($this->request->data['location']) || empty($this->request->data['event_image']) || empty($this->request->data['slug']) || empty($this->request->data['date_from']) || empty($this->request->data['date_to']) || empty($this->request->data['desp'])) {
				$this->Flash->error(__('Please complete all required fields before submitting the form.'));
				return $this->redirect(['action' => 'postevent']);
			}

			$imagefilename = $this->request->data['event_image']['name'];
			list($width, $height) = getimagesize($this->request->data['event_image']['tmp_name']);

			if ($width < 200 || $height < 200) {
				$this->Flash->error(__('Image dimensions are too small. Minimum (Size 200*200). Uploaded image (Size ' . $width . '*' . $height . ')'));
				return $this->redirect(['controller' => 'event', 'action' => 'postevent']);
			}
			$ext = pathinfo($this->request->data['event_image']['name'], PATHINFO_EXTENSION);
			if ($ext != ("png" || "jpeg" ||  "jpg")) {
				$this->Flash->error(__('Uploaded file is not a valid image. Only JPG, PNG and JPEG files are allowed.'));
				return $this->redirect(['controller' => 'event', 'action' => 'postevent']);
			}

			//For free event
			if ($this->request->data['is_free'] == 'Y') {

				$request_rsvp = date('Y-m-d H:i:s', strtotime($this->request->data['request_rsvp']));
				if (empty($request_rsvp)) {
					$this->Flash->error(__('Please choose Date Time for request RSVP.'));
					return $this->redirect(['controller' => 'event', 'action' => 'postevent']);
				}

				if ($imagefilename) {
					$itemww = $this->request->data['event_image']['tmp_name'];
					$ext = pathinfo($imagefilename, PATHINFO_EXTENSION);
					$name = time() . md5($imagefilename);
					$imagename = $name . '.' . $ext;
					if (move_uploaded_file($itemww, "images/eventimages/" . $imagename)) {
						$free_event['feat_image'] = $imagename;
					}
				}
				$free_event['event_org_id'] = $user_id;
				$free_event['company_id'] = $this->request->data['company_id'];
				$free_event['name'] = $this->request->data['name'];
				$free_event['country_id'] = $this->request->data['country_id'];
				$free_event['location'] = $this->request->data['location'];
				$free_event['video_url'] = $this->request->data['video_url'];
				$free_event['slug'] = $this->request->data['slug'];
				$free_event['desp'] = $this->request->data['desp'];
				$free_event['date_from'] = date('Y-m-d H:i:s', strtotime($this->request->data['date_from']));
				$free_event['date_to'] = date('Y-m-d H:i:s', strtotime($this->request->data['date_to']));
				$free_event['fee_assign'] = "user";
				$free_event['is_free'] = "Y";
				$free_event['allow_register'] = ($this->request->data['allow_register'] == 'Y') ? 'Y' : 'N';
				$free_event['admineventstatus'] = $forFreeEvent;
				$free_event['request_rsvp'] = date('Y-m-d H:i:s', strtotime($this->request->data['request_rsvp']));
				$addeventdata = $this->Event->patchEntity($addevent, $free_event);

				if ($addeventsave = $this->Event->save($addeventdata)) {
					// Create comp ticket default
					$checkTicket = $this->Eventdetail->find('all')->where(['eventid' => $addeventsave['id']])->first();
					if (empty($checkTicket)) {
						$newcomps = $this->Eventdetail->newEntity();
						$comps['title'] = 'Comps';
						$comps['price'] = 0;
						$comps['eventid'] = $addeventsave['id'];
						$comps['userid'] = $user_id;
						$comps['count'] = 0;
						$comps['type'] = 'comps';
						$comps['hidden'] = 'Y';
						$compsupdate = $this->Eventdetail->patchEntity($newcomps, $comps);
						$this->Eventdetail->save($compsupdate);
					}
					//user role id change
					$user_data = $this->Users->get($user_id);
					$user_data->role_id = '2';
					$this->Users->save($user_data);
					return $this->redirect(['controller' => 'event', 'action' => 'settings/' . $addeventsave['id']]);
				} else {
					$this->Flash->error(__('Something went Wrong ! Try after some time.'));
					return $this->redirect(['controller' => 'event', 'action' => 'postevent']);
				}
			} else {

				if ($imagefilename) {
					$itemww = $this->request->data['event_image']['tmp_name'];
					$ext = pathinfo($imagefilename, PATHINFO_EXTENSION);
					$name = time() . md5($imagefilename);
					$imagename = $name . '.' . $ext;
					if (move_uploaded_file($itemww, "images/eventimages/" . $imagename)) {
						$paid_event['feat_image'] = $imagename;
					}
				}
				$paid_event['event_org_id'] = $user_id;
				$paid_event['company_id'] = $this->request->data['company_id'];
				$paid_event['name'] = $this->request->data['name'];
				$paid_event['country_id'] = $this->request->data['country_id'];
				$paid_event['location'] = $this->request->data['location'];
				$paid_event['video_url'] = $this->request->data['video_url'];
				$paid_event['payment_currency'] = $this->request->data['payment_currency'];
				$paid_event['date_from'] = date('Y-m-d H:i:s', strtotime($this->request->data['date_from']));
				$paid_event['date_to'] = date('Y-m-d H:i:s', strtotime($this->request->data['date_to']));
				$paid_event['sale_start'] = date('Y-m-d H:i:s', strtotime($this->request->data['sale_start']));
				$paid_event['sale_end'] = date('Y-m-d H:i:s', strtotime($this->request->data['sale_end']));
				$paid_event['ticket_limit'] = $this->request->data['ticket_limit'];
				$paid_event['slug'] = $this->request->data['slug'];
				$paid_event['approve_timer'] = $this->request->data['approve_timer'];
				$paid_event['desp'] = trim($this->request->data['desp']);
				$paid_event['fee_assign'] = "user";
				$paid_event['admineventstatus'] = $forPaidEvent;
				$addeventdata = $this->Event->patchEntity($addevent, $paid_event);
				if ($addeventsave = $this->Event->save($addeventdata)) {
					//user role id change
					$user_data = $this->Users->get($user_id);
					$user_data->role_id = '2';
					$this->Users->save($user_data);
					return $this->redirect(['controller' => 'event', 'action' => 'settings/' . $addeventsave['id']]);
				} else {
					return $this->redirect(['controller' => 'event', 'action' => 'postevent']);
				}
			}
			$this->Flash->error(__('Something went Wrong ! Try after some time.'));
			return $this->redirect($this->referer());
		}
	}

	public function checkexist($data = null)
	{
		$this->loadModel('Event');
		$this->autoRender = false;

		if (!empty($this->request->data['exist_slug'])) {
			$checker = $this->Event->find('all')->where(['Event.slug' => $this->request->data['exist_slug']])->first();
		} else {
			$checker = $this->Event->find('all')->order(['Event.id' => 'DESC'])->first();
		}
		echo json_encode($checker);
		die;
	}

	public function myevent()
	{
		$this->loadModel('Event');
		$this->loadModel('Eventdetail');
		$date = date("Y-m-d H:i:s");
		$user_id = $this->request->session()->read('Auth.User.id');
		// pr($date);die;
		// $upcoming_event = $this->Event->find('all')->where(['Event.date_from >=' => $date, 'Event.event_org_id' => $user_id])->contain(['Users'])->order(['Event.id' => 'DESC'])->toarray();
		$upcoming_event = $this->Event->find('all')->contain(['Eventdetail'])->where(['Event.event_org_id' => $user_id])->contain(['Users'])->order(['Event.id' => 'DESC']);
		$upcoming_event = $this->paginate($upcoming_event)->toarray();
		$this->set('event', $upcoming_event);

		$past_event = $this->Event->find('all')->where(['Event.date_from <' => $date, 'Event.event_org_id' => $user_id, 'Event.status' => 'Y', 'Event.admineventstatus' => 'Y'])->contain(['Users'])->order(['Event.id' => 'DESC'])->toarray();
		$this->set('pastevent', $past_event);
	}

	public function manage($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Addons');

		$user_id = $this->request->session()->read('Auth.User.id');

		$event = $this->Event->find('all')->contain(['Currency', 'Addons'])->where(['Event.id' => $id])->first();
		$this->set('event', $event);
		// $findaddons = $this->Addons->find('all')->where(['Addons.event_id' => $id])->toarray();
		// $this->set('findaddons', $findaddons);

		if (isset($id) && !empty($id)) {
			$findtickets = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id])->order(['Eventdetail.id' => 'ASC'])->toarray();
			$this->set('findtickets', $findtickets);
		} else {
			$this->Flash->error(__('Ticket Id not fount'));
			return $this->redirect(['action' => 'manage/' . $id]);
		}

		if ($this->request->is(['post', 'put'])) {

			if (isset($id) && !empty($id)) {
				// pr($this->request->data);exit;
				$checkTicket = $this->Eventdetail->find('all')->where(['eventid' => $id])->first();
				$newticket = $this->Eventdetail->newEntity();
				if (empty($checkTicket)) {
					$newcomps = $this->Eventdetail->newEntity();
					$comps['title'] = 'Comps';
					$comps['price'] = 0;
					$comps['eventid'] = $id;
					$comps['userid'] = $user_id;
					$comps['count'] = 0;
					$comps['type'] = 'comps';
					$comps['hidden'] = 'Y';
					$compsupdate = $this->Eventdetail->patchEntity($newcomps, $comps);
					$this->Eventdetail->save($compsupdate);
				}
				$requestdata['title'] = ucwords(strtolower($this->request->data['title']));
				$requestdata['price'] = $this->request->data['price'];
				$requestdata['eventid'] = $id;
				$requestdata['userid'] = $user_id;
				if ($this->request->data['type'] != 'committee_sales') {
					$requestdata['count'] = $this->request->data['count'];
				}
				$requestdata['type'] = $this->request->data['type'];
				$requestdata['hidden'] = $this->request->data['hidden'];
				$updataevent = $this->Eventdetail->patchEntity($newticket, $requestdata);
				$result = $this->Eventdetail->save($updataevent);
				if ($result) {
					// $this->Flash->success(__('' . $updataevent['title'] . ' has been added successfully.'));
					return $this->redirect(['action' => 'manage/' . $id]);
				}
			}
		}

		$this->set('id', $id);
	}

	public function package($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Addons');
		$this->loadModel('Package');
		$this->loadModel('Packagedetails');

		$user_id = $this->request->session()->read('Auth.User.id');

		$event = $this->Event->find('all')->contain(['Currency', 'Addons'])->where(['Event.id' => $id])->first();
		$this->set('event', $event);

		if (isset($id) && !empty($id)) {
			$findtickets = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id])->order(['Eventdetail.id' => 'ASC'])->toarray();

			// Get package data with details
			$packageData = $this->Package->find()
				->contain(['Packagedetails'])
				->toarray();


			$this->set('packageData', $packageData);
			$this->set('findtickets', $findtickets);

			// pr($packageData);exit;
		}
		// $this->Flash->success(__('Package has been crated successfully.'));

		if ($this->request->is(['post', 'put'])) {

			$reqData = $this->request->getData(); // fixed variable name
			//pr($reqData);exit;

			// Check if type data is missing
			$redirect = true;
			foreach ($reqData['type'] as $ticket_type_id => $ticket_count) {
				if ($ticket_count != 0) {
					$redirect = false;
					break;
				}
			}

			if ($redirect) {
				$this->Flash->error(__('Package creation failed. Please select at least one ticket type.'));
				return $this->redirect($this->referer());
			}


			$package = $this->Package->newEntity();
			$package->name = $reqData['package_name'];
			$package->package_limit = $reqData['package_limit'];
			$package->discount_percentage = $reqData['discount_percentage'];
			$package->discount_amt = $reqData['discount_amt'];
			$package->event_id = $id;
			$package->total = $reqData['total'];
			$package->grandtotal = $reqData['grandtotal'];
			$this->Package->save($package);
			// // Get package ID
			$package_id = $package->id;
			// // Save data to Packagedetails table
			foreach ($reqData['type'] as $ticket_type_id => $ticket_count) {
				$package_details = $this->Packagedetails->newEntity();
				$package_details->package_id = $package_id;
				$package_details->ticket_type_id = $ticket_type_id;
				$package_details->qty = $ticket_count;
				$package_details->price = $reqData['ticket_price'][$ticket_type_id]; // fixed array key 
				$package_details->hidden = $reqData['hidden'];
				$this->Packagedetails->save($package_details);
			}
			// Save addon details
			foreach ($reqData['addons'] as $addon_id => $addon_count) {
				$addon_details = $this->Packagedetails->newEntity();
				$addon_details->package_id = $package_id;
				$addon_details->addon_id = $addon_id;
				$addon_details->qty = $addon_count;
				$addon_details->price = $reqData['addon_price'][$addon_id];
				$this->Packagedetails->save($addon_details);
			}

			$this->Flash->success(__('Package has been crated successfully.'));
			// $this->set('redirect', $this->referer());
			return $this->redirect(['action' => 'package/' . $id]);
		}

		$this->set('id', $id);
	}

	public function editpackage($event_id = null, $package_id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Addons');
		$this->loadModel('Package');
		$this->loadModel('Packagedetails');

		$user_id = $this->request->session()->read('Auth.User.id');

		$event = $this->Event->find('all')->contain(['Currency', 'Addons'])->where(['Event.id' => $event_id])->first();
		$this->set('event', $event);

		if (isset($package_id) && !empty($package_id)) {

			// Get package data with details
			$packageData = $this->Package->find()
				->where(['Package.id' => $package_id])
				->contain(['Packagedetails' => ['Eventdetail']])
				->first();

			$addonsData = $this->Packagedetails->find()
				->where(['Packagedetails.addon_id IS NOT' => null, 'Packagedetails.package_id' => $package_id])
				->contain(['Addons'])
				->toArray();

			$this->set('packageData', $packageData);
			$this->set('addonsData', $addonsData);
		} else {
			$this->Flash->error(__('Package Id not found'));
			return $this->redirect(['action' => 'package/' . $event_id]);
		}

		if ($this->request->is(['post', 'put'])) {
			$requestData = $this->request->getData(); // fixed variable name
			// Save data to Package table
			$package = $this->Package->get($package_id);
			$package->name = $requestData['package_name'];
			$package->hidden = $requestData['hidden'];
			$this->Package->save($package);
			$this->Flash->success(__('Package has been updated successfully.'));
			return $this->redirect(['action' => 'package/' . $event_id]);
		}

		$this->set('id', $event_id);
	}

	public function toggle($toggle = null, $id = null)
	{
		$this->loadModel('Eventdetail');
		$this->loadModel('Addons');
		$this->loadModel('Ticket');
		$this->loadModel('Cart');
		$this->loadModel('Package');


		if ($toggle == 'hideaddon') {
			$getaddons = $this->Addons->get($id);
			$type = $getaddons->hidden;
			if ($type == 'Y') {
				$getaddons->hidden = 'N';
			} else {
				$getaddons->hidden = 'Y';
			}

			if ($this->Addons->save($getaddons)) {
				$this->Flash->success(__('Addon has been updated.'));
				return $this->redirect(['action' => 'addons/' . $getaddons['event_id']]);
			}
		}

		if ($toggle == 'hiddenpackage') {
			$package = $this->Package->get($id);
			$type = $package->hidden;
			if ($type == 'Y') {
				$package->hidden = 'N';
			} else {
				$package->hidden = 'Y';
			}

			if ($this->Package->save($package)) {
				$this->Flash->success(__('Package has been updated.'));
			}
			return $this->redirect($this->referer());
			// return $this->redirect(['action' => 'package/' . $package['event_id']]);
		}

		$getticket = $this->Eventdetail->get($id);
		if ($toggle == 'type') {
			$type = $getticket->type;
			if ($type == 'open_sales') {
				$getticket->type = 'committee_sales';
			} else {
				$getticket->type = 'open_sales';
			}
			//pr($getticket); //die;
			$ticketpurchased   = $this->Ticket->find('all')->where(['Ticket.event_ticket_id' => $id])->first();

			$ticketpurchasedcart   = $this->Cart->find('all')->where(['Cart.ticket_id' => $id, 'Cart.status' => 'Y'])->order(['Cart.user_id' => 'ASC'])->first();
			//pr($ticketpurchased);
			//pr($ticketpurchasedcart); die;

			if (!empty($ticketpurchased) || !empty($ticketpurchasedcart)) {
				$this->Flash->error(__('You cannot update the ticket type ticket already has been booked by the user'));
				return $this->redirect(['action' => 'manage/' .  $getticket['eventid']]);
			}

			if ($this->Eventdetail->save($getticket)) {
				$this->Flash->success(__('Your Type has been updated.'));
				return $this->redirect(['action' => 'manage/' . $getticket['eventid']]);
			}
		} elseif ($toggle == 'hidden') {

			$type = $getticket->hidden;
			if ($type == 'Y') {
				$getticket->hidden = 'N';
			} else {
				$getticket->hidden = 'Y';
			}

			if ($this->Eventdetail->save($getticket)) {
				$this->Flash->success(__('Your Type has been updated.'));
				return $this->redirect(['action' => 'manage/' . $getticket['eventid']]);
			}
		} elseif ($toggle == 'sold_out') {

			$type = $getticket->sold_out;
			if ($type == 'Y') {
				$getticket->sold_out = 'N';
			} else {
				$getticket->sold_out = 'Y';
			}

			if ($this->Eventdetail->save($getticket)) {
				$this->Flash->success(__('Your Type has been updated.'));
				return $this->redirect(['action' => 'manage/' . $getticket['eventid']]);
			}
		} else {
			$this->Flash->error(__('Somthing went wrong Try Again !'));
			return $this->redirect(['action' => 'manage/' . $getticket['eventid']]);
		}
	}

	public function edittickets($id = null)
	{
		$this->loadModel('Eventdetail');
		$this->loadModel('Ticket');
		$this->loadModel('Cart');
		if (isset($id) && !empty($id)) {
			$findtickets = $this->Eventdetail->get($id);
			$this->set('findtickets', $findtickets);
		}
		if ($this->request->is(['post', 'put'])) {

			$ticketpurchased   = $this->Ticket->find('all')->where(['Ticket.event_ticket_id' => $id])->first();

			$ticketpurchasedcart   = $this->Cart->find('all')->where(['Cart.ticket_id' => $id, 'Cart.status' => 'Y'])->order(['Cart.user_id' => 'ASC'])->first();


			if (!empty($ticketpurchased) || !empty($ticketpurchasedcart)) {

				if ($this->request->data['tmp_type'] != $this->request->data['type']) {
					$this->Flash->error(__('You cannot update the price for ' . $this->request->data['title'] . ' because requests has already been approved at this price.'));
					return $this->redirect(['action' => 'manage/' . $findtickets['eventid']]);
				}
			}
			$this->request->data['title'] = ucwords(strtolower($this->request->data['title']));
			$updataevent = $this->Eventdetail->patchEntity($findtickets, $this->request->data);
			if ($this->Eventdetail->save($updataevent)) {
				$this->Flash->success(__('Ticket has been updated.'));
				return $this->redirect(['action' => 'manage/' . $findtickets['eventid']]);
			} else {
				$this->Flash->error(__('Ticket not updated.'));
				return $this->redirect(['action' => 'manage/' . $findtickets['eventid']]);
			}
		}
	}

	// Add Addons 
	public function addons($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Addons');

		$user_id = $this->request->session()->read('Auth.User.id');

		$event = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		$this->set('event', $event);

		if (isset($id) && !empty($id)) {
			$findaddons = $this->Addons->find('all')->where(['Addons.event_id' => $id])->toarray();
			$this->set('findaddons', $findaddons);
		} else {
			$this->Flash->error(__('Addon Id not fount'));
			return $this->redirect(['action' => 'addons/' . $id]);
		}

		if ($this->request->is(['post', 'put'])) {

			$newAddons = $this->Addons->newEntity();
			$this->request->data['event_id'] = $id;
			$this->request->data['name'] = ucwords(strtolower($this->request->data['name']));
			$this->request->data['description'] = ucfirst(strtolower($this->request->data['description']));
			$updateaddon = $this->Addons->patchEntity($newAddons, $this->request->data);
			if ($this->Addons->save($updateaddon)) {
				$this->Flash->success(__('' . $updateaddon['name'] . ' has been added successfully.'));
				return $this->redirect(['action' => 'addons/' . $id]);
			}
		}

		$this->set('id', $id);
	}

	// Edit addons 
	public function editaddon($id = null)
	{
		$this->loadModel('Addons');

		if (isset($id) && !empty($id)) {
			$findaddon = $this->Addons->get($id);
			$this->set('findaddon', $findaddon);
		}
		if ($this->request->is(['post', 'put'])) {
			$this->request->data['name'] = ucwords(strtolower($this->request->data['name']));
			$this->request->data['description'] = ucfirst(strtolower($this->request->data['description']));

			$updataevent = $this->Addons->patchEntity($findaddon, $this->request->data);
			if ($this->Addons->save($updataevent)) {
				$this->Flash->success(__('Addon has been updated.'));
				return $this->redirect(['action' => 'addons/' . $findaddon['event_id']]);
			} else {
				$this->Flash->error(__('Addon not updated.'));
				return $this->redirect(['action' => 'addons/' . $findaddon['event_id']]);
			}
		}
	}

	public function questions($id = null)
	{
		$this->loadModel('Eventdetail');
		$this->loadModel('Users');
		$this->loadModel('Question');
		$this->loadModel('Questionitems');

		$user_id = $this->request->session()->read('Auth.User.id');
		if (isset($id) && !empty($id)) {
			// $findquestion = $this->Question->find('all')->contain(['Questionitems'])->where(['Question.event_id' => $id])->toarray();
			$tickettype = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id, 'Eventdetail.price !=' => 0])->toarray();
			$findquestion = $this->Question->find('all')->where(['Question.event_id' => $id])->toarray();
			$this->set('findquestion', $findquestion);
			$this->set('tickettype', $tickettype);
		} else {
			$this->Flash->error(__('Question Id not fount'));
			return $this->redirect(['action' => 'Question/' . $id]);
		}

		if ($this->request->is(['post', 'put'])) {


			if (!empty($this->request->data['name'])) {

				$newQuestion = $this->Question->newEntity();
				$this->request->data['event_id'] = $id;
				$this->request->data['name'] = ucwords(strtolower($this->request->data['name']));
				$this->request->data['question'] = ucwords(strtolower($this->request->data['question']));
				$this->request->data['type'] = $this->request->data['type'];
				$newquestion = $this->Question->patchEntity($newQuestion, $this->request->data);
				if ($result = $this->Question->save($newquestion)) {
					if (!empty($this->request->data['items'][0])) {
						foreach ($this->request->data['items'] as $key => $value) {
							$newitems = $this->Questionitems->newEntity();
							$items['question_id'] = $result->id;
							$items['items']	= ucfirst(strtolower($value));
							$newitemadd = $this->Questionitems->patchEntity($newitems, $items);
							$this->Questionitems->save($newitemadd);
						}
					}

					$this->Flash->success(__('' . $newquestion['name'] . ' has been added successfully.'));
					return $this->redirect(['action' => 'questions/' . $id]);
				}
			} else {
				$this->Flash->error(__('Please fill the form'));
				return $this->redirect(['action' => 'questions/' . $id]);
			}
		}


		$this->set('id', $id);
	}

	public function linktickets($id = null)
	{
		$this->loadModel('Eventdetail');
		$this->loadModel('Users');
		$this->loadModel('Question');
		$this->loadModel('Questionitems');

		if ($this->request->is(['post', 'put'])) {

			if (!empty($this->request->data['tickets'])) {

				$findquestion = $this->Question->find('all')->where(['event_id' => $this->request->data['event_id'], 'id' => $this->request->data['question']])->first();
				$tickeid = implode(',', $this->request->data['tickets']);

				$tickets_id = $findquestion->ticket_type_id;
				$findquestion->ticket_type_id = $tickeid;


				if ($this->Question->save($findquestion)) {
					$this->Flash->success(__('Question has been linked with selected tickets.'));
					return $this->redirect(['action' => 'questions/' . $this->request->data['event_id']]);
				}
			} else {
				$findquestion = $this->Question->find('all')->where(['event_id' => $this->request->data['event_id'], 'id' => $this->request->data['question']])->first();
				$tickeid = implode(',', $this->request->data['tickets']);
				$findquestion->ticket_type_id = $tickeid;
				if ($this->Question->save($findquestion)) {
					$this->Flash->success(__('Question has been unlinked successfully.'));
					return $this->redirect(['action' => 'questions/' . $this->request->data['event_id']]);
				}
			}
		}
	}

	public function editquestion($id = null)
	{
		$this->loadModel('Question');
		$this->loadModel('Questionitems');

		if (isset($id) && !empty($id)) {
			$findquestion = $this->Question->get($id);
			$this->set('findquestion', $findquestion);
		}
		if ($this->request->is(['post', 'put'])) {

			$this->request->data['name'] = ucwords(strtolower($this->request->data['name']));
			$this->request->data['question'] = ucwords(strtolower($this->request->data['question']));
			$updatequestion = $this->Question->patchEntity($findquestion, $this->request->data);

			if ($result = $this->Question->save($updatequestion)) {
				$this->Questionitems->deleteAll(['Questionitems.question_id' => $id]);
				foreach ($this->request->data['items'] as $key => $value) {
					$newitems = $this->Questionitems->newEntity();
					$items['question_id'] = $result->id;
					$items['items']	= ucfirst(strtolower($value));
					$newitemadd = $this->Questionitems->patchEntity($newitems, $items);
					$this->Questionitems->save($newitemadd);
				}

				$this->Flash->success(__('' . $updatequestion['name'] . ' has been updated successfully.'));
				return $this->redirect(['action' => 'questions/' . $updatequestion['event_id']]);
			}
		}
	}

	public function committee($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Committe');
		$user_id = $this->request->session()->read('Auth.User.id');
		$this->set('user_id', $user_id);


		if (isset($id) && !empty($id)) {
			$findcommittee = $this->Committe->find('all')->contain(['Users'])->where(['event_id' => $id, 'Users.status' => 'Y'])->order(['Users.name' => 'ASC']);
			$findcommittee = $this->paginate($findcommittee)->toarray();
			$this->set('findcommittee', $findcommittee);
		}

		if ($this->request->is(['post', 'put'])) {


			if (!empty($this->request->data['user_id']) && !empty($this->request->data['email'])) {
				$finddata = $this->Committe->find('all')->contain(['Users'])->where(['event_id' => $id, 'user_id' => $this->request->data['user_id']])->first();
				if ($finddata) {
					$this->Flash->error(__('A user with the email ' . $finddata["user"]["email"] . ' is already on this committee.'));
					return $this->redirect(['action' => 'committee/' . $id]);
				} else {
					$newcommittee = $this->Committe->newEntity();
					$this->request->data['user_id'] = $this->request->data['user_id'];
					$this->request->data['event_id'] = $id;
					$newadd = $this->Committe->patchEntity($newcommittee, $this->request->data);
					$this->Committe->save($newadd);
					$this->Flash->success(__('Committee member has been add successfully.'));
					return $this->redirect(['action' => 'committee/' . $id]);
				}
			} else {
				$this->Flash->error(__('Please choose any users'));
				return $this->redirect(['action' => 'committee/' . $id]);
			}
		}
		$this->set('id', $id);
	}

	public function getusersname($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Committe');
		$stsearch = $this->request->data['fetch'];
		$check = $this->request->data['check'];
		$event_id = $this->request->data['event_id'];

		if ($event_id) {

			$searchst = $this->Committe->find('all')->contain(['Users'])->where(['Committe.event_id' => $event_id, 'Users.email LIKE' => '%' . $stsearch . '%', 'Users.status' => 'Y', 'Users.role_id !=' => '1'])->toarray();
			if (empty($searchst)) {
				echo '<li><a href="javascript:void(0)" class="list-group-item">We couldn’t find any user</a></li>';
			} else {
				foreach ($searchst as $key => $value) {
					echo '<li onclick="selectsearch(' . "'" . $value['user']['email'] . "'" . ',' . "'" . $value['user']['id'] . "'" . ',' . "'" . $key . "'" . ')"><a href="javascript:void(0)" class="list-group-item">' . $value['user']['name'] . ' ' . $value['user']['lname'] . ' (' . $value['user']['email'] . ')' . '</a></li>';
				}
			}
			die;
		} else {

			$searchst = $this->Users->find('all')->where(['Users.email LIKE' => '%' . $stsearch . '%', 'Users.status' => 'Y', 'Users.role_id !=' => '1'])->toarray();
			if (empty($searchst)) {
				echo '<li><a href="javascript:void(0)" class="list-group-item">We couldn’t find any user</a></li>';
			} else {
				foreach ($searchst as $key => $value) {
					echo '<li onclick="selectsearch(' . "'" . $value['email'] . "'" . ',' . "'" . $value['id'] . "'" . ',' . "'" . $key . "'" . ')"><a href="javascript:void(0)" class="list-group-item">' . $value['name'] . ' ' . $value['lname'] . ' (' . $value['email'] . ')' . '</a></li>';
				}
			}
			die;
		}
	}

	public function geteventcommittee($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Event');
		$stsearch = $this->request->data['fetch'];
		$check = $this->request->data['check'];
		$user_id = $this->request->data['user_id'];
		$eventid = $this->request->data['event_id'];
		$IsFree = $this->request->data['IsFree'];

		$searchst = $this->Event->find('all')->where(['Event.name LIKE' => '%' . $stsearch . '%', 'Event.event_org_id' => $user_id, 'Event.is_free' => $IsFree, 'Event.id NOT IN' => $eventid])->toarray();
		// pr($searchst);exit;
		if (empty($searchst)) {
			echo '<li><a href="javascript:void(0)" class="list-group-item">We couldn’t find any event</a></li>';
		} else {
			foreach ($searchst as $key => $value) {
				echo '<li onclick="selectevent(' . "'" . $value['name'] . "'" . ',' . "'" . $value['id'] . "'" . ',' . "'" . $key . "'" . ')"><a href="javascript:void(0)" class="list-group-item">' . $value['name'] . '</a></li>';
			}
		}
		die;
	}

	public function importcommittee($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Committe');

		if ($this->request->is(['post', 'put'])) {
			$findmember = $this->Committe->find('all')->where(['event_id' => $this->request->data['import_event_id']])->toarray();
			if (!empty($findmember[0]['id'])) {
				foreach ($findmember as $key => $value) {

					// already exist user in committee table 
					$checkmember = $this->Committe->find('all')->where(['user_id' => $value['user_id'], 'event_id' => $this->request->data['to_event_id']])->first();
					if (!empty($checkmember['id'])) {
						continue;
					}

					$newcommittee = $this->Committe->newEntity();
					$newdata['user_id'] = $value['user_id'];
					$newdata['event_id'] = $this->request->data['to_event_id'];
					$newadd = $this->Committe->patchEntity($newcommittee, $newdata);
					$this->Committe->save($newadd);
				}
				$this->Flash->success(__('Committee member has been added successfully.'));
				return $this->redirect(['action' => 'committee/' . $this->request->data['to_event_id']]);
			} else {

				$this->Flash->error(__('Sorry no committee member available in this event.'));
				return $this->redirect(['action' => 'committee/' . $this->request->data['to_event_id']]);
			}
		}
	}

	public function committeoptions($id = null, $status = null)
	{
		$this->loadModel('Committe');
		$this->loadModel('Committeeassignticket');
		$this->loadModel('Groupmember');

		$getcommittee = $this->Committe->get($id);
		if (!empty($status)) {
			if ($getcommittee['status'] == "N") {
				$getcommittee->status = 'Y';
			} else {
				$getcommittee->status = 'N';
			}

			if ($this->Committe->save($getcommittee)) {
				$this->Flash->success(__('Committee member status has been updated successfully.'));
				return $this->redirect(['action' => 'committee/' . $getcommittee['event_id']]);
			}
		} else {
			if ($getcommittee) {

				$this->Committeeassignticket->deleteAll(['user_id' => $getcommittee['user_id']]);
				$this->Groupmember->deleteAll(['user_id' => $getcommittee['user_id']]);
				$this->Committe->deleteAll(['Committe.id' => $id]);
				$this->Flash->success(__('Committee member has been deleted successfully.'));
				return $this->redirect(['action' => 'committee/' . $getcommittee['event_id']]);
			} else {
				$this->Flash->error(__('Committee user id not found.'));
				return $this->redirect(['action' => 'committee/' . $_GET['id']]);
			}
		}
	}

	public function committeegroups($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('CommitteeGroup');
		// $user_id = $this->request->session()->read('Auth.User.id');

		if (isset($id) && !empty($id)) {

			$findgroup = $this->CommitteeGroup->find('all')->contain(['Event'])->where(['CommitteeGroup.event_id' => $id])->toarray();
			$this->set('findgroup', $findgroup);
		}

		if ($this->request->is(['post', 'put'])) {

			if (!empty($this->request->data['event_id'])) {
				$newgroup = $this->CommitteeGroup->newEntity();
				$requestdata['event_id'] = $this->request->data['event_id'];
				$requestdata['name'] = $this->request->data['name'];
				$newadd = $this->CommitteeGroup->patchEntity($newgroup, $requestdata);
				if ($this->CommitteeGroup->save($newadd)) {
					$this->Flash->success(__('Group has been created successfully.'));
					return $this->redirect(['action' => 'committeegroups/' . $id]);
				}
			} else {
				$this->Flash->error(__('Event id not does not exist'));
				return $this->redirect(['action' => 'committeegroups/' . $id]);
			}
		}
		$this->set('id', $id);
	}

	public function addgroupmember($id = null)
	{
		$this->loadModel('Groupmember');
		$this->loadModel('Users');
		$this->loadModel('CommitteeGroup');
		$this->loadModel('Committeeassignticket');


		if (isset($id) && !empty($id)) {
			$findgroup = $this->CommitteeGroup->get($id);
			$this->set('findgroup', $findgroup);

			$findmember = $this->Groupmember->find('all')->contain(['Users'])->where(['Groupmember.group_id' => $id])->toarray();
			$this->set('findmember', $findmember);
		}

		if ($this->request->is(['post', 'put'])) {

			if (!empty($this->request->data['user_id'])) {

				// delete from tickets details particular user  
				$checkexist = $this->Committeeassignticket->find('all')->where(['user_id' => $this->request->data['user_id']])->toarray();

				if (!empty($checkexist[0]['id'])) {
					$this->Committeeassignticket->deleteAll(['user_id' => $this->request->data['user_id']]);
				}

				$checkmember = $this->Groupmember->find('all')->where(['Groupmember.group_id' => $id, 'Groupmember.user_id' => $this->request->data['user_id']])->first();

				if ($checkmember) {
					$this->Flash->error(__('User already added.'));
					return $this->redirect(['action' => 'addgroupmember/' . $findgroup['id']]);
				} else {
					$newmember = $this->Groupmember->newEntity();
					$requestdata['user_id'] = $this->request->data['user_id'];
					$requestdata['group_id'] = $findgroup->id;
					$newadd = $this->Groupmember->patchEntity($newmember, $requestdata);
					if ($this->Groupmember->save($newadd)) {
						$this->Flash->success(__('Member has been added successfully.'));
						return $this->redirect(['action' => 'addgroupmember/' . $findgroup['id']]);
					}
				}
			} else {
				$this->Flash->error(__('User not found.'));
				return $this->redirect(['action' => 'addgroupmember/' . $findgroup['id']]);
			}
		}
		$this->set('id', $findgroup['event_id']);
	}

	//delete member from committee group
	public function deletemember($id = null, $group_id = null)
	{
		$this->loadModel('Groupmember');
		$this->loadModel('CommitteeGroup');
		$this->loadModel('Committeeassignticket');


		if (isset($id) && !empty($id)) {

			$findgroupmember = $this->Groupmember->get($id);

			// delete from tickets details particular user  
			$checkexist = $this->Committeeassignticket->find('all')->where(['user_id' => $findgroupmember['user_id'], 'group_id' => $group_id])->first();

			if (!empty($checkexist['id'])) {
				$this->Committeeassignticket->deleteAll(['user_id' => $findgroupmember['user_id'], 'group_id' => $group_id]);
			}

			$this->Groupmember->deleteAll(['Groupmember.id' => $findgroupmember['id']]);
			$this->Flash->success(__('Member has been delete from this group'));
			return $this->redirect(['action' => 'addgroupmember/' . $findgroupmember['group_id']]);
		} else {
			$this->Flash->error(__('Member id does not exist'));
			$this->set('redirect', $this->referer());
		}
	}

	public function committeetickets($id = null)
	{
		$this->loadModel('Groupmember');
		$this->loadModel('CommitteeGroup');
		$this->loadModel('Event');
		$this->loadModel('Committe');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Committeeassignticket');
		$user_id = $this->request->session()->read('Auth.User.id');
		if (isset($id) && !empty($id)) {

			$ticketstype = $this->Eventdetail->find('all')->where(['eventid' => $id, 'status' => 'Y', 'type !=' => 'open_sales'])->toarray();
			// pr($ticketstype);exit;

			$findcommember = $this->Committe->find('all')->contain(['Users'])->where(['event_id' => $id, 'Users.status' => 'Y'])->toarray();

			$findgroupmember = $this->Groupmember->find('all')->contain(['CommitteeGroup'])->where(['CommitteeGroup.event_id' => $id])->group('group_id')->toarray();

			$this->set(compact('ticketstype', 'findcommember', 'findgroupmember'));
		} else {
			$this->Flash->error(__('No any event selected'));
			return $this->redirect(['action' => 'myevent']);
		}

		$this->set('id', $id);
	}

	public function assigncommtickets($user_id = null, $group_id = null, $event_id = null)
	{

		$this->loadModel('Users');
		$this->loadModel('CommitteeGroup');
		$this->loadModel('Event');
		$this->loadModel('Eventdetail');
		$this->loadModel('Committeeassignticket');

		if (isset($user_id) && !empty($user_id) && isset($group_id) && ($group_id != 'N')) {

			$getuser = $this->Users->get($user_id);
			$getgroup = $this->CommitteeGroup->get($group_id);
			// $currency = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $getgroup['event_id']])->first();
			$gettickettype = $this->Eventdetail->find('all')->where(['eventid' => $getgroup['event_id'], 'status' => 'Y', 'type !=' => 'open_sales'])->toarray();

			$this->set('getuser', $getuser);
			$this->set('gettickettype', $gettickettype);
		} else if (isset($user_id) && !empty($user_id) && isset($group_id) && !empty($group_id) && isset($event_id) && ($event_id)) {

			$getuser = $this->Users->get($user_id);
			$gettickettype = $this->Eventdetail->find('all')->where(['eventid' => $event_id, 'status' => 'Y', 'type !=' => 'open_sales'])->toarray();
			$this->set('getuser', $getuser);
			$this->set('gettickettype', $gettickettype);
		}

		$this->set(compact('user_id', 'group_id', 'event_id'));


		if ($this->request->is(['post'])) {
			// pr($this->request->data);exit;

			foreach ($this->request->data['count'] as $key => $tickets) {

				if ($this->request->data['group_id'] == 'N') {
					$groupId = 0;
				} else {
					$groupId = $this->request->data['group_id'];
				}

				$checkexist = $this->Committeeassignticket->find('all')->where(['user_id' => $this->request->data['user_id'], 'group_id' => $groupId, 'ticket_id' => $key, 'event_id' => $this->request->data['event_id']])->first();


				// Update tickets
				if ($checkexist['id']) {
					$requestdata['count'] = $tickets;
					$requestdata['updated'] = date('Y-m-d H:i:s');
					$newaddupdate = $this->Committeeassignticket->patchEntity($checkexist, $requestdata);
					$this->Committeeassignticket->save($newaddupdate);
				} else {
					// new add tickets 
					$newaddrecord = $this->Committeeassignticket->newEntity();
					$requestdata['user_id'] = $this->request->data['user_id'];
					$requestdata['ticket_id'] = $key;
					$requestdata['group_id'] = $groupId;
					$requestdata['event_id'] = $this->request->data['event_id'];
					$requestdata['count'] = $tickets;
					$newadd = $this->Committeeassignticket->patchEntity($newaddrecord, $requestdata);
					$this->Committeeassignticket->save($newadd);
				}
			}

			$this->Flash->success(__('Ticket update successfully'));
			return $this->redirect(['action' => 'committeetickets/' . $this->request->data['event_id']]);
		}
	}

	// public function boxoffice($id = null)
	// {
	// 	$this->loadModel('Users');
	// 	$this->loadModel('CommitteeGroup');
	// 	$this->loadModel('Event');
	// 	$this->loadModel('Eventdetail');
	// 	$this->loadModel('Committeeassignticket');

	// 	$user_id = $this->request->session()->read('Auth.User.id');

	// 	$currency = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
	// 	$findtickets = $this->Committeeassignticket->find('all')->contain(['Eventdetail'])->where(['Committeeassignticket.user_id' => $user_id])->toarray();

	// 	$this->set(compact('id', 'findtickets', 'currency'));

	// 	if ($this->request->is(['post', 'put'])) {
	// 		pr($this->request->data);
	// 		exit;
	// 	}
	// }

	public function deletevent($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Eventdetail');
		$this->loadModel('Question');
		$this->loadModel('Questionitems');
		$this->loadModel('Groupmember');
		$this->loadModel('Committe');
		$this->loadModel('CommitteeGroup'); //tblgroup
		$this->loadModel('Addons');
		$this->loadModel('Committeeassignticket');
		$this->loadModel('Attendeeslist');

		if (!empty($id)) {
			// pr($id);exit;
			$checkbooked = $this->Ticket->find('all')->where(['Ticket.event_id' => $id])->first();
			if (!empty($checkbooked)) {
				$this->Flash->error(__('Sorry this event can`t delete User`s already book tickets'));
				return $this->redirect(['action' => 'myevent']);
			} else {
				$findevent = $this->Event->find('all')->where(['Event.id' => $id])->first();
				// $this->Event->delete($findevent);

				// $findtickettype = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id])->toarray();
				// $findaddons = $this->Addons->find('all')->where(['Addons.event_id' => $id])->toarray();
				// $findquestion = $this->Question->find('all')->contain(['Questionitems'])->where(['Question.event_id' => $id])->toarray();
				// $findcommittee = $this->Committe->find('all')->where(['Committe.event_id' => $id])->toarray();
				// $committeeassignticket = $this->Committeeassignticket->find('all')->where(['Committeeassignticket.event_id' => $id])->toarray();
				// $committeeGroup = $this->CommitteeGroup->find('all')->contain(['Groupmember'])->where(['CommitteeGroup.event_id' => $id])->toarray();

				// pr($findquestion);exit;

				unlink('images/eventimages' . $findevent['feat_image']);
				$this->Eventdetail->deleteAll(['Eventdetail.eventid' => $findevent['id']]);
				$this->CommitteeGroup->deleteAll(['CommitteeGroup.event_id' => $findevent['id']]);
				$this->Question->deleteAll(['Question.event_id' => $findevent['id']]);
				$this->Attendeeslist->deleteAll(['Attendeeslist.event_id' => $findevent['id']]);
				$this->Event->delete($findevent);

				// $this->Groupmember->deleteAll(['Groupmember.eventid' => $findevent['id']]);

				// pr($findevent);
				// exit;

				$this->Flash->success(__('Event has been deleted successfully'));
				return $this->redirect(['action' => 'myevent']);
			}
		} else {
			$this->Flash->error(__('No any event selected'));
			return $this->redirect(['action' => 'myevent']);
		}
	}

	public function saleaddons($id = null)
	{
		$this->set('id', $id);
		$this->loadModel('Addons');
		$this->loadModel('Event');
		$event = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		$addons_types = $this->Addons->find('all')->where(['Addons.event_id' => $id])->toarray();
		$this->set('addons_types', $addons_types);
		$this->set('event', $event);
	}

	public function sales($id = null, $user_id = null)
	{
		$this->loadModel('Eventdetail');
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$this->set('id', $id);

		$event = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		$this->set('event', $event);

		$ticket_types = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id])->toarray();
		$this->set('ticket_types', $ticket_types);

		$purchasedticket = $this->Ticket->find('all')->contain(['Orders', 'Eventdetail'])->Select(['ticketsold' => 'SUM(amount)', 'ticketbuy' => 'SUM(ticket_buy)', 'Ticket.committee_user_id', 'Ticket.event_ticket_id', 'Eventdetail.title', 'Eventdetail.price', 'Orders.paymenttype'])->group(['Orders.paymenttype', 'Ticket.event_ticket_id'])->where(['Ticket.event_id' => $id])->toarray();

		// pr($purchasedticket);exit;
		$this->set('purchasedticket', $purchasedticket);


		$onlinepurchasedticket = $this->Ticket->find('all')->contain(['Orders', 'Eventdetail'])->Select(['ticketsold' => 'SUM(amount)', 'ticketbuy' => 'SUM(ticket_buy)', 'Ticket.committee_user_id', 'Ticket.event_ticket_id', 'Eventdetail.title', 'Eventdetail.price', 'Orders.paymenttype'])->group(['Orders.paymenttype', 'Ticket.event_ticket_id'])->where(['Ticket.event_id' => $id, 'Orders.paymenttype' => 'Online'])->toarray();
		$this->set('onlinepurchasedticket', $onlinepurchasedticket);


		// $onlinepurchasedticket = $this->Ticket->find('all')->Select(['ticketsold' => 'SUM(amount)', 'ticketbuy' => 'SUM(ticket_buy)'])->contain(['Orders'])->where(['Ticket.event_id' => $id, 'Orders.paymenttype' => 'Online'])->first();
		// $this->set('onlinepurchasedticket', $onlinepurchasedticket);
		//pr($onlinepurchasedticket); 

		$cashpurchasedticket = $this->Ticket->find('all')->contain(['Orders', 'Eventdetail'])->Select(['ticketsold' => 'SUM(amount)', 'ticketbuy' => 'SUM(ticket_buy)', 'Ticket.committee_user_id', 'Ticket.event_ticket_id', 'Eventdetail.title', 'Eventdetail.price'])->group(['Ticket.committee_user_id', 'Ticket.event_ticket_id'])->where(['Ticket.event_id' => $id, 'Orders.paymenttype' => 'Cash', 'Ticket.committee_user_id IS NOT NULL'])->toarray();
		$this->set('cashpurchasedticket', $cashpurchasedticket);
		//pr($cashpurchasedticket); 

	}

	public function lists($id = null)
	{
		$this->set('id', $id);
	}

	public function payments($id = null)
	{
		$this->set('id', $id);
		$this->loadModel('Ticket');
		$this->loadModel('Event');
		$event = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		$this->set('event', $event);

		$orders = $this->Ticket->find('all')->contain(['Orders' => ['Users']])->where(['Ticket.event_id' => $id])->group('order_id')->order(['Ticket.id' => 'desc']);

		//$orders = $this->Orders->find('all')->contain(['Users','Ticket'])->where(['Orders'])->order(['Orders.id' => 'DESC'])->toarray();

		$orders = $this->paginate($orders)->toarray();
		$this->set('orders', $orders);
	}

	public function paymentdetail($id = null, $order_id = null)
	{
		$this->set('id', $id);
		$this->set('order_id', $order_id);
		$this->loadModel('Ticket');
		$this->loadModel('Orders');
		$this->loadModel('Addonsbook');
		$orders = $this->Ticket->find('all')->contain(['Ticketdetail', 'Orders' => ['Users'], 'Eventdetail'])->where(['Ticket.event_id' => $id, 'Ticket.order_id' => $order_id])->toarray();
		//pr($orders); 
		$single_order = $this->Orders->find('all')->where(['Orders.id' => $order_id,])->contain(['Users'])->order(['Orders.id' => 'DESC'])->first();
		$this->set('single_order', $single_order);

		$addons_order = $this->Addonsbook->find('all')->contain(['Addons'])->where(['Addonsbook.order_id' => $order_id])->order(['Addonsbook.id' => 'DESC'])->toarray();
		//pr($addons_order); die;
		$this->set('addons_order', $addons_order);
		$this->set('orders', $orders);

		$event = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		$this->set('event', $event);
	}

	public function nameupdate($ticketid = null)
	{
		$this->loadModel('Ticketdetail');

		if ($this->request->is(['post', 'put'])) {

			$find = $this->Ticketdetail->get($this->request->data['ticketid']);
			// pr($find);exit;

			if (!empty($find) && !empty(trim($this->request->data['name']))) {
				$find->name = ucwords(strtolower(trim($this->request->data['name'])));
				$this->Ticketdetail->save($find);
				$this->Flash->success(__($find->name . ' has been updated successfully'));
				$this->redirect(Router::url($this->referer(), true));
			} else {
				$this->Flash->error(__('Name not updated Something went wrong !'));
				$this->redirect(Router::url($this->referer(), true));
			}
		}
	}

	// Lokesh sir 
	// public function analytics($id = null)
	// {
	// 	$this->set('id', $id);
	// 	$this->loadModel('Eventdetail');
	// 	$this->loadModel('Ticket');
	// 	$this->loadModel('Committeeassignticket');
	// 	$ticket_types = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id])->toarray();
	// 	//pr($ticket_types); 
	// 	$data_ticket = array();
	// 	$total_ticket_sale = array();
	// 	$total_ticket_sale[] = "Task";
	// 	$total_ticket_sale[] = 'Hours per Day';
	// 	$total_ticket_sale_all[] = $total_ticket_sale;
	// 	foreach ($ticket_types as $key => $value) {
	// 		$total_ticket_sale = array();
	// 		//$total_ticket_sale_all = array();
	// 		$ticket_id = $value['id'];
	// 		$ticket_types_amount = $this->Ticket->find('all')->Select(['ticketsold' => 'SUM(amount)'])->where(['Ticket.event_id' => $id, 'Ticket.event_ticket_id' => $ticket_id])->first();
	// 		//pr($ticket_types_amount);
	// 		$ticket_types_sale = $this->Ticket->find('all')->Select(['ticket_buy' => 'SUM(ticket_buy)'])->where(['Ticket.event_id' => $id, 'Ticket.event_ticket_id' => $ticket_id])->first();

	// 		$data_ticket['ticket'] = $value['title'];
	// 		$data_ticket['amount'] = "$" . sprintf('%.2f', $ticket_types_amount['ticketsold']);
	// 		$data_ticket_all[] = $data_ticket;

	// 		$total_ticket_sale[] = (int)$ticket_types_sale['ticket_buy'] . ' ' . $value['title'];
	// 		$total_ticket_sale[] = (int)$ticket_types_sale['ticket_buy'];
	// 		$total_ticket_sale_all[] = $total_ticket_sale;
	// 	}

	// 	$totalticket_payment_online = $this->Ticket->find('all')->contain(['Orders'])->select(['onlineamount' => 'SUM(Ticket.amount)'])->where(['Ticket.event_id' => $id, 'Orders.paymenttype' => 'Online'])->first();

	// 	if ($totalticket_payment_online['onlineamount']) {
	// 		$payment_method['ticket'] = "Online";
	// 		$payment_method['amount'] = (int)$totalticket_payment_online['onlineamount'];
	// 	} else {
	// 		$payment_method['ticket'] = "Online";
	// 		$payment_method['amount'] = 0;
	// 	}

	// 	$totalticket_payment_offline = $this->Ticket->find('all')->contain(['Orders'])->select(['offlineamount' => 'SUM(Ticket.amount)'])->where(['Ticket.event_id' => $id, 'Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Comps']])->first();

	// 	if ($totalticket_payment_offline['offlineamount']) {
	// 		$payment_method_offline['ticket'] = "Cash";
	// 		$payment_method_offline['amount'] = (int) $totalticket_payment_offline['offlineamount'];
	// 	} else {
	// 		$payment_method_offline['ticket'] = "Cash";
	// 		$payment_method_offline['amount'] = 0;
	// 	}


	// 	// for sale start 
	// 	$singleevent_detail = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
	// 	$dates = array();
	// 	$dates_data_all = array();
	// 	$date1 = date('Y-m-d', strtotime($singleevent_detail['sale_start']));
	// 	$date2 = date('Y-m-d', strtotime($singleevent_detail['sale_end']));

	// 	$date1_ts = strtotime($date1);
	// 	$date2_ts = strtotime($date2);
	// 	$diff = $date2_ts - $date1_ts;
	// 	$total_days = round($diff / 86400) + 1;


	// 	$current = strtotime($date1);
	// 	$date2 = strtotime($date2);
	// 	if ($total_days <= 10) {
	// 		$stepVal = '+1 day';
	// 	} else {
	// 		$stepVal = '+5 day';
	// 	}

	// 	$format = 'd-m-Y';

	// 	while ($current <= $date2) {
	// 		$dates[] = date($format, $current);
	// 		$current = strtotime($stepVal, $current);
	// 	}
	// 	// print_r($dates);exit;
	// 	$no = 0;

	// 	foreach ($dates as $value) {
	// 		$previousdates = date('Y-m-d', strtotime($value . ' - 4 days'));

	// 		$ticketsold_date  = $this->Ticket->find('all')->where(['Ticket.event_id' => $id, 'DATE(Ticket.created) >=' => $previousdates, 'DATE(Ticket.created) <=' => date('Y-m-d', strtotime($value))])->count();
	// 		// print_r($ticketsold_date);exit;

	// 		$dates_data['date'] = strtotime($value) * 1000;
	// 		$dates_data['value'] = $ticketsold_date;
	// 		$dates_data_all[$no++] = $dates_data;
	// 	}
	// 	// print_r(json_encode($dates_data_all));die;
	// 	// for sale end 

	// 	$ticket_sales_amount = json_encode($data_ticket_all);
	// 	$ticket_sales_all = json_encode($total_ticket_sale_all);
	// 	$method[] = $payment_method;
	// 	$method[] = $payment_method_offline;

	// 	//echo $ticket_sales_all; die;
	// 	// pr(json_encode($payment_method));
	// 	// exit;
	// 	// print_r($method);die;
	// 	$this->set('method', json_encode($method));
	// 	$this->set('dates_data_all', json_encode($dates_data_all));
	// 	$this->set('ticket_sales_all', $ticket_sales_all);
	// 	$this->set('ticket_sales_amount', $ticket_sales_amount);

	// 	$date =  date('Y-m-d');
	// 	$year =  date('Y');
	// 	$payment_cash_jan = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 1, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_jan', $payment_cash_jan['amount']);

	// 	$payment_cash_feb = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 2, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_feb', $payment_cash_feb['amount']);

	// 	$payment_cash_mar = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 3, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_mar', $payment_cash_mar['amount']);

	// 	$payment_cash_april = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 4, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_april', $payment_cash_april['amount']);

	// 	$payment_cash_may = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 5, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_may', $payment_cash_may['amount']);

	// 	$payment_cash_june = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 6, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_june', $payment_cash_june['amount']);

	// 	$payment_cash_july = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 7, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_july', $payment_cash_july['amount']);

	// 	$payment_cash_aug = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 8, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_aug', $payment_cash_aug['amount']);

	// 	$payment_cash_sep = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 9, 'Orders.paymenttype' => 'Cash'])->first();

	// 	$this->set('payment_cash_sep', $payment_cash_sep['amount']);

	// 	$payment_cash_oct = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 10, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_oct', $payment_cash_oct['amount']);

	// 	$payment_cash_nov = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 11, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_nov', $payment_cash_nov['amount']);

	// 	$payment_cash_dec = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 12, 'Orders.paymenttype' => 'Cash'])->first();
	// 	$this->set('payment_cash_dec', $payment_cash_dec['amount']);


	// 	//payment Online
	// 	$payment_online_jan = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 1, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_jan', $payment_online_jan['amount']);

	// 	$payment_online_feb = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 2, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_feb', $payment_online_feb['amount']);

	// 	$payment_online_mar = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 3, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_mar', $payment_online_mar['amount']);

	// 	$payment_online_april = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 4, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_april', $payment_online_april['amount']);

	// 	$payment_online_may = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 5, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_may', $payment_online_may['amount']);

	// 	$payment_online_june = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 6, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_june', $payment_online_june['amount']);

	// 	$payment_online_july = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 7, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_july', $payment_online_july['amount']);

	// 	$payment_online_aug = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 8, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_aug', $payment_online_aug['amount']);

	// 	$payment_online_sep = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 9, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_sep', $payment_online_sep['amount']);

	// 	$payment_online_oct = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 10, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_oct', $payment_online_oct['amount']);

	// 	$payment_online_nov = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 11, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_nov', $payment_online_nov['amount']);

	// 	$payment_online_dec = $this->Ticket->find('all')->select(['amount' => 'SUM(amount)'])->contain(['Orders'])->where(['YEAR(Ticket.created)' => $year, 'MONTH(Ticket.created)' => 12, 'Orders.paymenttype' => 'Online'])->first();
	// 	$this->set('payment_online_dec', $payment_online_dec['amount']);

	// 	$this->loadModel('Committeeassignticket');
	// 	$this->loadModel('Cart');

	// 	$Committeeassignticket = $this->Committeeassignticket->find('all')->select(['total_committee' => 'SUM(count)'])->where(['Committeeassignticket.event_id' => $id])->first();
	// 	if ($Committeeassignticket['total_committee']) {
	// 		$totalcommitee_ticket = $Committeeassignticket['total_committee'];
	// 	} else {
	// 		$totalcommitee_ticket = 0;
	// 	}
	// 	$this->set('totalcommitee_ticket', $totalcommitee_ticket);


	// 	$comitee_pending = $this->Cart->find('all')->select(['no_tickets' => 'SUM(no_tickets)'])->where(['Cart.event_id' => $id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'N'])->order(['Cart.user_id' => 'ASC'])->first();
	// 	$total_pending_ticket = $comitee_pending['no_tickets'];

	// 	if ($comitee_pending['no_tickets']) {
	// 		$total_pending_ticket = $comitee_pending['no_tickets'];
	// 	} else {
	// 		$total_pending_ticket = 0;
	// 	}

	// 	$this->set('total_pending_ticket', $total_pending_ticket);

	// 	$comitee_approved = $this->Cart->find('all')->select(['no_tickets' => 'SUM(no_tickets)'])->where(['Cart.event_id' => $id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'Y'])->order(['Cart.user_id' => 'ASC'])->first();
	// 	$total_approved_ticket = $comitee_approved['no_tickets'];

	// 	if ($comitee_approved['no_tickets']) {
	// 		$total_approved_ticket = $comitee_approved['no_tickets'];
	// 	} else {
	// 		$total_approved_ticket = 0;
	// 	}

	// 	$this->set('total_approved_ticket', $total_approved_ticket);


	// 	$comitee_completed = $this->Ticket->find('all')->select(['ticket_buy' => 'SUM(ticket_buy)'])->where(['Ticket.committee_user_id IS NOT NULL', 'Ticket.event_id' => $id])->order(['Ticket.id' => 'ASC'])->first();
	// 	$total_completed_ticket = $comitee_completed['ticket_buy'];

	// 	if ($comitee_completed['ticket_buy']) {
	// 		$total_completed_ticket = $comitee_completed['ticket_buy'];
	// 	} else {
	// 		$total_completed_ticket = 0;
	// 	}

	// 	$this->set('total_completed_ticket', $total_completed_ticket);

	// 	$total_appoved_ticket_cm['type'] = "Approved";
	// 	$total_appoved_ticket_cm['value'] = $comitee_approved['no_tickets'];

	// 	$total_completed_ticket_cm['type'] = "Completed";
	// 	$total_completed_ticket_cm['value'] = (int)$total_completed_ticket;
	// }

	//Rupam sir 04/04/2023
	public function analytics($id = null)
	{
		$this->set('id', $id);
		$this->loadModel('Eventdetail');
		$this->loadModel('Orders');
		$this->loadModel('Ticket');
		$this->loadModel('Committeeassignticket');
		$this->loadModel('Cart');

		$ticketTypes = $this->Eventdetail->find()
			->select(['id', 'title'])
			->contain(['Ticket' => function ($q) use ($id) {
				return $q->select(['event_ticket_id', 'ticketsold' => 'SUM(amount)', 'ticket_buy' => 'SUM(ticket_buy)'])
					->where(['Ticket.event_id' => $id])
					->group(['Ticket.event_ticket_id']);
			}])
			->where(['Eventdetail.eventid' => $id])
			->toArray();

		//Total Ticket Sales start
		$dataTicketAll = [];
		$totalTicketSaleAll = [];

		foreach ($ticketTypes as $key => $value) {
			$ticketTypesSale = $value->ticket[0]->ticket_buy;
			$ticketTypesAmount = $value->ticket[0]->ticketsold;

			$dataTicketAll[] = [
				'ticket' => $value->title,
				'amount' => '$' . sprintf('%.2f', $ticketTypesAmount)
			];

			$totalTicketSaleAll[] = [
				$value->title,
				(int)$ticketTypesSale
			];
		}
		$this->set('ticket_sales_all', json_encode($totalTicketSaleAll));
		//Total Ticket Sales end


		// Payment Method Chart start
		$paymenttypewithSalepercentage = $this->Ticket->find('all')
			->contain(['Orders'])
			->select(['total_amount' => 'SUM(Ticket.amount)', 'Orders.paymenttype', 'adminfee', 'Orders.id'])
			->where(['Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Online'], 'Orders.total_amount !=' => 0, 'Ticket.event_id' => $id])
			->group('Orders.paymenttype')
			->order(['Orders.id' => 'DESC'])
			->toArray();

		$payment_data = [];
		$completeEarnings = 0;
		$completeSales = 0;

		foreach ($paymenttypewithSalepercentage as $key => $value) {
			$completeEarnings += ($value['total_amount'] * $value['adminfee'] / 100);
			$completeSales += $value['total_amount'];
			$payment_data[] = [
				'paymenttype' => $value['order']['paymenttype'],
				'amounts' => sprintf('%.2f', $value['total_amount'])
			];
		}
		// Add the total earnings data to the payment type array
		$payment_data[] = ['paymenttype' => 'Earnings', 'amounts' =>  sprintf('%.2f', $completeEarnings)];
		$this->set(compact('completeEarnings', 'completeSales'));
		$this->set('paymenttypewithSalepercentage', json_encode($payment_data));
		// Payment Method Chart end


		// For Sales start 
		// $singleevent_detail = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		// $get_all_tickets_data = $this->Ticket->find()
		// 	->contain(['Orders'])
		// 	->where([
		// 		'Ticket.event_id' => $id,
		// 		'Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Online']
		// 	])
		// 	->order(['Ticket.created' => 'ASC'])
		// 	->toarray();
		// // pr($get_all_tickets_data);exit;
		// $dates_data_all = [];
		// $sizeofthearra = count($get_all_tickets_data);
		// $start_ticket_data = $get_all_tickets_data[0];
		// $last_ticket_data = $get_all_tickets_data[$sizeofthearra - 1];
		// // pr(date('d-m-Y', strtotime($start_ticket_data['created'])));
		// // pr(date('d-m-Y', strtotime($last_ticket_data['created'])));

		// $current = strtotime($start_ticket_data['created']);
		// $date2 = strtotime($last_ticket_data['created']);

		// $stepVal = '+1 day';
		// $format = 'd-m-Y';
		// $totalsale = 0;
		// $totalEarningsuponsales = 0;
		// while ($current <= $date2) {
		// 	$current_date = date('Y-m-d', $current);
		// 	$total_amount = 0;

		// 	// Check if there is data for the current date
		// 	foreach ($get_all_tickets_data as $ticket) {
		// 		$ticket_created_date = date('Y-m-d', strtotime($ticket->created));
		// 		if ($ticket_created_date == $current_date) {
		// 			$totalEarningsuponsales += ($ticket->order['total_amount'] * $ticket->order['adminfee'] / 100);
		// 			$total_amount += $ticket['amount'];
		// 		}
		// 	}

		// 	$dates_data_all[] = [
		// 		'date' => $current * 1000,
		// 		'value' => $total_amount
		// 	];
		// 	$totalsale += $total_amount;
		// 	$current = strtotime($stepVal, $current);
		// }

		// // Sort the dates_data_all array by date in ascending order
		// usort($dates_data_all, function ($a, $b) {
		// 	return $a['date'] <=> $b['date'];
		// });



		$singleevent_detail = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		$get_all_tickets_data = $this->Ticket->find()
			->contain(['Orders'])
			->where([
				'Ticket.event_id' => $id,
				'Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Online']
			])
			->order(['Ticket.created' => 'ASC'])
			->toArray();

		$totalsale = 0;
		$totalEarningsuponsales = 0;
		$dates_data_all = [];

		if (!empty($get_all_tickets_data)) {
			// Get the start and end dates of the sold tickets
			$start_date = date('Y-m-d', strtotime($get_all_tickets_data[0]->created));
			$end_date = date('Y-m-d', strtotime(end($get_all_tickets_data)->created));

			// Iterate through each day between the start and end dates
			$current_date = strtotime($start_date);
			while ($current_date <= strtotime($end_date)) {
				$current_date_str = date('Y-m-d', $current_date);

				// Calculate the total ticket sales for the current date
				$total_amount = 0;
				foreach ($get_all_tickets_data as $ticket) {
					$ticket_created_date = date('Y-m-d', strtotime($ticket->created));
					if ($ticket_created_date == $current_date_str) {
						$totalEarningsuponsales += ($ticket->order['total_amount'] * $ticket->order['adminfee'] / 100);
						$total_amount += $ticket['amount'];
					}
				}

				// Add the current date and total ticket sales to the dates_data_all array
				$dates_data_all[] = [
					'date' => strtotime($current_date_str) * 1000,
					'value' => $total_amount
				];

				// Update the total ticket sales
				$totalsale += $total_amount;

				// Move to the next day
				$current_date = strtotime('+1 day', $current_date);
			}

			// Sort the dates_data_all array by date in ascending order
			usort($dates_data_all, function ($a, $b) {
				return $a['date'] <=> $b['date'];
			});
		}


		$ticket_sales_amount = json_encode($data_ticket_all);
		$this->set('dates_data_all', json_encode($dates_data_all));


		$Committeeassignticket = $this->Committeeassignticket->find('all')->select(['total_committee' => 'SUM(count)'])->where(['Committeeassignticket.event_id' => $id])->first();
		if ($Committeeassignticket['total_committee']) {
			$totalcommitee_ticket = $Committeeassignticket['total_committee'];
		} else {
			$totalcommitee_ticket = 0;
		}
		$this->set('totalcommitee_ticket', $totalcommitee_ticket);


		$comitee_pending = $this->Cart->find('all')->select(['no_tickets' => 'SUM(no_tickets)'])->where(['Cart.event_id' => $id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'N'])->order(['Cart.user_id' => 'ASC'])->first();
		$total_pending_ticket = $comitee_pending['no_tickets'];

		if ($comitee_pending['no_tickets']) {
			$total_pending_ticket = $comitee_pending['no_tickets'];
		} else {
			$total_pending_ticket = 0;
		}

		$this->set('total_pending_ticket', $total_pending_ticket);

		$comitee_approved = $this->Cart->find('all')->select(['no_tickets' => 'SUM(no_tickets)'])->where(['Cart.event_id' => $id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'Y'])->order(['Cart.user_id' => 'ASC'])->first();
		$total_approved_ticket = $comitee_approved['no_tickets'];

		if ($comitee_approved['no_tickets']) {
			$total_approved_ticket = $comitee_approved['no_tickets'];
		} else {
			$total_approved_ticket = 0;
		}

		$this->set('total_approved_ticket', $total_approved_ticket);


		$comitee_completed = $this->Ticket->find('all')->select(['ticket_buy' => 'SUM(ticket_buy)'])->where(['Ticket.committee_user_id IS NOT NULL', 'Ticket.event_id' => $id])->order(['Ticket.id' => 'ASC'])->first();
		$total_completed_ticket = $comitee_completed['ticket_buy'];

		if ($comitee_completed['ticket_buy']) {
			$total_completed_ticket = $comitee_completed['ticket_buy'];
		} else {
			$total_completed_ticket = 0;
		}

		$this->set('total_completed_ticket', $total_completed_ticket);

		$total_appoved_ticket_cm['type'] = "Approved";
		$total_appoved_ticket_cm['value'] = $comitee_approved['no_tickets'];

		$total_completed_ticket_cm['type'] = "Completed";
		$total_completed_ticket_cm['value'] = (int)$total_completed_ticket;
	}

	public function payouts($id = null)
	{

		$this->loadModel('Ticket');
		$this->set('id', $id);

		$onlinepurchasedticket = $this->Ticket->find('all')->contain(['Orders', 'Eventdetail'])->Select(['ticketsold' => 'SUM(amount)', 'ticketbuy' => 'SUM(ticket_buy)', 'Ticket.committee_user_id', 'Ticket.event_ticket_id', 'Eventdetail.title', 'Eventdetail.price', 'Orders.paymenttype'])->group(['Orders.paymenttype', 'Ticket.event_ticket_id'])->where(['Ticket.event_id' => $id, 'Orders.paymenttype' => 'Online'])->toarray();
		$this->set('onlinepurchasedticket', $onlinepurchasedticket);

		// $onlinepurchasedticket = $this->Ticket->find('all')->Select(['ticketsold' => 'SUM(Ticket.amount)', 'ticketbuy' => 'SUM(Ticket.ticket_buy)', 'Event.payment_currency'])->contain(['Orders', 'Event'])->where(['Orders.paymenttype' => 'Online', 'Ticket.event_id' => $id])->first();
		// //pr($onlinepurchasedticket); die; 
		// $this->set('onlinepurchasedticket', $onlinepurchasedticket);

		$event = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		//pr($event);
		$this->set('event', $event);
	}

	public function requests($id = null)
	{
		$this->set('id', $id);
	}

	public function exporttickets($id = null)
	{
		$this->loadModel('Eventdetail');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->set('id', $id);
		//echo $id; //die;
		$session = $this->request->session();
		$session->delete('cond');

		$event_data = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		//pr($event_data); die;
		$this->set('event_data', $event_data);

		$alltickets = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id])->toarray();
		//pr($alltickets); die;

		$ticket_data = $this->Ticketdetail->find('all')->where(['Ticket.event_id' => $id])->contain(['Users', 'Ticket' => ['Event', 'Eventdetail', 'Orders']]);

		$totalScannedTicket = $this->Ticketdetail->find()
			->where(['Ticket.event_id' => $id, 'Ticketdetail.status' => 1])
			->contain(['Users', 'Eventdetail', 'Ticket' => ['Event', 'Eventdetail', 'Orders']])
			->count();

		$totalTicketCount = count($ticket_data->toarray());
		$ticket_data = $this->paginate($ticket_data)->toarray();

		$this->set('totalScannedTicket', $totalScannedTicket);
		$this->set('totalTicketCount', $totalTicketCount);
		$this->set('ticket_data', $ticket_data);
		$this->set('alltickets', $alltickets);
	}

	// public function generalsetting($id = null)
	// {

	// 	$this->loadModel('Users');
	// 	$this->loadModel('Templates');
	// 	$this->loadModel('Event');
	// 	$this->loadModel('Eventdetail');
	// 	$this->loadModel('Currency');
	// 	$this->loadModel('Ticket');
	// 	$this->loadModel('Cart');
	// 	$this->loadModel('Company');
	// 	$this->loadModel('Attendeeslist');
	// 	$this->loadModel('Orders');
	// 	$this->loadModel('Payment');
	// 	$this->loadModel('Ticketdetail');
	// 	$this->loadModel('Committeeassignticket');

	// 	$authId = $this->request->session()->read('Auth.User.id');
	// 	$user_email = $this->request->session()->read('Auth.User.email');
	// 	$admin_user = $this->Users->find('all')->where(['role_id' => 1])->first();
	// 	$current_datetime = date('Y-m-d H:i:s');
	// 	// $linkdinurl = $admin_user['linkdinurl'];
	// 	// $Twitterurl = $admin_user['Twitterurl'];
	// 	// $fburl = $admin_user['fburl'];
	// 	// $instaurl = $admin_user['instaurl'];
	// 	$applestore = $admin_user['applestore'];
	// 	$googleplaystore = $admin_user['googleplaystore'];

	// 	$this->set('admin_user', $admin_user);
	// 	$currency = $this->Currency->find('list', ['keyField' => 'id', 'valueField' => 'Currency'])->toarray();
	// 	$this->set('currency', $currency);

	// 	if (isset($id) && !empty($id)) {
	// 		$findevent = $this->Event->get($id);
	// 		$event = $this->Event->find('all')->where(['Event.id' => $id])->contain(['Currency', 'Users', 'Eventdetail', 'Company'])->first();
	// 		$this->set('findevent', $findevent);
	// 	}
	// 	if ($this->request->is(['post', 'put'])) {
	// 		// pr($this->request->data);exit;

	// 		// Begin transaction
	// 		$connection = ConnectionManager::get('default');
	// 		$connection->begin();
	// 		try {
	// 			if ($event['submit_count'] == '' || $event['admineventstatus'] == 'N' || $this->request->data['is_send_email'] == 'Y') {
	// 				$eventdetails = $this->Event->get($id);
	// 				// $currenny = $this->Currency->get($eventdetails['payment_currency']);
	// 				$checkTicket = $this->Eventdetail->find('all')->where(['eventid' => $id])->first();

	// 				$eventname = ucwords(strtolower($event['name']));
	// 				$hostedby = $event['company']['name'];
	// 				$event_start = date('D, dS M Y h:i:A', strtotime($event['date_from']));
	// 				$event_end = date('D, dS M Y h:i:A', strtotime($event['date_to']));
	// 				if ($event['is_free'] == 'Y') {
	// 					$sale_start = 'N/A';
	// 					$sale_end = 'N/A';
	// 					$is_free = ' <span style="background: #e62d56; padding: 2px 8px; border-radius: 3px; color:#fff; font-size: 18px; ">Free Event</span>';
	// 				} else {
	// 					$sale_start = date('D, dS M Y h:i:A', strtotime($event['sale_start']));
	// 					$sale_end = date('D, dS M Y h:i:A', strtotime($event['sale_end']));
	// 					$is_free = '';
	// 				}

	// 				$location = ucwords(strtolower($event['location']));
	// 				$Description = ucwords($event['desp']);
	// 				$TimeStart =  date('h:i A', strtotime($event['date_from']));
	// 				$TimeEnd =  date('h:i A', strtotime($event['date_to']));
	// 				$slug = SITE_URL . 'event/' . $event['slug'];
	// 				$site_url = SITE_URL;
	// 				$eventImage = SITE_URL . 'images/eventimages/' . $event['feat_image'];
	// 				$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 18])->first();
	// 				$from = $emailtemplate['fromemail'];
	// 				$to = $user_email;
	// 				$cc = $from;
	// 				$subject = $emailtemplate['title'];
	// 				$formats = $emailtemplate['description'];

	// 				$message1 = str_replace(array('{EventName}', '{HostedBy}', '{EventStart}', '{EventEnd}', '{Location}', '{Description}', '{TimeStart}', '{TimeEnd}', '{Slug}', '{SITE_URL}', '{From}', '{SaleStart}', '{SaleEnd}', '{IsFree}', '{EventImage}', '{PlayStoreLink}', '{AppleStoreLink}'), array($eventname, $hostedby, $event_start, $event_end, $location, $Description, $TimeStart, $TimeEnd, $slug, $site_url, $from, $sale_start, $sale_end, $is_free, $eventImage, $googleplaystore, $applestore), $formats);
	// 				$message = stripslashes($message1);

	// 				$message = '<!DOCTYPE HTML>
	// 				<html>			
	// 				<head>
	// 					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	// 					<title>eboxtickets.com</title>	
	// 				</head>			
	// 				<body style="background:#d8dde4; padding:15px;">' . $message1 . '</body></html>';

	// 				$headers = 'MIME-Version: 1.0' . "\r\n";
	// 				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// 				$headers .= 'From: <' . $from . '>' . "\r\n";
	// 				$mail = $this->Email->send($to, $subject, $message, $cc);
	// 				// send mail complete 

	// 				$findevent->submit_count = $findevent->submit_count + 1;
	// 				$findevent->status = 'Y';
	// 				$this->Event->save($findevent);
	// 				$numwithcode = 0;
	// 				// ********************Ticket generate Start for attendees*******************
	// 				if ($event['is_free'] == 'Y') {
	// 					$findattendees = $this->Attendeeslist->find('all')->contain(['Users'])->where(['Attendeeslist.event_id' => $id])->toarray();
	// 					// pr($findattendees);exit;
	// 					foreach ($findattendees as $atkey => $attvalues) {

	// 						$getticketdetails = $this->Attendeeslist->get($attvalues['id']);
	// 						$this->Attendeeslist->delete($getticketdetails);

	// 						if ($atkey == 0) {
	// 							$orderdata['user_id'] = $authId;
	// 							$orderdata['total_amount'] = 0;
	// 							$orderdata['paymenttype'] = "Comps";
	// 							$orderdata['adminfee'] = $admin_user['feeassignment'];
	// 							$orderdata['created'] = $current_datetime;
	// 							$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);
	// 							$saveorders = $this->Orders->save($insertdata);
	// 							// pr($saveorders);exit;
	// 						}

	// 						$findone = $this->Ticket->find('all')->where(['event_id' => $id, 'cust_id' => $attvalues['user_id']])->first();

	// 						$numwithcode = ($attvalues['user']['mobile']) ? $attvalues['user']['mobile'] : $attvalues['mobile'];

	// 						if (empty($findone)) {
	// 							$fn['user_id'] = $attvalues['user_id'];
	// 							$fn['event_id'] = $id;
	// 							$fn['mpesa'] = null;
	// 							$fn['amount'] =  0;
	// 							$fn['created'] = $current_datetime;
	// 							$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
	// 							$this->Payment->save($payment);

	// 							$ticketbook['order_id'] = $saveorders->id;
	// 							$ticketbook['event_id'] =  $id;
	// 							$ticketbook['event_ticket_id'] = $checkTicket['id'];
	// 							$ticketbook['cust_id'] = $attvalues['user_id'];
	// 							$ticketbook['ticket_buy'] = 1;
	// 							$ticketbook['amount'] = 0;
	// 							$ticketbook['mobile'] = $numwithcode;
	// 							$ticketbook['committee_user_id'] = $authId;
	// 							$ticketbook['user_desc'] = 'Free Ticket';
	// 							$ticketbook['adminfee'] = $admin_user['feeassignment'];
	// 							$ticketbook['created'] = $current_datetime;
	// 							$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
	// 							$lastinsetid = $this->Ticket->save($insertticketbook);

	// 							$ticketdetaildata['tid'] = $lastinsetid['id'];
	// 							$ticketdetaildata['user_id'] =  $attvalues['user_id'];
	// 							$ticketdetaildata['created'] = $current_datetime;
	// 							$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
	// 							$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

	// 							$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
	// 							$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
	// 							$Packff->name = $attvalues['user']['name'] . ' ' . $attvalues['user']['lname'];
	// 							$Packff->is_rsvp = $attvalues['is_rsvp'];
	// 							$ticketdetail = $this->Ticketdetail->save($Packff);

	// 							$ticketqrimages = $this->qrcodepro($attvalues['user_id'], $ticketdetail['ticket_num'], $authId);
	// 							$Pack = $this->Ticketdetail->get($ticketdetail['id']);
	// 							$Pack->qrcode = $ticketqrimages;
	// 							$this->Ticketdetail->save($Pack);


	// 							$eventname = ucwords(strtolower($eventdetails['name']));
	// 							$requestername = $attvalues['user']['name'] . ' ' . $attvalues['user']['lname'];
	// 							$url = SITE_URL . 'tickets/myticket';
	// 							$site_url = SITE_URL;
	// 							// $currenny_sign = $currenny['Currency'];
	// 							$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
	// 							$from = $emailtemplate['fromemail'];
	// 							$to = $attvalues['user']['email'];
	// 							// $cc = $from;
	// 							$subject = $emailtemplate['subject'] . ': ' . $eventname;
	// 							$formats = $emailtemplate['description'];

	// 							$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $attvalues['user']['email'], $attvalues['user']['confirm_pass']), $formats);
	// 							$message = stripslashes($message1);
	// 							$message = '<!DOCTYPE HTML>
	// 							<html>                
	// 							<head>
	// 								<meta http-equiv="Content-Type " content="text/html; charset=utf-8 ">
	// 								<title>Untitled Document</title>
	// 								<style>
	// 									p {
	// 										margin: 9px 0px;
	// 									}
	// 								</style>                
	// 							</head>                
	// 							<body style="background:#d8dde4; padding:15px;">' . $message1 . '</body></html>';
	// 							$headers = 'MIME-Version: 1.0' . "\r\n";
	// 							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// 							$headers .= 'From: <' . $from . '>' . "\r\n";
	// 							$mail = $this->Email->send($to, $subject, $message);

	// 							// send watsappmessage start 
	// 							$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";

	// 							if ($numwithcode) {
	// 								$this->whatsappmsg($numwithcode, $message);
	// 							}
	// 							// send watsappmessage start 
	// 						}
	// 					}
	// 				}
	// 				// If all data saved successfully, commit the transaction
	// 				$connection->commit();
	// 				// *****************************End*********************

	// 				$this->Flash->message(__('' . ucwords($findevent['name']) . ' Event has been Published'));
	// 				return $this->redirect(['action' => 'generalsetting/' . $id]);

	// 				// $this->Flash->success(__('' . ucwords($findevent['name']) . ' Event has been Published'));
	// 				// return $this->redirect(['action' => 'generalsetting/' . $id]);
	// 			} else {
	// 				return $this->redirect(['action' => 'generalsetting/' . $id]);
	// 			}
	// 		} catch (Exception $e) {
	// 			// Rollback transaction
	// 			$connection->rollback();
	// 			$this->Flash->error('Failed to save data: ' . $e->getMessage());
	// 			// throw $e;
	// 		}
	// 	}
	// 	$this->set('id', $id);
	// }

	public function generalsetting($id = null)
	{

		$this->loadModel('Users');
		$this->loadModel('Templates');
		$this->loadModel('Event');
		$this->loadModel('Eventdetail');
		$this->loadModel('Currency');
		$this->loadModel('Ticket');
		$this->loadModel('Cart');
		$this->loadModel('Company');
		$this->loadModel('Attendeeslist');
		$this->loadModel('Orders');
		$this->loadModel('Payment');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Committeeassignticket');

		$authId = $this->request->session()->read('Auth.User.id');
		$user_email = $this->request->session()->read('Auth.User.email');
		$admin_user = $this->Users->find('all')->where(['role_id' => 1])->first();
		$current_datetime = date('Y-m-d H:i:s');
		// $linkdinurl = $admin_user['linkdinurl'];
		// $Twitterurl = $admin_user['Twitterurl'];
		// $fburl = $admin_user['fburl'];
		// $instaurl = $admin_user['instaurl'];
		$applestore = $admin_user['applestore'];
		$googleplaystore = $admin_user['googleplaystore'];

		$this->set('admin_user', $admin_user);
		$currency = $this->Currency->find('list', ['keyField' => 'id', 'valueField' => 'Currency'])->toarray();
		$this->set('currency', $currency);

		if (isset($id) && !empty($id)) {
			$findevent = $this->Event->get($id);
			$event = $this->Event->find('all')->where(['Event.id' => $id])->contain(['Currency', 'Users', 'Eventdetail', 'Company'])->first();
			$this->set('findevent', $findevent);
		}
		if ($this->request->is(['post', 'put'])) {
			// pr($this->request->data);exit;

			// Begin transaction
			$connection = ConnectionManager::get('default');
			$connection->begin();
			try {

				if ($event['submit_count'] == '' || $event['admineventstatus'] == 'N' || $this->request->data['is_send_email'] == 'Y') {

					$eventdetails = $this->Event->get($id);
					// $currenny = $this->Currency->get($eventdetails['payment_currency']);
					$checkTicket = $this->Eventdetail->find('all')->where(['eventid' => $id])->first();

					$eventname = ucwords(strtolower($event['name']));
					$hostedby = $event['company']['name'];
					$event_start = date('D, dS M Y h:i:A', strtotime($event['date_from']));
					$event_end = date('D, dS M Y h:i:A', strtotime($event['date_to']));
					if ($event['is_free'] == 'Y') {
						$sale_start = 'N/A';
						$sale_end = 'N/A';
						$is_free = ' <span style="background: #e62d56; padding: 2px 8px; border-radius: 3px; color:#fff; font-size: 18px; ">Free Event</span>';
					} else {
						$sale_start = date('D, dS M Y h:i:A', strtotime($event['sale_start']));
						$sale_end = date('D, dS M Y h:i:A', strtotime($event['sale_end']));
						$is_free = '';
					}


					$location = ucwords(strtolower($event['location']));
					$Description = ucwords($event['desp']);
					$TimeStart =  date('h:i A', strtotime($event['date_from']));
					$TimeEnd =  date('h:i A', strtotime($event['date_to']));
					$slug = SITE_URL . 'event/' . $event['slug'];
					$site_url = SITE_URL;
					$eventImage = SITE_URL . 'images/eventimages/' . $event['feat_image'];
					$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 18])->first();
					$from = $emailtemplate['fromemail'];
					$to = $user_email;
					$cc = $from;
					$subject = $emailtemplate['title'];
					$formats = $emailtemplate['description'];

					$message1 = str_replace(array('{EventName}', '{HostedBy}', '{EventStart}', '{EventEnd}', '{Location}', '{Description}', '{TimeStart}', '{TimeEnd}', '{Slug}', '{SITE_URL}', '{From}', '{SaleStart}', '{SaleEnd}', '{IsFree}', '{EventImage}', '{PlayStoreLink}', '{AppleStoreLink}'), array($eventname, $hostedby, $event_start, $event_end, $location, $Description, $TimeStart, $TimeEnd, $slug, $site_url, $from, $sale_start, $sale_end, $is_free, $eventImage, $googleplaystore, $applestore), $formats);
					$message = stripslashes($message1);

					$message = '<!DOCTYPE HTML>
					<html>			
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
						<title>eboxtickets.com</title>	
					</head>			
					<body style="background:#d8dde4; padding:15px;">' . $message1 . '</body></html>';

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
					$headers .= 'From: <' . $from . '>' . "\r\n";
					// pr($message);exit;
					$mail = $this->Email->send($to, $subject, $message, $cc);
					// send mail complete 

					$findevent->submit_count = $findevent->submit_count + 1;
					$findevent->status = 'Y';
					$this->Event->save($findevent);
					$numwithcode = 0;

					// ********************Ticket generate Start for attendees*******************

					if ($event['is_free'] == 'Y') {
						// pr($event['is_free']);exit;

						$attendees = $this->Attendeeslist->find()
							->contain(['Users'])
							->where(['Attendeeslist.event_id' => $id])
							->toArray();

						if (!empty($attendees)) {
							foreach ($attendees as $atkey => $attvalues) {
								$ticketDetails = $this->Attendeeslist->get($attvalues['id']);
								$this->Attendeeslist->delete($ticketDetails);

								$isAllowedGuest = $ticketDetails->is_allowed_guest;
								$custId = $attvalues['user_id'];

								$existingTicketCount = $this->Ticket->find()
									->where(['event_id' => $id, 'cust_id' => $custId])
									->count();
								// pr($existingTicketCount);exit;

								$numwithcode = ($attvalues['user']['mobile']) ? $attvalues['user']['mobile'] : $attvalues['mobile'];

								// order save data 
								if ($atkey === 0) {
									$orderdata['user_id'] = $authId;
									$orderdata['total_amount'] = 0;
									$orderdata['paymenttype'] = "Comps";
									$orderdata['adminfee'] = $admin_user['feeassignment'];
									$orderdata['created'] = $current_datetime;
									$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);
									$saveorders = $this->Orders->save($insertdata);
								}

								if ($existingTicketCount === 0 && $isAllowedGuest === 'Y') {
									// Generate two tickets
									for ($i = 0; $i < 2; $i++) {

										$fn['user_id'] = $attvalues['user_id'];
										$fn['event_id'] = $id;
										$fn['mpesa'] = null;
										$fn['amount'] =  0;
										$fn['created'] = $current_datetime;
										$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
										$this->Payment->save($payment);

										$ticketbook['order_id'] = $saveorders->id;
										$ticketbook['event_id'] =  $id;
										$ticketbook['event_ticket_id'] = $checkTicket['id'];
										$ticketbook['cust_id'] = $attvalues['user_id'];
										$ticketbook['ticket_buy'] = 1;
										$ticketbook['amount'] = 0;
										$ticketbook['mobile'] = $numwithcode;
										$ticketbook['committee_user_id'] = $authId;
										$ticketbook['user_desc'] = 'Free Ticket from generalsetting';
										$ticketbook['adminfee'] = $admin_user['feeassignment'];
										$ticketbook['created'] = $current_datetime;
										$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
										$lastinsetid = $this->Ticket->save($insertticketbook);

										$ticketdetaildata['tid'] = $lastinsetid['id'];
										$ticketdetaildata['user_id'] =  $attvalues['user_id'];
										$ticketdetaildata['created'] = $current_datetime;
										$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
										$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

										$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
										$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
										$Packff->name = ($attvalues['name']) ? $attvalues['name'] : $attvalues['user']['name'] . ' ' . $attvalues['user']['lname'];
										$Packff->is_rsvp = $attvalues['is_rsvp'];
										$ticketdetail = $this->Ticketdetail->save($Packff);

										$ticketqrimages = $this->qrcodepro($attvalues['user_id'], $ticketdetail['ticket_num'], $authId);
										$Pack = $this->Ticketdetail->get($ticketdetail['id']);
										$Pack->qrcode = $ticketqrimages;
										$this->Ticketdetail->save($Pack);


										$eventname = ucwords(strtolower($eventdetails['name']));
										$requestername = $attvalues['user']['name'] . ' ' . $attvalues['user']['lname'];
										$url = SITE_URL . 'tickets/myticket';
										$site_url = SITE_URL;
										// $currenny_sign = $currenny['Currency'];
										$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
										$from = $emailtemplate['fromemail'];
										$to = $attvalues['user']['email'];
										// $cc = $from;
										$subject = $emailtemplate['subject'] . ': ' . $eventname;
										$formats = $emailtemplate['description'];

										$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $attvalues['user']['email'], $attvalues['user']['confirm_pass']), $formats);
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
										if ($atkey === 0) {
											$mail = $this->Email->send($to, $subject, $message);
										}
										// send watsappmessage start 
										$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
										if ($numwithcode && $atkey === 0) {
											$this->whatsappmsg($numwithcode, $message);
										}
										// send watsappmessage start 
									}
									$connection->commit();
									// ...
								} else if ($existingTicketCount === 0 && $isAllowedGuest === 'N') {
									// Generate one ticket
									$fn['user_id'] = $attvalues['user_id'];
									$fn['event_id'] = $id;
									$fn['mpesa'] = null;
									$fn['amount'] =  0;
									$fn['created'] = $current_datetime;
									$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
									$this->Payment->save($payment);

									$ticketbook['order_id'] = $saveorders->id;
									$ticketbook['event_id'] =  $id;
									$ticketbook['event_ticket_id'] = $checkTicket['id'];
									$ticketbook['cust_id'] = $attvalues['user_id'];
									$ticketbook['ticket_buy'] = 1;
									$ticketbook['amount'] = 0;
									$ticketbook['mobile'] = $numwithcode;
									$ticketbook['committee_user_id'] = $authId;
									$ticketbook['user_desc'] = 'Free Ticket from generalsetting';
									$ticketbook['adminfee'] = $admin_user['feeassignment'];
									$ticketbook['created'] = $current_datetime;
									$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
									$lastinsetid = $this->Ticket->save($insertticketbook);

									$ticketdetaildata['tid'] = $lastinsetid['id'];
									$ticketdetaildata['user_id'] =  $attvalues['user_id'];
									$ticketdetaildata['created'] = $current_datetime;
									$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
									$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

									$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
									$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
									$Packff->name = ($attvalues['name']) ? $attvalues['name'] : $attvalues['user']['name'] . ' ' . $attvalues['user']['lname'];
									$Packff->is_rsvp = $attvalues['is_rsvp'];
									$ticketdetail = $this->Ticketdetail->save($Packff);

									$ticketqrimages = $this->qrcodepro($attvalues['user_id'], $ticketdetail['ticket_num'], $authId);
									$Pack = $this->Ticketdetail->get($ticketdetail['id']);
									$Pack->qrcode = $ticketqrimages;
									$this->Ticketdetail->save($Pack);


									$eventname = ucwords(strtolower($eventdetails['name']));
									$requestername = $attvalues['user']['name'] . ' ' . $attvalues['user']['lname'];
									$url = SITE_URL . 'tickets/myticket';
									$site_url = SITE_URL;
									// $currenny_sign = $currenny['Currency'];
									$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
									$from = $emailtemplate['fromemail'];
									$to = $attvalues['user']['email'];
									// $cc = $from;
									$subject = $emailtemplate['subject'] . ': ' . $eventname;
									$formats = $emailtemplate['description'];


									$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $attvalues['user']['email'], $attvalues['user']['confirm_pass']), $formats);
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
									$mail = $this->Email->send($to, $subject, $message);

									// send watsappmessage start 
									$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
									if ($numwithcode) {
										$this->whatsappmsg($numwithcode, $message);
									}
									// send watsappmessage start 
									$connection->commit();
									// ...
								} else {
									// $this->Orders->delete($saveorders['id']);
									continue;
									// Already generated
									// ...
								}
							}
						}
					}

					// If all data saved successfully, commit the transaction
					$connection->commit();
					// *****************************End*********************

					$this->Flash->message(__('' . ucwords($findevent['name']) . ' Event has been Published'));
					return $this->redirect(['action' => 'generalsetting/' . $id]);
				} else {
					return $this->redirect(['action' => 'generalsetting/' . $id]);
				}
			} catch (Exception $e) {
				// Rollback transaction
				$connection->rollback();
				$this->Flash->error('Failed to save data: ' . $e->getMessage());
				// throw $e;
			}
		}
		$this->set('id', $id);
	}

	public function settings($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->loadModel('Currency');
		$this->set('id', $id);
		$user_id = $this->request->session()->read('Auth.User.id');
		$session = $this->request->session();
		$session->delete('postevent');
		$lateventid = $this->Event->find('all')->order(['id' => 'desc'])->first();
		$currency = $this->Currency->find('list', ['keyField' => 'id', 'valueField' => 'Currency'])->toarray();
		$this->set('currency', $currency);
		$country = $this->Countries->find('list', [
			'keyField' => 'id',
			'valueField' => 'CountryName'
		])->where(['status' => 'Y'])->toArray();

		$company = $this->Company->find('list', [
			'keyField' => 'id',
			'valueField' => 'name'
		])->where(['status' => 'Y', 'user_id' => $user_id])->toArray();

		$this->set('country', $country);
		$this->set('company', $company);
		$this->set('lateventid', $lateventid['id']);

		if (isset($id) && !empty($id)) {
			$eventDetails = $this->Event->find('all')->contain('Eventdetail')->where(['Event.id' => $id])->first();
			$addevent = $this->Event->get($id);
			$this->set('id', $id);
			$this->set('eventDetails', $eventDetails);
		}

		if ($this->request->is(['post', 'put'])) {

			// pr($this->request->data);exit;
			$requestdata['name'] = ucwords(strtolower($this->request->data['name']));
			$requestdata['location'] = ucwords(strtolower($this->request->data['location']));
			$requestdata['company_id'] = $this->request->data['company_id'];
			$requestdata['country_id'] = $this->request->data['country_id'];
			$requestdata['allow_register'] = ($this->request->data['allow_register']) ? 'Y' : 'N';
			$requestdata['slug'] = $this->request->data['slug'];
			$requestdata['date_from'] = date('Y-m-d H:i:s', strtotime(($this->request->data['date_from'] == '') ? $eventDetails['date_from'] : $this->request->data['date_from']));
			$requestdata['date_to'] = date('Y-m-d H:i:s', strtotime(($this->request->data['date_to'] == '') ? $eventDetails['date_to'] : $this->request->data['date_to']));
			$requestdata['request_rsvp'] = date('Y-m-d H:i:s', strtotime(($this->request->data['request_rsvp'] == '') ? $eventDetails['request_rsvp'] : $this->request->data['request_rsvp']));
			// pr($requestdata);exit;


			if ($addevent['is_free'] == 'N') {

				$requestdata['sale_start'] = date('Y-m-d H:i:s', strtotime(($this->request->data['sale_start'] == '') ? $eventDetails['sale_start'] : $this->request->data['sale_start']));

				$requestdata['sale_end'] = date('Y-m-d H:i:s', strtotime(($this->request->data['sale_end'] == '') ? $eventDetails['sale_end'] : $this->request->data['sale_end']));

				$requestdata['payment_currency'] = ($this->request->data['payment_currency'] == '') ? $eventDetails['sale_end'] : $this->request->data['payment_currency'];

				$requestdata['ticket_limit'] = $this->request->data['ticket_limit'];

				$requestdata['approve_timer'] = $this->request->data['approve_timer'];
			}
			// pr($requestdata);exit;

			$requestdata['desp'] = $this->request->data['desp'];
			$imagefilename = $this->request->data['event_image']['name'];

			if ($imagefilename) {

				list($width, $height) = getimagesize($this->request->data['event_image']['tmp_name']);

				if ($width < 200 || $height < 200) {
					$this->Flash->error(__('Image dimensions are too small. Minimum (Size 200*200). Uploaded image (Size ' . $width . '*' . $height . ')'));
					return $this->redirect(['action' => 'settings/' . $id]);
				}

				$ext = pathinfo($this->request->data['event_image']['name'], PATHINFO_EXTENSION);
				if ($ext != "png" || $ext != "jpeg" || $ext != "jpg") {
					$this->Flash->error(__('Uploaded file is not a valid image. Only JPG, PNG and JPEG files are allowed.'));
					return $this->redirect(['action' => 'settings/' . $id]);
				}

				$itemww = $this->request->data['event_image']['tmp_name'];
				$ext = pathinfo($imagefilename, PATHINFO_EXTENSION);
				$name = time() . md5($imagefilename);
				$imagename = $name . '.' . $ext;
				unlink('images/eventimages' . $eventDetails['feat_image']);
				if (move_uploaded_file($itemww, "images/eventimages/" . $imagename)) {
					$requestdata['feat_image'] = $imagename;
				}
			} else {
				$requestdata['feat_image'] = $eventDetails['feat_image'];
			}

			$updataevent = $this->Event->patchEntity($addevent, $requestdata);
			$result = $this->Event->save($updataevent);
			if ($result) {
				if ($result['is_free'] == 'Y') {
					return $this->redirect(['action' => 'attendees/' . $id]);
				} else {
					return $this->redirect(['action' => 'manage/' . $id]);
				}

				// $this->Flash->success(__('' . $updataevent['name'] . ' has been updated successfully.'));
			}
			$this->Flash->error(__('Something error'));
			return $this->redirect(['action' => 'settings/' . $id]);
		}
	}

	//Download sample excel sheet for attendees
	public function exportexcel($id = null)
	{
		$this->loadModel('Users');
		// $this->autoRender = false;
	}

	// import excel file attendees 17/03/2023 commented by rupapm 
	// public function importattendees($id = null)
	// {
	// 	$this->loadModel('Orders');
	// 	$this->loadModel('Users');
	// 	$this->loadModel('Event');
	// 	$this->loadModel('Eventdetail');
	// 	$this->loadModel('Cart');
	// 	$this->loadModel('Payment');
	// 	$this->loadModel('Ticket');
	// 	$this->loadModel('Ticketdetail');
	// 	$this->loadModel('Committeeassignticket');
	// 	$this->loadModel('Currency');
	// 	$this->loadModel('Templates');
	// 	$this->loadModel('Attendeeslist');
	// 	$this->autoRender = false;
	// 	$authId = $this->request->session()->read('Auth.User.id');
	// 	$current_datetime = date('Y-m-d H:i:s');
	// 	// $fn['created'] = $current_datetime;

	// 	if ($this->request->is(['post'])) {
	// 		//	pr($this->request->data); die;
	// 		if ($this->request->data['file']['tmp_name']) {
	// 			$empexcel = $this->request->data['file'];
	// 			$inputfilename = $empexcel['tmp_name'];
	// 			try {
	// 				$objPHPExcel = \PHPExcel_IOFactory::load($inputfilename);
	// 			} catch (Exception $e) {
	// 				die('Error loading file "' . pathinfo($inputfilename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
	// 			}

	// 			$sheet = $objPHPExcel->getWorksheetIterator();
	// 			$dataArr = array();
	// 			foreach ($sheet as $hj) {
	// 				$highestRow = $hj->getHighestDataRow();
	// 				$highestColumn = $hj->getHighestDataColumn();
	// 				$highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
	// 				for ($row = 2; $row <= $highestRow; ++$row) {
	// 					for ($col = 0; $col < $highestColumnIndex; ++$col) {
	// 						$cell = $hj->getCellByColumnAndRow($col, $row);
	// 						$val = $cell->getValue();
	// 						$dataArr[$row][$col] = $val;
	// 					}
	// 				}
	// 			}

	// 			$eventdetails = $this->Event->get($id);
	// 			$checkTicket = $this->Eventdetail->find('all')->where(['eventid' => $id])->first();

	// 			// without publish event we have create user if new other wise insert in attendees list table 
	// 			if ($eventdetails['submit_count'] == '') {
	// 				foreach ($dataArr as $key1 => $opt1) {
	// 					$name = ucfirst(trim($opt1[0]));
	// 					$lname = ucfirst(trim($opt1[1]));
	// 					$email = trim($opt1[2]);
	// 					$country_code = $opt1[3];
	// 					$mobile = trim($opt1[4]);
	// 					$gender = trim($opt1[5]);
	// 					$rsvp = trim($opt1[6]);
	// 					$allowed_guest_count = trim($opt1[7]);
	// 					$retVal = ($gender == 'Female' || $gender == 'female') ? 'Female' : 'Male';

	// 					$finduser = $this->Users->find('all')->where(['email' => $email])->first();

	// 					if ($finduser) {
	// 						$chk = $this->Attendeeslist->find('all')->where(['user_id' => $finduser['id'], 'event_id' => $id])->first();

	// 						if ($chk) {
	// 							$existuser = $chk;
	// 							$attendeesInsert['is_rsvp'] = $rsvp;
	// 							$attendeesInsert['created'] = $current_datetime;
	// 							$attendeesInsert['allowed_guest_count'] = $allowed_guest_count;
	// 						} else {
	// 							$existuser = $this->Attendeeslist->newEntity();
	// 							$attendeesInsert['user_id'] = $finduser->id;
	// 							$attendeesInsert['event_id'] = $id;
	// 							$attendeesInsert['is_rsvp'] = $rsvp;
	// 							$attendeesInsert['mobile'] = '+' . $country_code . $mobile;
	// 							$attendeesInsert['allowed_guest_count'] = $allowed_guest_count;
	// 							$attendeesInsert['created'] = $current_datetime;
	// 						}
	// 						$save = $this->Attendeeslist->patchEntity($existuser, $attendeesInsert);
	// 						$this->Attendeeslist->save($save);
	// 					} else {
	// 						//New user register
	// 						$randompass = strtoupper(strtolower(substr(md5(uniqid(rand(), true)), 10, 10)));
	// 						$usr['name'] = $name;
	// 						$usr['lname'] = $lname;
	// 						$usr['email'] = $email;
	// 						$usr['mobile'] = '+' . $country_code . $mobile;
	// 						$usr['mobileverifynumber'] = '+' . $country_code . $mobile;
	// 						$usr['password'] = $this->_setPassword($randompass);
	// 						$usr['confirm_pass'] = $randompass;
	// 						$usr['gender'] = $retVal;
	// 						$usr['status'] = 'Y';
	// 						$usr['is_suspend'] = 'N';
	// 						$usr['is_mob_verify'] = 'Y';
	// 						$usr['role_id'] = 3;
	// 						$usr['created'] = $current_datetime;
	// 						$atn = $this->Users->patchEntity($this->Users->newEntity(), $usr);
	// 						$saveUsers = $this->Users->save($atn);

	// 						$existuser = $this->Attendeeslist->newEntity();
	// 						$attendeesInsert['user_id'] = $saveUsers->id;
	// 						$attendeesInsert['event_id'] = $id;
	// 						$attendeesInsert['is_rsvp'] = $rsvp;
	// 						$attendeesInsert['mobile'] = '+' . $country_code . $mobile;
	// 						$attendeesInsert['allowed_guest_count'] = $allowed_guest_count;
	// 						$attendeesInsert['created'] = $current_datetime;
	// 						$save = $this->Attendeeslist->patchEntity($existuser, $attendeesInsert);
	// 						$this->Attendeeslist->save($save);
	// 					}
	// 				}
	// 				$this->Flash->success(__('All Attendees were imported successfully .'));
	// 				return $this->redirect($this->referer());
	// 			} else {

	// 				foreach ($dataArr as $key => $opt) {
	// 					$name = ucfirst(trim($opt[0]));
	// 					$lname = ucfirst(trim($opt[1]));
	// 					$email = trim($opt[2]);
	// 					$country_code = $opt[3];
	// 					$mobile = trim($opt[4]);
	// 					$gender = trim($opt[5]);
	// 					$rsvp = trim($opt[6]);
	// 					$allowed_guest_count = trim($opt[7]);
	// 					$retVal = ($gender == 'Female' || $gender == 'female') ? 'Female' : 'Male';

	// 					if ($key == 2) {
	// 						$orderdata['user_id'] = $authId;
	// 						$orderdata['total_amount'] = 0;
	// 						$orderdata['paymenttype'] = "Comps";
	// 						$orderdata['created'] = $current_datetime;
	// 						$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);
	// 						$saveorders = $this->Orders->save($insertdata);
	// 					}
	// 					$finduser = $this->Users->find('all')->where(['email' => $email])->first();
	// 					// if already exist user 
	// 					if ($finduser) {
	// 						$findone = $this->Ticket->find('all')->where(['event_id' => $id, 'cust_id' => $finduser['id']])->first();

	// 						if (empty($findone)) {
	// 							$fn['user_id'] = $finduser['id'];
	// 							$fn['event_id'] = $id;
	// 							$fn['mpesa'] = null;
	// 							$fn['amount'] =  0;
	// 							$fn['created'] = $current_datetime;
	// 							$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
	// 							$this->Payment->save($payment);
	// 							$ticketbook['order_id'] = $saveorders->id;
	// 							$ticketbook['event_id'] =  $id;
	// 							$ticketbook['event_ticket_id'] = $checkTicket['id'];
	// 							$ticketbook['cust_id'] = $finduser['id'];
	// 							$ticketbook['ticket_buy'] = 1;
	// 							$ticketbook['amount'] = 0;
	// 							$ticketbook['mobile'] =  ($finduser['mobile']) ? $finduser['mobile'] : 123456789;
	// 							$ticketbook['committee_user_id'] = $eventdetails['event_org_id'];
	// 							$ticketbook['user_desc'] = 'Free Ticket';
	// 							$ticketbook['created'] = $current_datetime;
	// 							$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
	// 							$lastinsetid = $this->Ticket->save($insertticketbook);

	// 							$ticketdetaildata['tid'] = $lastinsetid['id'];
	// 							$ticketdetaildata['user_id'] = $finduser['id'];
	// 							$ticketdetaildata['created'] = $current_datetime;
	// 							$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
	// 							$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

	// 							$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
	// 							$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
	// 							$Packff->name = $name . ' ' . $lname;
	// 							$Packff->is_rsvp = $rsvp;
	// 							$ticketdetail = $this->Ticketdetail->save($Packff);

	// 							$ticketqrimages = $this->qrcodepro($finduser['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
	// 							$Pack = $this->Ticketdetail->get($ticketdetail['id']);
	// 							$Pack->qrcode = $ticketrqimages;
	// 							$this->Ticketdetail->save($Pack);


	// 							// send email to admin and event organiser 
	// 							$eventname = ucwords(strtolower($eventdetails['name']));
	// 							$requestername = $finduser['name'] . ' ' . $finduser['lname'];
	// 							$url = SITE_URL . 'tickets/myticket';
	// 							$site_url = SITE_URL;
	// 							// $currenny_sign = $currenny['Currency'];
	// 							$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
	// 							$from = $emailtemplate['fromemail'];
	// 							$to = $finduser['email'];
	// 							// $cc = $from;
	// 							$subject = $emailtemplate['subject'] . ': ' . $eventname;
	// 							$formats = $emailtemplate['description'];

	// 							$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $finduser['email'], $finduser['confirm_pass']), $formats);
	// 							$message = stripslashes($message1);
	// 							$message = '<!DOCTYPE HTML>
	// 							<html>                
	// 							<head>
	// 								<meta http-equiv="Content-Type " content="text/html; charset=utf-8 ">
	// 								<title>Untitled Document</title>
	// 								<style>
	// 									p {
	// 										margin: 9px 0px;
	// 									}
	// 								</style>                
	// 							</head>                
	// 							<body style="background:#d8dde4; padding:15px;">' . $message1 . '</body></html>';
	// 							$headers = 'MIME-Version: 1.0' . "\r\n";
	// 							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// 							$headers .= 'From: <' . $from . '>' . "\r\n";
	// 							$mail = $this->Email->send($to, $subject, $message);

	// 							// send watsappmessage start 
	// 							$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
	// 							$numwithcode = $finduser['mobile'];
	// 							if ($numwithcode) {
	// 								$this->whatsappmsg($numwithcode, $message);
	// 							}
	// 							// send watsappmessage start 
	// 						} else {
	// 							$Packff = $this->Ticketdetail->get($findone['id']);
	// 							$ticketdetaildata['is_rsvp'] = $rsvp;
	// 							$ticketdetaildata['created'] = $current_datetime;
	// 							$ticketdetail = $this->Ticketdetail->patchEntity($Packff, $ticketdetaildata);
	// 							$this->Ticketdetail->save($ticketdetail);
	// 						}
	// 						//New user register and generate ticket for free event
	// 					} else {
	// 						$randompass = strtoupper(strtolower(substr(md5(uniqid(rand(), true)), 10, 10)));
	// 						$usr['name'] = $name;
	// 						$usr['lname'] = $lname;
	// 						$usr['email'] = $email;
	// 						$usr['mobile'] = '+' . $country_code . $mobile;
	// 						$usr['mobileverifynumber'] = '+' . $country_code . $mobile;
	// 						$usr['password'] = $this->_setPassword($randompass);
	// 						$usr['confirm_pass'] = $randompass;
	// 						$usr['gender'] = $retVal;
	// 						$usr['status'] = 'Y';
	// 						$usr['is_suspend'] = 'N';
	// 						$usr['is_mob_verify'] = 'Y';
	// 						$usr['role_id'] = CUSTOMERROLE; // 3
	// 						$usr['created'] = $current_datetime;
	// 						$atn = $this->Users->patchEntity($this->Users->newEntity(), $usr);
	// 						$saveUsers = $this->Users->save($atn);

	// 						$fn['user_id'] = $saveUsers['id'];
	// 						$fn['event_id'] = $id;
	// 						$fn['mpesa'] = null;
	// 						$fn['amount'] =  0;
	// 						$fn['created'] = $current_datetime;
	// 						$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
	// 						$this->Payment->save($payment);

	// 						$ticketbook['order_id'] = $saveorders->id;
	// 						$ticketbook['event_id'] =  $id;
	// 						$ticketbook['event_ticket_id'] = $checkTicket['id'];
	// 						$ticketbook['cust_id'] = $saveUsers['id'];
	// 						$ticketbook['ticket_buy'] = 1;
	// 						$ticketbook['amount'] = 0;
	// 						$ticketbook['mobile'] =  $saveUsers['mobile'];
	// 						$ticketbook['committee_user_id'] = $eventdetails['event_org_id'];
	// 						$ticketbook['user_desc'] = 'Free Ticket';
	// 						$ticketbook['created'] = $current_datetime;
	// 						$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
	// 						$lastinsetid = $this->Ticket->save($insertticketbook);

	// 						$ticketdetaildata['tid'] = $lastinsetid['id'];
	// 						$ticketdetaildata['user_id'] = $saveUsers['id'];
	// 						$ticketdetaildata['created'] = $current_datetime;
	// 						$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
	// 						$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

	// 						$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
	// 						$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
	// 						$Packff->name = $name . ' ' . $lname;
	// 						$ticketdetail = $this->Ticketdetail->save($Packff);

	// 						$ticketqrimages = $this->qrcodepro($saveUsers['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
	// 						$Pack = $this->Ticketdetail->get($ticketdetail['id']);
	// 						$Pack->qrcode = $ticketqrimages;
	// 						$this->Ticketdetail->save($Pack);


	// 						// send email to admin and event organiser 
	// 						$eventname = ucwords(strtolower($eventdetails['name']));
	// 						$requestername = $saveUsers['name'] . ' ' . $saveUsers['lname'];
	// 						$url = SITE_URL . 'tickets/myticket';
	// 						$site_url = SITE_URL;
	// 						// $currenny_sign = $currenny['Currency'];
	// 						$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
	// 						$from = $emailtemplate['fromemail'];
	// 						$to = $saveUsers['email'];
	// 						// $cc = $from;
	// 						$subject = $emailtemplate['subject'] . ': ' . $eventname;
	// 						$formats = $emailtemplate['description'];

	// 						$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $saveUsers['email'], $saveUsers['confirm_pass']), $formats);
	// 						$message = stripslashes($message1);
	// 						$message = '<!DOCTYPE HTML>
	// 							<html>                
	// 							<head>
	// 								<meta http-equiv="Content-Type " content="text/html; charset=utf-8 ">
	// 								<title>Untitled Document</title>
	// 								<style>
	// 									p {
	// 										margin: 9px 0px;
	// 									}
	// 								</style>                
	// 							</head>                
	// 							<body style="background:#d8dde4; padding:15px;">' . $message1 . '</body></html>';
	// 						$headers = 'MIME-Version: 1.0' . "\r\n";
	// 						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// 						$headers .= 'From: <' . $from . '>' . "\r\n";
	// 						$mail = $this->Email->send($to, $subject, $message);

	// 						// send watsappmessage start 
	// 						$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
	// 						$numwithcode = $country_code . $mobile;
	// 						if ($numwithcode) {
	// 							$this->whatsappmsg($numwithcode, $message);
	// 						}
	// 						// send watsappmessage start 
	// 					}
	// 					$checkOrderid = $this->Ticket->find('all')->where(['order_id' => $saveorders['id']])->first();
	// 					if (empty($checkOrderid)) {
	// 						$this->Orders->deleteAll(['Orders.id' =>  $saveorders['id']]);
	// 					}
	// 				}
	// 				$this->Flash->success(__('All Attendees were imported successfully .'));
	// 				return $this->redirect($this->referer());
	// 			}
	// 		}
	// 		//end 
	// 		$this->Flash->error(__('Failed to import Excel'));
	// 		return $this->redirect($this->referer());
	// 	}
	// }

	// this is the depiricate code
	public function importattendees($id = null)
	{
		$this->loadModel('Orders');
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Eventdetail');
		$this->loadModel('Cart');
		$this->loadModel('Payment');
		$this->loadModel('Ticket');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Committeeassignticket');
		$this->loadModel('Currency');
		$this->loadModel('Templates');
		$this->loadModel('Attendeeslist');
		$this->autoRender = false;
		$authId = $this->request->session()->read('Auth.User.id');
		$admin_user = $this->Users->find('all')->where(['role_id' => 1])->first();
		$current_datetime = date('Y-m-d H:i:s');

		if ($this->request->is(['post'])) {
			// pr($this->request->data); die;

			// Begin transaction
			$connection = ConnectionManager::get('default');
			$connection->begin();
			try {

				if ($this->request->data['file']['tmp_name']) {

					$empexcel = $this->request->data['file'];
					$inputfilename = $empexcel['tmp_name'];

					$allowedExtensions = array('xlsx', 'xls');
					$fileExt = pathinfo($empexcel['name'], PATHINFO_EXTENSION);
					if (!in_array(strtolower($fileExt), $allowedExtensions)) {
						// The file is not an Excel file
						$this->Flash->error(__('The file is not an Excel file'));
						return $this->redirect($this->referer());
					}

					try {
						$objPHPExcel = \PHPExcel_IOFactory::load($inputfilename);
					} catch (Exception $e) {
						die('Error loading file "' . pathinfo($inputfilename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
					}

					$sheet = $objPHPExcel->getWorksheetIterator();
					$dataArr = array();
					$emptyFields = array(); // array to store the row and column of empty cells

					// foreach ($sheet as $hj) {
					// 	$highestRow = $hj->getHighestDataRow();
					// 	$highestColumn = $hj->getHighestDataColumn();
					// 	$highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
					// 	for ($row = 2; $row <= $highestRow; ++$row) {
					// 		$rowData = array();
					// 		for ($col = 0; $col < $highestColumnIndex; ++$col) {
					// 			$cell = $hj->getCellByColumnAndRow($col, $row);
					// 			$val = $cell->getValue();
					// 			$rowData[$col] = $val;
					// 			if (empty($val)) {
					// 				$emptyFields[] = array("row" => $row, "column" => $col);
					// 			}
					// 		}
					// 		$dataArr[$row] = $rowData;
					// 	}
					// }

					foreach ($sheet as $hj) {
						$highestRow = $hj->getHighestDataRow();
						$highestColumn = $hj->getHighestDataColumn();
						$highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
						for ($row = 2; $row <= $highestRow; ++$row) {
							$rowData = array();
							for ($col = 0; $col < $highestColumnIndex; ++$col) {
								$cell = $hj->getCellByColumnAndRow($col, $row);
								$val = $cell->getValue();
								if (!empty($val)) {
									$rowData[$col] = $val;
									// $emptyFields[] = array("row" => $row, "column" => $col);
								}
							}
							if (!empty($rowData)) {
								$dataArr[$row] = $rowData;
							}
						}
					}


					if (!empty($emptyFields)) {
						// Display error message to user with details of empty fields
						$flashMessage = "Some fields are empty";
						// foreach ($emptyFields as $field) {
						// 	$flashMessage .= "Row " . $field['row'] . ", Column " . $field['column'] . "; ";
						// }
						$this->Flash->error(__($flashMessage));
						return $this->redirect($this->referer());
					} elseif (empty($dataArr)) {
						$this->Flash->error(__('The Excel file is empty. Please provide a file with data.'));
						return $this->redirect($this->referer());
					}

					$eventdetails = $this->Event->get($id);
					$checkTicket = $this->Eventdetail->find('all')->where(['eventid' => $id])->first();

					// without publish event we have create user if new other wise insert in attendees list table 
					if ($eventdetails['submit_count'] == '') {

						foreach ($dataArr as $key => $opt1) {
							$name = ucfirst(trim($opt1[0]));
							$lname = ucfirst(trim($opt1[1]));
							$email = trim($opt1[2]);
							$country_code = $opt1[3];
							// $mobile = $opt1[4];
							$mobile = str_replace([' ', '-'], '', $opt[4]);
							$gender = trim($opt1[5]);
							$rsvp = trim($opt1[6]);
							$is_allowed_guest = trim($opt1[7]);
							$retVal = ($gender == 'Female' || $gender == 'female') ? 'Female' : 'Male';

							$finduser = $this->Users->find('all')->where(['email' => $email])->first();

							if ($finduser) {

								// $chk = $this->Attendeeslist->find('all')->where(['user_id' => $finduser['id'], 'event_id' => $id])->first();

								$chk = $this->Attendeeslist->find('all')
									->where(function ($exp, $q) use ($finduser, $id) {
										return $exp->add(
											$exp->or_([
												['user_id' => $finduser['id']],
												['mobile' => $finduser['mobile']]
											])
										)->add(['event_id' => $id]);
									})
									->first();

								if ($chk) {
									$existuser = $chk;
									$attendeesInsert['name'] = $name . ' ' . $lname;
									$attendeesInsert['email'] = $email;
									$attendeesInsert['is_rsvp'] = $rsvp;
									$attendeesInsert['is_allowed_guest'] = $is_allowed_guest;
									$attendeesInsert['created'] = $current_datetime;
								} else {
									$existuser = $this->Attendeeslist->newEntity();
									$attendeesInsert['user_id'] = $finduser->id;
									$attendeesInsert['name'] = $name . ' ' . $lname;
									$attendeesInsert['email'] = $email;
									$attendeesInsert['event_id'] = $id;
									$attendeesInsert['is_rsvp'] = $rsvp;
									$attendeesInsert['mobile'] = '+' . $country_code . $mobile;
									$attendeesInsert['is_allowed_guest'] = $is_allowed_guest;
									$attendeesInsert['created'] = $current_datetime;
								}
								$save = $this->Attendeeslist->patchEntity($existuser, $attendeesInsert);
								$this->Attendeeslist->save($save);
								$connection->commit();
							} else {
								//New user register
								$randompass = strtoupper(strtolower(substr(md5(uniqid(rand(), true)), 10, 10)));
								$usr['name'] = $name;
								$usr['lname'] = $lname;
								$usr['email'] = $email;
								$usr['mobile'] = '+' . $country_code . $mobile;
								$usr['mobileverifynumber'] = '+' . $country_code . $mobile;
								$usr['password'] = $this->_setPassword($randompass);
								$usr['confirm_pass'] = $randompass;
								$usr['gender'] = $retVal;
								$usr['status'] = 'Y';
								$usr['is_suspend'] = 'N';
								$usr['is_mob_verify'] = 'Y';
								$usr['role_id'] = 3;
								$usr['created'] = $current_datetime;
								$atn = $this->Users->patchEntity($this->Users->newEntity(), $usr);
								$saveUsers = $this->Users->save($atn);

								$existuser = $this->Attendeeslist->newEntity();
								$attendeesInsert['user_id'] = $saveUsers->id;
								$attendeesInsert['name'] = trim($name . ' ' . $lname);
								$attendeesInsert['email'] = $email;
								$attendeesInsert['event_id'] = $id;
								$attendeesInsert['is_rsvp'] = $rsvp;
								$attendeesInsert['mobile'] = '+' . $country_code . $mobile;
								$attendeesInsert['is_allowed_guest'] = $is_allowed_guest;
								$attendeesInsert['created'] = $current_datetime;
								$save = $this->Attendeeslist->patchEntity($existuser, $attendeesInsert);
								$this->Attendeeslist->save($save);
							}
						}
						$connection->commit();
						$this->Flash->success(__('All Attendees were imported successfully .'));
						return $this->redirect($this->referer());
					} else {
						// Event already live and then upload excel file
						$firstloop = 0;
						$secondloop = 0;

						foreach ($dataArr as $key => $opt) {
							$name = ucfirst(trim($opt[0]));
							$lname = ucfirst(trim($opt[1]));
							$email = trim($opt[2]);
							$country_code = $opt[3];
							// $mobile = trim($opt[4]);
							$mobile = str_replace([' ', '-'], '', $opt[4]);
							$gender = trim($opt[5]);
							$rsvp = trim($opt[6]);
							$is_allowed_guest = trim($opt[7]);
							// $this->dd($opt);die;

							if ($key == 2) {
								$orderdata['user_id'] = $authId;
								$orderdata['total_amount'] = 0;
								$orderdata['paymenttype'] = "Comps";
								$orderdata['adminfee'] = $admin_user['feeassignment'];
								$orderdata['created'] = $current_datetime;
								$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);
								$saveorders = $this->Orders->save($insertdata);
							}

							// Check if any field is empty
							if (empty($opt[0]) || empty($opt[1]) || empty($opt[2]) || empty($opt[3]) || empty($opt[4]) || empty($opt[5]) || empty($opt[6]) || empty($opt[7])) {
								continue; // Skip this record and move on to the next one
							}

							$retVal = ($gender == 'Female' || $gender == 'female') ? 'Female' : 'Male';
							$finduser = $this->Users->find('all')->where(['email' => $email])->first();
							// pr($is_allowed_guest);exit;
							// if already exist user and guest allowed and not allowed 
							if ($finduser && ($is_allowed_guest === 'Y' || $is_allowed_guest === 'N')) {

								$findone = $this->Ticket->find('all')->where(['event_id' => $id, 'mobile' => $finduser['mobile']])->count();

								$findbyid = $this->Ticket->find('all')->where(['event_id' => $id, 'cust_id' => $finduser['id']])->count();

								//for guest not allowed
								if ($is_allowed_guest == 'N' && $findone == 0 && $findbyid == 0) {
									// No ticket generated yet for this user, so generate one tickets for the user and guest
									// pr('No ticket generated yet for this user, so generate one tickets for the user.');
									// exit;

									$fn['user_id'] = $finduser['id'];
									$fn['event_id'] = $id;
									$fn['mpesa'] = null;
									$fn['amount'] =  0;
									$fn['created'] = $current_datetime;
									$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
									$this->Payment->save($payment);

									$ticketbook['order_id'] = $saveorders->id;
									$ticketbook['event_id'] =  $id;
									$ticketbook['event_ticket_id'] = $checkTicket['id'];
									$ticketbook['cust_id'] = $finduser['id'];
									$ticketbook['ticket_buy'] = 1;
									$ticketbook['amount'] = 0;
									$ticketbook['mobile'] =  ($finduser['mobile']) ? $finduser['mobile'] : $finduser['id'];
									$ticketbook['committee_user_id'] = $eventdetails['event_org_id'];
									$ticketbook['user_desc'] = 'Free Ticket from importattendees';
									$ticketbook['adminfee'] = $admin_user['feeassignment'];
									$ticketbook['created'] = $current_datetime;
									$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
									$lastinsetid = $this->Ticket->save($insertticketbook);

									$ticketdetaildata['tid'] = $lastinsetid['id'];
									$ticketdetaildata['user_id'] = $finduser['id'];
									$ticketdetaildata['created'] = $current_datetime;
									$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
									$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

									$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
									$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
									$Packff->name = $name . ' ' . $lname;
									$Packff->is_rsvp = $rsvp;
									$ticketdetail = $this->Ticketdetail->save($Packff);

									$ticketqrimages = $this->qrcodepro($finduser['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
									$Pack = $this->Ticketdetail->get($ticketdetail['id']);
									$Pack->qrcode = $ticketqrimages;
									$this->Ticketdetail->save($Pack);


									// send email to admin and event organiser 
									$eventname = ucwords(strtolower($eventdetails['name']));
									$requestername = $finduser['name'] . ' ' . $finduser['lname'];
									$url = SITE_URL . 'tickets/myticket';
									$site_url = SITE_URL;
									// $currenny_sign = $currenny['Currency'];
									$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
									$from = $emailtemplate['fromemail'];
									$to = $finduser['email'];
									// $cc = $from;
									$subject = $emailtemplate['subject'] . ': ' . $eventname;
									$formats = $emailtemplate['description'];

									$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $finduser['email'], $finduser['confirm_pass']), $formats);
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
									$mail = $this->Email->send($to, $subject, $message);

									// send watsappmessage start 
									$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
									$numwithcode = $finduser['mobile'];
									if ($numwithcode) {
										$this->whatsappmsg($numwithcode, $message);
									}
									// send watsappmessage start 

								} else if ($is_allowed_guest === 'Y') {
									//for guest allowed
									if ($findone == 2 && $findbyid == 2) {
										// pr('Two ticket already generated for this user need to continue the loop');
										// exit;
										continue;
									} else if ($findone == 1 && $findbyid == 1) {
										// One ticket already generated for this user, so generate another ticket for the guest
										// pr('One ticket already generated for this user, so generate another ticket for the guest');
										// exit;
										$fn['user_id'] = $finduser['id'];
										$fn['event_id'] = $id;
										$fn['mpesa'] = null;
										$fn['amount'] =  0;
										$fn['created'] = $current_datetime;
										$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
										$this->Payment->save($payment);
										$ticketbook['order_id'] = $saveorders->id;
										$ticketbook['event_id'] =  $id;
										$ticketbook['event_ticket_id'] = $checkTicket['id'];
										$ticketbook['cust_id'] = $finduser['id'];
										$ticketbook['ticket_buy'] = 1;
										$ticketbook['amount'] = 0;
										$ticketbook['mobile'] =  ($finduser['mobile']) ? $finduser['mobile'] : $finduser['id'];
										$ticketbook['committee_user_id'] = $eventdetails['event_org_id'];
										$ticketbook['user_desc'] = 'Free Ticket from importattendees';
										$ticketbook['adminfee'] = $admin_user['feeassignment'];
										$ticketbook['created'] = $current_datetime;
										$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
										$lastinsetid = $this->Ticket->save($insertticketbook);

										$ticketdetaildata['tid'] = $lastinsetid['id'];
										$ticketdetaildata['user_id'] = $finduser['id'];
										$ticketdetaildata['created'] = $current_datetime;
										$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
										$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

										$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
										$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
										$Packff->name = $name . ' ' . $lname;
										$Packff->is_rsvp = $rsvp;
										$ticketdetail = $this->Ticketdetail->save($Packff);

										$ticketqrimages = $this->qrcodepro($finduser['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
										$Pack = $this->Ticketdetail->get($ticketdetail['id']);
										$Pack->qrcode = $ticketqrimages;
										$this->Ticketdetail->save($Pack);


										// send email to admin and event organiser 
										$eventname = ucwords(strtolower($eventdetails['name']));
										$requestername = $finduser['name'] . ' ' . $finduser['lname'];
										$url = SITE_URL . 'tickets/myticket';
										$site_url = SITE_URL;
										// $currenny_sign = $currenny['Currency'];
										$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
										$from = $emailtemplate['fromemail'];
										$to = $finduser['email'];
										// $cc = $from;
										$subject = $emailtemplate['subject'] . ': ' . $eventname;
										$formats = $emailtemplate['description'];

										$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $finduser['email'], $finduser['confirm_pass']), $formats);
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
										$mail = $this->Email->send($to, $subject, $message);

										// send watsappmessage start 
										$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
										$numwithcode = $finduser['mobile'];
										if ($numwithcode) {
											$this->whatsappmsg($numwithcode, $message);
										}
										// send watsappmessage start 
									} else if ($findone == 0 && $findbyid == 0) {
										// No ticket generated yet for this user, so generate two tickets for the user and guest
										// pr('No ticket generated yet for this user, so generate two tickets for the user and guest');
										// exit;

										for ($i = 0; $i < 2; $i++) {
											$fn['user_id'] = $finduser['id'];
											$fn['event_id'] = $id;
											$fn['mpesa'] = null;
											$fn['amount'] =  0;
											$fn['created'] = $current_datetime;
											$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
											$this->Payment->save($payment);
											$ticketbook['order_id'] = $saveorders->id;
											$ticketbook['event_id'] =  $id;
											$ticketbook['event_ticket_id'] = $checkTicket['id'];
											$ticketbook['cust_id'] = $finduser['id'];
											$ticketbook['ticket_buy'] = 1;
											$ticketbook['amount'] = 0;
											$ticketbook['mobile'] =  ($finduser['mobile']) ? $finduser['mobile'] : $finduser['id'];
											$ticketbook['committee_user_id'] = $eventdetails['event_org_id'];
											$ticketbook['user_desc'] = 'Free Ticket from importattendees';
											$ticketbook['adminfee'] = $admin_user['feeassignment'];
											$ticketbook['created'] = $current_datetime;
											$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
											$lastinsetid = $this->Ticket->save($insertticketbook);

											$ticketdetaildata['tid'] = $lastinsetid['id'];
											$ticketdetaildata['user_id'] = $finduser['id'];
											$ticketdetaildata['created'] = $current_datetime;
											$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
											$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

											$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
											$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
											$Packff->name = $name . ' ' . $lname;
											$Packff->is_rsvp = $rsvp;
											$ticketdetail = $this->Ticketdetail->save($Packff);

											$ticketqrimages = $this->qrcodepro($finduser['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
											$Pack = $this->Ticketdetail->get($ticketdetail['id']);
											$Pack->qrcode = $ticketqrimages;
											$this->Ticketdetail->save($Pack);


											// send email to admin and event organiser 
											$eventname = ucwords(strtolower($eventdetails['name']));
											$requestername = $finduser['name'] . ' ' . $finduser['lname'];
											$url = SITE_URL . 'tickets/myticket';
											$site_url = SITE_URL;
											// $currenny_sign = $currenny['Currency'];
											$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
											$from = $emailtemplate['fromemail'];
											$to = $finduser['email'];
											// $cc = $from;
											$subject = $emailtemplate['subject'] . ': ' . $eventname;
											$formats = $emailtemplate['description'];

											$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $finduser['email'], $finduser['confirm_pass']), $formats);
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
											if ($i == 0) {
												$mail = $this->Email->send($to, $subject, $message);
											}
											// send watsappmessage start 
											$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
											$numwithcode = $finduser['mobile'];
											if ($numwithcode && $i == 0) {
												$this->whatsappmsg($numwithcode, $message);
											}
											// send watsappmessage start 
										}
									}
								}
								//New user register and generate ticket for free event
							} else {
								// pr('this is new user for this plateform	');
								// exit;

								$randompass = strtoupper(strtolower(substr(md5(uniqid(rand(), true)), 10, 10)));
								$usr['name'] = $name;
								$usr['lname'] = $lname;
								$usr['email'] = $email;
								$usr['mobile'] = '+' . $country_code . $mobile;
								$usr['mobileverifynumber'] = '+' . $country_code . $mobile;
								$usr['password'] = $this->_setPassword($randompass);
								$usr['confirm_pass'] = $randompass;
								$usr['gender'] = $retVal;
								$usr['status'] = 'Y';
								$usr['is_suspend'] = 'N';
								$usr['is_mob_verify'] = 'Y';
								$usr['role_id'] = CUSTOMERROLE; // 3
								$usr['created'] = $current_datetime;
								$atn = $this->Users->patchEntity($this->Users->newEntity(), $usr);

								$findone = $this->Ticket->find('all')->where(['event_id' => $id, 'mobile' => $atn['mobile']])->count();

								if ($is_allowed_guest === 'Y') {
									$saveUsers = $this->Users->save($atn);

									//send mail new register user
									$name = $saveUsers['name'];
									$email = $saveUsers['email'];
									$password = $saveUsers['confirm_pass'];
									$site_url = SITE_URL;

									$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 24])->first();
									$from = $emailtemplate['fromemail'];
									$to = $email;
									$subject = $emailtemplate['subject'];
									$formats = $emailtemplate['description'];

									$message1 = str_replace(array('{Name}', '{Email}', '{Password}', '{SITE_URL}', '{From}'), array($name, $email, $password, $site_url, $from), $formats);
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
									// end the sending mail for user 


									if ($findone == 1) {
										$secondloop = 1;
									} elseif ($findone == 2) {
										continue;
									} else {
										$secondloop = 2;
									}
								} else if ($is_allowed_guest === 'N') {
									$saveUsers = $this->Users->save($atn);

									//send mail new register user
									$name = $saveUsers['name'];
									$email = $saveUsers['email'];
									$password = $saveUsers['confirm_pass'];
									$site_url = SITE_URL;

									$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 24])->first();
									$from = $emailtemplate['fromemail'];
									$to = $email;
									$subject = $emailtemplate['subject'];
									$formats = $emailtemplate['description'];

									$message1 = str_replace(array('{Name}', '{Email}', '{Password}', '{SITE_URL}', '{From}'), array($name, $email, $password, $site_url, $from), $formats);
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
									// end the sending mail for user 

									if ($findone == 1) {
										continue;
									}
									$secondloop = 1;
								}

								for ($i = 0; $i < $secondloop; $i++) {

									$fn['user_id'] = $saveUsers['id'];
									$fn['event_id'] = $id;
									$fn['mpesa'] = null;
									$fn['amount'] =  0;
									$fn['created'] = $current_datetime;
									$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
									$this->Payment->save($payment);

									$ticketbook['order_id'] = $saveorders->id;
									$ticketbook['event_id'] =  $id;
									$ticketbook['event_ticket_id'] = $checkTicket['id'];
									$ticketbook['cust_id'] = $saveUsers['id'];
									$ticketbook['ticket_buy'] = 1;
									$ticketbook['amount'] = 0;
									$ticketbook['mobile'] =  $saveUsers['mobile'];
									$ticketbook['committee_user_id'] = $eventdetails['event_org_id'];
									$ticketbook['user_desc'] = 'Free Ticket from importattendees';
									$ticketbook['adminfee'] = $admin_user['feeassignment'];
									$ticketbook['created'] = $current_datetime;
									$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
									$lastinsetid = $this->Ticket->save($insertticketbook);

									$ticketdetaildata['tid'] = $lastinsetid['id'];
									$ticketdetaildata['user_id'] = $saveUsers['id'];
									$ticketdetaildata['created'] = $current_datetime;
									$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
									$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

									$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
									$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
									$Packff->name = $name . ' ' . $lname;
									$Packff->is_rsvp = $rsvp;
									$ticketdetail = $this->Ticketdetail->save($Packff);

									$ticketqrimages = $this->qrcodepro($saveUsers['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
									$Pack = $this->Ticketdetail->get($ticketdetail['id']);
									$Pack->qrcode = $ticketqrimages;
									$this->Ticketdetail->save($Pack);


									// send email to admin and event organiser 
									$eventname = ucwords(strtolower($eventdetails['name']));
									$requestername = $saveUsers['name'] . ' ' . $saveUsers['lname'];
									$url = SITE_URL . 'tickets/myticket';
									$site_url = SITE_URL;
									// $currenny_sign = $currenny['Currency'];
									$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
									$from = $emailtemplate['fromemail'];
									$to = $saveUsers['email'];
									// $cc = $from;
									$subject = $emailtemplate['subject'] . ': ' . $eventname;
									$formats = $emailtemplate['description'];

									$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $saveUsers['email'], $saveUsers['confirm_pass']), $formats);
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
									if ($i == 0) {
										$mail = $this->Email->send($to, $subject, $message);
									}

									// send watsappmessage start 
									$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
									$numwithcode = $country_code . $mobile;
									if ($numwithcode && $i == 0) {
										$this->whatsappmsg($numwithcode, $message);
									}
									// send watsappmessage start 
								}
							}

							$checkOrderid = $this->Ticket->find('all')->where(['order_id' => $saveorders['id']])->first();
							if (empty($checkOrderid)) {
								$this->Orders->deleteAll(['Orders.id' =>  $saveorders['id']]);
							}
						}
						$connection->commit();
						$this->Flash->success(__('All Attendees were imported successfully .'));
						return $this->redirect($this->referer());
					}
					$connection->commit();
					// If all data saved successfully, commit the transaction
				}
				//end 
				$this->Flash->error(__('Failed to import Excel'));
				return $this->redirect($this->referer());
			} catch (Exception $e) {
				// Rollback transaction
				$connection->rollback();
				$this->Flash->error('Failed to save data: ' . $e->getMessage());
				// throw $e;
			}
		}
	}

	// download excel formate 
	public function downloadattendees($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Templates');
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Attendeeslist');
		$event = $this->Event->get($id);
		if (empty($event['submit_count'])) {
			$getUsers = $this->Attendeeslist->find('all')->contain(['Users'])->where(['event_id' => $id])->toarray();
		} else {
			// $getUsers = $this->Ticket->find('all')->contain(['Users', 'Ticketdetail'])->group(['Users.id'])->where(['event_id' => $id])->order(['Ticket.id' => 'DESC'])->toarray();
			$getUsers = $this->Ticket->find('all')
				->contain(['Users', 'Ticketdetail'])
				->group(['Users.id'])
				->where(['event_id' => $id])
				->order(['Users.name' => 'ASC', 'Ticket.id' => 'DESC'])
				->toArray();
		}
		// print_r($getUsers);exit; 

		if ($getUsers) {
			$this->set('getUsers', $getUsers);
		} else {
			$this->Flash->error(__('No invitation send till now !!'));
			return $this->redirect($this->referer());
		}
	}
	// attedees index 
	public function attendees($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->loadModel('Ticket');
		$this->loadModel('Cart');
		$this->loadModel('Payment');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Committeeassignticket');
		$this->loadModel('Currency');
		$this->loadModel('Templates');
		$this->loadModel('Orders');
		$this->loadModel('Attendeeslist');

		$authId = $this->request->session()->read('Auth.User.id');
		$current_datetime = date('Y-m-d H:i:s');
		$admin_user = $this->Users->find('all')->where(['role_id' => 1])->first();

		if (isset($id) && !empty($id)) {
			$eventDetails = $this->Event->find('all')->contain('Eventdetail')->where(['Event.id' => $id])->first();
			if ($eventDetails['submit_count']) {
				$getUsers = $this->Ticket->find('all')->contain(['Users', 'Ticketdetail'])->where(['Ticket.event_id' => $id])->group(['Users.id'])->order(['Ticket.id' => 'DESC']);
				// ->toarray();
				// pr($getUsers);exit;
				// $getUsers = $this->Ticket->find('all')->contain(['Users', 'Ticketdetail'])->where(['Ticket.event_id' => $id])->order(['Ticket.id' => 'DESC']);
			} else {
				$getUsers = $this->Attendeeslist->find('all')->contain(['Users'])->where(['Attendeeslist.event_id' => $id])->order(['Attendeeslist.id' => 'DESC']);
			}
			// Get the total count of users returned by the query
			$userCount = $getUsers->count();
			$getUsers = $this->paginate($getUsers)->toarray();
			// $getUsers->limit(30); // Set the limit to 100 records
			if ($getUsers) {
				$this->set(compact('userCount', 'getUsers', 'id'));
			}
			$this->set('user_id', $authId);
			$this->set('findevent', $eventDetails);
			$this->set('id', $id);
		}

		if ($this->request->is(['post', 'put'])) {
			// pr($this->request->data); die;
			$eventdetails = $this->Event->get($id);
			$is_allowed_guest = ($this->request->data['is_allowed_guest'] === 'Y') ? 'Y' : 'N';
			$checkTicket = $this->Eventdetail->find('all')->where(['eventid' => $id])->first();
			$finduser = $this->Users->find('all')->where(['id' => $this->request->data['user_id']])->first();

			if (empty($eventdetails['submit_count'])) {
				$chk = $this->Attendeeslist->find('all')->where(['user_id' => $this->request->data['user_id'], 'event_id' => $id])->first();
				if ($chk) {
					$this->Flash->error(__('User already added'));
					return $this->redirect($this->referer());
				} else {
					$existuser = $this->Attendeeslist->newEntity();
					$attendeesInsert['user_id'] = $finduser->id;
					$attendeesInsert['event_id'] = $id;
					$attendeesInsert['name'] = trim($finduser['name'] . ' ' . $finduser['lname']);
					$attendeesInsert['email'] = $finduser['email'];
					$attendeesInsert['is_allowed_guest'] = $is_allowed_guest;
					$attendeesInsert['is_rsvp'] = 'N';
					$attendeesInsert['created'] = $current_datetime;
					$save = $this->Attendeeslist->patchEntity($existuser, $attendeesInsert);
					$this->Attendeeslist->save($save);
					$this->Flash->success(__('User add successfully'));
					return $this->redirect($this->referer());
				}
			}

			if (!empty($finduser)) {

				// $findcount = $this->Ticket->find('all')->where(['event_id' => $id, 'cust_id' => $finduser['id']])->count();
				$findcount = $this->Ticket->find('all')->where(['event_id' => $id, 'mobile' => $finduser['mobile']])->count();

				$findbyid = $this->Ticket->find('all')->where(['event_id' => $id, 'cust_id' => $finduser['id']])->count();

				if ($findcount == 0 && $findbyid == 0 && ($is_allowed_guest == 'Y' || $is_allowed_guest == 'N') || ($findcount == 1 && $is_allowed_guest == 'Y')) {

					if (($is_allowed_guest == 'N' && $findcount == 0 && $findbyid == 0) || ($is_allowed_guest == 'Y' && $findcount == 1 && $findbyid == 1)) {
						$loopcount = 1;
					} else if ($is_allowed_guest == 'Y' && $findcount == 0 && $findbyid == 0) {
						$loopcount = 2;
					}
					// pr($loopcount);exit;
					for ($i = 0; $i < $loopcount; $i++) {
						if ($i == 0) {
							$orderdata['user_id'] = $authId;
							$orderdata['total_amount'] = 0;
							$orderdata['paymenttype'] = "Comps";
							$orderdata['adminfee'] = $admin_user['feeassignment'];
							$orderdata['created'] = $current_datetime;
							$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);
							$saveorders = $this->Orders->save($insertdata);
						}

						$fn['user_id'] = $finduser['id'];
						$fn['event_id'] = $id;
						$fn['mpesa'] = null;
						$fn['amount'] =  0;
						$fn['created'] = $current_datetime;
						$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
						$this->Payment->save($payment);

						$ticketbook['order_id'] = $saveorders->id;
						$ticketbook['event_id'] =  $id;
						$ticketbook['event_ticket_id'] = $checkTicket['id'];
						$ticketbook['cust_id'] = $finduser['id'];
						$ticketbook['ticket_buy'] = 1;
						$ticketbook['amount'] = 0;
						$ticketbook['mobile'] =  ($finduser['mobile']) ? $finduser['mobile'] : $finduser['id'];
						$ticketbook['committee_user_id'] = $eventdetails['event_org_id'];
						$ticketbook['user_desc'] = 'Free Ticket from attendess';
						$ticketbook['adminfee'] = $admin_user['feeassignment'];
						$ticketbook['created'] = $current_datetime;
						$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
						$lastinsetid = $this->Ticket->save($insertticketbook);

						$ticketdetaildata['tid'] = $lastinsetid['id'];
						$ticketdetaildata['user_id'] = $finduser['id'];
						$ticketdetaildata['created'] = $current_datetime;
						$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
						$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

						$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
						$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
						$Packff->name = $finduser['name'] . ' ' . $finduser['lname'];
						$ticketdetail = $this->Ticketdetail->save($Packff);

						$ticketqrimages = $this->qrcodepro($finduser['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
						$Pack = $this->Ticketdetail->get($ticketdetail['id']);
						$Pack->qrcode = $ticketqrimages;
						$this->Ticketdetail->save($Pack);


						// send email to admin and event organiser 
						$eventname = ucwords(strtolower($eventdetails['name']));
						$requestername = $finduser['name'] . ' ' . $finduser['lname'];
						$url = SITE_URL . 'tickets/myticket';
						$site_url = SITE_URL;
						// $currenny_sign = $currenny['Currency'];
						$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
						$from = $emailtemplate['fromemail'];
						$to = $finduser['email'];
						// $cc = $from;
						$subject = $emailtemplate['subject'] . ': ' . $eventname;
						$formats = $emailtemplate['description'];

						$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $finduser['email'], $finduser['confirm_pass']), $formats);
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
						if ($i == 0) {
							$mail = $this->Email->send($to, $subject, $message);
						}
						// send watsappmessage start 
						$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
						$numwithcode = $finduser['mobile'];
						if ($numwithcode && $i == 0) {
							$this->whatsappmsg($numwithcode, $message);
						}
					}

					$this->Flash->success(__('Tickete assign successfully'));
					return $this->redirect($this->referer());
				} else if (($findcount == 2 && $is_allowed_guest == 'Y') || ($findbyid == 2 && $is_allowed_guest == 'Y') || ($findbyid == 1 && $is_allowed_guest == 'N') || ($findcount == 1 && $is_allowed_guest == 'N')) {
					$this->Flash->error(__('Already assign ticket'));
					return $this->redirect($this->referer());
				} else {
					$this->Flash->error(__('Already assign ticket'));
					return $this->redirect($this->referer());
				}
			} else {
				$this->Flash->error(__('Invalid User !'));
				return $this->redirect($this->referer());
			}
		}
	}

	// user register self if event is free 
	public function selfregistration($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Eventdetail');
		$this->loadModel('Countries');
		$this->loadModel('Company');
		$this->loadModel('Ticket');
		$this->loadModel('Cart');
		$this->loadModel('Payment');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Committeeassignticket');
		$this->loadModel('Currency');
		$this->loadModel('Templates');
		$this->loadModel('Orders');
		$this->loadModel('Attendeeslist');
		$this->autoRender = false;
		$current_datetime = date('Y-m-d H:i:s');
		// pr($current_datetime);exit;

		if ($this->request->is(['post', 'put'])) {
			// pr($this->request->data);
			// exit;

			$email = $this->request->data['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$this->Flash->error("{$email} is not a valid email address");
				return $this->redirect($this->referer());
			}


			$id = $this->request->data['event_id'];
			$name =  ucfirst($this->request->data['fname']);
			$lname =  ucfirst($this->request->data['lname']);
			$password = $this->request->data['password'];
			$mobile = $this->request->data['countrycode'] . $this->request->data['mobile'];

			$position = $this->request->data['position'];
			$divisions = $this->request->data['divisions'];
			$timeslot = $this->request->data['timeslot'];
			$choosedate = $this->request->data['choosedate'];

			$gender = ucfirst($this->request->data['gender']);
			$dob = date('Y-m-d', strtotime($this->request->data['dob']));
			$eventdetails = $this->Event->get($id);
			$authId = $eventdetails['event_org_id'];
			// pr($eventdetails);exit;
			if ($this->request->data['isnew'] == 'new' && empty($email) && empty($name) && empty($lname) && empty($password) && empty($gender) && empty($dob) && empty($id)) {
				$this->Flash->error(__('Please fill all required fields'));
				return $this->redirect($this->referer());
			} else if (empty($eventdetails['submit_count'])) {
				$this->Flash->error(__('Event not yet Published.'));
				return $this->redirect($this->referer());
			}

			// pr($dob);exit;

			if ($eventdetails && $eventdetails['allow_register'] == 'Y') {

				$finduser = $this->Users->find('all')->where(['email' => $email])->first();
				$checkTicket = $this->Eventdetail->find('all')->where(['eventid' => $id])->first();

				// if already exist user 
				if ($finduser) {

					//save order data
					$orderdata['user_id'] = $finduser['id'];
					$orderdata['total_amount'] = 0;
					$orderdata['paymenttype'] = "Comps";
					$orderdata['created'] = $current_datetime;
					$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);
					$saveorders = $this->Orders->save($insertdata);
					$order_id = $saveorders['id'];

					$findone = $this->Ticket->find('all')->where(['event_id' => $id, 'mobile' => $finduser['mobile']])->first();

					$findbyid = $this->Ticket->find('all')->where(['event_id' => $id, 'cust_id' => $finduser['id']])->first();

					if (empty($findone) && empty($findbyid)) {
						$fn['user_id'] = $finduser['id'];
						$fn['event_id'] = $id;
						$fn['mpesa'] = null;
						$fn['amount'] =  0;
						$fn['created'] =  $current_datetime;
						$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
						$this->Payment->save($payment);
						$ticketbook['order_id'] = $saveorders->id;
						$ticketbook['event_id'] =  $id;
						$ticketbook['event_ticket_id'] = $checkTicket['id'];
						$ticketbook['cust_id'] = $finduser['id'];
						$ticketbook['ticket_buy'] = 1;
						$ticketbook['amount'] = 0;
						$ticketbook['mobile'] =  ($finduser['mobile']) ? $finduser['mobile'] : $finduser['id'];
						$ticketbook['committee_user_id'] = $authId;
						$ticketbook['user_desc'] = 'Free Ticket by Self registration existing user';
						$ticketbook['created'] = $current_datetime;
						$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
						$lastinsetid = $this->Ticket->save($insertticketbook);

						$ticketdetaildata['tid'] = $lastinsetid['id'];
						$ticketdetaildata['user_id'] = $finduser['id'];
						$ticketdetaildata['created'] = $current_datetime;
						$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
						$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

						$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
						$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
						$Packff->name = $finduser['name'] . ' ' . $finduser['lname'];
						$Packff->is_rsvp = 'N';

						$Packff->position = $position;
						$Packff->divisions = $divisions;
						$Packff->timeslot = $timeslot;
						$Packff->choosedate = $choosedate;

						$ticketdetail = $this->Ticketdetail->save($Packff);

						$ticketqrimages = $this->qrcodepro($finduser['id'], $ticketdetail['ticket_num'], $authId);
						$Pack = $this->Ticketdetail->get($ticketdetail['id']);
						$Pack->qrcode = $ticketqrimages;
						$this->Ticketdetail->save($Pack);

						// send email to admin and event organiser 
						$eventname = ucwords(strtolower($eventdetails['name']));
						$requestername = $finduser['name'] . ' ' . $finduser['lname'];
						$url = SITE_URL . 'tickets/myticket';
						$site_url = SITE_URL;
						// $currenny_sign = $currenny['Currency'];
						$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
						$from = $emailtemplate['fromemail'];
						$to = $finduser['email'];
						// $cc = $from;
						$subject = $emailtemplate['subject'] . ': ' . $eventname;
						$formats = $emailtemplate['description'];

						$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $finduser['email'], $finduser['confirm_pass']), $formats);
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
						$mail = $this->Email->send($to, $subject, $message);

						// send watsappmessage start 
						$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
						$numwithcode = $finduser['mobile'];
						if ($numwithcode) {
							$this->whatsappmsg($numwithcode, $message);
						}
						// send watsappmessage start 
						$this->Flash->success(__('You have received a ticket for this event – You can access your ticket in the MyTickets section of the platform.'));
						return $this->redirect($this->referer());
					} else {
						$this->Flash->error(__('Oops! It looks like you have already received a ticket for this event. Please check the My Tickets section to view your ticket. Thank you!.'));
						return $this->redirect($this->referer());
					}
					//New user register and generate ticket for free event
				} else {
					// $randompass = strtoupper(strtolower(substr(md5(uniqid(rand(), true)), 10, 10)));
					$usr['name'] = $name;
					$usr['lname'] = $lname;
					$usr['email'] = $email;
					$usr['mobile'] = $mobile;
					// $usr['mobileverifynumber'] = '+' . $country_code . $mobile;
					$usr['password'] = $this->_setPassword($password);
					$usr['confirm_pass'] = $password;
					$usr['gender'] = $gender;
					$usr['dob'] = $dob;
					$usr['status'] = 'Y';
					$usr['is_suspend'] = 'N';
					$usr['is_mob_verify'] = 'N';

					$usr['created'] = $current_datetime;
					$usr['role_id'] = CUSTOMERROLE; // 3
					$atn = $this->Users->patchEntity($this->Users->newEntity(), $usr);
					$saveUsers = $this->Users->save($atn);

					//save order data
					$orderdata['user_id'] = $saveUsers['id'];
					$orderdata['total_amount'] = 0;
					$orderdata['paymenttype'] = "Comps";
					$orderdata['created'] = $current_datetime;
					$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);
					$saveorders = $this->Orders->save($insertdata);


					$fn['user_id'] = $saveUsers['id'];
					$fn['event_id'] = $id;
					$fn['mpesa'] = null;
					$fn['amount'] =  0;
					$fn['created'] = $current_datetime;
					$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
					$this->Payment->save($payment);

					$ticketbook['order_id'] = $saveorders->id;
					$ticketbook['event_id'] =  $id;
					$ticketbook['event_ticket_id'] = $checkTicket['id'];
					$ticketbook['cust_id'] = $saveUsers['id'];
					$ticketbook['ticket_buy'] = 1;
					$ticketbook['amount'] = 0;
					$ticketbook['mobile'] =  $saveUsers['mobile'];
					$ticketbook['committee_user_id'] = $authId;
					$ticketbook['user_desc'] = 'Free Ticket from self registratin new user';
					$ticketbook['created'] = $current_datetime;
					$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
					$lastinsetid = $this->Ticket->save($insertticketbook);

					$ticketdetaildata['tid'] = $lastinsetid['id'];
					$ticketdetaildata['user_id'] = $saveUsers['id'];
					$ticketdetaildata['created'] = $current_datetime;
					$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
					$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

					$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
					$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
					$Packff->name = $name . ' ' . $lname;
					$Packff->is_rsvp = 'N';

					$Packff->position = $position;
					$Packff->divisions = $divisions;
					$Packff->timeslot = $timeslot;
					$Packff->choosedate = $choosedate;

					$ticketdetail = $this->Ticketdetail->save($Packff);

					$ticketqrimages = $this->qrcodepro($saveUsers['id'], $ticketdetail['ticket_num'], $authId);
					$Pack = $this->Ticketdetail->get($ticketdetail['id']);
					$Pack->qrcode = $ticketqrimages;
					$this->Ticketdetail->save($Pack);


					// send email to admin and event organiser 
					$eventname = ucwords(strtolower($eventdetails['name']));
					$requestername = $saveUsers['name'] . ' ' . $saveUsers['lname'];
					$url = SITE_URL . 'tickets/myticket';
					$site_url = SITE_URL;
					$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
					$from = $emailtemplate['fromemail'];
					$to = $saveUsers['email'];
					// $cc = $from;
					$subject = $emailtemplate['subject'] . ': ' . $eventname;
					$formats = $emailtemplate['description'];

					$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $saveUsers['email'], $saveUsers['confirm_pass']), $formats);
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
					$mail = $this->Email->send($to, $subject, $message);

					// send watsappmessage start 
					$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
					$numwithcode = $mobile;
					$this->whatsappmsg($numwithcode, $message);
					// send watsappmessage start 

					$this->Flash->success(__('You have received a ticket for this event – You can access your ticket in the MyTickets section of the platform.'));
					return $this->redirect($this->referer());
				}
				$checkOrderid = $this->Ticket->find('all')->where(['order_id' => $saveorders['id']])->first();
				if (empty($checkOrderid)) {
					$this->Orders->deleteAll(['Orders.id' =>  $saveorders['id']]);
				}
			} else {
				$this->Flash->error(__('This Event not allow to self Registration feature'));
				return $this->redirect($this->referer());
			}
		}
	}

	//import attendees previous event search based
	public function importprattendees($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Orders');
		$this->loadModel('Payment');
		$this->loadModel('Currency');
		$this->loadModel('Eventdetail');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Templates');
		$this->loadModel('Attendeeslist');
		$this->autoRender = false;


		$authId = $this->request->session()->read('Auth.User.id');
		$current_datetime = date('Y-m-d H:i:s');
		$admin_user = $this->Users->find('all')->where(['role_id' => 1])->first();

		if ($this->request->is(['post', 'put'])) {
			// pr($this->request->data);
			// die;
			// $findeventid = $this->request->data['import_event_id'];
			if ($this->request->data['import_event_id']) {
				$eventdetails = $this->Event->get($this->request->data['import_event_id']);
			} elseif ($this->request->data['event_name']) {
				$eventdetails = $this->Event->find('all')->where(['name' => $this->request->data['event_name']])->first();
			}
			$chechevent = $this->Event->get($id);

			if ($chechevent['submit_count'] == '') {
				$getUsers = $this->Ticket->find('all')->contain(['Users'])->where(['event_id' => $eventdetails['id']])->toarray();
				// pr($getUsers);exit;
				foreach ($getUsers as $key => $value2) {
					// pr($value2);exit;
					$chk = $this->Attendeeslist->find('all')->where(['mobile' => $value2['user']['mobile'], 'event_id' => $id])->first();
					if ($chk) {
						continue;
					} else {
						$attendeesInsert['name'] = $value2['user']['name'] . ' ' . $value2['user']['lname'];
						$attendeesInsert['email'] = $value2['user']['email'];
						$attendeesInsert['mobile'] = $value2['user']['mobile'];
						$attendeesInsert['event_id'] = $id;
						$attendeesInsert['user_id'] = $value2->cust_id;
						$attendeesInsert['created'] = $current_datetime;
						$save = $this->Attendeeslist->patchEntity($this->Attendeeslist->newEntity(), $attendeesInsert);
						$this->Attendeeslist->save($save);
					}
				}
				$this->Flash->success(__('Attendees imported successfully'));
				return $this->redirect($this->referer());
			} else {
				if ($eventdetails) {

					$getUsers = $this->Ticket->find('all')->contain(['Users'])->where(['event_id' => $eventdetails['id']])->toarray();
					// pr($getUsers);exit;
					if ($getUsers) {
						$checkTicket = $this->Eventdetail->find('all')->where(['eventid' => $chechevent['id']])->first();
						foreach ($getUsers as $key => $value) {

							if ($key == 0) {
								$orderdata['user_id'] = $authId;
								$orderdata['total_amount'] = 0;
								$orderdata['paymenttype'] = "Comps";
								$orderdata['created'] = $current_datetime;
								$orderdata['adminfee'] = $admin_user['feeassignment'];
								$insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);
								$saveorders = $this->Orders->save($insertdata);
							}

							$order_id = $saveorders['id'];

							$findone = $this->Ticket->find('all')->where(['event_id' => $id, 'mobile' => $value['user']['mobile']])->first();

							$findbyid = $this->Ticket->find('all')->where(['event_id' => $id, 'cust_id' => $value['id']])->first();


							if (empty($findone) && empty($findbyid)) {
								$fn['user_id'] = $value['user']['id'];
								$fn['event_id'] = $id;
								$fn['mpesa'] = null;
								$fn['amount'] =  0;
								$fn['created'] = $current_datetime;
								$payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
								$ok = $this->Payment->save($payment);

								$ticketbook['order_id'] = $order_id;
								$ticketbook['event_id'] =  $id;
								$ticketbook['event_ticket_id'] = $checkTicket['id'];
								$ticketbook['cust_id'] = $value['user']['id'];
								$ticketbook['ticket_buy'] = 1;
								$ticketbook['amount'] = 0;
								$ticketbook['mobile'] =  ($value['user']['mobile']) ? $value['user']['mobile'] : $value['user']['id'];
								$ticketbook['committee_user_id'] = $chechevent['event_org_id'];
								$ticketbook['user_desc'] = 'Free Ticket from importprattendees';
								$ticketbook['created'] = $current_datetime;
								$ticketbook['adminfee'] = $admin_user['feeassignment'];
								$insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
								$lastinsetid = $this->Ticket->save($insertticketbook);

								$ticketdetaildata['tid'] = $lastinsetid['id'];
								$ticketdetaildata['user_id'] = $value['user']['id'];
								$ticketdetaildata['created'] = $current_datetime;
								$ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
								$ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

								$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
								$Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
								$Packff->name = $value['user']['name'] . ' ' . $value['user']['lname'];
								$ticketdetail = $this->Ticketdetail->save($Packff);

								$ticketqrimages = $this->qrcodepro($value['user']['id'], $ticketdetail['ticket_num'], $chechevent['event_org_id']);
								$Pack = $this->Ticketdetail->get($ticketdetail['id']);
								$Pack->qrcode = $ticketqrimages;
								$this->Ticketdetail->save($Pack);


								// send email to admin and event organiser 
								$eventname = ucwords(strtolower($chechevent['name']));
								$requestername = $value['user']['name'] . ' ' . $value['user']['lname'];
								$url = SITE_URL . 'tickets/myticket';
								$site_url = SITE_URL;
								// $currenny_sign = $currenny['Currency'];
								$emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 31])->first();
								$from = $emailtemplate['fromemail'];
								$to = $value['user']['email'];
								// $cc = $from;
								$subject = $emailtemplate['subject'] . ': ' . $eventname;
								$formats = $emailtemplate['description'];

								$message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{Email}', '{Password}'), array($eventname, $requestername, $url, $site_url, $value['user']['email'], $value['user']['confirm_pass']), $formats);
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
								$mail = $this->Email->send($to, $subject, $message);

								// send watsappmessage start 
								$message = "*Eboxtickets: Event Invitation*%0AHello $requestername,%0A%0AYou have received an Invitation to attend *$eventname* Event. This ticket is FREE.%0A%0AKindly download the eboxtickets App to access your ticket.%0A%0ARegards,%0AEboxtickets.com";
								$numwithcode = $finduser['mobile'];
								if ($numwithcode) {
									$numwithcode = $value['user']['mobile'];
									$this->whatsappmsg($numwithcode, $message);
								}
								// send watsappmessage start 
							}
						}
						$checkOrderid = $this->Ticket->find('all')->where(['order_id' => $order_id])->first();
						if (empty($checkOrderid)) {
							$this->Orders->deleteAll(['Orders.id' =>  $order_id]);
						}
						$this->Flash->success(__('Attendees imported successfully'));
						return $this->redirect($this->referer());
					} else {
						$this->Flash->error(__('No invitation found on this event !!'));
						return $this->redirect($this->referer());
					}
				} else {
					$this->Flash->error(__('Event not found'));
					return $this->redirect($this->referer());
				}
			}
		}
	}

	// /Serach attendees 
	public function attendeessearch($id = null)
	{
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Eventdetail');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Attendeeslist');

		$rsvp = $this->request->data['fetch']; // Y,N
		$eventid = $this->request->data['eventid'];
		$eventdet = $this->Event->get($eventid);

		if (empty($eventdet['submit_count'])) {
			if (!empty($rsvp)) {
				$getUsers = $this->Attendeeslist->find('all')->contain(['Users'])->where(['Attendeeslist.event_id' => $eventid, 'Attendeeslist.is_rsvp' => $rsvp])->order(['Attendeeslist.id' => 'DESC']);
			} else {
				$getUsers = $this->Attendeeslist->find('all')->contain(['Users'])->where(['Attendeeslist.event_id' => $eventid])->order(['Attendeeslist.id' => 'DESC']);
			}
		} else if (empty($rsvp)) {
			$getUsers = $this->Ticketdetail->find('all')->contain(['Users', 'Ticket'])->where(['Ticket.event_id' => $eventid])->group(['Users.id'])->order(['Ticket.id' => 'DESC']);

			// $getUsers = $this->Ticket->find('all')->contain(['Users', 'Ticketdetail'])->where(['Ticket.event_id' => $eventid])->group(['Users.id'])->order(['Ticket.id' => 'DESC']);

		} else {
			$getUsers = $this->Ticketdetail->find('all')->contain(['Users', 'Ticket'])->where(['Ticket.event_id' => $eventid, 'Ticketdetail.is_rsvp' => $rsvp])->group(['Users.id'])->order(['Ticket.id' => 'DESC']);

			// $getUsers = $this->Ticket->find('all')->contain(['Users', 'Ticketdetail'])->where(['Ticket.event_id' => $eventid,'Ticketdetail.is_rsvp' => $rsvp])->group(['Users.id'])->order(['Ticket.id' => 'DESC']);
		}
		$search = $this->paginate($getUsers)->toarray();
		// pr($search);exit;
		if ($search) {
			$this->set('getUsers', $search);
		}
		$this->set('id', $eventid);
	}

	public function exportticketsdata($id = null)
	{
		$this->loadModel('Eventdetail');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Event');
		$this->set('id', $id);

		if ($this->request->is(['post', 'put'])) {
			// $this->dd($this->request->data);

			if ($this->request->data['scanticket'] == "no") {
				$scanticket_status = 2;
			} else if ($this->request->data['scanticket'] == "yes") {
				$scanticket_status = 1;
			} else {
				$scanticket_status = '';
			}
			$ticket_type = $this->request->data['tickets'];
			$event_id = $this->request->data['event_id'];

			$cond = [];
			$session = $this->request->session();
			$session->delete('cond');


			if (!empty($ticket_type)) {
				$cond['Ticket.event_ticket_id IN'] = $ticket_type;
			}
			//echo $scanticket_status; //die;
			if (!empty($scanticket_status)) {
				if ($scanticket_status == 2) {
					$cond['Ticketdetail.status'] = 0;
				} else {
					$cond['Ticketdetail.status'] = $scanticket_status;
				}
			}

			if (!empty($event_id)) {
				$cond['Ticket.event_id'] = $event_id;
			}
			//pr($cond); die;
			$session = $this->request->session();
			$session->write('cond', $cond);


			$event_data = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
			$this->set('event_data', $event_data);

			$alltickets = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id])->toarray();
			//pr($alltickets); die;

			$ticket_data = $this->Ticketdetail->find('all')->where([$cond])->contain(['Users', 'Ticket' => ['Event', 'Eventdetail', 'Orders']])->toarray();
			$this->set('ticket_data', $ticket_data);

			$this->set('alltickets', $alltickets);
		}
	}

	public function exportticketcsv($id = null)
	{
		$this->loadModel('Ticketdetail');
		$this->loadModel('Event');
		$this->loadModel('Eventdetail');
		$session = $this->request->session();
		$event = $session->read('cond');
		// pr($event);exit;


		$event_data = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
		$this->set('event_data', $event_data);

		$alltickets = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $id])->toarray();
		$this->set('alltickets', $alltickets);


		$export_date = date('Y-m-d h:i');
		$this->set('export_date', $export_date);

		if ($event) {
			$ticket_data = $this->Ticketdetail->find('all')->where([$event])->contain(['Users', 'Ticket' => ['Event', 'Eventdetail', 'Orders']])->toarray();
		} else {
			$ticket_data = $this->Ticketdetail->find('all')->where(['Ticket.event_id' => $id])->contain(['Users', 'Ticket' => ['Event', 'Eventdetail', 'Orders']])->toarray();
		}

		$this->set('ticket_data', $ticket_data);
	}


	// public function usersmanager($id = null)
	// {
	// 	$this->loadModel('Users');
	// 	$this->loadModel('Roles');
	// 	$this->loadModel('CommitteeGroup');
	// 	$this->loadModel('Event');
	// 	$this->loadModel('Eventdetail');
	// 	$this->loadModel('Committeeassignticket');

	// 	$allUsers = $this->Roles->find('all')->contain(['Users'])->where(['Roles.event_id' => $id])->toarray();

	// 	$this->set(compact('allUsers', 'id', 'event_id'));
	// 	if ($this->request->is(['post', 'put'])) {
	// 		// pr($_POST);exit;				
	// 		if ($this->request->data['user_id'] && $this->request->data['email']) {
	// 			$find = $this->Users->get($this->request->data['user_id']);
	// 			if ($find) {
	// 				$fn['user_id'] = $this->request->data['user_id'];
	// 				$fn['event_id'] =  $id;
	// 				$user_add = $this->Roles->patchEntity($this->Roles->newEntity(), $fn);
	// 				$this->Roles->save($user_add);
	// 				$this->Flash->success(__('User has been added successfully'));
	// 				return $this->redirect($this->referer());
	// 			}
	// 		} else {
	// 			$find = $this->Roles->get($this->request->data['user_id']);
	// 			$this->Roles->deleteAll(['Roles.id' => $find['id']]);
	// 			$this->Flash->success(__('User has been deleted successfully'));
	// 			return $this->redirect($this->referer());
	// 		}
	// 	}
	// }
	// public function roles($id)
	// {
	// 	$this->set('id', $id);
	// }
}
