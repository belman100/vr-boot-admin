<?php
namespace App\Models;

use ci4mongodblibrary\Models\CommonModel;

//create class
class HostportModel extends CommonModel
{
    public $collection = 'hostport';

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