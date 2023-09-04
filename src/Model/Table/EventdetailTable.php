<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class EventdetailTable extends Table
{

    public $name = 'Eventdetail';
    public function initialize(array $config)
    {
        $this->table('event_ticket_id');
        $this->primaryKey('id');

        $this->belongsTo('Question', [
            'foreignKey' => 'question_id',
            'joinType' => 'left',
        ]);    

        $this->hasMany('Ticket', [
            'foreignKey' => 'event_ticket_id'
        ]);


    }
}
