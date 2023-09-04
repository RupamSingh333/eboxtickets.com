<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class CurrencyTable extends Table
{

    public $name = 'Currency';

    public function initialize(array $config)
    {
        $this->table('tblcurrency');
        $this->primaryKey('id');

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'event_org_id',
        //     'joinType' => 'INNER',
        // ]);

        // // $this->hasmany('Ticket', [
        // //     'foreignKey' => 'event_id',
        // //     'joinType' => 'INNER',
        // // ]);

        // // $this->hasmany('Eventdetail', [
        // //     'foreignKey' => 'eventid',
        // //     'joinType' => 'INNER',
        // // ]);
    }
}
