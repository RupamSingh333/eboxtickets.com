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
include '../vendor/PHPExcel/Classes/PHPExcel.php';
include '../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';
class ReportsController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadModel('Users');
		$this->loadComponent('Email');
		$this->Auth->allow(['resetImei']);
	}



    public function ticketreports($id = null)
    {
		$this->loadModel('Ticketdetail');
		$this->loadModel('Ticketreport');
        $this->set('id', $id);

		$ticket_data = $this->Ticketreport->find('all')->order(['id'=>'desc'])->toarray();
		$this->set('ticket_data', $ticket_data);
    }


	public function exportreport($id = null)
    {

		$this->loadModel('Ticketreport');
		$this->loadModel('Ticket');
		$this->set('id', $id);
		if ($this->request->is('post')) {
			$ticket_report = $this->Ticketreport->newEntity();

			$ticket_report_data['title'] = $this->request->data['title'];
			$ticket_report_data['export_date'] = date('Y-m-d H:i:s');
			$ticket_report_data['update_date'] = date('Y-m-d H:i:s');

			$ticket_report_save = $this->Ticketreport->patchEntity($ticket_report, $ticket_report_data);
			// pr($organiser);exit;
			$res = $this->Ticketreport->save($ticket_report_save);
			if ($res) {	
				$this->Flash->success(__('Report Export Successfully !!'));
				return $this->redirect(SITE_URL . 'reports/ticketreports/'.$this->request->data['id']);
			}else{
				$this->Flash->success(__('Something went wrong !!'));
				return $this->redirect(SITE_URL . 'reports/ticketreports/'.$this->request->data['id']);
			}

    }
    }

	public function exporttickets($id = null,$event_id = null)
    {
		$this->loadModel('Ticketdetail');
		$this->loadModel('Ticketreport');
		$ticketreport_first = $this->Ticketreport->get($id);

	
		$export_date = date('Y-m-d ',strtotime($ticketreport_first['export_date']));
		

		$ticket_data = $this->Ticketdetail->find('all')->where(['Ticketdetail.created <=' =>$export_date,'Ticket.event_id'=>$event_id])->contain(['Users','Ticket' => ['Event','Eventdetail','Orders']])->toarray();
		//pr($ticket_data); die;
		// $ticket_data = $this->Ticketdetail->find('all')->order(['id'=>'desc'])->toarray();
		$this->set('export_date', $export_date);
		$this->set('ticket_data', $ticket_data);
    }


	public function importtickets($id = null)
    {
		$this->loadModel('Ticketreport');
        $this->set('id', $id);
	
}

}