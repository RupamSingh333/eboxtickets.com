<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class PaymentTable extends Table {

    public $name = 'Payment';
    
    public function initialize(array $config)
    {
	    $this->table('payment');
	    $this->primaryKey('id');  
    }

}
?>
