<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class CartTable extends Table
{

    public $name = 'Cart';

    public function initialize(array $config)
    {
        $this->table('tblcart');
        $this->primaryKey('id');

        $this->belongsTo('Eventdetail', [
            'foreignKey' => 'ticket_id',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('Event', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Addons', [
            'foreignKey' => 'addons_id',
            'joinType' => 'INNER',
        ]);

        // $this->hasmany('Eventdetail', [
        //     'foreignKey' => 'eventid',
        //     'joinType' => 'INNER',
        // ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]); 

        $this->belongsTo('Package', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER',
        ]); 


    }
}
