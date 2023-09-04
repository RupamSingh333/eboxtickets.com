<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class PackagedetailsTable extends Table
{

    public $name = 'Packagedetails';

    public function initialize(array $config)
    {
        $this->table('tblpackage_details');
        $this->primaryKey('id');

        $this->belongsTo('Eventdetail', [
            'foreignKey' => 'ticket_type_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Addons', [
            'foreignKey' => 'addon_id',
            'joinType' => 'INNER',
        ]);

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'user_id',
        //     'joinType' => 'INNER',
        // ]);

        // $this->hasmany('Ticketshare', [
        //     'foreignKey' => 'ticket_num',
        //     'joinType' => 'INNER',
        // ]);
        // $this->hasmany('Eventdetail', [
        //     'foreignKey' => 'eventid',
        //     'joinType' => 'INNER',
        // ]);

        // $this->hasmany('Questionbook', [
        //     'foreignKey' => 'ticketdetail_id',
        //     'joinType' => 'INNER',
        // ]);
    }
}
