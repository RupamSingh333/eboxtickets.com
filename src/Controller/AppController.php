<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Core\Configure;
use Cake\View\Helper;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use MyClass\MyClass;
use MyClass\Exception;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    // public function initialize()
    // {
    //     parent::initialize();

    //     $this->loadComponent('RequestHandler');
    //     $this->loadComponent('Flash');
    //     $this->set('BASE_URL', Configure::read('BASE_URL'));
    //     $this->loadComponent('Auth', [
    //         'authenticate' => [
    //             'Form' => [
    //                 'fields' => ['username' => 'email', 'password' => 'password']
    //             ]
    //         ],

    //     ]);

    //     /*
    //      * Enable the following components for recommended CakePHP security settings.
    //      * see http://book.cakephp.org/3.0/en/controllers/components/security.html
    //      */
    //     //$this->loadComponent('Security');
    //     //$this->loadComponent('Csrf');
    // }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['whatsappmobileverify', 'whatsappmsg']);
    }
    public $paginate = ['limit' => 10];
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        // $this->loadComponent('Csrf');
        $this->loadComponent('Flash');
        $this->set('BASE_URL', Configure::read('BASE_URL'));

        // if ($this->request->data['email'] && $this->request->data['password']) {

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password'],
                ],
            ],

        ]);
        // } 

        // else {
        //     $this->loadComponent('Auth', [
        //         'authenticate' => [
        //             'Form' => [
        //                 'fields' => ['username' => 'mobile', 'password' => 'password'],
        //             ],
        //         ],

        //     ]);
        // }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {

        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] = "admin") {
        }

        if (
            !array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function qrcodepro($user_id, $name, $event_org_id)
    {
        $dirname = 'temp';
        $PNG_TEMP_DIR = WWW_ROOT . 'qrimages' . DS . $dirname . DS;
        //$PNG_WEB_DIR = 'temp/';
        // pr($PNG_TEMP_DIR);die;
        if (!file_exists($PNG_TEMP_DIR))
            mkdir($PNG_TEMP_DIR);
        $filename = $PNG_TEMP_DIR . 'EBX.png';
        $name = $user_id . "," . $name . "," . $event_org_id;
        $errorCorrectionLevel = 'M';
        $matrixPointSize = 4;

        $filename = $PNG_TEMP_DIR . 'EBX' . md5($name . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
        \QRcode::png($name, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        //display generated file
        $qrimagename = basename($filename);
        return $qrimagename;
    }

    public function dd($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    

    public function whatsappmsg($to = null, $message = null)
    {
        //$to = "7742102027";
        $instance_id = 'instance18306';
        $token = 't7vzx58iaz7tw3qy';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/$instance_id/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "token=$token&to=$to&body=$message&priority=10&referenceId=",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //   echo "cURL Error #:" . $err; //die;
        } else {
            //echo $response; //die;
        }
    }
}