<?php
namespace App\Models;

use ci4mongodblibrary\Models\CommonModel;
//create a new class
class AdminModel extends CommonModel
{
    public $collection = 'admin';

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