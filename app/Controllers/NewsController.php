<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\NewsModel;

class NewsController extends BaseController
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
    //add news view
    public function addNewsView()
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return view('admin/AddInformationNews');
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }
    //add news post
    public function addNewsPost()
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            //var_dump($data);
            $news = new NewsModel();

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['status'] = true;
            $data['user_id'] = $session->get('user')->_id;
            //check foder is exist
            $data_return='';
            if(!is_dir('resource/image/news/')){
                mkdir('resource/image/news/', 0777, true);
            }               
            //check image file is exist
            if($_FILES["image_file"]["error"]!=4){
                //create new image file name using uniqid
                $image_file_name = uniqid().'.'.pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION);
                $data['image_name'] = $image_file_name;
                //write image file from file-input to folder
                if(move_uploaded_file($_FILES["image_file"]["tmp_name"],"resource/image/news/".$image_file_name))
                {
                    $data_return.='\nupload image success';
                }
            }
            //get data from client
            $newsRes=$news->createOne($news->collection, [
                'attr_type_id' => new \MongoDB\BSON\ObjectId($data['attr_type_id']),
                'name' => $data['name'],
                'details' => $data['details'],
                'date_time_start_valid'=>$data['date_time_start_valid'],
                'date_time_end_valid'=>$data['date_time_end_valid'],
                'image_name'=>$data['image_name'],
                'video_youtube'=>$data['video_youtube'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
                'status' => $data['status'],
                'user_id' => $data['user_id']
            ]);
            if ($newsRes) {
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Add news success', 'data' => $data_return]));
            }
            else {
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Add news fail', 'data' => $data_return]));
            }   
        }
        else{
            return json_encode(['status' => 400, 'message' => 'You are not logged in']);
        }
    }
    //edit news view
    public function editNewsView()
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {            
            return view('admin/UpdateInformationNews');
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }
    //edit news post
    public function editNewsPost()
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            //var_dump($data);
            $news = new NewsModel();
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['status'] = true;
            $data['user_id'] = $session->get('user')->_id;
            //check foder is exist
            $data_return='';
            if(!is_dir('resource/image/news/')){
                mkdir('resource/image/news/', 0777, true);
            }               
            //check image file is exist
            if(!empty($_FILES["image_file"])){
                if($_FILES["image_file"]["error"]!=4){
                    //create new image file name using uniqid
                    $image_file_name = uniqid().'.'.pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION);
                    $data['image_name'] = $image_file_name;
                    //write image file from file-input to folder
                    if(move_uploaded_file($_FILES["image_file"]["tmp_name"],"resource/image/news/".$image_file_name))
                    {
                        //check old image file is exist
                        if(file_exists('resource/image/news/'.$data['image_old_name'])){
                            //delete old image file
                            unlink('resource/image/news/'.$data['image_old_name']);
                        }
                        $data_return.='\nupload image success';
                    }    
                }
            }   
            //get data from client
            $newsRes=$news->updateOne($news->collection, ['_id' => new \MongoDB\BSON\ObjectId($data['_id'])
            ], [    
                'attr_type_id' => new \MongoDB\BSON\ObjectId($data['attr_type_id']),
                'name' => $data['name'],
                'details' => $data['details'],
                'date_time_start_valid'=>$data['date_time_start_valid'],
                'date_time_end_valid'=>$data['date_time_end_valid'],
                'image_name'=>$data['image_name'],
                'video_youtube'=>$data['video_youtube'],
                'updated_at' => $data['updated_at'],
                'status' => $data['status'],
                'user_id' => $data['user_id']    
            ]);
            //check update success
            if($newsRes){
                 
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Edit news success', 'data' => $data_return]));
            }
            else{
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Update news fail '.$newsRes]));
            }
            
        }
        else{
            return json_encode(['status' => 400, 'message' => 'You are not logged in']);
        }
    }
    //get all news and sort by date update
    public function getAllNews($id)
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $news = new NewsModel();
            $newsRes=$news->getList($news->collection,['attr_type_id'=>new \MongoDB\BSON\ObjectId($id)],['sort'=>['updated_at'=>-1]]);
            //$newsRes["date_time_server"] = date('Y-m-d H:i:s');
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get all news success','server_date'=>date('Y-m-d H:i:s'), 'news' => $newsRes]));
        }
        else{
            return json_encode(['status' => 400, 'message' => 'You are not logged in']);
        }
    }
    //get news by id
    public function getNewsById($id)
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            //$data = $this->request->getPost();
            $news = new NewsModel();
            $newsRes=$news->getOne($news->collection,['_id'=>new \MongoDB\BSON\ObjectId($id)]);
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get news success', 'news' => $newsRes]));
        }
        else{
            return json_encode(['status' => 400, 'message' => 'You are not logged in']);
        }
    }
    //view preview news
    public function previewNewsView($id)
    {
        return view('PreviewNews');
    }
    //get news all status true and date time start valid is less than current date time and date time end valid is greater than current date time
    public function getNewsByDateTimeStartEndValid($id)
    {    
        $news = new NewsModel();
        $newsRes=$news->getList($news->collection,['attr_type_id'=>new \MongoDB\BSON\ObjectId($id),'status'=>true,'date_time_start_valid'=>['$lte'=>date('Y-m-d H:i:s')],'date_time_end_valid'=>['$gte'=>date('Y-m-d H:i:s')]],['sort'=>['updated_at'=>-1]]);
        //check data is exist
        if(!empty($newsRes)){
            //$newsRes["date_time_server"] = date('Y-m-d H:i:s');
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get news success','news' => $newsRes]));
        }
        else{
            return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Get news fail']));
        }    
    }
    //view preview news details
    public function previewNewsDetailsView()
    {
        return view('NewsDetails');
    }
    //get news preview by id
    public function getNewsPreviewById($id)
    {    
        //$data = $this->request->getPost();
        $news = new NewsModel();
        $newsRes=$news->getOne($news->collection,['_id'=>new \MongoDB\BSON\ObjectId($id)]);
        //check data is exist
        if($newsRes){
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get news success', 'news' => $newsRes]));
        }
        else{
            return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Get news fail']));
        }    
    }
    //view preview Video
    public function previewVideoView()
    {
        return view('PreviewVideoYoutube');
    }
    //get news details by id public
    public function getNewsDetailsByIdPublic($id)
    {    
        //$data = $this->request->getPost();
        $news = new NewsModel();
        $newsRes=$news->getOne($news->collection,['_id'=>new \MongoDB\BSON\ObjectId($id)]);
        //check data is exist
        if($newsRes){            
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get news success', 'news' => $newsRes]));
        }
        else{
            return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Get news fail']));
        }    
    }
    //delete news by id and delete image
    public function deleteNews($id)
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            //$data = $this->request->getPost();
            $news = new NewsModel();
            $newsRes=$news->deleteOne($news->collection,['_id'=>new \MongoDB\BSON\ObjectId($id)]);
            //check delete success
            if($newsRes){
                //delete image
                $this->deleteImage($id);
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Delete news success']));
            }
            else{
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Delete news fail']));
            }    
        }
        else{
            return json_encode(['status' => 400, 'message' => 'You are not logged in']);
        }
    }
    //delete image by id
    public function deleteImage($id)
    {
        //$data = $this->request->getPost();
        $news = new NewsModel();
        //get news image mongodb
        $newsRes=$news->getOne($news->collection,['_id'=>new \MongoDB\BSON\ObjectId($id)]);
        //check data is exist
        if($newsRes){
            //$newsRes=$news->getOne($news->collection,['_id'=>new \MongoDB\BSON\ObjectId($id)]);
            //check data is exist
            if($newsRes){
                //delete image
                $file_name=$newsRes['image_name'];
                if($file_name){
                    $file_name = 'resource/image/news/'.$file_name;
                    if (file_exists($file_name)) {
                        unlink($file_name);
                    }
                }
            }          
        }
    }    
}