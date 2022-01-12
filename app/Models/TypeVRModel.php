<?php
namespace App\Models;

use ci4mongodblibrary\Models\CommonModel;

//new class
class TypeVRModel extends CommonModel
{
    public $collection = 'type_vr';

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @param array $credentials
     * @return mixed
     */
    
}
?>