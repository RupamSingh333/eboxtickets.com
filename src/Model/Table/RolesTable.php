<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class RolesTable extends Table
{

    public $name = 'Roles';

    public function initialize(array $config)
    {
        $this->table('tblroles');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        // $this->hasmany('Ticket', [
        //     'foreignKey' => 'event_id',
        //     'joinType' => 'INNER',
        // ]);

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
        // $this->belongsTo('Currency', [
        //     'foreignKey' => 'payment_currency',
        //     'joinType' => 'LEFT',
        // ]);
        
    }
}
