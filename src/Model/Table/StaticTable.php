<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class StaticTable extends Table {

    public $name = 'Static';
    
    public function initialize(array $config)
    {
	    $this->table('tblstatic');
	    $this->primaryKey('id');
	}

}
?>
