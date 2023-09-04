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
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
include(ROOT . DS . "vendor" . DS  . "phpqrcode" . DS . "qrlib.php");
include(ROOT . DS . "vendor" . DS  . "PHPMailer/" . DS . "PHPMailerAutoload.php");
class CommitteeController extends AppController
{



    // public  function _setPassword($password)
    // {
    //     return (new DefaultPasswordHasher)->hash($password);
    // }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Email');
    }

    public function beforeFilter()
    {
        // $this->Auth->allow(['event', 'approved']);
    }

    public function event($event_id = null)
    {
        $this->loadModel('Cart');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Committeeassignticket');
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->set('user_id', $user_id);

        $ticketstype = $this->Committeeassignticket->find('all')->contain(['Event'])->where(['Committeeassignticket.user_id' => $user_id, 'Committeeassignticket.status' => 'Y'])->group('Committeeassignticket.event_id')->toarray();
        // pr($ticketstype);exit;

        $this->set(compact('ticketstype'));
    }

    public function ticketdetails($event_id = null)
    {
        $this->loadModel('Event');
        $this->loadModel('Users');
        $this->loadModel('Eventdetail');
        $this->loadModel('Committeeassignticket');
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->set('user_id', $user_id);
        // $findtickets = $this->Committeeassignticket->find('all')->contain(['Eventdetail'])->where(['Committeeassignticket.event_id' => $event_id, 'Committeeassignticket.count !=' => 0])->toarray();

        $ticketstype = $this->Committeeassignticket->find('all')->contain(['Eventdetail'])->where(['Committeeassignticket.user_id' => $user_id, 'Committeeassignticket.event_id' => $event_id, 'Committeeassignticket.status' => 'Y'])->toarray();
        // pr($ticketstype);die;

        $eventdetails = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $event_id])->first();
        // pr($ticketstype);exit;       

        $this->set(compact('ticketstype', 'eventdetails', 'event_id'));

        if ($this->request->is(['post', 'put'])) {
            // pr($this->request->data);
            // exit;
            $userDatas = $this->Users->find('all')->where(['Users.email' => $this->request->data['email'], 'Users.status' => 'Y'])->first();
            // pr($userDatas);die;
            if ($userDatas['is_mob_verify'] == 'N' || empty($userDatas)) {
                if ($userDatas['is_mob_verify'] == 'N') {
                    $this->Flash->error(__('The email address you entered does not verify mobile number kindly verify'));
                } else {
                    $this->Flash->error(__('The email address you entered does not have an eboxticket account.'));
                }
            } else {
                $this->Flash->success(__('Work in progress'));
            }
        }
    }

    public function pending($id = null)
    {
        $this->loadModel('Cart');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Cartquestiondetail');

        $user_id = $this->request->session()->read('Auth.User.id');
        $event_id = $id;

        $cart_data_comitee = $this->Cart->find('all')->contain(['Event' => ['Currency'], 'Eventdetail', 'Users'])->where(['Cart.commitee_user_id' => $user_id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'N'])->order(['Cart.user_id' => 'ASC'])->toarray();
        // pr($cart_data_comitee);exit;
        $this->set('cart_data_comitee', $cart_data_comitee);
    }

    public function approvalreq($cart_id = null, $type = null)
    {
        // $this->viewBuilder()->layout('ajax');
        $this->loadModel('Cart');
        $this->loadModel('Event');
        $this->loadModel('Users');
        $this->loadModel('Payment');
        $this->loadModel('Ticketdetail');
        $this->loadModel('Eventdetail');
        $this->loadModel('Ticket');
        $this->loadModel('Committeeassignticket');
        $this->loadModel('Templates');
        $this->loadModel('Currency');
        $user_id = $this->request->session()->read('Auth.User.id');
        $fname = $this->request->session()->read('Auth.User.name');
        $useremail = $this->request->session()->read('Auth.User.email');

        $cart_data_comitee_data = $this->Cart->find('all')->contain(['Users', 'Eventdetail', 'Event' => ['Currency']])->where(['Cart.id' => $cart_id])->first();
        // pr($cart_data_comitee_data); exit;
        $this->set('cart_data_comitee_data', $cart_data_comitee_data);

        $event_id  = $cart_data_comitee_data['event_id'];
        $ticket_id  = $cart_data_comitee_data['ticket_id'];

        if ($type == 'I') {
            $cart_data_comitee = $this->Cart->find('all')->where(['Cart.event_id' => $event_id, 'Cart.commitee_user_id' => $user_id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'N', 'Cart.ticket_id' => $ticket_id])->first();

            // send email to admin and event organiser 
            $eventname = ucwords(strtolower($cart_data_comitee_data['event']['name']));
            $requestername = $cart_data_comitee_data['user']['name'] . ' ' . $cart_data_comitee_data['user']['lname'];
            $site_url = SITE_URL;
            $emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 28])->first();
            $from = $emailtemplate['fromemail'];
            $to = $cart_data_comitee_data['user']['email'];
            $subject = $emailtemplate['subject'] . ': ' . $eventname;
            $formats = $emailtemplate['description'];

            $message1 = str_replace(array('{EventName}', '{RequesterName}', '{SITE_URL}'), array($eventname, $requestername, $site_url), $formats);
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
            if ($event_id != 49 || $event_id != 53) {
                $mail = $this->Email->send($to, $subject, $message);
                // send mail complete 

                // send watsappmessage start 
                $message = "*Eboxtickets: Request Rejected*%0AHi $requestername,%0A%0AYour request to attend *" . $eventname . "* was Rejected from committee member.%0A%0ARegards,%0A%0AEboxtickets.com";
                $numwithcode = $cart_data_comitee_data['user']['mobile'];
                $this->whatsappmsg($numwithcode, $message);
                // send watsappmessage start 
            }
            $cart_data_comitee->status = 'I';
            $this->Cart->save($cart_data_comitee);
            $this->Flash->success(__('Approved Ignored.'));
            return $this->redirect(['action' => 'ignored']);
        }

        $ticketstype = $this->Committeeassignticket->find('all')->contain(['Eventdetail'])->where(['Committeeassignticket.event_id' => $event_id, 'Committeeassignticket.user_id' => $user_id, 'Committeeassignticket.status' => 'Y'])->toarray();
        // pr($ticketstype);exit;
        $this->set(compact('ticketstype', 'ticket_id', 'event_id'));

        if ($this->request->is(['post', 'put'])) {
            //pr($this->request->data); die;
            $cart_data_comitee = $this->Cart->find('all')->contain(['Eventdetail'])->where(['Cart.id' => $this->request->data['cart_id']])->first();
            $eventdetails_all = $this->Eventdetail->get($this->request->data['tickettype']);
            $ticket_price = $eventdetails_all['price'];

            // echo $ticket_price; die;
            // Different tickets assigned and complimentary tickets assigned validation
            if ($ticket_price != 0) {
                if ($cart_data_comitee['ticket_id']  != $this->request->data['tickettype']) {
                    $this->Flash->error(__('Different ticket assign for user'));
                    return $this->redirect(['action' => 'pending']);
                }
            }

            // Tickets Assigned validation
            $checkticket = $this->Committeeassignticket->find('all')->where(['Committeeassignticket.event_id' => $this->request->data['event_id'], 'Committeeassignticket.user_id' => $user_id, 'Committeeassignticket.ticket_id' => $this->request->data['tickettype'], 'Committeeassignticket.status' => 'Y'])->first();
            if ($checkticket['count'] <= 0) {
                $this->Flash->error(__('Sorry ! You have 0 tickets assigned'));
                return $this->redirect(['action' => 'pending']);
            }

            //sold complimentary and open sale ticket start
            $ticket_total_sold =  $this->Ticket->find('all')->Select(['ticketsold' => 'SUM(ticket_buy)'])->where(['Ticket.event_id' => $this->request->data['event_id'], 'Ticket.event_ticket_id' => $this->request->data['tickettype'], 'Ticket.committee_user_id' => $user_id])->first();


            $cart_total_sold =   $this->Cart->find('all')->Select(['no_tickets' => 'SUM(no_tickets)'])->where(['Cart.commitee_user_id' => $user_id, 'Cart.event_id' => $this->request->data['event_id'], 'Cart.status' => 'Y', 'Cart.ticket_type' => 'committesale', 'Cart.ticket_id' => $this->request->data['tickettype']])->first();


            $total_sold_ticket   =   $ticket_total_sold['ticketsold'] +  $cart_total_sold['no_tickets'] + 1;
            if ($total_sold_ticket  <= $checkticket['count']) {
            } else {
                $this->Flash->error(__('Sorry ! You have assigned all tickets'));
                return $this->redirect(['action' => 'pending']);
            }

            //validtion end

            if ($ticket_price == 0) {
                $this->loadModel('Orders');
                $this->loadModel('Users');
                $eventdetails = $this->Event->get($cart_data_comitee['event_id']);
                $user_detail = $this->Users->get($cart_data_comitee['user_id']);
                $currenny = $this->Currency->get($eventdetails['payment_currency']);
                $orderdata['user_id'] = $cart_data_comitee['user_id'];
                $orderdata['total_amount'] = 0;
                $orderdata['paymenttype'] = "Comps";
                $insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);
                if ($saveorders = $this->Orders->save($insertdata)) {

                    $fn['user_id'] = $cart_data_comitee['user_id'];
                    $fn['event_id'] =  $cart_data_comitee['event_id'];
                    $fn['mpesa'] = null;
                    $fn['amount'] =  0;
                    $payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
                    $this->Payment->save($payment);

                    $ticketbook['order_id'] = $saveorders->id;
                    $ticketbook['event_id'] =  $cart_data_comitee['event_id'];
                    $ticketbook['event_ticket_id'] = $this->request->data['tickettype'];
                    $ticketbook['cust_id'] = $cart_data_comitee['user_id'];
                    $ticketbook['ticket_buy'] = 1;
                    $ticketbook['amount'] = 0;
                    $ticketbook['mobile'] =  $user_detail['mobile'];
                    $ticketbook['committee_user_id'] = $cart_data_comitee['commitee_user_id'];
                    $ticketbook['user_desc'] = $cart_data_comitee['description'];
                    $insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
                    $lastinsetid = $this->Ticket->save($insertticketbook);

                    $ticketdetaildata['tid'] = $lastinsetid['id'];
                    $ticketdetaildata['user_id'] = $cart_data_comitee['user_id'];
                    $ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
                    $ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

                    $Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
                    $Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
                    $ticketdetail = $this->Ticketdetail->save($Packff);

                    $ticketqrimages = $this->qrcodepro($cart_data_comitee['user_id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
                    $Pack = $this->Ticketdetail->get($ticketdetail['id']);
                    $Pack->qrcode = $ticketqrimages;
                    $this->Ticketdetail->save($Pack);
                }

                // send email to admin and event organiser 
                $eventname = ucwords(strtolower($eventdetails['name']));
                $requestername = $user_detail['name'] . ' ' . $user_detail['lname'];
                $url = SITE_URL . 'tickets/myticket';
                $site_url = SITE_URL;
                $currenny_sign = $currenny['Currency'];
                $emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 29])->first();
                $from = $emailtemplate['fromemail'];
                $to = $user_detail['email'];
                // $cc = $from;
                $subject = $emailtemplate['subject'] . ': ' . $eventname;
                $formats = $emailtemplate['description'];

                $message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', 'CurrencySign'), array($eventname, $requestername, $url, $site_url, $currenny_sign), $formats);
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
                if ($cart_data_comitee['event_id'] != 49 || $cart_data_comitee['event_id'] != 53) {
                    $mail = $this->Email->send($to, $subject, $message);
                    // send mail complete 

                    // send watsappmessage start 
                    $message = "*Eboxtickets: Complimentary Ticket Issued*%0AHi $requestername,%0A%0AYou Complimentary Ticket has been issued. This Ticket was FREE.%0ANo payment details were required.%0A%0ARegards,%0A%0AEboxtickets.com";
                    $numwithcode = $user_detail['mobile'];
                    $this->whatsappmsg($numwithcode, $message);
                    // send watsappmessage start 
                }
                $this->Cart->deleteAll(['Cart.id' => $cart_data_comitee['id']]);
                $this->Flash->success(__('Ticket assigned successfully'));
                return $this->redirect(['action' => 'pending']);
            } else {

                $findcartdata = $this->Cart->find('all')->contain(['Users', 'Eventdetail', 'Event' => ['Currency']])->where(['Cart.id' => $this->request->data['cart_id']])->first();
                // pr($findcartdata);exit;                
                $cart_data_comitee_approve = $this->Cart->find('all')->where(['Cart.id' => $this->request->data['cart_id']])->first();
                $cart_data_comitee_approve->status = 'Y';
                $this->Cart->save($cart_data_comitee_approve);

                // send email to admin and event organiser 
                $eventname = ucwords(strtolower($findcartdata['event']['name']));
                $requestername = $findcartdata['user']['name'] . ' ' . $findcartdata['user']['lname'];
                $url = SITE_URL . 'cart';
                $site_url = SITE_URL;
                $emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 27])->first();
                $from = $emailtemplate['fromemail'];
                $to = $findcartdata['user']['email'];
                // $cc = $from;
                $subject = $emailtemplate['subject'] . ': ' . $eventname;
                $formats = $emailtemplate['description'];

                $message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}'), array($eventname, $requestername, $url, $site_url), $formats);
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
                if ($findcartdata['event']['id'] != 49 || $findcartdata['event']['id'] != 53) {
                    $mail = $this->Email->send($to, $subject, $message);
                    // send mail complete 

                    // send watsappmessage start 
                    $message = "*Eboxtickets: Request Approved*%0AHi $requestername,%0A%0AYour request to attend *" . $eventname . "* was approved.%0A%0ARegards,%0A%0AEboxtickets.com";
                    $numwithcode = $findcartdata['user']['mobile'];
                    $this->whatsappmsg($numwithcode, $message);
                    // send watsappmessage start 
                }
                $this->Flash->success(__('Approved accepted.'));
                return $this->redirect(['action' => 'pending']);
            }
            // commitee sales end   
        }
    }

    public function completepayment($id = null)
    {

        $this->loadModel('Orders');
        $this->loadModel('Users');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Cart');
        $this->loadModel('Payment');
        $this->loadModel('Ticket');
        $this->loadModel('Currency');
        $this->loadModel('Ticketdetail');
        $this->loadModel('Templates');
        $cart_data_comitee = $this->Cart->find('all')->where(['Cart.id' => $id])->first();


        $eventdetails = $this->Event->get($cart_data_comitee['event_id']);
        $currenny = $this->Currency->get($eventdetails['payment_currency']);
        $eventdetails_all = $this->Eventdetail->get($cart_data_comitee['ticket_id']);
        $user_detail = $this->Users->get($cart_data_comitee['user_id']);
        $orderdata['user_id'] = $cart_data_comitee['user_id'];
        $orderdata['total_amount'] = $eventdetails_all['price'];
        $orderdata['paymenttype'] = "Cash";

        // pr($eventdetails_all); die;
        $insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);

        if ($saveorders = $this->Orders->save($insertdata)) {

            $fn['user_id'] = $cart_data_comitee['user_id'];
            $fn['event_id'] =  $cart_data_comitee['event_id'];
            $fn['mpesa'] = null;
            $fn['amount'] =  $eventdetails_all['price'];
            $payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
            $this->Payment->save($payment);

            $ticketbook['order_id'] = $saveorders->id;
            $ticketbook['event_id'] =  $cart_data_comitee['event_id'];
            $ticketbook['event_ticket_id'] = $cart_data_comitee['ticket_id'];
            $ticketbook['cust_id'] = $cart_data_comitee['user_id'];
            $ticketbook['ticket_buy'] = 1;
            $ticketbook['amount'] = $eventdetails_all['price'];
            $ticketbook['mobile'] =  $user_detail['mobile'];
            $ticketbook['committee_user_id'] = $cart_data_comitee['commitee_user_id'];
            $ticketbook['user_desc'] = $cart_data_comitee['description'];
            $insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
            $lastinsetid = $this->Ticket->save($insertticketbook);

            $ticketdetaildata['tid'] = $lastinsetid['id'];
            $ticketdetaildata['user_id'] = $cart_data_comitee['user_id'];
            $ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
            $ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

            $Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
            $Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
            $ticketdetail = $this->Ticketdetail->save($Packff);

            $ticketqrimages = $this->qrcodepro($cart_data_comitee['user_id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
            $Pack = $this->Ticketdetail->get($ticketdetail['id']);
            $Pack->qrcode = $ticketqrimages;
            $this->Ticketdetail->save($Pack);
        }

        // send email to admin and event organiser 
        $eventname = ucwords(strtolower($eventdetails['name']));
        $requestername = $user_detail['name'] . ' ' . $user_detail['lname'];
        $url = SITE_URL . 'tickets/myticket';
        $site_url = SITE_URL;
        $ticket_name = $eventdetails_all['title'];
        $paymnet_type = 'Cash';
        $total_amount = sprintf('%.2f', $eventdetails_all['price']) . ' ' . $currenny['Currency'];
        $emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 30])->first();
        $from = $emailtemplate['fromemail'];
        $to = $user_detail['email'];
        // $cc = $from;
        $subject = $emailtemplate['subject'] . ': ' . $eventname;
        $formats = $emailtemplate['description'];

        $message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{TicketName}', '{PaymentType}', '{TotalAmount}'), array($eventname, $requestername, $url, $site_url, $ticket_name, $paymnet_type, $total_amount), $formats);
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
        if ($eventdetails['id'] != 49 || $eventdetails['id'] != 53) {
            $mail = $this->Email->send($to, $subject, $message);
            // send mail complete 

            // send watsappmessage start 
            $message = "*Eboxtickets: Payment Complete*%0AHi $requestername,%0A%0AYour payment was received for *$ticket_name* type ticket.%0A%0ARegards,%0A%0AEboxtickets.com";
            $numwithcode = $user_detail['mobile'];
            $this->whatsappmsg($numwithcode, $message);
            // send watsappmessage start 
        }
        $this->Cart->deleteAll(['Cart.id' => $cart_data_comitee['id']]);
        $this->Flash->success(__('Ticket assigned successfully'));
        return $this->redirect(['action' => 'approved']);
    }

    public function issuecommittee($id = null)
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

        $cart_data_comitee = $this->Cart->find('all')->where(['Cart.id' => $id])->first();
        $user_id = $this->request->session()->read('Auth.User.id');

        $eventdetails_all_ticket = $this->Eventdetail->find('all')->where(['Eventdetail.eventid' => $cart_data_comitee['event_id'], 'Eventdetail.type' => 'comps'])->first();
        //pr($eventdetails_all_ticket); die;

        $checkticket = $this->Committeeassignticket->find('all')->where(['Committeeassignticket.event_id' => $cart_data_comitee['event_id'], 'Committeeassignticket.user_id' => $user_id, 'Committeeassignticket.ticket_id' => $eventdetails_all_ticket['id'], 'Committeeassignticket.status' => 'Y'])->first();
        if ($checkticket['count'] <= 0) {
            $this->Flash->error(__('Sorry ! You have 0 tickets assigned'));
            return $this->redirect(['action' => 'approved']);
        }

        //sold complimentary and open sale ticket start
        $ticket_total_sold =  $this->Ticket->find('all')->Select(['ticketsold' => 'SUM(ticket_buy)'])->where(['Ticket.event_id' => $cart_data_comitee['event_id'], 'Ticket.event_ticket_id' => $eventdetails_all_ticket['id'], 'Ticket.committee_user_id' => $user_id])->first();

        $total_sold_ticket   =   $ticket_total_sold['ticketsold'] + 1;
        if ($total_sold_ticket  <= $checkticket['count']) {
        } else {
            $this->Flash->error(__('Sorry ! You have assigned all tickets'));
            return $this->redirect(['action' => 'approved']);
        }

        $this->loadModel('Orders');
        $this->loadModel('Users');
        $eventdetails = $this->Event->get($cart_data_comitee['event_id']);
        $user_detail = $this->Users->get($cart_data_comitee['user_id']);
        $currenny = $this->Currency->get($eventdetails['payment_currency']);
        $orderdata['user_id'] = $cart_data_comitee['user_id'];
        $orderdata['total_amount'] = 0;
        $orderdata['paymenttype'] = "Comps";
        $insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);

        if ($saveorders = $this->Orders->save($insertdata)) {

            $fn['user_id'] = $cart_data_comitee['user_id'];
            $fn['event_id'] =  $cart_data_comitee['event_id'];
            $fn['mpesa'] = null;
            $fn['amount'] =  0;
            $payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
            $this->Payment->save($payment);

            $ticketbook['order_id'] = $saveorders->id;
            $ticketbook['event_id'] =  $cart_data_comitee['event_id'];
            $ticketbook['event_ticket_id'] = $eventdetails_all_ticket['id'];
            $ticketbook['cust_id'] = $cart_data_comitee['user_id'];
            $ticketbook['ticket_buy'] = 1;
            $ticketbook['amount'] = 0;
            $ticketbook['mobile'] =  $user_detail['mobile'];
            $ticketbook['committee_user_id'] = $cart_data_comitee['commitee_user_id'];
            $ticketbook['user_desc'] = $cart_data_comitee['description'];
            $insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
            $lastinsetid = $this->Ticket->save($insertticketbook);

            $ticketdetaildata['tid'] = $lastinsetid['id'];
            $ticketdetaildata['user_id'] = $cart_data_comitee['user_id'];
            $ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
            $ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

            $Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
            $Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
            $ticketdetail = $this->Ticketdetail->save($Packff);

            $ticketqrimages = $this->qrcodepro($cart_data_comitee['user_id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
            $Pack = $this->Ticketdetail->get($ticketdetail['id']);
            $Pack->qrcode = $ticketqrimages;
            $this->Ticketdetail->save($Pack);
        }

        // send email to admin and event organiser 
        $eventname = ucwords(strtolower($eventdetails['name']));
        $requestername = $user_detail['name'] . ' ' . $user_detail['lname'];
        $url = SITE_URL . 'tickets/myticket';
        $site_url = SITE_URL;
        $currenny_sign = $currenny['Currency'];
        $emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 29])->first();
        $from = $emailtemplate['fromemail'];
        $to = $user_detail['email'];
        // $cc = $from;
        $subject = $emailtemplate['subject'] . ': ' . $eventname;
        $formats = $emailtemplate['description'];

        $message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{CurrencySign}'), array($eventname, $requestername, $url, $site_url, $currenny_sign), $formats);
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
        if ($eventdetails['id'] != 49 || $eventdetails['id'] != 53) {
            $mail = $this->Email->send($to, $subject, $message);
            // pr($mail);exit;
            // send mail complete 

            // send watsappmessage start 
            $message = "*Eboxtickets: Complimentary Ticket Issued*%0AHi $requestername,%0A%0AYou Complimentary Ticket has been issued. This Ticket was FREE.%0ANo payment details were required.%0A%0ARegards,%0A%0AEboxtickets.com";
            $numwithcode = $user_detail['mobile'];
            $this->whatsappmsg($numwithcode, $message);
            // send watsappmessage start 
        }
        $this->Cart->deleteAll(['Cart.id' => $cart_data_comitee['id']]);
        $this->Flash->success(__('Ticket assigned successfully'));
        return $this->redirect(['action' => 'approved']);
    }

    public function ticketpush($id = null)
    {
        $this->loadModel('Users');
        $this->loadModel('Cartquestiondetail');
        $this->loadModel('Committeeassignticket');
        $this->loadModel('Orders');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Cart');
        $this->loadModel('Payment');
        $this->loadModel('Ticket');
        $this->loadModel('Ticketdetail');
        $this->loadModel('Currency');
        $this->loadModel('Templates');

        $userDatas = $this->Users->find('all')->where(['Users.email' => trim($this->request->data['email']), 'Users.status' => 'Y'])->first();
        $admin_user = $this->Users->find('all')->where(['role_id' => 1])->first();
        $current_datetime = date('Y-m-d H:i:s');
        $user_id = $this->request->session()->read('Auth.User.id');
        $event_id = $this->request->data['event_id'];
        $eventdetails = $this->Event->get($event_id);
        $currenny = $this->Currency->get($eventdetails['payment_currency']);

        if (!array_filter($this->request->data['ticket_count'])) {
            $this->Flash->error(__('Please choose any ticket'));
            return $this->redirect($this->referer());
        }

        // pr($this->request->data);
        // exit;

        if ($userDatas) {
            foreach ($this->request->data['ticket_count'] as $ticket_id => $ticketcount) {

                if (!empty($ticketcount)) {
                    $ticketdetails = $this->Eventdetail->get($ticket_id);
                    // pr($ticketdetails);die;
                    if ($ticketdetails['type'] == 'open_sales') {
                        $type = 'opensale';
                        $status = 'Y';
                    } else {
                        $status = 'Y';
                        $type = 'committesale';
                    }

                    // add question reply
                    for ($i = 0; $i < $ticketcount; $i++) {
                        $c = $i + 1;
                        $dynamic = 'question' . str_replace(' ', '_', $ticketdetails['title']) . '_' . $c;
                        $dynamic_question_id = 'questionid' . str_replace(' ', '_', $ticketdetails['title']) . '_' . $c;
                        $digits = 10;
                        // pr($dynamic_question_id);die;
                        $randomnumber = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

                        // Zero rupes price ticket direct book 
                        if ($ticketdetails['price'] == 0) {
                            $orderdata['user_id'] =  $userDatas['id'];
                            $orderdata['total_amount'] = $ticketdetails['price'];
                            $orderdata['paymenttype'] = "Comps";
                            $orderdata['adminfee'] = $admin_user['feeassignment'];
                            $orderdata['created'] = $current_datetime;
                            $insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);

                            if ($saveorders = $this->Orders->save($insertdata)) {

                                $fn['user_id'] = $userDatas['id'];
                                $fn['event_id'] =   $event_id;
                                $fn['mpesa'] = null;
                                $fn['amount'] = $ticketdetails['price'];
                                $payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
                                $this->Payment->save($payment);

                                $ticketbook['order_id'] = $saveorders->id;
                                $ticketbook['event_id'] =  $event_id;
                                $ticketbook['event_ticket_id'] = $ticket_id;
                                $ticketbook['cust_id'] = $userDatas['id'];
                                $ticketbook['ticket_buy'] = 1;
                                $ticketbook['amount'] = 0;
                                $ticketbook['mobile'] =  $userDatas['mobile'];
                                $ticketbook['committee_user_id'] = $user_id;
                                $ticketbook['user_desc'] = 'Ticket Push';
                                $ticketbook['adminfee'] = $admin_user['feeassignment'];
                                $ticketbook['created'] = $current_datetime;
                                $insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
                                $lastinsetid = $this->Ticket->save($insertticketbook);

                                $ticketdetaildata['tid'] = $lastinsetid['id'];
                                $ticketdetaildata['user_id'] = $userDatas['id'];
                                $ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
                                $ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

                                $Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
                                $Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
                                $ticketdetail = $this->Ticketdetail->save($Packff);

                                $ticketqrimages = $this->qrcodepro($userDatas['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
                                $Pack = $this->Ticketdetail->get($ticketdetail['id']);
                                $Pack->qrcode = $ticketqrimages;
                                $this->Ticketdetail->save($Pack);
                            }

                            // send email to admin and event organiser 
                            $eventname = ucwords(strtolower($eventdetails['name']));
                            $requestername = $userDatas['name'] . ' ' . $userDatas['lname'];
                            $url = SITE_URL . 'tickets/myticket';
                            $site_url = SITE_URL;
                            $currenny_sign = $currenny['Currency'];
                            $emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 29])->first();
                            $from = $emailtemplate['fromemail'];
                            $to = $userDatas['email'];
                            // $cc = $from;
                            $subject = $emailtemplate['subject'] . ': ' . $eventname;
                            $formats = $emailtemplate['description'];

                            $message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{CurrencySign}'), array($eventname, $requestername, $url, $site_url, $currenny_sign), $formats);
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
                            if ($eventdetails['id'] != 49 || $eventdetails['id'] != 53) {
                                $mail = $this->Email->send($to, $subject, $message);
                                // pr($mail);exit;
                                // send mail complete 

                                // send watsappmessage start 
                                $message = "*Eboxtickets: Complimentary Ticket Issued*%0AHi $requestername,%0A%0AYou Complimentary Ticket has been issued. This Ticket was FREE.%0ANo payment details were required.%0A%0ARegards,%0A%0AEboxtickets.com";
                                $numwithcode = $userDatas['mobile'];
                                $this->whatsappmsg($numwithcode, $message);
                                // send watsappmessage start 
                            }
                        } else {

                            foreach ($this->request->data[$dynamic] as $questionid => $value) {

                                $newquestiondetails = $this->Cartquestiondetail->newEntity();
                                $questiondata['user_id'] = $userDatas['id'];
                                $questiondata['question_id'] = $this->request->data[$dynamic_question_id][$questionid];
                                $questiondata['event_id'] = $event_id;
                                $questiondata['ticket_id'] = $ticketdetails['id'];
                                $questiondata['user_reply'] = $value;
                                $questiondata['serial_no'] = $randomnumber;
                                $addquestionnew = $this->Cartquestiondetail->patchEntity($newquestiondetails, $questiondata);
                                $this->Cartquestiondetail->save($addquestionnew);
                            }

                            // add ticket in cart 
                            $newcart = $this->Cart->newEntity();
                            $reqdata['user_id'] = $userDatas['id'];
                            $reqdata['event_id'] = $event_id;
                            $reqdata['ticket_id'] = $ticketdetails['id'];
                            $reqdata['no_tickets'] = 1; //$ticketcount;
                            $reqdata['ticket_type'] = $type;
                            $reqdata['status'] = $status;
                            $reqdata['description'] = 'Ticket Push';
                            $reqdata['commitee_user_id'] = $user_id;
                            $reqdata['serial_no'] = $randomnumber;
                            $insertdata = $this->Cart->patchEntity($newcart, $reqdata);
                            $ok = $this->Cart->save($insertdata);
                            // $allId[]=$ok['id'];
                        }
                    }
                }
            }
            $this->Flash->success(__('Requests have been succesfully sent.'));
            return $this->redirect($this->referer());
        } else {
            $this->Flash->error(__('User does not exist in eboxtickets'));
            return $this->redirect($this->referer());
        }
    }

    // for generate random tickets for promoter account 
    public function pushrandom($event_id = null)
    {
        $this->loadModel('Event');
        $this->loadModel('Users');
        $this->loadModel('Committe');
        $this->loadModel('Cartquestiondetail');
        $this->loadModel('Committeeassignticket');
        $this->loadModel('Orders');
        $this->loadModel('Eventdetail');
        $this->loadModel('Cart');
        $this->loadModel('Payment');
        $this->loadModel('Ticket');
        $this->loadModel('Ticketdetail');
        $this->loadModel('Currency');
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->set('user_id', $user_id);
        // $findtickets = $this->Committeeassignticket->find('all')->contain(['Eventdetail'])->where(['Committeeassignticket.event_id' => $event_id, 'Committeeassignticket.count !=' => 0])->toarray();
        $ticketstype = $this->Committeeassignticket->find('all')->contain(['Eventdetail'])->where(['Committeeassignticket.user_id' => $user_id, 'Committeeassignticket.event_id' => $event_id, 'Committeeassignticket.status' => 'Y'])->toarray();
        $eventdetails = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $event_id])->first();
        // pr($ticketstype);exit;   

        $findcommember = $this->Committe->find('all')->contain(['Users'])->where(['event_id' => $event_id, 'Users.status' => 'Y'])->toarray();
        // pr($findcommember);exit;

        $this->set(compact('ticketstype', 'eventdetails', 'event_id', 'findcommember'));

        if ($this->request->is(['post', 'put'])) {
            //Start point of our date range.
            $start = strtotime("20 June 2022");
            $end = strtotime("27 July 2022");
            // pr($this->request->data);
            // exit;

            $user_id = $this->request->data['committee'];
            $event_id = $this->request->data['event_id'];
            $eventdetails = $this->Event->get($event_id);
            $currenny = $this->Currency->get($eventdetails['payment_currency']);
            $userDatas = $this->Users->find('all')->where(['Users.email' => trim($this->request->data['email']), 'Users.status' => 'Y'])->first();
            // pr($userDatas);exit;

            foreach ($this->request->data['ticket_count'] as $ticket_id => $ticketcount) {
                $timestamp = rand($start, $end);

                if (!empty($ticketcount)) {
                    $ticketdetails = $this->Eventdetail->get($ticket_id);

                    if (rand(0, 1)) {
                        $status = 'Online';
                    } else {
                        $status = 'Cash';
                    }

                    $orderdata['user_id'] =  $userDatas['id'];
                    $orderdata['total_amount'] = $ticketdetails['price'] * $ticketcount;
                    $orderdata['paymenttype'] = $status;
                    $orderdata['created'] = date("Y-m-d H:i:s", $timestamp);
                    $insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);

                    $fn['user_id'] = $userDatas['id'];
                    $fn['event_id'] =   $event_id;
                    $fn['mpesa'] = null;
                    $fn['amount'] = $ticketdetails['price'];
                    $fn['created'] = date("Y-m-d H:i:s", $timestamp);
                    $payment = $this->Payment->patchEntity($this->Payment->newEntity(), $fn);
                    $this->Payment->save($payment);

                    if ($saveorders = $this->Orders->save($insertdata)) {

                        for ($i = 0; $i < $ticketcount; $i++) {
                            $forticket = mt_rand($start, $end);
                            $ticketbook['order_id'] = $saveorders->id;
                            $ticketbook['event_id'] =  $event_id;
                            $ticketbook['event_ticket_id'] = $ticket_id;
                            $ticketbook['cust_id'] = $userDatas['id'];
                            $ticketbook['ticket_buy'] = 1;
                            $ticketbook['amount'] = $ticketdetails['price'];
                            $ticketbook['mobile'] =  $userDatas['mobile'];
                            $ticketbook['committee_user_id'] = $user_id;
                            $ticketbook['user_desc'] = 'Ticket Push';
                            $ticketbook['created'] = date("Y-m-d H:i:s", $forticket);
                            $insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
                            $lastinsetid = $this->Ticket->save($insertticketbook);

                            $ticketdetaildata['tid'] = $lastinsetid['id'];
                            $ticketdetaildata['user_id'] = $userDatas['id'];
                            $ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
                            $ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

                            $Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
                            $Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
                            $Packff->created = date("Y-m-d H:i:s", $timestamp);
                            $ticketdetail = $this->Ticketdetail->save($Packff);

                            $ticketqrimages = $this->qrcodepro($userDatas['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
                            $Pack = $this->Ticketdetail->get($ticketdetail['id']);
                            $Pack->qrcode = $ticketqrimages;
                            $this->Ticketdetail->save($Pack);
                        }
                    }
                }
            }

            $this->Flash->success(__('Generate successfully'));
            return $this->redirect($this->referer());
        }
    }

    public function approved($id = null)
    {
        $this->loadModel('Cart');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Cartquestiondetail');

        $user_id = $this->request->session()->read('Auth.User.id');
        $event_id = $id;

        $cart_data_comitee = $this->Cart->find('all')->contain(['Event' => ['Currency'], 'Eventdetail', 'Users'])->where(['Cart.commitee_user_id' => $user_id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'Y'])->order(['Cart.user_id' => 'ASC'])->toarray();
        // pr($cart_data_comitee);exit;
        $this->set('cart_data_comitee', $cart_data_comitee);
    }

    public function complete($id = null)
    {
        $this->loadModel('Cart');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Ticket');
        $this->loadModel('Cartquestiondetail');

        $user_id = $this->request->session()->read('Auth.User.id');
        $event_id = $id;

        $cart_data_complete = $this->Ticket->find('all')->contain(['Event' => ['Currency'], 'Users', 'Eventdetail', 'Orders'])->where(['Ticket.committee_user_id' => $user_id, 'Ticket.status' => 'Y'])->order(['Ticket.id' => 'DESC']);
        $cart_data_complete = $this->paginate($cart_data_complete)->toarray();
        $this->set('cart_data_complete', $cart_data_complete);
    }

    public function ignored($id = null)
    {
        $this->loadModel('Cart');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Cartquestiondetail');

        $user_id = $this->request->session()->read('Auth.User.id');
        $event_id = $id;
        $cart_data_pendding = $this->Cart->find('all')->contain(['Event' => ['Currency'], 'Eventdetail', 'Users'])->where(['Cart.commitee_user_id' => $user_id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'I'])->order(['Cart.user_id' => 'ASC'])->toarray();

        $this->set('cart_data_pendding', $cart_data_pendding);
    }

}
