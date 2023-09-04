<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\PaginatorHelper;
use Cake\View\Exception\MissingTemplateException;


class ContactUsController extends AppController
{

    //$this->loadcomponent('Session');
    public function initialize()
    {
        //load all models
        parent::initialize();
    }

    public function index()
    {
        $this->loadModel('Contactus');
        $this->viewBuilder()->layout('admin');
        $contactusDetails = $this->Contactus->find('all')->order(['Contactus.id' => 'DESC']);
        //pr($event_org);die;
        $this->set('contactusDetails', $this->paginate($contactusDetails));
    }
}
