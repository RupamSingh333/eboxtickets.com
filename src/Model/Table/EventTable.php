<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class EventTable extends Table
{

    public $name = 'Event';

    public function initialize(array $config)
    {
        $this->table('tblevent');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'event_org_id',
            'joinType' => 'INNER',
        ]);

        $this->hasmany('Ticket', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);

        $this->hasmany('Eventdetail', [
            'foreignKey' => 'eventid',
            'joinType' => 'INNER',
        ]);

        $this->hasmany('Addons', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Company', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Currency', [
            'foreignKey' => 'payment_currency',
            'joinType' => 'LEFT',
        ]);
        
    }
}
