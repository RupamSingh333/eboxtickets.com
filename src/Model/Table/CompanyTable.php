<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class CompanyTable extends Table
{

    public $name = 'Company';

    public function initialize(array $config)
    {
        $this->table('tblcompany');
        $this->primaryKey('id');

        $this->belongsTo('Question', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER',
        ]);

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
