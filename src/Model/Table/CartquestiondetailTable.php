<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class CartquestiondetailTable extends Table
{

    public $name = 'Cartquestiondetail';

    public function initialize(array $config)
    {
        $this->table('tblcartquestion_detail');
        $this->primaryKey('id');

        // $this->belongsTo('CommitteeGroup', [
        //     'foreignKey' => 'group_id',
        //     'joinType' => 'INNER',
        // ]);

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'user_id',
        //     'joinType' => 'INNER',
        // ]);

        // $this->belongsTo('Event', [
        //     'foreignKey' => 'event_id',
        //     'joinType' => 'INNER',
        // ]);


    }
}
