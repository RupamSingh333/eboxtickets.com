<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Datasource\ConnectionManager;
use LDAP\Result;
use PHPMailer\PHPMailer\PHPMailer;
use Cake\Routing\Router;
use Cake\View\CommanHelper;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
include(ROOT . DS . "vendor" . DS  . "PHPMailer/" . DS . "PHPMailerAutoload.php");
include(ROOT . DS . "vendor" . DS  . "phpqrcode" . DS . "qrlib.php");
class EventofficeController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Email');
    }

    public function beforeFilter()
    {

        // $this->Auth->allow(['index']);
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



    public function index($id = null)
    {

        $this->loadModel('Users');
        $this->loadModel('CommitteeGroup');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Currency');
        $this->loadModel('Committeeassignticket');
        $this->loadModel('Eventofficecart');
        $this->loadModel('Evetofficequestiondetail');
        $this->loadModel('Ticket');


        $user_id = $this->request->session()->read('Auth.User.id');
        $event_id = $id;

        $event = $this->Event->find('all')->contain(['Currency'])->where(['Event.id' => $id])->first();
        // pr($event);exit;

        $admin_fee = $this->Users->find()->where(['role_id' => 1])->first();
        $fees = $admin_fee['feeassignment'];
        $this->set('fees', $fees);

        $findtickets = $this->Committeeassignticket->find('all')->contain(['Eventdetail'])->where(['Committeeassignticket.event_id' => $event_id, 'Committeeassignticket.user_id' => $user_id, 'Committeeassignticket.count !=' => 0])->toarray();
        // pr($findtickets);exit;

        $findcart = $this->Eventofficecart->find('all')->contain(['Eventdetail', 'Event' => 'Currency'])->where(['Eventofficecart.user_id' => $user_id])->group('ticket_id')->toarray();

        $this->set(compact('id', 'findtickets', 'event', 'findcart', 'user_id'));

        if ($this->request->is(['post', 'put'])) {
            // pr($this->request->data);
            // exit;
            if (!array_filter($this->request->data['ticket_count'])) {
                $this->Flash->error(__('You did not select any tickets.'));
                return $this->redirect($this->referer());
            }
            foreach ($this->request->data['ticket_count'] as $ticket_id => $ticketcount) {

                $ticketdetails = $this->Eventdetail->get($ticket_id);

                $totalsold = $this->Ticket->find('all')->Select(['ticketsold' => 'SUM(ticket_buy)'])->where(['Ticket.event_id' => $event_id, 'Ticket.event_ticket_id' => $ticket_id, 'Ticket.committee_user_id' => $user_id])->first();
                $findcount = $this->Committeeassignticket->find('all')->where(['Committeeassignticket.event_id' => $event_id, 'Committeeassignticket.ticket_id' => $ticket_id])->first();
                $total_left = $findcount['count'] - $totalsold['ticketsold'];

                if ($total_left < $ticketcount) {
                    $this->Flash->error(__('You have no left ' . $ticketdetails['title'] . ' tickets..'));
                    return $this->redirect($this->referer());
                }

                if (!empty($ticketcount)) {
                    if ($ticketdetails['type'] == 'open_sales') {
                        $type = 'opensale';
                        $status = 'Y';
                    } else {
                        $status = 'N';
                        $type = 'committesale';
                    }

                    // add question reply
                    for ($i = 0; $i < $ticketcount; $i++) {

                        $c = $i + 1;
                        $dynamic = 'question' . str_replace(' ', '_', $ticketdetails['title']) . '_' . $c;
                        $dynamic_question_id = 'questionid' . str_replace(' ', '_', $ticketdetails['title']) . '_' . $c;
                        // pr($dynamic_question_id);die;
                        $digits = 10;
                        $randomnumber = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
                        foreach ($this->request->data[$dynamic] as $questionid => $value) {

                            $newquestiondetails = $this->Evetofficequestiondetail->newEntity();
                            $questiondata['user_id'] = $user_id;
                            $questiondata['question_id'] = $this->request->data[$dynamic_question_id][$questionid];
                            $questiondata['event_id'] = $event_id;
                            $questiondata['ticket_id'] = $ticket_id;
                            $questiondata['user_reply'] = $value;
                            $questiondata['serial_no'] = $randomnumber;
                            $addquestionnew = $this->Evetofficequestiondetail->patchEntity($newquestiondetails, $questiondata);
                            $this->Evetofficequestiondetail->save($addquestionnew);
                        }

                        // add ticket in cart 
                        $newcart = $this->Eventofficecart->newEntity();
                        $reqdata['user_id'] = $user_id;
                        $reqdata['event_id'] = $event_id;
                        $reqdata['ticket_id'] = $ticket_id;
                        $reqdata['no_tickets'] = "1"; //$ticketcount;
                        $reqdata['ticket_type'] = $type;
                        $reqdata['status'] = $status;
                        // $reqdata['description'] = $this->request->data['commitee_message'];
                        // $reqdata['commitee_user_id'] = $commitee_user_id;
                        $reqdata['serial_no'] = $randomnumber;
                        $insertdata = $this->Eventofficecart->patchEntity($newcart, $reqdata);
                        $ok = $this->Eventofficecart->save($insertdata);
                        // $allId[]=$ok['id'];
                    }
                }
            }

            $this->Flash->success(__('Ticket has Added successfully.'));
            return $this->redirect($this->referer());
            // pr('else');exit;
        }
    }

    public function summary($event_order)
    {
        $this->loadModel('Eventofficecart');
        $this->loadModel('Evetofficequestiondetail');
        $this->loadModel('Orders');
        $this->loadModel('Users');
        $this->loadModel('CommitteeGroup');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Payment');
        $this->loadModel('Ticket');
        $this->loadModel('Ticketdetail');
        $this->loadModel('Templates');
        $this->loadModel('Questionbook');
        $auth_user_id = $this->request->session()->read('Auth.User.id');
        $orderid_eventid = explode("/", base64_decode($event_order));
        $admin_fee = $this->Users->find()->where(['role_id' => 1])->first();
        $fees = $admin_fee['feeassignment'];
        $this->set('fees', $fees);
        // pr($orderid_eventid);exit;
        $id = $orderid_eventid[0];
        $order_id = $orderid_eventid[1];
        $event_orderboth = base64_encode($order_id . '/' . $id);

        $this->set('id', $id);
        $order_details = $this->Ticket->find('all')->contain(['Eventdetail', 'Ticketdetail', 'Event' => 'Currency'])->where(['Ticket.cust_id' => $auth_user_id, 'Ticket.order_id' => $order_id])->toarray();
        $this->set('order_details', $order_details);
        $this->set('event_order', $event_orderboth);

        //ticket name update 
        if ($this->request->is(['post', 'put'])) {
            // pr($this->request->data);
            // exit;

            if (!array_filter($this->request->data['name'])) {
                $this->Flash->error(__('Please fill name field'));
                return $this->redirect($this->referer());
            } else {
                foreach ($this->request->data['ticket_id'] as $key => $ticket_value) {
                    $getticketdetails = $this->Ticketdetail->get($ticket_value);
                    if ($getticketdetails) {
                        $getticketdetails->name = ucwords(strtolower($this->request->data['name'][$key]));
                        $this->Ticketdetail->save($getticketdetails);
                    } else {
                        return $this->redirect($this->referer());
                        $this->Flash->error(__('Ticket id not valide.'));
                    }
                }
                $this->Flash->success(__('Name has been updated on the ticket'));
                return $this->redirect($this->referer());
            }

            $this->Flash->error(__('Please fill name field'));
            return $this->redirect(['controller' => 'tickets', 'action' => 'ticketdetails/' . $id]);
        }

        //    pr($id.'id '.$key);exit;
    }

    public function remove($id)
    {
        $this->loadModel('Eventofficecart');
        $this->loadModel('Evetofficequestiondetail');
        $getcart = $this->Eventofficecart->get($id);
        $this->Eventofficecart->deleteAll(['Eventofficecart.event_id' => $getcart['event_id'], 'Eventofficecart.ticket_id' => $getcart['ticket_id']]);
        $this->Evetofficequestiondetail->deleteAll(['Evetofficequestiondetail.event_id' => $getcart['event_id'], 'Evetofficequestiondetail.ticket_id' => $getcart['ticket_id']]);
        $this->Flash->success(__('Ticket has been deleted successfully.'));
        return $this->redirect($this->referer());
    }

    public function cal_percentage($num_amount, $num_total)
    {
        $count1 = $num_total * $num_amount / 100;
        $count = number_format($count1, 2);
        return $count;
    }

    public function checkout($id = null)
    {
        $this->loadModel('Eventofficecart');
        $this->loadModel('Evetofficequestiondetail');
        $this->loadModel('Orders');
        $this->loadModel('Users');
        $this->loadModel('CommitteeGroup');
        $this->loadModel('Event');
        $this->loadModel('Eventdetail');
        $this->loadModel('Currency');
        $this->loadModel('Payment');
        $this->loadModel('Ticket');
        $this->loadModel('Ticketdetail');
        $this->loadModel('Templates');
        $this->loadModel('Questionbook');

        $user_id = $this->request->session()->read('Auth.User.id');
        $admin_user = $this->Users->find('all')->where(['role_id' => 1])->first();
        $fees = $admin_user['feeassignment'];
        $current_datetime = date('Y-m-d H:i:s');
        $date = date("Y-m-d H:i:s");
        $this->set('id', $id);

        if ($this->request->is(['post', 'put'])) {

            // pr($this->request->data);exit;
            $findcart = $this->Eventofficecart->find('all')->contain(['Eventdetail', 'Event' => 'Currency'])->where(['Eventofficecart.user_id' => $user_id])->toarray();

            $findemail = $this->Users->find('all')->where(['Users.email' => $this->request->data['email']])->first();
            $eventdetails = $this->Event->get($id);
            $currenny = $this->Currency->get($eventdetails['payment_currency']);
            $sale_end = date('Y-m-d H:i:s', strtotime($eventdetails['sale_end']));

            // if ($sale_end <= $date) {
            //     $this->Flash->error(__('Ticket sales for ' . $eventdetails['name'] . ' event are currently closed.'));
            //     return $this->redirect($this->referer());
            // }


            if (!empty($findemail) && $this->request->data['payment_type'] == 'cash') {

                $TotalAmount = 0;
                $GTAmt = 0;
                $conversion_rate_amt = 0;
                $ordersummary = '';
                $ordersummarywtsapp = '';

                $orderdata['user_id'] = $findemail['id'];
                $orderdata['paymenttype'] = "EventOffice";
                $orderdata['adminfee'] = $admin_user['feeassignment'];
                $orderdata['created'] = $current_datetime;
                $insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);

                if ($saveorders = $this->Orders->save($insertdata)) {

                    foreach ($findcart as $boxoffid => $boxoffdetail) {
                        if ($currenny == 1) {
                            $conversion_rate_amt = $currenny['conversion_rate'] * $boxoffdetail['eventdetail']['price'];
                        } else {
                            $conversion_rate_amt = $boxoffdetail['eventdetail']['price'];
                        }
                        // $TotalAmount += sprintf('%0.2f', $conversion_rate_amt);
                        $feescal = $this->cal_percentage($fees, $conversion_rate_amt);
                        $GTAmt += $conversion_rate_amt + $feescal;

                        $ticketbook['order_id'] = $saveorders->id;
                        $ticketbook['event_id'] =  $boxoffdetail['event_id'];
                        $ticketbook['event_ticket_id'] = $boxoffdetail['ticket_id'];
                        $ticketbook['cust_id'] = $findemail['id'];
                        $ticketbook['ticket_buy'] = 1;
                        $ticketbook['amount'] = $conversion_rate_amt + $feescal;
                        $ticketbook['currency_rate'] = $currenny['conversion_rate'];
                        $ticketbook['mobile'] =  $findemail['mobile'];
                        $ticketbook['committee_user_id'] = $user_id;
                        $ticketbook['user_desc'] = 'Print ticket from box office';
                        $ticketbook['adminfee'] = $admin_user['feeassignment'];
                        $ticketbook['created'] = $current_datetime;
                        $insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
                        $lastinsetid = $this->Ticket->save($insertticketbook);

                        $ticketdetaildata['tid'] = $lastinsetid['id'];
                        $ticketdetaildata['user_id'] = $findemail['id'];
                        $ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
                        $ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

                        $Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
                        $Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
                        $ticketdetail = $this->Ticketdetail->save($Packff);

                        $ticketqrimages = $this->qrcodepro($findemail['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
                        $Pack = $this->Ticketdetail->get($ticketdetail['id']);
                        $Pack->qrcode = $ticketqrimages;
                        $this->Ticketdetail->save($Pack);

                        $questiondetail = $this->Evetofficequestiondetail->find('all')->where(['Evetofficequestiondetail.serial_no' => $boxoffdetail['serial_no']])->toarray();

                        foreach ($questiondetail as $keyid => $questionreply) {
                            $bookquestion['order_id'] = $saveorders->id;
                            $bookquestion['ticketdetail_id'] = $ticketdetail['id'];
                            $bookquestion['question_id'] = $questionreply['question_id'];
                            $bookquestion['event_id'] = $questionreply['event_id'];
                            $bookquestion['user_id'] = $questionreply['user_id'];
                            $bookquestion['user_reply'] = $questionreply['user_reply'];
                            $savequestionbook = $this->Questionbook->patchEntity($this->Questionbook->newEntity(), $bookquestion);
                            $this->Questionbook->save($savequestionbook);
                        }
                        // delete from cart
                        $this->Evetofficequestiondetail->deleteAll(['Evetofficequestiondetail.serial_no' => $boxoffdetail['serial_no']]);


                        $TotalAmount = '$' . sprintf('%0.2f', $conversion_rate_amt) . ' TTD';
                        $eventname = ucwords(strtolower($eventdetails['name']));
                        $ticket_name = $boxoffdetail['eventdetail']['title'];
                        $ordersummary .= '<p> <strong style="display: flex;"><span style="width: 60%; display:inline-block;font-size: 14px;font-weight: 400;">' . $eventname . ' (' . $ticket_name . ')</span><span style="width: 10%; display:inline-block;font-weight: 400;font-size: 14px;">:</span><span style="width: 30%; color:#464646; font-size:14px;font-weight: 400;">' . $TotalAmount . '</span></strong></p>';
                        $ordersummarywtsapp .= '%0A %0A' . $eventname . ' (' . $ticket_name . ') ' . $TotalAmount . '  %0A';
                        $this->Eventofficecart->deleteAll(['Eventofficecart.id' => $boxoffdetail['id']]);
                    }
                }
                $Ord = $this->Orders->get($saveorders['id']);
                $Ord->total_amount = $GTAmt;
                $this->Orders->save($Ord);

                // send email to admin and event organiser 
                $requestername = $findemail['name'] . ' ' . $findemail['lname'];
                $url = SITE_URL . 'tickets/myticket';
                $site_url = SITE_URL;
                $paymentType = 'EventOffice';
                $emailtemplate = $this->Templates->find('all')->where(['Templates.id' => 30])->first();
                $from = $emailtemplate['fromemail'];
                $to = $findemail['email'];
                $GrandTotalAmount = '$' . sprintf('%0.2f', $GTAmt) . ' TTD';
                // $cc = $from;
                $subject = $emailtemplate['subject'] . ': ' . $eventname;
                $formats = $emailtemplate['description'];

                $message1 = str_replace(array('{EventName}', '{RequesterName}', '{URL}', '{SITE_URL}', '{PaymentType}', '{TotalAmount}', '{OrderSummary}'), array($eventname, $requestername, $url, $site_url, $paymentType, $GrandTotalAmount, $ordersummary), $formats);
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
                // pr($message);exit;
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: <' . $from . '>' . "\r\n";
                $mail = $this->Email->send($to, $subject, $message);
                // send mail complete 

                // send watsappmessage start 
                // $message = "*Eboxtickets: Payment Complete*%0AHi $requestername,%0A%0AYour payment was received for *" . $boxoffdetail['eventdetail']['title'] . "* ticket.%0ANo payment details were required.%0A%0ARegards,%0A%0AEboxtickets.com";
                $message = "*Eboxtickets: Payment Complete*%0AHi $requestername,%0A%0AYour payment was received for " . $ordersummarywtsapp . " ticket.%0ANo payment details were required.%0A%0ARegards,%0A%0AEboxtickets.com";
                $numwithcode = $findemail['mobile'];
                $this->whatsappmsg($numwithcode, $message);
                // send watsappmessage start 

                $this->Flash->success(__('Ticket booked successfully'));
                return $this->redirect($this->referer());
            } else {
                $findemail = $this->Users->find('all')->where(['Users.id' => $user_id])->first();
                // for print ticket cash 
                $TotalAmount = 0;
                $ordersummary = '';
                $feescal = 0;
                $ordersummarywtsapp = '';

                $orderdata['user_id'] = $user_id;
                $orderdata['total_amount'] = $user_id;
                $orderdata['paymenttype'] = "EventOffice";
                $orderdata['adminfee'] = $admin_user['feeassignment'];
                $orderdata['created'] = $current_datetime;
                $insertdata = $this->Orders->patchEntity($this->Orders->newEntity(), $orderdata);

                if ($saveorders = $this->Orders->save($insertdata)) {

                    foreach ($findcart as $boxoffid => $boxoffdetail) {

                        if ($currenny == 1) {
                            $conversion_rate_amt = $currenny['conversion_rate'] * $boxoffdetail['eventdetail']['price'];
                        } else {
                            $conversion_rate_amt = $boxoffdetail['eventdetail']['price'];
                        }
                        $feescal = $this->cal_percentage($fees, $conversion_rate_amt);
                        $TotalAmount += $conversion_rate_amt + $feescal;
                        // $GTAmt += $boxoffdetail['eventdetail']['price'];

                        $ticketbook['order_id'] = $saveorders->id;
                        $ticketbook['event_id'] =  $boxoffdetail['event_id'];
                        $ticketbook['event_ticket_id'] = $boxoffdetail['ticket_id'];
                        $ticketbook['cust_id'] = $findemail['id'];
                        $ticketbook['ticket_buy'] = 1;
                        $ticketbook['amount'] =  $conversion_rate_amt + $feescal;
                        $ticketbook['currency_rate'] = $currenny['conversion_rate'];
                        $ticketbook['mobile'] =  $findemail['mobile'];
                        $ticketbook['committee_user_id'] = $user_id;
                        $ticketbook['user_desc'] = 'Print ticket from box office';
                        $ticketbook['adminfee'] = $admin_user['feeassignment'];
                        $ticketbook['created'] = $current_datetime;
                        $insertticketbook = $this->Ticket->patchEntity($this->Ticket->newEntity(), $ticketbook);
                        $lastinsetid = $this->Ticket->save($insertticketbook);

                        $ticketdetaildata['tid'] = $lastinsetid['id'];
                        $ticketdetaildata['user_id'] = $findemail['id'];
                        $ticketdetail = $this->Ticketdetail->patchEntity($this->Ticketdetail->newEntity(), $ticketdetaildata);
                        $ticketdetailvvv = $this->Ticketdetail->save($ticketdetail);

                        $Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
                        $Packff->ticket_num = 'T' . $ticketdetailvvv['id'];
                        $ticketdetail = $this->Ticketdetail->save($Packff);

                        $ticketqrimages = $this->qrcodepro($findemail['id'], $ticketdetail['ticket_num'], $eventdetails['event_org_id']);
                        $Pack = $this->Ticketdetail->get($ticketdetail['id']);
                        $Pack->qrcode = $ticketqrimages;
                        $this->Ticketdetail->save($Pack);

                        $questiondetail = $this->Evetofficequestiondetail->find('all')->where(['Evetofficequestiondetail.serial_no' => $boxoffdetail['serial_no']])->toarray();

                        foreach ($questiondetail as $keyid => $questionreply) {
                            $bookquestion['order_id'] = $saveorders->id;
                            $bookquestion['ticketdetail_id'] = $ticketdetail['id'];
                            $bookquestion['question_id'] = $questionreply['question_id'];
                            $bookquestion['event_id'] = $questionreply['event_id'];
                            $bookquestion['user_id'] = $questionreply['user_id'];
                            $bookquestion['user_reply'] = $questionreply['user_reply'];
                            $savequestionbook = $this->Questionbook->patchEntity($this->Questionbook->newEntity(), $bookquestion);
                            $this->Questionbook->save($savequestionbook);
                        }
                        // delete from cart
                        $this->Evetofficequestiondetail->deleteAll(['Evetofficequestiondetail.serial_no' => $boxoffdetail['serial_no']]);
                        $this->Eventofficecart->deleteAll(['Eventofficecart.id' => $boxoffdetail['id']]);
                    }
                    $order_again = $this->Orders->get($saveorders['id']);
                    $order_again->total_amount = $TotalAmount;
                    $this->Orders->save($order_again);
                    $data = base64_encode($id . '/' . $saveorders['id']);
                    // pr($data);exit;
                    // return $this->redirect(['action' => 'summary/' . $data]);
                    return $this->redirect(['controller' => 'eventoffice', 'action' => 'summary', $data]);

                    $this->Flash->success(__('Purchase successful.'));
                }
            }
            $this->Flash->error(__('Something went wrong!.'));
            return $this->redirect($this->referer());
        }
        $this->Flash->error(__('Something went wrong!.'));
        return $this->redirect($this->referer());
    }

    public function qrcodepro($user_id, $name, $event_org_id)
    {
        $dirname = 'temp';
        $PNG_TEMP_DIR = WWW_ROOT . 'qrimages' . DS . $dirname . DS;
        //$PNG_WEB_DIR = 'temp/';
        if (!file_exists($PNG_TEMP_DIR))
            mkdir($PNG_TEMP_DIR);
        $filename = $PNG_TEMP_DIR . 'EBX.png';
        $name = $user_id . "," . $name . "," . $event_org_id;;
        //$name="testddd";
        $errorCorrectionLevel = 'M';
        $matrixPointSize = 4;

        $filename = $PNG_TEMP_DIR . 'EBX' . md5($name . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
        \QRcode::png($name, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        //display generated file
        $qrimagename = basename($filename);
        return $qrimagename;
    }
}
