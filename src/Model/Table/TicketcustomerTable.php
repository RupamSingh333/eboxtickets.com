<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class TicketcustomerTable extends Table {

    public $name = 'Ticketcustomer';
    
    public function initialize(array $config)
    {
	    $this->table('tblcustomer');
	    $this->primaryKey('id');     

       
	}

}
