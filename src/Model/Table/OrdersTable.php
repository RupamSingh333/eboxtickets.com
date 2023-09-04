<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class OrdersTable extends Table
{

    public $name = 'Orders';

    public function initialize(array $config)
    {
        $this->table('tblorders');
        $this->primaryKey('id');

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'event_org_id',
        //     'joinType' => 'INNER',
        // ]);

        // $this->belongsTo('Addons', [
        //     'foreignKey' => 'addon_id',
        //     'joinType' => 'INNER',
        // ]);

        $this->hasmany('Ticket', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',
        ]);

        // $this->belongsTo('Countries', [
        //     'foreignKey' => 'country_id',
        //     'joinType' => 'INNER',
        // ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }
}
