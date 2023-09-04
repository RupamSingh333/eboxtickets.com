<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class CommitteeGroupTable extends Table
{

    public $name = 'CommitteeGroup';

    public function initialize(array $config)
    {
        $this->table('tblgroup');
        $this->primaryKey('id');

        $this->belongsTo('Event', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
        ]);

        
    }
}
