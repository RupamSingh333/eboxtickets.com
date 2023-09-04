<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class CountriesTable extends Table
{

    public $name = 'Countries';

    public function initialize(array $config)
    {
        $this->table('tbl_Countries');
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
