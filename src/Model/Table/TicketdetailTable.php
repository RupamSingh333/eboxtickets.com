<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class TicketdetailTable extends Table
{

    public $name = 'Ticketdetail';

    public function initialize(array $config)
    {
        $this->table('ticketdetail');
        $this->primaryKey('id');

        $this->belongsTo('Ticket', [
            'foreignKey' => 'tid',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Package', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->hasmany('Ticketshare', [
            'foreignKey' => 'ticket_num',
            'joinType' => 'INNER',
        ]);
        $this->hasmany('Eventdetail', [
            'foreignKey' => 'eventid',
            'joinType' => 'INNER',
        ]);

        $this->hasmany('Questionbook', [
            'foreignKey' => 'ticketdetail_id',
            'joinType' => 'INNER',
        ]);
    }
}
