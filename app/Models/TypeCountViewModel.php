<?php

namespace App\Models;

use ci4mongodblibrary\Models\CommonModel;

class TypeCountViewModel extends CommonModel
{
    public $collection = 'type_view';

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