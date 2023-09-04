<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class AddonsTable extends Table
{

    public $name = 'Addons';

    public function initialize(array $config)
    {
        $this->table('tbladdons');
        $this->primaryKey('id');

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'event_org_id',
        //     'joinType' => 'INNER',
        // ]);

        $this->belongsTo('Event', [
            'foreignKey' => 'event_id',
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
        // $this->belongsTo('Company', [
        //     'foreignKey' => 'company_id',
        //     'joinType' => 'INNER',
        // ]);
    }
}
