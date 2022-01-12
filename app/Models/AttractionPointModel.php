<?php
namespace App\Models;

use ci4mongodblibrary\Models\CommonModel;

class AttractionPointModel extends CommonModel{
    public $collection = 'attraction_point';

    public function __construct(){
        parent::__construct();
    }

}
?>