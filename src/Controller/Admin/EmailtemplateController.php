<?php

namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

class EmailtemplateController extends AppController

{
	public function index()
	{
		$this->viewBuilder()->layout('admin');
		$this->loadModel('Templates');

		$emailtemplate = $this->Templates->find('all')->order(['Templates.subject' => 'ASC']);
		$this->set('emailtemplate', $this->paginate($emailtemplate)->toarray());
	}



	public function status($id = null, $status = null)
	{

		$this->loadModel('Templates');
		if (isset($id) && !empty($id)) {
			$product = $this->Templates->get($id);
			$product->status = $status;
			if ($this->Templates->save($product)) {
				$this->Flash->success(__('Emailtemplate status has been updated.'));
				return $this->redirect(['action' => 'index']);
			}
		}
	}

	public function edit($id = null)
	{

		$this->viewBuilder()->layout('admin');
		$this->loadModel('Templates');
		$newpack = $this->Templates->get($id);
		$this->set('newpack', $newpack);

		if ($this->request->is(['post', 'put'])) {
			// pr($this->request->data);die;
			$title = $this->request->data['title'];
			$savepack = $this->Templates->patchEntity($newpack, $this->request->data);
			$results = $this->Templates->save($savepack);
			if ($results) {
				$this->Flash->success(__($title . ' Emailtemplate has been updated successfully.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Emailtemplate not updated'));
				return $this->redirect(['action' => 'edit']);
			}
		}
	}

	public function viewtemplate($id = null)
	{
		$this->loadModel('Templates');
		$popupdata = $this->Templates->find('all')->where(['Templates.id' => $id])->first();
		$this->set('popupdata', $popupdata);
	}

	public function add()
	{
		$this->viewBuilder()->layout('admin');
		$this->loadModel('Templates');

		if ($this->request->is(['post', 'put'])) {
			$new_template = $this->Templates->newEntity();
			$savepack = $this->Templates->patchEntity($new_template, $this->request->data);
			$results = $this->Templates->save($savepack);
			if ($results) {
				$this->Flash->success(__($title.' Emailtemplate has add successfully.'));
				return $this->redirect(['action' => 'index']);
				// return $this->redirect($this->referer());
			} else {
				$this->Flash->error(__('Emailtemplate not add'));
				// return $this->redirect(['action' => 'edit']);
				return $this->redirect($this->referer());
			}
		}
	}
}
