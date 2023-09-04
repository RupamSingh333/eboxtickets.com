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

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
include(ROOT . DS . "vendor" . DS  . "phpqrcode" . DS . "qrlib.php");

class CalendarController extends AppController
{



    public  function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }


    public function beforeFilter(Event $event)
    {

        $this->Auth->allow(['index','selectdate','eventcheck']);
    }
    public function index($id=null)
    {
        
		$this->loadModel('Event');
		$this->loadModel('Users');
		$this->loadModel('Countries');
		$date = date("Y-m-d H:i:s");
        $this->set('event', $date);
        
    }

    public function selectdate()
    {
        $this->loadModel('Event');
        $date = date('Y-m-d', strtotime($this->request->data['selecteddate']));
      
        $upcoming_event = $this->Event->find('all')->contain(['Countries'])->where(['DATE(Event.date_from)' => $date,'Event.status'=>'Y','Event.admineventstatus' => 'Y'])->order(['Event.date_to' => 'ASC'])->toarray();

       $this->set('event', $upcoming_event);


    }


    public function eventcheck()
    {
        $this->loadModel('Event');
        $date = date('Y-m-d', strtotime($this->request->data['selecteddate']));
      
        $upcoming_event = $this->Event->find('all')->contain(['Countries'])->where(['DATE(Event.date_from)' => $date,'Event.status'=>'Y','Event.admineventstatus' => 'Y'])->order(['Event.date_to' => 'ASC'])->toarray();
        if(!empty($upcoming_event)){
            echo 1; die;
        }else{
            echo 0; die;
        }
    }
}
