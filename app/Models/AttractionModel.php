<?php
namespace App\Models;

use ci4mongodblibrary\Models\CommonModel;
//new class
class AttractionModel extends CommonModel
{
    public $collection = 'attraction';

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