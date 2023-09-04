<?php

namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Core\Configure; 
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\PaginatorHelper;
use Cake\View\Exception\MissingTemplateException;


class CustomerController extends AppController
{

	//$this->loadcomponent('Session');
	public function initialize(){	
		//load all models
		parent::initialize();
	}

	public function index(){ 
		$this->loadModel('Users');
	$this->viewBuilder()->layout('admin');
    $ticketcustomer= $this->Users->find('all')->where(['Users.role_id' =>CUSTOMERROLE])->order(['Users.id' => 'DESC']);
    //pr($event_org);die;
    $this->set('ticketcustomer', $this->paginate($ticketcustomer));
   // $this->set('ticketcustomer', $ticketcustomer);
	}

	public function add(){ 
	}
		

//function for delete Event organiser 
public function delete($id=null)
    {
    	$this->loadModel('Users');
    	$this->loadModel('Ticket'); 
		$customer_data = $this->Users->get($id);
		$ticketTable = TableRegistry::get('Ticket');
		$exists = $ticketTable->exists(['cust_id' => $customer_data['id']]);
		if($exists){
			$this->Flash->error(__(''.ucwords($customer_data['name']).' has not been deleted because customer have entry in some Manager'));
		return $this->redirect(['action' => 'index']);
		}else{
	   if ($this->Users->delete($customer_data)) {
		$this->Flash->success(__(''.ucwords($customer_data['name']).' has been deleted Successfully.'));
		return $this->redirect(['action' => 'index']);
	    }
	}

    }


    public function status($id,$status){
		$this->loadModel('Users'); 
		//pr($status);die;
		if(isset($id) && !empty($id)){
		if($status =='N' ){
			
				$status = 'Y';
			//status update
				$ticketcustomer = $this->Users->get($id);
				$ticketcustomer->status = $status;
				//pr($event_org);die;
				if ($this->Users->save($ticketcustomer)) {
					$this->Flash->success(__(''.ucwords($ticketcustomer['name']).' status has been updated.'));
					return $this->redirect(['action' => 'index']);	
				}
		}else{
			
				$status = 'N';
			//status update
			$ticketcustomer = $this->Users->get($id);
			$ticketcustomer->status = $status;
			//pr($event_org);die;
			if ($this->Users->save($ticketcustomer)) {
				$this->Flash->success(__(''.ucwords($ticketcustomer['name']).' status has been updated.'));
				return $this->redirect(['action' => 'index']);	
			}
			
			
		}

	}
		
	}
	

		
}
