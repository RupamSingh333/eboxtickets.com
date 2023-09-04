<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class PackageTable extends Table
{

    public $name = 'Package';

    public function initialize(array $config)
    {
        $this->table('tblpackage');
        $this->primaryKey('id');

        // $this->belongsTo('Ticket', [
        //     'foreignKey' => 'tid',
        //     'joinType' => 'INNER',
        // ]);

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'user_id',
        //     'joinType' => 'INNER',
        // ]);

        $this->hasmany('Packagedetails', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER',
        ]);
        
        // $this->hasmany('Eventdetail', [
        //     'foreignKey' => 'package_id',
        //     'joinType' => 'INNER',
        // ]);

        // $this->hasmany('Questionbook', [
        //     'foreignKey' => 'ticketdetail_id',
        //     'joinType' => 'INNER',
        // ]);
    }
}
