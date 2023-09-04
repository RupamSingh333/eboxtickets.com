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

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    public function beforeFilter()
    {

        $this->Auth->allow(['home', 'aboutus', 'coursepage', 'termsAndConditions', 'refund', 'privacyPolicy', 'cookiePolicy', 'deliveryPolicy', 'Branding','dashboardapi']);
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
    public function organizerdashboardapi()
    {

        $this->autoRender = false;
    
        $this->loadModel('Eventdetail');
        $this->loadModel('Committeeassignticket');
        $this->loadModel('Ticket');

		if ($this->request->is(['post', 'put'])) {

        $user_id = $_REQUEST['userId'];            
        $event_id = $_REQUEST['eventId'];            
                
        $totalopen_sales_ticket = $this->Eventdetail->find('all')->select(['sum' => 'SUM(Eventdetail.count)'])->where(['Eventdetail.eventid' => $event_id])->first();

        $totalcommitee_sales_ticket = $this->Committeeassignticket->find('all')->select(['sum' => 'SUM(Committeeassignticket.count)'])->where(['Committeeassignticket.event_id' => $event_id])->first();
        
        $totalcommitee_sales_ticket = $this->Committeeassignticket->find('all')->select(['sum' => 'SUM(Committeeassignticket.count)'])->where(['Committeeassignticket.event_id' => $event_id])->first();

        $totalticket = $totalopen_sales_ticket['sum'] + $totalcommitee_sales_ticket['sum'];
        if($totalticket){
            $totalticket_count = $totalticket;
        }else{
            $totalticket_count = 0;
        }
       
        $totalticket_sold = $this->Ticket->find('all')->select(['sum' => 'SUM(Ticket.ticket_buy)'])->where(['Ticket.event_id' => $event_id])->first();

        if($totalticket_sold['sum']){
            $totalticketsold_count = $totalticket_sold['sum'];
        }else{
            $totalticketsold_count = 0;
        }


        $totalticket_sold_revenue = $this->Ticket->find('all')->select(['sumamount' => 'SUM(Ticket.amount)'])->where(['Ticket.event_id' => $event_id])->first();
        //pr($totalticket_sold_revenue);
        if($totalticket_sold_revenue['sumamount']){
            $totalticketrevenue_count = $totalticket_sold_revenue['sumamount'];
        }else{
            $totalticketrevenue_count = 0;
        }   

       
        //pr($totalticket_payment_online); die;

        //$payment_method =[];

        $totalticket_payment_online = $this->Ticket->find('all')->contain(['Orders'])->select(['onlineamount' => 'SUM(Ticket.amount)'])->where(['Ticket.event_id' => $event_id,'Orders.paymenttype'=>'Online'])->first();

        if($totalticket_payment_online['onlineamount']){
            $payment_method_online = $totalticket_payment_online['onlineamount'];
        }else{
            $payment_method_online = 0;
        }
        
        $totalticket_payment_offline = $this->Ticket->find('all')->contain(['Orders'])->select(['offlineamount' => 'SUM(Ticket.amount)'])->where(['Ticket.event_id' => $event_id,'Orders.paymenttype IN'=>['Cash','EventOffice','Comps']])->first();

        if($totalticket_payment_offline['offlineamount']){
            $payment_method_cash= $totalticket_payment_offline['offlineamount'];
        }else{
            $payment_method_cash = 0;
        }
        $total_ticket_sale = array();
        $ticket_types = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $event_id])->toarray();
        foreach ($ticket_types as $key => $value) {
		
            //$total_ticket_sale_buy = array();
			//$total_ticket_sale_all = array();
			$ticket_id = $value['id'];
			$ticket_types_amount = $this->Ticket->find('all')->Select(['ticketsold' => 'SUM(amount)'])->where(['Ticket.event_id' => $event_id, 'Ticket.event_ticket_id' => $ticket_id])->first();
			//pr($ticket_types_amount);
			$ticket_types_sale = $this->Ticket->find('all')->Select(['ticket_buy' => 'SUM(ticket_buy)'])->where(['Ticket.event_id' => $event_id, 'Ticket.event_ticket_id' => $ticket_id])->first();

			// $data_ticket['ticket'] = $value['title'];
			// $data_ticket['amount'] = "$" . sprintf('%.2f', $ticket_types_amount['ticketsold']);
			// $data_ticket_all[] = $data_ticket;

			//$total_ticket_sale[] = $value['title'];
			$total_ticket_sale[$value['title']] = (int)$ticket_types_sale['ticket_buy'];
			//$total_ticket_sale_all[] = $total_ticket_sale;
		}
        //pr($total_ticket_sale_all);

       

        $data = array(
            'totalTicket' => $totalticket_count,
            'ticketsold' => $totalticketsold_count,
            'revenue' => $totalticketrevenue_count,
            'currency' => "$",
            'paymentMethod'=>["online:$payment_method_online","cash:$payment_method_cash"],
            'ticketTypes'=>[$total_ticket_sale]
        );

        $response['success'] = true;
        $response['data'] = $data;
        }else{
        $response['success'] = false;
		$response['status'] = 'Invalid method';
        }
        echo json_encode($response);
		die;
    }

    public function home()
    {
    }
    /*   Home function End */

    public function aboutus()
    {
    }

    public function contactus()
    {
    }


    public function termsAndConditions()
    {
    }


    public function refund()
    {
    }

    public function privacyPolicy()
    {
    }

    public function cookiePolicy()
    {
    }

    public function deliveryPolicy()
    {
    }

    public function branding()
    {
    }
}
