<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class AddonsbookTable extends Table
{

    public $name = 'Addonsbook';

    public function initialize(array $config)
    {
        $this->table('tbladdonsbook');
        $this->primaryKey('id');

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'event_org_id',
        //     'joinType' => 'INNER',
        // ]);

        $this->belongsTo('Addons', [
            'foreignKey' => 'addons_id',
            'joinType' => 'Left',
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
