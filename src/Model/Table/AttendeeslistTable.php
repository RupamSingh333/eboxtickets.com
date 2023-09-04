<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class AttendeeslistTable extends Table
{

    public $name = 'Attendeeslist';

    public function initialize(array $config)
    {
        $this->table('tblattendees_list');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Event', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);

        // $this->hasmany('Ticketdetail', [
        //     'foreignKey' => 'tid',
        //     'joinType' => 'INNER',
        // ]);

        // // $this->belongsTo('Ticketdetail', [
        // //     'foreignKey' => 'id',
        // //     'joinType' => 'INNER',
        // // ]);

        // $this->belongsTo('Eventdetail', [
        //     'foreignKey' => 'event_ticket_id',
        //     'joinType' => 'INNER',
        // ]);
        // $this->belongsTo('Orders', [
        //     'foreignKey' => 'order_id',
        //     'joinType' => 'INNER',  
        // ]);

    }
}
