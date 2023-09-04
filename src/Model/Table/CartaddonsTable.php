<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class CartaddonsTable extends Table
{

    public $name = 'Cartaddons';

    public function initialize(array $config)
    {
        $this->table('tblcartaddons');
        $this->primaryKey('id');

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'event_org_id',
        //     'joinType' => 'INNER',
        // ]);

        $this->belongsTo('Addons', [
            'foreignKey' => 'addon_id',
            'joinType' => 'INNER',
        ]);

        // $this->hasmany('Eventdetail', [
        //     'foreignKey' => 'eventid',
        //     'joinType' => 'INNER',
        // ]);

        // $this->belongsTo('Countries', [
        //     'foreignKey' => 'country_id',
        //     'joinType' => 'INNER',
        // ]);
        $this->belongsTo('Event', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);
    }
}
