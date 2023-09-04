<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class TicketTable extends Table
{

    public $name = 'Ticket';

    public function initialize(array $config)
    {
        $this->table('tblticket_book');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'cust_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Event', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);

        $this->hasmany('Ticketdetail', [
            'foreignKey' => 'tid',
            'joinType' => 'INNER',
        ]);

        // $this->belongsTo('Ticketdetail', [
        //     'foreignKey' => 'id',
        //     'joinType' => 'INNER',
        // ]);

        $this->belongsTo('Eventdetail', [
            'foreignKey' => 'event_ticket_id',
            'joinType' => 'INNER',
        ]);
        
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',  
        ]);


        $this->belongsTo('Package', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER',
        ]);

        
    }
}
