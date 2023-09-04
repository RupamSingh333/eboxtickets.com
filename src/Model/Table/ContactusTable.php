<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class ContactusTable extends Table
{

    public $name = 'Contactus';

    public function initialize(array $config)
    {
        $this->table('tblcontactus');
        $this->primaryKey('id');

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'event_org_id',
        //     'joinType' => 'INNER',
        // ]);

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
        
    }
}
