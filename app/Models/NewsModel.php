<?php
namespace App\Models;

use ci4mongodblibrary\Models\CommonModel;

class NewsModel extends CommonModel
{
    public $collection = 'news';

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