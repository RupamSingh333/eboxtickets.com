<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\View\Exception\MissingTemplateException;


class TicketController extends AppController
{

	//$this->loadcomponent('Session');
	public function initialize()
	{
		//load all models
		parent::initialize();
	}

	public function index()
	{
		$session = $this->request->session();
		$session->delete('cond');
		$this->loadModel('Ticket');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Users');
		$this->viewBuilder()->layout('admin');
		$this->paginate = [
			'limit' => 50 // Set the pagination limit here
		];
		$admin_info = $this->Users->get(1);
		$ticket = $this->Ticketdetail->find('all')->contain(['Users', 'Ticket' => 'Event'])->order(['Ticket.id' => 'DESC']);
		$ticket = $this->paginate($ticket)->toarray();
		// pr($ticket);die;
		$this->set('admin_info', $admin_info);
		$this->set('ticket', $ticket);
	}

	public function search()
	{
		// $this->autoRender = false;
		$this->loadModel('Ticket');
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Ticketdetail');
		$admin_info = $this->Users->get(1);
		// pr($this->request->data);
		// die;
		$this->set('admin_info', $admin_info);

		$this->paginate = [
			'limit' => 50 // Set the pagination limit here
		];

		$req_data = $this->request->data;
		$customername = trim($req_data['customername']);
		$eventname = trim($req_data['eventname']);
		$customermobile = $req_data['customermobile'];
		$organiser_id = $req_data['organiser_id'];
		$datefrom = $req_data['date_from'];
		$dateto = $req_data['date_to'];
		$ticket_number = trim($req_data['ticket_number']);

		// pr($req_data);exit;

		$cond = [];
		$session = $this->request->session();
		$session->delete('cond');

		if (!empty($customername)) {
			$cond['Users.name LIKE'] = '%' . $customername . '%';
		}
		if (!empty($eventname)) {
			$cond['Event.name LIKE'] = '%' . $eventname . '%';
			$this->set('eventname', $eventname);
		}

		if (!empty($customermobile)) {
			$cond['Users.mobile LIKE'] = '%' . $customermobile . '%';
			$this->set('customermobile', $customermobile);
		}

		if (!empty($ticket_number)) {
			$cond['Ticketdetail.ticket_num'] = $ticket_number;
			$this->set('ticket_number', $ticket_number);
		}

		if (!empty($organiser_id)) {
			$cond['Event.event_org_id'] = $organiser_id;
			$this->set('organiser_id', $organiser_id);

		}

		if (!empty($datefrom)) {
			$cond['DATE(Ticket.created) >='] = date('Y-m-d', strtotime($datefrom));
		}
		if (!empty($dateto)) {
			$cond['DATE(Ticket.created) <='] = date('Y-m-d', strtotime($dateto));
		}


		$session = $this->request->session();
		$session->write('cond', $cond);
		// pr($cond);die;
		// $users_data = $this->Ticket->find('all')->contain(['Users', 'Event'])->where([$cond])->order(['Ticket.id' => 'DESC']);
		$ticket_data = $this->Ticketdetail->find('all')->contain(['Users', 'Ticket' => 'Event'])->where([$cond])->order(['Ticket.id' => 'DESC']);
		$ticket_data = $this->paginate($ticket_data)->toarray();
		$this->set('users_search', $ticket_data);
	}

	public function export()
	{
		$this->loadModel('Ticket');
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Ticketdetail');

		$this->viewBuilder()->layout('admin');
		$session = $this->request->session();
		$ticket = $session->read('cond');
		$admin_info = $this->Users->get(1);
		// pr($ticket);die;
		$order = $this->Ticketdetail->find('all')->contain(['Users', 'Ticket' => 'Event'])->where([$ticket])->limit(1000)->order(['Ticket.id' => 'DESC'])->toarray();
		// $order = $this->paginate($order)->toarray();
		// pr($order);die;

		// $order = $this->Ticket->find('all')->contain(['Users', 'Event'])->where([$ticket])->order(['Ticket.id' => 'DESC'])->toarray();
		//$order = $this->Ticket->find('all')->contain(['Users','Event'])->where([$ticket])->order(['Ticket.id' => 'DESC'])->toarray();
		//pr($order);die;
		$output = "";
		$output .= 'Buy Date & Time,';
		$output .= 'Ticket No.,';
		$output .= 'Event Name,';
		$output .= 'Event Date & Time,';
		$output .= 'Customer Name,';
		$output .= 'Mobile,';
		$output .= 'Buy Ticket,';
		$output .= 'Amount,';
		$output .= 'Commission(' . $admin_info['feeassignment'] . '%),';
		// $output .= 'Grand Total,';
		$output .= "\n";

		$total_amount = 0;
		$total_commission = 0;


		foreach ($order as $value) {
			$amount = $value['ticket']['amount'];
			$commission = $amount * $admin_info['feeassignment'] / 100;
			$total_amount += $amount;
			$total_commission += $commission;

			$output .= date('d M Y h:i A', strtotime($value['ticket']['created'])) . ",";
			$output .= $value['ticket_num'] . ",";
			$output .= ucfirst($value['ticket']['event']['name']) . ",";
			$output .= date('d M Y h:i A', strtotime($value['ticket']['event']['date_from'])) . ",";
			$output .= ucwords($value['user']['name']) . ' ' . ucwords($value['user']['lname']) . ",";
			$output .= $value['user']['mobile'] . ",";
			$output .= $value['ticket']['ticket_buy'] . ",";
			$output .= "$" . $amount . " TTD" . ",";
			$output .= "$" . $commission . " TTD" . ",";
			// $output .= "$" . number_format($amount + $commission, 2) . " TTD" . ",";
			$output .= "\r\n";
		}

		$output .= "Total,";
		$output .= ",";
		$output .= ",";
		$output .= ",";
		$output .= ",";
		$output .= ",";
		$output .= ",";
		$output .= "$" . $total_amount . ",";
		$output .= "$" . $total_commission . ",";
		// $output .= "$" . number_format($total_amount + $total_commission, 2) . " TTD" . ",";
		$output .= "\r\n";

		$filename = "Ticket_" . date('d-m-Y') . ".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename=' . $filename);
		echo $output;
		die;
		$session = $this->request->session();
		$this->Session->delete('cond');
		$this->redirect($this->referer());
	}

	//Event name keyword search in fee report
	public function loction()
	{
		$this->loadModel('Event');
		$stsearch = $this->request->data['fetch'];
		//pr($stsearch);die;
		$i = $this->request->data['i'];
		$usest = array('Event.name LIKE' => $stsearch . '%', 'Event.status' => 'Y');
		$searchst = $this->Event->find('all', array('conditions' => $usest));
		foreach ($searchst as $value) {
			echo '<li onclick="cllbck(' . "'" . $value['name'] . "'" . ',' . "'" . $value['id'] . "'" . ',' . "'" . $i . "'" . ')"><a href="#">' . $value['name'] . '</a></li>';
		}

		die;
	}

	/*

		student name keyword search in fee report
		public function loctionFilter(){

		$this->loadModel('Payment');
		$this->loadModel('Students');
		$stsearch=$this->request->data['fetch'];
		$i=$this->request->data['i'];
		$usest=array('Students.name LIKE'=>$stsearch.'%','Students.status'=>'Y');
		$searchst=$this->Students->find('all',array('conditions'=>$usest));
		foreach($searchst as $value){
		echo '<li onclick="cllbck('."'".$value['name']."'".','."'".$value['id']."'".','."'".$i."'".')"><a href="#">'.$value['name'].'</a></li>';
		}

		die;
		}

		*/
}
