<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class CommitteTable extends Table
{

    public $name = 'Committe';

    public function initialize(array $config)
    {
        $this->table('tblcommitte');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Event', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);

        // $this->belongsTo('Committeeassignticket', [
        //     'foreignKey' => 'user_id',
        //     'joinType' => 'right',
        // ]);

        
    }
}
