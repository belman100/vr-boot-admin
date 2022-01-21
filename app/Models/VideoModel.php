<?php
namespace App\Models;

use ci4mongodblibrary\Models\CommonModel;

class VideoModel extends CommonModel
{
    public $collection = 'video';

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