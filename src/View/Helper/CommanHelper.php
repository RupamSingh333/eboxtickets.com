<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\ORM\TableRegistry;

class CommanHelper extends Helper
{
    // initialize() hook is available since 3.2. For prior versions you can
    // override the constructor if required.
    public function initialize(array $config)
    {
    }
    public function course()
    {

        $articles = TableRegistry::get('Course');

        return $articles->find('all')->where(['Course.status' => 'Y'])->toArray();
    }

    public function city()
    {

        $articles = TableRegistry::get('City');

        return $articles->find('all')->where(['City.status' => 'Y'])->toArray();
    }

    public function meta($url)
    {

        $articles = TableRegistry::get('Seo');
        return $articles->find('all')->where(['Seo.pagelocation' => $url])->first();
        //return $articles->find('all')->where(['Seo.pagelocation' =>$url])->first()->toArray();

    }


    public function admindetail()
    {

        $articles = TableRegistry::get('Users');
        return $articles->find('all')->where(['Users.id' => 1])->first()->toArray();
    }

    public function finduser($id = null)
    {
        $articles = TableRegistry::get('Users');
        return $articles->find('all')->where(['Users.id' => $id])->first();
    }

    public function totalseatbook($id = null)
    {
        // pr($id);die;
        $articles = TableRegistry::get('Ticket');
        return $articles->find('all')->Select(['ticketsold' => 'SUM(ticket_buy)'])->where(['Ticket.event_ticket_id' => $id])->first();
    }

    public function chechguest($cust_id = null, $event_id = null)
    {
        $articles = TableRegistry::get('Ticket');
        $check =  $articles->find('all')->Select(['ticketcount' => 'SUM(ticket_buy)'])->where(['Ticket.cust_id' => $cust_id, 'Ticket.event_id' => $event_id])->first();
        return $res = ($check['ticketcount'] == 1) ? 'N' : 'Y';
        // pr($res);exit;
    }


    public function ticketcount_event($order_id = null, $event_id = null)
    {
        //pr($id);die;
        $articles = TableRegistry::get('Ticket');

        return $articles->find('all')->Select(['ticketsold' => 'SUM(ticket_buy)'])->where(['Ticket.event_id' => $event_id, 'Ticket.order_id' => $order_id])->toArray();
    }

    public function sharedticket($id = null)
    {
        //pr($id);die;
        $articles = TableRegistry::get('Ticketshare');
        return $articles->find('all')->where(['Ticketshare.ticket_num' => $id])->toArray();
    }

    public function ticketsalecount($id = null, $ticket_id = null)
    {
        //pr($id);die;
        //  echo $ticket_id;
        $articles = TableRegistry::get('Ticket');
        return $articles->find('all')->Select(['ticketsold' => 'SUM(ticket_buy)'])->where(['Ticket.event_id' => $id, 'Ticket.event_ticket_id' => $ticket_id])->first();
    }
    public function ticketsalecount_committee($event_id = null, $ticket_id = null)
    {
        // pr($event_id);
        //  echo $ticket_id;die;
        $user_id = $this->request->session()->read('Auth.User.id');
        $articles = TableRegistry::get('Ticket');
        $ticket_total_sold =  $articles->find('all')->Select(['ticketsold' => 'SUM(ticket_buy)'])->where(['Ticket.event_id' => $event_id, 'Ticket.event_ticket_id' => $ticket_id, 'Ticket.committee_user_id' => $user_id])->first();


        $articlesdd = TableRegistry::get('Cart');
        $cart_total_sold  = $articlesdd->find('all')->Select(['no_tickets' => 'SUM(no_tickets)'])->where(['Cart.commitee_user_id' => $user_id, 'Cart.event_id' => $id, 'Cart.status' => 'Y', 'Cart.ticket_type' => 'committesale', 'Cart.ticket_id' => $ticket_id])->first();
        $total_sold_ticket =   $ticket_total_sold['ticketsold'] +  $cart_total_sold['no_tickets'];
        return $total_sold_ticket;
    }

    public function complimentary($id = null)
    {
        //pr($id);die;
        $articles = TableRegistry::get('Ticketdetail');
        return $articles->find('all')->where(['Ticketdetail.tid' => $id])->first();
    }

    public function getAddons($event_id)
    {
        $articles = TableRegistry::get('Addons');
        return $articles->find('all')->where(['event_id' => $event_id, 'hidden' => 'N'])->first();
    }

    public function getAddongroup($event_id)
    {
        $articles = TableRegistry::get('Addons');
        return $articles->find('all')->where(['event_id' => $event_id, 'hidden' => 'N'])->toarray();
    }

    public function cart_addons($user_id = null)
    {
        $articles = TableRegistry::get('Cartaddons');
        return $articles->find('all')->contain(['Addons'])->where(['Cartaddons.user_id' => $user_id, 'Addons.hidden' => 'N'])->toarray();
    }

    public function eventfind($month = null, $eventsearch = null)
    {
        // echo $month; //die;
        $date = date("Y-m-d");
        $articles = TableRegistry::get('Event');
        return $articles->find('all')->contain(['Countries', 'Company'])->where(['Event.date_to >=' => $date, 'MONTH(date_to)' => $month, 'Event.name LIKE' => '%' . trim($eventsearch) . '%', 'Event.status' => 'Y', 'Event.admineventstatus' => 'Y'])->order(['Event.date_from' => 'ASC'])->toarray();
    }

    public function findeventdetail($id = null)
    {
        // pr($id); die;
        $articles = TableRegistry::get('Event');
        return $articles->find('all')->contain(['Eventdetail', 'Currency'])->where(['Event.id' => $id])->first();
    }

    public function eventfindsearch($month = null, $searchquery = null)
    {
        // echo $month; //die;
        $articles = TableRegistry::get('Event');
        return $articles->find('all')->contain(['Countries', 'Company'])->where(['Event.name LIKE' => '%' . trim($searchquery) . '%', 'MONTH(date_to)' => $month, 'Event.status' => 'Y', 'Event.admineventstatus' => 'Y'])->order(['Event.date_from' => 'ASC'])->toarray();
    }

    public function findquestion($event_id = null, $ticket_type_id = null)
    {
        $articles = TableRegistry::get('Question');
        return $articles->find('all')->where(['Question.event_id' => $event_id, 'FIND_IN_SET(\'' . $ticket_type_id . '\',Question.ticket_type_id)'])->toArray();
    }

    public function findquestionitems($question_id = null)
    {
        // echo $question_id;
        $articles = TableRegistry::get('Questionitems');
        return $articles->find('all')->where(['Questionitems.question_id' => $question_id])->toArray();
    }

    public function findcommittee($event_id = null, $ticket_type_id = null)
    {
        $articles = TableRegistry::get('Eventdetail');
        return $articles->find('all')->where(['Eventdetail.eventid' => $event_id, 'Eventdetail.type' => 'committee_sales'])->first();
    }

    public function ticketdetails($ticket_id = null)
    {
        $articles = TableRegistry::get('Eventdetail');
        return $articles->find('all')->where(['Eventdetail.id' => $ticket_id])->first();
    }

    public function questionitems($event_id = null)
    {
        $articles = TableRegistry::get('Questionitems');
        return $articles->find('all')->where(['Questionitems.question_id' => $event_id])->toarray();
    }

    // find group member in the specified group 
    public function groupmembers($id = null)
    {
        $articles = TableRegistry::get('Groupmember');
        return $articles->find('all')->contain(['Users'])->where(['Groupmember.group_id' => $id])->toarray();
    }

    public function findticketdetails($user_id = null, $ticket_id = null, $group_id = null, $event_id = null)
    {
        $articles = TableRegistry::get('Committeeassignticket');
        return $articles->find('all')->where(['Committeeassignticket.ticket_id' => $ticket_id, 'Committeeassignticket.user_id' => $user_id, 'Committeeassignticket.group_id' => $group_id, 'Committeeassignticket.event_id' => $event_id])->first();
    }
    public function committee_assigned_ticket()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $articles = TableRegistry::get('Committeeassignticket');
        return $articles->find('all')->where(['Committeeassignticket.user_id' => $user_id])->first();
    }

    public function ticketcount($event_id = null, $ticket_type_id = null)
    {
        $articles = TableRegistry::get('Committeeassignticket');

        return $articles->find('all')->select(['sum' => 'SUM(Committeeassignticket.count)'])->where(['Committeeassignticket.event_id' => $event_id, 'Committeeassignticket.ticket_id' => $ticket_type_id])->toarray();
    }

    public function ticketeventofficecount($user_id = null, $ticket_id = null)
    {
        $articles = TableRegistry::get('Eventofficecart');
        return $articles->find('all')->where(['Eventofficecart.user_id' => $user_id, 'Eventofficecart.ticket_id' => $ticket_id])->count();
    }

    public function findcartcount($user_id = null, $event_id = null)
    {
        $articles = TableRegistry::get('Cart');

        if (!empty($user_id) && !empty($event_id)) {

            return $articles->find('all')->where(['Cart.user_id' => $user_id, 'Cart.event_id' => $event_id])->count();
        } else {

            return $articles->find('all')->where(['Cart.user_id' => $user_id, 'Cart.status' => 'Y'])->count();
        }
    }


    public function countreq($user_id = null)
    {
        $articles = TableRegistry::get('Cart');
        return $articles->find('all')->contain(['Event', 'Eventdetail', 'Users'])->where(['Cart.commitee_user_id' => $user_id, 'Cart.ticket_type' => 'committesale'])->order(['Cart.user_id' => 'ASC'])->count();
    }
    public function finduserusingid($user_id = null)
    {
        $articles = TableRegistry::get('Users');
        return $articles->find('all')->where(['Users.id' => $user_id])->first();
    }
    public function ticketquestion($ticket_detail_id = null, $order_id = null)
    {
        $articles = TableRegistry::get('Questionbook');
        return $articles->find('all')->where(['Questionbook.ticketdetail_id' => $ticket_detail_id, 'Questionbook.order_id' => $order_id])->contain(['Question'])->toarray();
    }

    public function addonsale($addon_id = null)
    {
        // echo $addon_id;
        $articles = TableRegistry::get('Addonsbook');
        return $articles->find('all')->where(['Addonsbook.addons_id' => $addon_id])->toarray();
    }
    
    public function getPackageDetails($packageId = null)
    {

        $articles = TableRegistry::get('Packagedetails');
        return $articles->find('all')
            ->where(['Packagedetails.addon_id IS NOT' => null, 'Packagedetails.package_id' => $packageId])
            ->contain(['Addons'])
            ->toarray();
    }

    public function packageDetails($packageId = null)
    {
        $articles = TableRegistry::get('Package');
        return $articles->find('all')
            ->contain([
                'Packagedetails' => 'Eventdetail'
            ])
            ->where([
                'Package.id' => $packageId
            ])
            ->first();
    }

    public function packagesalecount($packageId = null)
    {
        $articles = TableRegistry::get('Orders');
        return $articles->find('all')->where(['Orders.package_id' => $packageId])->count();
    }

    public function complimentary_assigned_tickets($event_id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        //echo $event_id; die;
        $articles = TableRegistry::get('Committeeassignticket');

        return $articles->find('all')->where(['Committeeassignticket.user_id' => $user_id, 'Committeeassignticket.event_id' => $event_id, 'Committeeassignticket.ticket_id' => 0])->first();
    }
    public function checkeventoffice($event_id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $articles = TableRegistry::get('Committe');
        return $articles->find('all')->where(['Committe.user_id' => $user_id, 'Committe.event_id' => $event_id])->first();
    }

    public function complimentary_assigned_ticketssold($event_id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $articles = TableRegistry::get('Ticket');
        //echo "test"; die;
        return $articles->find('all')->Select(['ticketsold' => 'SUM(ticket_buy)'])->where(['Ticket.committee_user_id' => $user_id, 'Ticket.event_id' => $event_id, 'Ticket.event_ticket_id' => 0])->first();
    }

    public function committee_assigned()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        //pending
        $articles = TableRegistry::get('Cart');
        $articles_ticket = TableRegistry::get('Ticket');

        $cart_data_pending = $articles->find('all')->where(['Cart.commitee_user_id' => $user_id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'N'])->order(['Cart.user_id' => 'ASC'])->count();

        //Approved
        $cart_data_approved = $articles->find('all')->where(['Cart.commitee_user_id' => $user_id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'Y'])->order(['Cart.user_id' => 'ASC'])->count();

        //ignored
        $cart_data_ignored = $articles->find('all')->where(['Cart.commitee_user_id' => $user_id, 'Cart.ticket_type' => 'committesale', 'Cart.status' => 'I'])->order(['Cart.user_id' => 'ASC'])->count();

        //complete
        $cart_data_complete = $articles_ticket->find('all')->where(['Ticket.committee_user_id' => $user_id, 'Ticket.status' => 'Y'])->order(['Ticket.id' => 'ASC'])->count();

        $committee_assigned['cart_data_pending'] = $cart_data_pending;
        $committee_assigned['cart_data_approved'] = $cart_data_approved;
        $committee_assigned['cart_data_ignored'] = $cart_data_ignored;
        $committee_assigned['cart_data_complete'] = $cart_data_complete;
        return $committee_assigned;
    }

    public function getallevents()
    {
        // echo $month; //die;
        $articles = TableRegistry::get('Event');
        $user_id = $this->request->session()->read('Auth.User.id');
        return $articles->find('all')->contain(['Eventdetail'])->where(['event_org_id' => $user_id])->order(['Event.id' => 'DESC'])->limit('10')->toarray();
    }
    public function singleeventdetail($event_id = null)
    {
        // echo $month; //die;
        $articles = TableRegistry::get('Event');
        $user_id = $this->request->session()->read('Auth.User.id');
        return $articles->find('all')->contain(['Eventdetail'])->where(['event_org_id' => $user_id, 'id' => $event_id])->first();
    }

    public function getScannerName($id = null)
    {
        // pr($id);exit;
        $articles = TableRegistry::get('Users');
        return $articles->find('all')->where(['id' => $id])->first();
    }

    public function calculatepayment($id = null)
    {
        $articles = TableRegistry::get('Ticket');
        $totalAmount = $articles->find()
            ->select(['totalAmount' => 'SUM(Ticket.amount)'])
            ->where(['Ticket.event_id' => $id])
            ->first()
            ->totalAmount;

        return $totalAmount;
    }
    //pr($id);die;
    //  $articles = TableRegistry::get('Ticket');
    //  return $articles->find('all')->Select(['ticketsold' => 'SUM(ticket_buy)'])->where(['Ticket.event_id' => $id])->toArray();
}
