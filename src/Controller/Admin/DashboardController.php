<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;
use \DateTime;

class DashboardController extends AppController
{
	//$this->loadcomponent('Session');
	public function initialize()
	{
		//load all models
		parent::initialize();
	}

	public function index()
	{
		$this->viewBuilder()->layout('admin');
		$this->loadModel('Users');
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Ticketdetail');
		$this->loadModel('Orders');

		//get totalcustomer list...
		$totalcustomer = $this->Users->find('all')->where(['Users.role_id' => CUSTOMERROLE])->count();

		$totaldisablecustomer = $this->Users->find('all')->where(['Users.role_id' => CUSTOMERROLE, 'Users.status' => 'N'])->count();


		//get totalorganiser list...
		$totalorganiser = $this->Users->find('all')->where(['Users.role_id' => ORGANISERROLE])->count();
		$totaldisableorganiser = $this->Users->find('all')->where(['Users.role_id' => ORGANISERROLE, 'Users.status' => 'N'])->count();

		//get totalevent list...
		$totalevent = $this->Event->find('all')->count();
		$totaldisableevent = $this->Event->find('all')->where(['Event.status' => 'N'])->count();

		// Total sales 
		$totalticket_sale_payment = $this->Orders->find('all')->contain(['Ticket'])->select(['totalSaleAmount' => 'SUM(Orders.total_amount)'])->where(['Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Online'], 'Orders.total_amount !=' => 0])->toarray();
		// pr($totalticket_sale_payment);exit;

		// pr($totalticket_sale_payment[0]['totalSaleAmount']);die;

		// $query = $this->Ticket->find()->where(['amount !=' => 0, 'Orders.paymenttype IN' => ['Cash', 'EventOffice']])->contain(['Orders']);
		// $totalsales = $query->toArray();
		// $Totalticketsalesamounts = $query->sumOf('amount');

		// Total Earning
		$totalearning = $this->Orders->find('all')->contain(['Ticket'])->select(['totalSaleAmount' => 'SUM(Orders.total_amount)'])->where(['Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Online'], 'Orders.total_amount !=' => 0])->toarray();


		$orders = $this->Orders->find('all')
			->contain(['Ticket'])
			->select(['total_amount', 'adminfee', 'paymenttype'])
			->where([
				'Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Online'],
				'Orders.total_amount !=' => 0
			])
			->order(['Orders.id' => 'DESC'])
			->toArray();

		$totalEarnings = 0;

		foreach ($orders as $order) {
			$totalEarnings += ($order['total_amount'] * $order['adminfee'] / 100);
			// pr($totalEarnings);exit;
		}


		// Payment Method Chart
		$paymenttypewithSalepercentage = $this->Orders->find('all')
			->contain(['Ticket'])
			->select(['total_amount' => 'SUM(total_amount)','paymenttype','adminfee'])
			->where(['Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Online'], 'Orders.total_amount !=' => 0])
			->group('Orders.paymenttype')
			// ->group('date')
			->order(['Orders.id' => 'DESC'])
			->toArray();

		$payment_data = [];
		$completeEarnings = 0;
		foreach ($paymenttypewithSalepercentage as $key => $value) {
			// pr($value);exit;
			// $completeEarnings += ($value['total_amount'] * $value['adminfee'] / 100);
			$payment_data[] = [
				'paymenttype' => $value['paymenttype'],
				'amounts' => sprintf('%.2f',$value['total_amount'])
			];
		}
		// Add the total earnings data to the payment type array
		$payment_data[] = ['paymenttype' => 'Earnings','amounts' => $totalEarnings];



		// Payment Chart
		$dates_data_all = array();
		$orders_data = $this->Orders->find()
			->contain(['Ticket'])
			->select(['date' => 'DATE(created)', 'total_amount' => 'SUM(total_amount)', 'adminfee'])
			->where(['paymenttype IN' => ['Cash', 'EventOffice', 'Online'], 'Date(created) >=' => date('Y-m-d', strtotime('-8 days')), 'Date(created) <=' => date('Y-m-d')])
			->group('date')
			->toArray();
		// pr($orders_data);exit;

		$current = strtotime('-8 days');
		$date2 = strtotime('now');
		$stepVal = '+1 day';
		$format = 'd-m-Y';
		$totalsale = 0;
		$totalEarningsuponsales = 0;
		while ($current <= $date2) {
			$current_date = date('Y-m-d', $current);
			$total_amount = 0;

			// Check if there is data for the current date
			foreach ($orders_data as $order) {
				if ($order->date == $current_date) {
					$totalEarningsuponsales += ($order['total_amount'] * $order['adminfee'] / 100);
					$total_amount = $order->total_amount;
					break;
				}
			}

			$dates_data_all[] = [
				'date' => $current * 1000,
				'value' => $total_amount
			];
			$totalsale += $total_amount;
			$current = strtotime($stepVal, $current);
		}

		// Sort the dates_data_all array by date in ascending order
		usort($dates_data_all, function ($a, $b) {
			return $a['date'] <=> $b['date'];
		});


		$this->set('Totalticketamount', $totalticket_sale_payment[0]['totalSaleAmount']);
		$this->set('TotalEarning', $totalEarnings);
		$this->set('paymentdataWithtype', json_encode($payment_data));
		$this->set('dates_data_all', json_encode($dates_data_all));
		$this->set('totalsale', $totalsale);
		$this->set('totalEarningsuponsales', $totalEarningsuponsales);


		$latestevent = $this->Event->find('all')->where(['Event.status' => 'Y'])->contain(['Eventdetail', 'Users', 'Currency'])->order(['Event.id' => 'DESC'])->limit(5);

		$latestevent_organiser = $this->Users->find('all')->where(['Users.role_id' => 2])->order(['Users.id' => 'DESC'])->limit(5);

		// $latestticket_book = $this->Ticket->find('all')->contain(['Users', 'Event'])->order(['Ticket.id' => 'DESC'])->limit(5);
		$latestticket_book = $this->Ticketdetail->find('all')->contain(['Users', 'Ticket' => 'Event'])->order(['Ticket.id' => 'DESC'])->limit(5);

		// this week
		$week_cash = $this->Ticket->find('all')->Select(['amount' => 'SUM(amount)'])->where(['Ticket.created >=' => date('Y-m-d', strtotime('-1 weeks'))])->toarray();

		// month
		$month1_cash = $this->Ticket->find('all')->Select(['amount' => 'SUM(amount)'])->where(['Ticket.created >=' => date('Y-m-d', strtotime('-1 Months'))])->toarray();

		// last 3 month
		$month3_cash = $this->Ticket->find('all')->Select(['amount' => 'SUM(amount)'])->where(['Ticket.created >=' => date('Y-m-d', strtotime('-3 Months'))])->toarray();

		//total amount
		$month12_cash = $this->Ticket->find('all')->Select(['amount' => 'SUM(amount)'])->where(['Ticket.created >=' => date('Y-m-d', strtotime('-12 Months'))])->toarray();

		$this->set(compact('week_cash'));
		$this->set(compact('month1_cash'));
		$this->set(compact('month3_cash'));
		$this->set(compact('month12_cash'));
		$this->set(compact('totalcustomer', 'totaldisablecustomer', 'totaldisableevent', 'totaldisableorganiser', 'totalorganiser', 'totalevent', 'latestevent_organiser', 'latestevent', 'latestticket_book'));
	}

	public function getticketsales($id = null)
	{
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Orders');

		$params = $this->request->getData('params');
		$dates_data_all = $this->getTicketSalesData($params);
		$this->set('dates_data_all', json_encode($dates_data_all));
		$this->set(compact('params'));
	}

	// public function getTicketSalesData($params)
	// {
	// 	$dates = [];
	// 	$dates_data_all = [];
	// 	$current_date = date('Y-m-d');
	// 	$format = 'Y-m-d';

	// 	switch ($params) {
	// 		case 'last_month':
	// 			// Calculate start and end dates for last month
	// 			$start_date_last_month = date('Y-m-01', strtotime('-1 month', strtotime($current_date)));
	// 			$end_date_last_month = date('Y-m-t', strtotime('-1 month', strtotime($current_date)));

	// 			// Set the start date to the first day of last month
	// 			$current_date = $start_date_last_month;
	// 			break;
	// 		case 'last_week':
	// 			$start_date_last_month = date('Y-m-d', strtotime('-7 days', strtotime($current_date)));
	// 			$end_date_last_month = date('Y-m-d', strtotime('-1 days', strtotime($current_date)));

	// 			// Set the start date to the first day of last week
	// 			$current_date = $start_date_last_month;
	// 			break;
	// 		case 'today':
	// 			$start_date_last_month = $current_date;
	// 			$end_date_last_month = $current_date;

	// 			// Set the start date to today
	// 			$current_date = $start_date_last_month;
	// 			break;
	// 		default:
	// 			// Invalid parameter value, return empty data
	// 			return $dates_data_all;
	// 	}

	// 	while ($current_date <= $end_date_last_month) {
	// 		$dates[] = date($format, strtotime($current_date));

	// 		$ticketsold_date = $this->Ticket->find('all')
	// 			->contain(['Orders'])
	// 			->where(['Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Online'], 'DATE(Ticket.created)' => $current_date])
	// 			->count();

	// 		$dates_data_all[] = [
	// 			'date' => strtotime($current_date) * 1000,
	// 			'value' => $ticketsold_date
	// 		];

	// 		$current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
	// 	}

	// 	return $dates_data_all;
	// }

	public function getTicketSalesData($params)
	{
		$dates = [];
		$dates_data_all = [];
		$current_date = date('Y-m-d');
		$format = 'Y-m-d';
		$totalEarningsuponsales = 0;
		$totalsale = 0;

		switch ($params) {
			case 'last_month':
				// Calculate start and end dates for last month
				$start_date_last_month = date('Y-m-01', strtotime('-1 month', strtotime($current_date)));
				$end_date_last_month = date('Y-m-t', strtotime('-1 month', strtotime($current_date)));

				// Set the start date to the first day of last month
				$current_date = $start_date_last_month;
				break;
			case 'last_week':
				$start_date_last_month = date('Y-m-d', strtotime('-7 days', strtotime($current_date)));
				$end_date_last_month = date('Y-m-d');

				// Set the start date to the first day of last week
				$current_date = $start_date_last_month;
				break;
			case 'today':
				$start_date_last_month = $current_date;
				$end_date_last_month = $current_date;

				// Set the start date to today
				$current_date = $start_date_last_month;
				break;

			case 'reset':
				$start_date_last_month = date('Y-m-d', strtotime('-7 days'));
				$end_date_last_month =  date('Y-m-d');

				// Set the data last 7 days current date
				$current_date = $start_date_last_month;
				break;
			default:
				// Invalid parameter value, return empty data
				return $dates_data_all;
		}


		while ($current_date <= $end_date_last_month) {
			$dates[] = date($format, strtotime($current_date));


			$orders_data = $this->Orders->find()
				->contain(['Ticket'])
				->select(['date' => 'DATE(created)', 'total_amount' => 'SUM(total_amount)', 'adminfee'])
				->where(['paymenttype IN' => ['Cash', 'EventOffice', 'Online'], 'DATE(created) >=' => date('Y-m-d', strtotime($current_date)), 'DATE(created) <=' => date('Y-m-d', strtotime($current_date))])
				->group('date')
				->toArray();

			$total_sales = 0;
			foreach ($orders_data as $order) {
				$totalEarningsuponsales += ($order['total_amount'] * $order['adminfee'] / 100);
				$total_sales += $order->total_amount;
			}

			$dates_data_all[] = [
				'date' => strtotime($current_date) * 1000,
				'value' => $total_sales
			];
			$totalsale += $total_sales;
			$current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
		}
		// exit;
		$this->set('totalsale', $totalsale);
		$this->set('totalsale', $totalsale);
		$this->set('totalEarningsuponsales', $totalEarningsuponsales);
		// Sort the dates_data_all array by date in ascending order
		usort($dates_data_all, function ($a, $b) {
			return $a['date'] <=> $b['date'];
		});
		// pr($dates_data_all);exit;

		return $dates_data_all;
	}

	//Payment method ajex
	public function changepaymentmethod()
	{
		$this->loadModel('Event');
		$this->loadModel('Ticket');
		$this->loadModel('Orders');
		$params = $this->request->getData('params');
		$dates = [];
		$paymentdataWithtype = [];
		$current_date = date('Y-m-d');
		$format = 'Y-m-d';

		switch ($params) {
			case 'last_month':
				// Calculate start and end dates for last month
				$start_date_last_month = date('Y-m-01', strtotime('-1 month', strtotime($current_date)));
				$end_date_last_week = date('Y-m-t', strtotime('-1 month', strtotime($current_date)));

				// Set the start date to the first day of last month
				$current_date = $start_date_last_month;
				break;
			case 'last_week':
				$start_date_last_week = date('Y-m-d', strtotime('-7 days', strtotime($current_date)));
				$end_date_last_week = date('Y-m-d');

				// Set the start date to the first day of last week
				$current_date = $start_date_last_week;
				break;
			case 'today':
				$start_date_today = $current_date;
				$end_date_last_week = $current_date;

				// Set the start date to today
				$current_date = $start_date_today;
				break;

			case 'reset':
				$start_date_last_week = date('Y-m-d', strtotime('-7 days'));
				$end_date_last_week =  date('Y-m-d');

				// Set the data last 7 days current date
				$current_date = $start_date_last_week;
				break;
			default:
				// Invalid parameter value, return empty data
				return $paymentdataWithtype;
		}

		$paymentdataWithtype = [];
		$totalEarningsuponsales = 0;

		while ($current_date <= $end_date_last_week) {
			$dates[] = date($format, strtotime($current_date));

			// Payment Method Chart
			$paymenttypewithSalepercentage = $this->Orders->find('all')
				->contain(['Ticket'])
				->select(['Orders.paymenttype', 'total_amount' => 'SUM(total_amount)', 'adminfee'])
				->where(['Orders.paymenttype IN' => ['Cash', 'EventOffice', 'Online'], 'Orders.total_amount !=' => 0, 'DATE(created)' => $current_date])
				->group('Orders.paymenttype')
				->order(['Orders.id' => 'DESC'])
				->toArray();

			foreach ($paymenttypewithSalepercentage as $key => $value) {
				$totalEarningsuponsales += ($value['total_amount'] * $value['adminfee'] / 100);
				$paymentdataWithtype[] = [
					'paymenttype' => $value['paymenttype'],
					'amounts' => $value['total_amount']
				];
			}

			$current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
		}

		if ($totalEarningsuponsales > 0) {
			$paymentdataWithtype[] = ['paymenttype' => 'Earning', 'amounts' => $totalEarningsuponsales];
		}


		// Sort the paymentdataWithtype array by paymenttype in ascending order
		usort($paymentdataWithtype, function ($a, $b) {
			return $a['paymenttype'] <=> $b['paymenttype'];
		});

		if (empty($paymentdataWithtype)) {
			$paymentdataWithtype[] = [
				'paymenttype' => 'No Data',
				'amounts' => 0
			];
		}

		$paymentdataWithtype = json_encode($paymentdataWithtype);
		$this->set('paymentdataWithtype', $paymentdataWithtype);
		$this->set('params', $params);
	}
}
