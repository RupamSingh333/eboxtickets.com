<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class CommitteeassignticketTable extends Table
{

    public $name = 'Committeeassignticket';

    public function initialize(array $config)
    {
        $this->table('tblcommittee_assigntickets');
        $this->primaryKey('id');

        $this->belongsTo('Event', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        // $this->belongsTo('Company', [
        //     'foreignKey' => 'company_id',
        //     'joinType' => 'INNER',
        // ]);

        $this->belongsTo('Eventdetail', [
            'foreignKey' => 'ticket_id',
            'joinType' => 'INNER',
        ]);
    }
}
