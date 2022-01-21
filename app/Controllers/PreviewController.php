<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AttractionPointModel;
use App\Models\AttractionCountViewModel;

class PreviewController extends BaseController
{
    //index function
    public function index($id)
    {
        //return view('welcome_message');
        $data = [
            'id' => $id
        ];
        return view('Preview', $data);
    }
    //get data from database
    public function getPointData($id)
    {
        //getdata from database
        $attraction = new AttractionPointModel();
        //get data from database mongo
        $data = $attraction->getOne($attraction->collection,['_id' => new \MongoDB\BSON\ObjectId($id)]);
        //check if data is null
        if ($data) { 

            //return json
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'success', 'point' => $data]));
        }else{
            return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'failed']));
        }    
    }
} 

?>