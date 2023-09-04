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
include(ROOT .DS. "vendor" . DS  . "phpqrcode" . DS . "qrlib.php");

class HomesController extends AppController
{



	public  function _setPassword($password)
	{
		return (new DefaultPasswordHasher)->hash($password);
	}


	public function beforeFilter(Event $event)
	{     

		$this->Auth->allow(['contactus','privacy','mpesaonline','mpesaonlinestatus','index','checkticket','upcomingevent','dashboardmyevent','pastevent','eventdetail','bookticket','loctions','usersearch','upcomingeventsearch','aboutus','contact','faq','mpesacheck','addcomp','viewcomp','findticketdetail']);

	}

public function contactus()
    {

    }
public function privacy()
    {

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

    public function mpesaonline($mobilenew='', $businesscode=''){
/*
 $this->autoRender=false;

$user_mobile=$mobilenew;
$customer_phone =$user_mobile;
$accountno ="test";
$transactiondesc = "Test Payment Transaction";
$amount= '1';
//$business_code= '372222'; 
$business_code= $businesscode;
$curl_post_data = array(
//Fill in the request parameters with valid values
'customer_phone' => ''.$customer_phone.'',
'accountno' => ''.$accountno.'',
'transactiondesc' => ''.$transactiondesc.'',
'amount' => ''.$amount.'',
'business_code' => ''.$business_code.''
     );                            
$data_string = json_encode($curl_post_data);
//echo $data_string; echo "<br>";
$username='MPesaSTK';
$password='STK@2019!#';
$url = 'https://198.154.230.163/~coopself/mpesastkapi/index.php';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_USERPWD, $username . ":" .$password);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // ask for results to De retrained
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
$curl_response =  curl_exec($curl);
$curl_response = strip_tags($curl_response);
$character = json_decode($curl_response);

if($character->CheckoutRequestID){
$check = $this->mpesaonlinestatus($character->CheckoutRequestID,$business_code);
if($check==0){
return false;
}else{
return true;
}
}else{
return false;
}
*/
}
public function mpesaonlinestatus($mobilenew='',$totalamt=''){
	$this->autoRender=false;

	$customer_phone =$mobilenew; 
	$accountno =$mobilenew;
	$transactiondesc = "Flashticket Payment Transaction";
	$amount= $totalamt;
	$business_code= '372222';
	$curl_post_data = array(
 //Fill in the request parameters with valid values
		'customer_phone' => ''.$customer_phone.'',
		'accountno' => ''.$accountno.'',
		'transactiondesc' => ''.$transactiondesc.'',
		'amount' => ''.$amount.'',
		'business_code' => ''.$business_code.''
	);
	$data_string = json_encode($curl_post_data);						
	$username='MPesaSTK';
	$password='STK@2019!#';
	$url = 'http://flashticket.co-opselfservice.com/mpesastkapi/index.php';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($curl, CURLOPT_USERPWD, $username . ":" .$password);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // ask for results to De retrained
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
$curl_response =  curl_exec($curl);
//echo $curl_response; die;
if($curl_response){
	return true;
}else{
	return false;
}

}


public function index(){
	
	$this->loadModel('Event');
	$this->loadModel('Users');
	$date =date("Y-m-d H:i:s");

	$upcoming_event = $this->Event->find('all')->where(['Event.date_to >=' =>$date,'Event.status'=>'Y','Event.featured'=>'Y'])->contain(['Users'])->order(['Event.id' =>'DESC'])->limit('3')->toarray();
	$this->set('event', $upcoming_event);


	$date =date("Y-m-d H:i:s");
	$upcoming_event_details = $this->Event->find('all')->where(['Event.date_to >=' =>$date,'Event.status'=>'Y'])->contain(['Users'])->order(['Event.id' =>'DESC'])->limit('3')->toarray();
	$this->set('eventupcoming', $upcoming_event_details);


	$trem = $this->Users->find('all')->where(['Users.role_id'=>1])->order(['Users.id' =>'DESC'])->first();
	$this->set('trem',$trem);
}

public function checkticket(){


}

public function upcomingevent(){


	$query=$this->request->query['search'];
//pr($query);die;
	$this->set('keyword',$this->request->query['search']);
	$this->loadModel('Event');
	$event = $this->Event->find('all')->where(['Event.name LIKE'=>'%'.$query.'%'])->order(['Event.id' =>'DESC'])->first();
 //pr($event );die;
	$this->set('event', $event);


}

public function eventdetail($id){

	$this->loadModel('Event');
	$this->loadModel('Users');
	$this->loadModel('Eventdetail');
	//pr($id); die;
	$uid = $this->Auth->user('id');
	//pr($uid); die;

	$event_ticket_type= $this->Eventdetail->find('list')->where(['Eventdetail.eventid'=>$id])->order(['Eventdetail.id' => DESC])->toarray();
	//pr($event_ticket_type); die;
		$this->set('event_ticket_type', $event_ticket_type);


	$user_id=$this->request->session()->read('Auth.User.id');
    	//pr($user_id);die;
	if($user_id){
		$userDatas = $this->Users->find('all')->where(['id' => $user_id])->first();
		$this->set('userDatas', $userDatas);
	}

	$event = $this->Event->find('all')->where(['Event.id' =>$id,'Event.status'=>'Y'])->contain(['Users','Eventdetail'])->order(['Event.id'=>'DESC'])->first();
	//pr($event); die;
	$this->set('event', $event);

	
	

	// $evntdetail =  $this->Event->find('all')->contain(['Eventdetail'])->where(['Event.id'=>$id])->order(['Event.id'=>DESC])->first();
	// 	//pr($evntdetail); die;
	// 	$this->set('evntdetail',$evntdetail);

}

public function findticketdetail(){
$this->loadModel('Eventdetail');

$ids=$this->request->data['evntid'];
$ticketid=$this->request->data['id'];
//pr($ids); die;
$event_org = $this->Eventdetail->find('all')->select(['price','quantity'])->where(['Eventdetail.id' =>$ticketid])->first();
$this->set('event_org', $event_org);
			//pr($event_org); die;
			if($event_org){	
				echo json_encode($event_org);
			}
			else{
				$event_org['success']=0;
				echo json_encode($event_org);
			}
			die;

		}


public function seatcheck()
{
	$this->loadModel('Event');

	$eventid= $this->request->data['id'];
	$seatnumber= $this->request->data['seat'];
	$eventseatcheck = $this->Event->find('all')->where(['Event.id' =>$eventid])->order(['Event.id' =>'DESC'])->first();
	if($eventseatcheck['no_of_seats']>=$seatnumber){

		echo 0; die;
	}else{
		echo 1; die;
	}

}

public function myevent()
{
	$this->loadModel('Event');
	$date =date("Y-m-d H:i:s");
	$user_id=$this->request->session()->read('Auth.User.id');
	//pr($date);die;
	$upcoming_event = $this->Event->find('all')->where(['Event.date_from >=' =>$date,'Event.event_org_id'=>$user_id])->contain(['Users'])->order(['Event.id' =>'DESC'])->toarray();
	$this->set('event', $upcoming_event);
	$past_event = $this->Event->find('all')->where(['Event.date_from <' =>$date,'Event.event_org_id'=>$user_id,'Event.status'=>'Y'])->contain(['Users'])->order(['Event.id' =>'DESC'])->toarray();
	$this->set('pastevent', $past_event);

}







public function checkemail(){
	$this->autoRender=false;
	$this->loadModel('Users');
	$name=$this->request->data['name'];
	$email=$this->request->data['email'];
	$phone=$this->request->data['mobile'];


    //pr($check_count); die;
	if(!empty($email))
	{       
		$check_count = $this->Users->find('all')->where(['Users.email LIKE '=>$email])->count();
		echo $check_count; die;
	}
	if(!empty($phone))
	{       
		$check_count = $this->Users->find('all')->where(['Users.mobile LIKE '=>$phone])->count();
		echo $check_count; die;
	}



}



public function postevent($id=null)
{ 

	$this->loadModel('Event');
	$this->loadModel('Users');
	$this->loadModel('Eventdetail');
	$user_id=$this->request->session()->read('Auth.User.id');
	//pr($user_id); die;
$evntdetail = $this->Event->find('all')->contain(['Eventdetail'])->where(['Event.id'=>$id])->order(['Event.id'=>DESC])->first();
		//pr($evntdetail); die;
		$this->set('evntdetail',$evntdetail);

	if(isset($id) && !empty($id))
	{

		$addevent = $this->Event->get($id);
	}
	else
	{

		$addevent = $this->Event->newEntity();
	}

	$this->request->data['name']=ucwords($this->request->data['name']);

	if ($this->request->is(['post', 'put'])) 
	{
		$this->Eventdetail->deleteAll(['Eventdetail.eventid' => $id]); 

			//pr($this->request->data);die;
		$this->request->data['event_org_id']=$user_id;
			//$date_from=str_replace("/","-",$this->request->data['date_from']);
		$this->request->data['date_from']=date('Y-m-d H:i:s',strtotime($this->request->data['date_from']));
			//$date_to=str_replace("/","-",$this->request->data['date_to']);
		$this->request->data['date_to']=date('Y-m-d H:i:s',strtotime($this->request->data['date_to']));
			//pr($this->request->data);die;
		$imagefilename=$this->request->data['feat_image']['name'];
		if($imagefilename){
			$imagefiletype=$this->request->data['feat_image']['type'];
			$item=$this->request->data['feat_image']['tmp_name'];
			$ext=  end(explode('.',$imagefilename));
			$name = md5(time($filename)); 
			$imagename=$name.'.'.$ext; 
			$this->request->data['feat_image']=$imagename;
			if(move_uploaded_file($item,"imagess/".$imagename))
			{                       
				$this->request->data['feat_image']=$imagename;
			}
		}
		else
		{
			$this->request->data['feat_image']=$addevent['feat_image'];
		}

		$addevent = $this->Event->patchEntity($addevent, $this->request->data);

		if ($addevent=$this->Event->save($addevent)) 

			$record_id=$addevent->id;
//echo $record_id; die;
		/*sending email start */

		$this->loadmodel('Templates');
		
		$profile = $this->Templates->find('all')->where(['Templates.id' =>EVENTADD])->first();

		

		$user = $this->Users->find('all')->order(['Users.id' => 'ASC'])->toarray();
//pr($user);die;
		$subject = $profile['subject'];
		$from= $profile['from'];
		$fromname = $profile['fromname'];
		$eventname = $addevent['name'];
		$name =  $this->request->session()->read('Auth.User.name');

		$date = $addevent['date_from'];
		$dates = $addevent['date_to'];
		//pr($date);die;
		$seats = $addevent['no_of_seats'];
		//pr($seats);die;
		$price = $addevent['amount'];
		$address = $addevent['location'];
		//pr($address);die;
		$to = $user[0]['email'];
		$to1 = $this->request->session()->read('Auth.User.email');

//pr($to);die;
		$url=SITE_URL."homes/eventdetail/".$record_id; 
		$formats=$profile['description'];
		$site_url=SITE_URL;
		$message1 = str_replace(array('{EventName}','{Name}','{Date}','{Dates}','{Seats}','{Price}','{Address}','{site_url}','{Url}'), array($eventname,$name,$date,$dates,$seats,$price,$address,$site_url,$url), $formats);
		$message = stripslashes($message1);
//echo $message ; die;
		$message='
		<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Mail</title>
		</head>
		<body style="padding:0px; margin:0px;font-family:Arial,Helvetica,sans-serif; font-size:13px;">
		'.$message1.'
		</body>
		</html>
		';	//die;
		// echo $message; die;
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//$headers .= 'To: <'.$to.'>' . "\r\n";
		$headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";
		$emailcheck= mail($to, $subject, $message, $headers);
		$emailcheck= mail($to1, $subject, $message, $headers);
		/*   sending email end */
		

		{
			$price = $this->request->data['price'];
				//pr($price); die;
		//echo count($price); die;
         for ($i=0; $i < count($price); $i++) { 
         	$pro_details = $this->Eventdetail->newEntity();
              $saveDetail['userid']=$user_id;
         	 $saveDetail['eventid']=$addevent['id']; 
         	$saveDetail['title']=$this->request->data['title'][$i]; 
         	 $saveDetail['price']=$this->request->data['price'][$i]; 
         	$saveDetail['quantity']=$this->request->data['quantity'][$i]; 


         	$event_detail = $this->Eventdetail->patchEntity($pro_details, $saveDetail);
         	//pr($event_detail); die;
			$result=$this->Eventdetail->save($event_detail);
		}


			$this->Flash->success(__(''.$addevent['name'].' has been saved.'),3000);

			return $this->redirect(['action' => 'myevent']);	
		}

	}
	$this->set('addevent', $addevent);

}



public function usersearch(){
	$query=$this->request->query['search'];
//pr($query);die;
	$this->set('keyword',$this->request->query['search']);
	$this->loadModel('Event');
	$event = $this->Event->find('all')->where(['Event.name LIKE'=>'%'.$query.'%'])->order(['Event.id' =>'DESC'])->first();
//pr($event );die;
	$this->set('event', $event);
}


//Event name keyword search in fee report
public function loctions(){


	$this->loadModel('Event');
//pr($this->request->data); die;
//pr($this->request->data); die;
	$stsearch=$this->request->data['fetch'];
//pr($stsearch);die;
	$i=$this->request->data['i'];
	$usest=array('Event.name LIKE'=>$stsearch.'%','Event.status'=>'Y');
	$searchst=$this->Event->find('all',array('conditions'=>$usest));
	foreach($searchst as $value){
		echo '<li onclick="cllbck('."'".$value['name']."'".','."'".$value['id']."'".','."'".$i."'".')"><a href="#">'.$value['name'].'</a></li>';
	}

	die;
}

public function bookticket()
{
	$this->loadModel('Users');
	$this->loadModel('Ticket');
	$this->loadModel('Event');  
	$this->loadModel('Ticketdetail');
	$this->loadModel('Eventdetail');
	if ($this->request->is(['post', 'put'])) {
	//pr($this->request->data); die;
		$user_id=$this->request->session()->read('Auth.User.id');
//pr($user_id); die;
		$ticketid=$this->request->data['event_id'];
 $data_event_qr = $this->Event->find('all')->where(['Event.id' => $ticketid])->first();

		$ticketda = $this->Event->find('all')->where(['Event.id' => $ticketid,'Event.event_org_id'=>$user_id])->first();
//pr($ticketda); die;
		if($ticketda){
			$this->Flash->error(__('Event organiser not able to buy his own event ticket.'));
			return $this->redirect(['controller' => 'homes','action'=>'eventdetail/'.$this->request->data['event_id']]);
		}else{
			$userTable = TableRegistry::get('Users');
			if($user_id==''){
				$customeruser = $this->Users->newEntity();	
				$user_data['name']= $this->request->data['name'];
				$user_data['email']=$this->request->data['email'];
				$user_data['mobile']=$this->request->data['mobile'];
				$user_data['role_id']=CUSTOMERROLE;
				$ranpassword=$this->randomPassword();
				$user_data['confirm_pass']=$ranpassword;
				$user_data['password']= $this->_setPassword($ranpassword);
				$customeruser = $this->Users->patchEntity($customeruser, $user_data);
				/*sending email start */
				$this->loadmodel('Templates');
				$profile = $this->Templates->find('all')->where(['Templates.id' =>ORGANISER])->first();
				$subject = $profile['subject'];
				$from= $profile['from'];
				$fromname = $profile['fromname'];
				$name = $customeruser['name'];
				$email = $customeruser['email'];
				$password = $customeruser['confirm_pass'];
				$to  = $email;
				$formats=$profile['description'];
				$site_url=SITE_URL;
				$message1 = str_replace(array('{Name}','{Email}','{Password}','{site_url}','{Useractivation}'), array($name,$email,$password,$site_url), $formats);
				$message = stripslashes($message1);
				$message='
				<!DOCTYPE HTML>
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<title>Mail</title>
				</head>
				<body style="padding:0px; margin:0px;font-family:Arial,Helvetica,sans-serif; font-size:13px;">
				'.$message1.'
				</body>
				</html>
				';	
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";
				$emailcheck= mail($to, $subject, $message, $headers);
				/*   sending email end */
				$customeruser=$this->Users->save($customeruser);
				$profess = $this->Users->find('all')->where(['id' =>$customeruser['id']])->first(); 
				//pr($profess); die;
				$this->Auth->setUser($profess);


			}else{
				$user_id=$this->request->session()->read('Auth.User.id');
				$profess = $this->Users->find('all')->where(['id' =>$user_id])->first(); 
			}
/*
if($this->request->data['mobile']){
$user_mobile = $this->request->data['mobile'];
//$user_mobile = "254721491491";
}else{
//$user_mobile = "254721491491";
$user_mobile=$this->request->session()->read('Auth.User.mobile');
}
$chekc = $this->mpesaonlinestatus($user_mobile,$this->request->data['totalamt']);

*/


		//$connection = ConnectionManager::get('db2'); 
		//$connectmpesa =$connection->execute("SELECT count(*) as res, amount FROM `transactions_573314` WHERE MPESA_REF_ID='".$this->request->data['code']."'")->fetch('assoc');
if($profess){	
	$this->loadModel('Payment');
	$paymentnew = $this->Payment->newEntity();
	$amount=$eve['amount'] * $quantity;
	$fn['user_id']=$profess['id'];
	$fn['event_id']=$this->request->data['event_id'];
	$fn['mpesa']=$this->request->data['code'];
	$fn['amount']=$connectmpesa['amount'];
	$payment = $this->Payment->patchEntity($paymentnew,$fn);
	$payment = $this->Payment->save($payment);

				//pr($this->request->data); die;
	$ticketbook = $this->Ticket->newEntity();
	$customerdata = $this->Users->find('all')->where(['id' =>$setuserdata])->first();
	//pr($customerdata); die;
	$romm=$this->request->data['ticket_buy'];
	$this->request->data['cust_id']= $profess['id'];
	$this->request->data['event_id']=$this->request->data['event_id'];
	$this->request->data['ticket_buy']=$this->request->data['ticket_buy'];
	$this->request->data['amount']=$this->request->data['totalamt'];
	$ticketbook = $this->Ticket->patchEntity($ticketbook, $this->request->data);
	$ticketbook=$this->Ticket->save($ticketbook);
	$lastticketid=$ticketbook->id;  
	if($ticketbook){
		for($i=1;$i<=$romm;$i++)
		{
			$ticketdetail = $this->Ticketdetail->newEntity();
			$ticketdata = $this->Ticket->find('all')->where(['id' => $lastticketid])->first();
			$this->request->data['tid']= $ticketdata['id'];
			$this->request->data['user_id']=$this->request->data['cust_id'];
			$ticketdetail = $this->Ticketdetail->patchEntity($ticketdetail, $this->request->data);
			$ticketdetailvvv=$this->Ticketdetail->save($ticketdetail);
			$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
			$Packff->ticket_num = 'T'.$ticketdetailvvv['id'];
			$ticketdetail =$this->Ticketdetail->save($Packff);
			$ticketqrimages = $this->qrcodepro($this->request->data['cust_id'],$ticketdetail['ticket_num'],$data_event_qr['event_org_id']);	
			$Pack = $this->Ticketdetail->get($ticketdetail['id']);
			$Pack->qrcode = $ticketqrimages;
			$this->Ticketdetail->save($Pack);
		}         		
		$event = $this->Event->find('all')->where(['Event.id'=>$this->request->data['event_id']])->contain(['Users'])->order(['Event.id' =>'DESC'])->first();
		$date=$event['date_from'];
		$dates=$event['date_to'];
		$user=$this->request->session()->read('Auth.User.name');
		$name=$event['name'];
		$quantity=$ticketcustomer['ticket_buy'];
		$totale=$ticketdetailvvv['totalamt'];
		$location=$event['location'];
		$password=$ranpassword;
		$this->loadmodel('Templates');
		$profile = $this->Templates->find('all')->where(['Templates.id' =>PURCHASE])->first();
		$subject = $profile['subject'];
		$from= $profile['from'];
		$fromname = $profile['fromname'];
		$to  = $this->request->session()->read('Auth.User.email');
		$formats=$profile['description'];
		$site_url=SITE_URL;
		$message1 = str_replace(array('{User}','{Name}','{Date}','{Dates}','{Totale}','{Quantity}','{Location}','{Password}','{site_url}'), array($user,$name,$date,$dates,$totale,$quantity,$location,$password,$site_url), $formats);
		$message = stripslashes($message1);
		$message='
		<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Mail</title>
		</head>
		<body style="padding:0px; margin:0px;font-family:Arial,Helvetica,sans-serif; font-size:13px;">
		'.$message1.'
		</body>
		</html>
		';	
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";
		$emailcheck= mail($to, $subject, $message, $headers);
	}

	$mobile = $this->request->data['mobile'];
	$customer_phone = '254'.substr($mobile, 1);
	$transactiondesc = "Flashticket Payment Transaction";
	$amount= $this->request->data['totalamt'];
	$business_code= '372222';

	$curl_post_data = array(
						  //Fill in the request parameters with valid values
		'customer_phone' => ''.$customer_phone.'',
		'accountno' => ''.$mobile.'',
		'transactiondesc' => ''.$transactiondesc.'',
		'amount' => ''.$amount.'',
		'business_code' => ''.$business_code.''
	);

	$data_string = json_encode($curl_post_data);
						//echo $data_string; echo "<br>";

	$username="MPesaSTK";
	$password="STK@2019!#";	 
	$url = 'https://198.154.230.163/~coopself/mpesastkapi/index.php';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ask for results to be returned
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
						$curl_response = curl_exec($curl);
						
						$tt = "#event_tkt_dtl";

						$this->Flash->success(__('Your request to pay KES'.$this->request->data['totalamt'].' for FlashTicket event for '.$this->request->data['name'].' has been successfully received. You will be taken to MPESA Shortly on your phone'));    
						return $this->redirect(['controller' => 'tickets','action'=>'myticket']);
		   //return $this->redirect(['controller' => 'tickets','action'=>'myticket/'.$this->request->data['event_id']]);			

					}else{
						$this->Flash->error(__('Sorry your ticket not booked Check Mpesa !!!'));
						return $this->redirect(['controller' => 'homes','action'=>'eventdetail/'.$this->request->data['event_id']]);
					}




				}
			}

		}

		public function mpesacheck()
		{
			$connection = ConnectionManager::get('db2'); 
			$connectmpesa =$connection->execute("SELECT count(*) as res, amount FROM `transactions_573314` WHERE MPESA_REF_ID='".$this->request->data['mpesa']."'")->fetch('assoc');
			$this->loadModel('Payment');


			if($connectmpesa['res'] > 0){
				$customerdata = $this->Payment->find('all')->where(['Payment.mpesa' =>$this->request->data['mpesa']])->first();

				if($customerdata){
					echo "4"; die;
				}else{
					echo "7"; die;
				}


			}else{
				echo "0"; die;
			}



		}

		public function randomPassword() {
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 6; $i++) {
	    	$n = rand(0, $alphaLength);
	    	$pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	} 	
//view sold tickets..
public function viewsold($id=null){

		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Event');  
		$this->loadModel('Ticketdetail');
	//pr($this->request->data); die;
		$user_id=$this->request->session()->read('Auth.User.id');

		$comptickets = $this->Ticket->find('all')->contain(['Ticketdetail','Users'])->where(['Ticket.event_id'=>$id,'Ticket.event_admin'=>'0'])->toarray();
		//pr($comptickets); die;
		$this->set('comptickets', $comptickets);
	
}


// View Complementary user ticket...
	public function viewcomp($id=null){

		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Event');  
		$this->loadModel('Ticketdetail');
	//pr($this->request->data); die;
		$user_id=$this->request->session()->read('Auth.User.id');

		$comptickets = $this->Ticket->find('all')->contain(['Ticketdetail','Users'])->where(['Ticket.event_id'=>$id,'Ticket.event_admin'=>'1'])->order(['Ticket.id'=>DESC])->toarray();
		//pr($comptickets); die;
		$this->set('comptickets', $comptickets);
	
}




// Add Complementary user ticket...
	public function addcomp($id=null){
		$this->loadModel('Users');
		$this->loadModel('Ticket');
		$this->loadModel('Event');  
		$this->loadModel('Ticketdetail');
		if ($this->request->is(['post', 'put'])) {
	//pr($this->request->data); die;
			$user_id=$this->request->session()->read('Auth.User.id');
//pr($user_id); die;

$data_event_qr = $this->Event->find('all')->where(['Event.id' => $id])->first();
			$ticketda = $this->Event->find('all')->where(['Event.id' => $id])->first();
			$ticketdata = $this->Ticket->find('all')->where(['event_id'=>$id,'mobile' =>$this->request->data['mobile']])->first();
			

			$existsuser = $this->Users->find('all')->where(['mobile' =>$this->request->data['mobile']])->first();
			if ($ticketdata) {
				$this->Flash->error(__('Ticket already share to this user'));
				return $this->redirect(['action' => 'myevent']);
			}else{
				if($existsuser==''){
$existsuseremailid = $this->Users->find('all')->where(['email'=>$this->request->data['email']])->count();
					if ($existsuseremailid > 0) {
						$this->Flash->error(__('Email id or mobile number already exists'));
						return $this->redirect(['action' => 'myevent']);
					}
					$customeruser = $this->Users->newEntity();	
					$user_data['name']= $this->request->data['name'];
					$user_data['email']=$this->request->data['email'];
					$user_data['mobile']=$this->request->data['mobile'];
					$user_data['role_id']=CUSTOMERROLE;
					$ranpassword=$this->randomPassword();
					$user_data['confirm_pass']=$ranpassword;
					$user_data['password']= $this->_setPassword($ranpassword);
					$customeruser = $this->Users->patchEntity($customeruser, $user_data);
					/*sending email start */
					$this->loadmodel('Templates');
					$profile = $this->Templates->find('all')->where(['Templates.id' =>ORGANISER])->first();
					$subject = $profile['subject'];
					$from= $profile['from'];
					$fromname = $profile['fromname'];
					$name = $customeruser['name'];
					$email = $customeruser['email'];
					$password = $customeruser['confirm_pass'];
					$to  = $email;
					$formats=$profile['description'];
					$site_url=SITE_URL;
					$message1 = str_replace(array('{Name}','{Email}','{Password}','{site_url}','{Useractivation}'), array($name,$email,$password,$site_url), $formats);
					$message = stripslashes($message1);
					$message='
					<!DOCTYPE HTML>
					<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title>Mail</title>
					</head>
					<body style="padding:0px; margin:0px;font-family:Arial,Helvetica,sans-serif; font-size:13px;">
					'.$message1.'
					</body>
					</html>
					';	
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";
					$emailcheck= mail($to, $subject, $message, $headers);
					/*   sending email end */
					$customeruser=$this->Users->save($customeruser);
					$profess = $this->Users->find('all')->where(['id' =>$customeruser['id']])->first(); 
					


				}else{
					
					$profess = $this->Users->find('all')->where(['id' =>$existsuser['id']])->first(); 
				}

				if($profess){	
					

				//pr($this->request->data); die;
					$ticketbook = $this->Ticket->newEntity();
					$customerdata = $this->Users->find('all')->where(['id' =>$setuserdata])->first();
					
					$this->request->data['cust_id']= $profess['id'];
					$this->request->data['event_id']=$id;
					$this->request->data['event_admin']=1;
					$ticketbook = $this->Ticket->patchEntity($ticketbook, $this->request->data);
					$ticketbook=$this->Ticket->save($ticketbook);
					$lastticketid=$ticketbook->id;

					if($ticketbook){
						
						$ticketdetail = $this->Ticketdetail->newEntity();
						$ticketdata = $this->Ticket->find('all')->where(['id' => $lastticketid])->first();
						$this->request->data['tid']= $ticketdata['id'];
						$this->request->data['user_id']=$this->request->data['cust_id'];

						$ticketdetail = $this->Ticketdetail->patchEntity($ticketdetail, $this->request->data);
						$ticketdetailvvv=$this->Ticketdetail->save($ticketdetail);

						$Packff = $this->Ticketdetail->get($ticketdetailvvv['id']);
						$Packff->ticket_num = 'T'.$ticketdetailvvv['id'];
						$ticketdetail =$this->Ticketdetail->save($Packff);
						$ticketqrimages = $this->qrcodepro($this->request->data['cust_id'],$ticketdetail['ticket_num'],$data_event_qr['event_org_id']);	
						$Pack = $this->Ticketdetail->get($ticketdetail['id']);
						$Pack->qrcode = $ticketqrimages;
						$this->Ticketdetail->save($Pack);
						

						$event = $this->Event->find('all')->where(['Event.id'=>$this->request->data['event_id']])->contain(['Users'])->order(['Event.id' =>'DESC'])->first();
						$date=$event['date_from'];
						$dates=$event['date_to'];
						$user=$this->request->session()->read('Auth.User.name');
						$name=$event['name'];
						$quantity=$ticketcustomer['ticket_buy'];
						$totale=$ticketdetailvvv['totalamt'];
						$location=$event['location'];
						$password=$ranpassword;
						$this->loadmodel('Templates');
						$profile = $this->Templates->find('all')->where(['Templates.id' =>TICKETCOMPLI])->first();
						$subject = $profile['subject'];
						$from= $profile['from'];
						$fromname = $profile['fromname'];
						$to  = $this->request->data['email'];
						$formats=$profile['description'];
						$site_url=SITE_URL;
						$message1 = str_replace(array('{User}','{Name}','{Date}','{Dates}','{Totale}','{Quantity}','{Location}','{Password}','{site_url}'), array($user,$name,$date,$dates,$totale,$quantity,$location,$password,$site_url), $formats);
						$message = stripslashes($message1);
						$message='
						<!DOCTYPE HTML>
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<title>Mail</title>
						</head>
						<body style="padding:0px; margin:0px;font-family:Arial,Helvetica,sans-serif; font-size:13px;">
						'.$message1.'
						</body>
						</html>
						';	
						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";
						$emailcheck= mail($to, $subject, $message, $headers);
					}

					$this->Flash->success(__('Complementary ticket has been shared'));    
					return $this->redirect(['action' => 'myevent']);	
		   //return $this->redirect(['controller' => 'tickets','action'=>'myticket/'.$this->request->data['event_id']]);			

				}else{
					$this->Flash->error(__('Sorry your ticket not booked Check Mpesa !!!'));
					return $this->redirect(['action' => 'index']);
				}
			}

		}

	}











	public function qrcodepro($user_id,$name,$event_org_id)
	{
		$dirname = 'temp';
		$PNG_TEMP_DIR = WWW_ROOT . 'qrimages' . DS . $dirname . DS;
		//$PNG_WEB_DIR = 'temp/';
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);
		$filename = $PNG_TEMP_DIR.'test.png';
		$name=$user_id.",".$name.",".$event_org_id;
		$errorCorrectionLevel = 'M';
		$matrixPointSize = 4;
		
		$filename = $PNG_TEMP_DIR.'test'.md5($name.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
		\QRcode::png( $name, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
		//display generated file
		$qrimagename = basename($filename);  
		return $qrimagename;


		
	}



	public function aboutus()					
	{

		$this->loadModel('Static');
		$static = $this->Static->find('all')->order(['Static.id' => 'DESC'])->toarray();
	 	//pr($static); die;
		$this->set('static', $static);
	}



	public function contact()					
	{
		$this->loadModel('Static');
		$static = $this->Static->find('all')->order(['Static.id' => 'DESC'])->toarray();
	//pr($static); die;
		$this->set('static', $static);
	}


	public function faq()					
	{
		$this->loadModel('Static');
		$static = $this->Static->find('all')->order(['Static.id' => 'DESC'])->toarray();
		 	//pr($static); die;
		$this->set('static', $static);
	}








}
