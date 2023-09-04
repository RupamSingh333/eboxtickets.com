<?php

namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Core\Configure; 
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;


class StaticController extends AppController
{

  // for view or index page

	public function index(){ 
	$this->loadModel('Static');
	$this->viewBuilder()->layout('admin');
    $static = $this->Static->find('all')->order(['Static.id' => 'DESC'])->toarray();
    //pr($companies);die;
    $this->set('static', $static);
	}
	

	public function add(){ 
		//echo "test";die;
		$this->loadModel('Static');
		$this->viewBuilder()->layout('admin');
		$static = $this->Static->newEntity();
		$this->request->data['title']=ucwords($this->request->data['title']);
		if ($this->request->is(['post', 'put'])) {
			//pr($this->request->data);die;
			
			$static = $this->Static->patchEntity($static, $this->request->data);
    	
			if ($static=$this->Static->save($static)) {
				$this->Flash->success(__(''.ucwords($static['title']).' page has been saved.'));
			return $this->redirect(['action' => 'index']);	
			}
		}
	}

	public function edit($id=null){ 
		//echo "test";die;
		//pr($id);die;
		$this->loadModel('Static');
		$this->viewBuilder()->layout('admin');
		$static = $this->Static->get($id);
		$this->set('static', $static);
		$this->request->data['title']=ucwords($this->request->data['title']);
		if ($this->request->is(['post', 'put'])) {
			//pr($this->request->data);die;
				$static = $this->Static->patchEntity($static, $this->request->data);
				if ($static=$this->Static->save($static)) {
				$this->Flash->success(__(''.ucwords($static['title']).' page has been saved.'));
				return $this->redirect(['action' => 'index']);	
			}
		}
	}
	

		public function delete($id=null)
    {
    	$this->loadModel('Static'); 
		$static = $this->Static->get($id);
		//delete pariticular entry
	    if ($this->Static->delete($static)) {
		$this->Flash->success(__(''.ucwords($static['title']).' page has been deleted successfully.'));
		return $this->redirect(['action' => 'index']);
	    }

    }


	public function rack_info(){ 
		//echo "test";die;
	
	}
 }
