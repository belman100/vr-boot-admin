<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\VideoModel;

class VideoController extends BaseController
{
    public function index()
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return redirect()->to(site_url('./admin/dashboard'));
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }
    //add and edit data
    public function addEditVideo()
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            $video = new VideoModel();
            //var_dump($data['_id']);
            if ($data['_id']!='undefined') {
                //var_dump($data['video_url']);
                $video->updateOne($video->collection, ['_id' => new \MongoDB\BSON\ObjectId($data['_id'])],[
                    'type_id' => new \MongoDB\BSON\ObjectId($data['type_id']),
                    'video_url' => $data['video_url'],    
                    'status' => true,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);    
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Update success','data' => $video]));
            }else{
                $video->createOne($video->collection, [
                    'type_id' => new \MongoDB\BSON\ObjectId($data['type_id']),                    
                    'video_url' => $data['video_url'],    
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Add success']));
            }
        }else{
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }
    //get video data
    public function getVideo($id)
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            //$data = $this->request->getPost();
            $video = new VideoModel();
            $video_data = $video->getOne($video->collection, ['type_id' => new \MongoDB\BSON\ObjectId($id)]);
            //var_dump($video_data);
            //check if data is exist
            if ($video_data) {
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get data success', 'video' => $video_data]));
            }else{
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Data not found']));
            }    
        }else{
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }
    //get video not login
    public function getVideoNotLogin($id)
    {    
        $video = new VideoModel();
        $video_data = $video->getOne($video->collection, ['type_id' => new \MongoDB\BSON\ObjectId($id)]);
        //var_dump($video_data);
        //check if data is exist
        if ($video_data) {
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get data success', 'video' => $video_data]));
        }else{
            return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Data not found']));
        }    
        
    }
}