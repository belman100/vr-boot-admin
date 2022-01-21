<?php

namespace App\Models;

use ci4mongodblibrary\Models\CommonModel;

class AttractionCountViewModel extends CommonModel
{
    public $collection = 'attraction_view';

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