<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class TicketshareTable extends Table {

    public $name = 'Ticketshare';
    
    public function initialize(array $config)
    {
	    $this->table('tblticket_share');
	    $this->primaryKey('id');

           $this->belongsTo('Ticket', [
           'foreignKey' => 'tid',
           'joinType' => 'INNER',
       ]);
	}

}
?>
