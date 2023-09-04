<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class QuestionbookTable extends Table
{

    public $name = 'Questionbook';

    public function initialize(array $config)
    {
        $this->table('tblquestion_book');
        $this->primaryKey('id');

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'event_org_id',
        //     'joinType' => 'INNER',
        // ]);

        $this->belongsTo('Question', [
            'foreignKey' => 'question_id',
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
