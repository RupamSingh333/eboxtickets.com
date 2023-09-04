<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class GroupmemberTable extends Table
{

    public $name = 'Groupmember';

    public function initialize(array $config)
    {
        $this->table('tblgroup_member');
        $this->primaryKey('id');

        $this->belongsTo('CommitteeGroup', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        // $this->belongsTo('Event', [
        //     'foreignKey' => 'event_id',
        //     'joinType' => 'INNER',
        // ]);

        
    }
}
