<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Files\File;
use App\Models\AttractionPointModel;

class AttractionPointController extends BaseController{
    public function index(){
        //return view('welcome_message');
    }

    //set new attraction
    public function setAttractionPoint(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return view('admin/AddPointAttr');
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }
    //update attraction point view
    public function updateAttractionPoint(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return view('admin/UpdatePointAttr');
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }
    public function setAttractionPointPost(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            $attraction = new AttractionPointModel();
        
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['status'] = true;
            $data['user_id'] = $session->get('user')->_id;
            //upload file
            //check foder is exist
            $data_return='';
            if(!is_dir('resource/audio/')){
                mkdir('resource/audio/');
            }
            if($data['audio_file_name']!='' && $data['audio_file_base64']!=''){
                //create new name file with unique
                $file_name = uniqid().'.mp3';
                $data['audio_file_name'] = $file_name;
                //write audio file from base64 to folder
                $audio_file_name = $this->base64_to_jpeg($data['audio_file_base64'], 'resource/audio/'.$file_name);
                //var_dump($audio_file_name);
                //check audio file is exist
                if(file_exists($audio_file_name)){
                    //var_dump("Uploaded");
                    $data_return.="\n upload audio success";
                }
            }
            //image upload
            if(!is_dir('resource/image/')){
                mkdir('resource/image/');
            }               
            //check image file is exist
            if($data['image_file_name']!='' && $_FILES["image_file"]["error"]!=4){
                //create new name file with unique
                $file_name = uniqid().'.'.pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION);
                $data['image_file_name'] = $file_name;
                //write image file from file-input to folder
                if(move_uploaded_file($_FILES["image_file"]["tmp_name"],"resource/image/".$file_name))
                {
                    $data_return.='\nupload image success';
                }
            }
            //insert data to database mongo
            //get point count from database withch attr_id
            //var_dump($data);
            $point = $attraction->getList($attraction->collection,['attr_id' => new \MongoDB\BSON\ObjectId($data['attr_id'])]);
            //check insert success
            if ($attraction->createOne($attraction->collection,[
                    'attr_name' => $data['attr_name'],
                    'attr_id' => new \MongoDB\BSON\ObjectId($data['attr_id']),
                    'point_number' => count($point) + 1,
                    'point_name' => $data['point_name'],
                    'details' => $data['details'],
                    'audio_file_name' => $data['audio_file_name'],
                    'image_file_name' => $data['image_file_name'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at'],
                    'status' => $data['status'],
                    'user_id' => $data['user_id']
            ])) {
                   
                //returen json
                return json_encode(['status' => 200, 'message' => 'success',$data_return]);
            }
            else{
                //return json
                return json_encode(['status' => 400, 'message' => 'Insert failed','error' => $attraction->errors()]);
            }    
        }else{
            return json_encode(['status' => 401, 'message' => 'Unauthorized']);
        }   
    }
    //write file base64 to folder
    public function base64_to_jpeg($base64_string, $output_file) {
        file_put_contents($output_file, file_get_contents($base64_string));
        return $output_file; 
    }
    //update attraction point post
    public function updateAttractionPointPost(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            $attraction = new AttractionPointModel();
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['status'] = true;
            $data['user_id'] = $session->get('user')->_id;
            
            $dataRerun="";
            //audio file
            if(!is_dir('resource/audio/')){
                mkdir('resource/audio/');
            }
            
            //get base64 audio file
            $audio_file_name = $data['audio_file_base64'];
            //check audio file is exist
            if($data['audio_file_name']!='' && $audio_file_name!=''){
                //remove old audio file
                if(file_exists('resource/audio/'.$data['audio_file_name'])){
                    unlink('resource/audio/'.$data['audio_file_name']);
                }
                //create new audio file name using uniqid
                $file_name = uniqid().'.mp3';
                $data['audio_file_name'] = $file_name;
                //write audio file from base64 to folder
                $audio_file_name = $this->base64_to_jpeg($audio_file_name, 'resource/audio/'.$file_name);
                //var_dump($audio_file_name);
                //check audio file is exist
                if(file_exists($audio_file_name)){
                    //var_dump("Uploaded");
                    $dataRerun.="\n upload audio success";
                }
            } 
            //check image name is exist
            //image file
            if(!is_dir('resource/image/')){
                mkdir('resource/image/');
            }    
            //check image file is exist
            if(!empty($_FILES["image_file"])){
                //create new image file name using uniqid
                $image_file_name = uniqid().'.'.pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION);
                $data['image_file_name'] = $image_file_name;
                //write image file from file-input to folder
                if(move_uploaded_file($_FILES["image_file"]["tmp_name"],"resource/image/".$image_file_name))
                {
                    if(file_exists('resource/image/'.$data['image_file_pre_name'])){
                        if(!unlink('resource/image/'.$data['image_file_pre_name'])){
                            return json_encode(['status' => 400, 'message' => 'remove old image file failed!']);
                        }
                    } 
                    $dataRerun.="upload image file success!";
                }    
            }

            //check update success
            //update data to database mongo
            if ($attraction->updateOne($attraction->collection,['_id' => new \MongoDB\BSON\ObjectId($data['_id'])],[
                    'attr_name' => $data['attr_name'],
                    'attr_id' => new \MongoDB\BSON\ObjectId($data['attr_id']),        
                    'point_name' => $data['point_name'],
                    'details' => $data['details'],
                    'audio_file_name' => $data['audio_file_name'],
                    'image_file_name' => $data['image_file_name'],
                    'updated_at' => $data['updated_at'],
                    'status' => $data['status'],
                    'user_id' => $data['user_id']
                ])) {                       
                    
                    //return json
                    return json_encode(['status' => 200, 'message' => 'success','data' => $dataRerun]);    
            }
            else{
                //return json
                return json_encode(['status' => 400, 'message' => 'Update failed']);
            }
        }else{
            return json_encode(['status' => 401, 'message' => 'Unauthorized']);
        }
    }
    //delete attraction point
    public function deleteAttractionPoint($id){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $attraction = new AttractionPointModel();
            //get data from database mongo
            $data = $attraction->getOne($attraction->collection,['_id' => new \MongoDB\BSON\ObjectId($id)]);
            //check data is exist
            if($data){
                //delete data from database mongo
                if ($attraction->deleteOne($attraction->collection,['_id' => new \MongoDB\BSON\ObjectId($id)])) {    
                    //check file exist
                    if(!empty($data['audio_file_name'])){
                        //delete file audio
                        unlink('resource/audio/'.$data['audio_file_name']);
                    }
                    if(!empty($data['image_file_name'])){
                        //delete file image
                        unlink('resource/image/'.$data['image_file_name']);
                    }    
                    //return json
                    return json_encode(['status' => 200, 'message' => 'Delete success']);
                }
                else{
                    //return json
                    return json_encode(['status' => 400, 'message' => 'Delete failed']);
                }
            }else{
                //return json
                return json_encode(['status' => 400, 'message' => 'Data is not exist']);
            }    
        }else{
            return json_encode(['status' => 401, 'message' => 'Unauthorized']);
        }
    }
    //get all attraction point by attr_id
    public function getAllAttractionPointByAttrId($attr_id){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $attraction = new AttractionPointModel();
            //get data from database mongo
            $data = $attraction->getList($attraction->collection, [
                'attr_id' => new \MongoDB\BSON\ObjectId($attr_id)
            ]);
            //return json
            return json_encode(['status' => 200, 'message' => 'Delete success','data' => $data]);
        }else{
            return json_encode(['status' => 401, 'message' => 'Unauthorized']);
        }
    }
    //get select attraction point by id
    public function getSelectAttractionPointById($id){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $attraction = new AttractionPointModel();
            //get data from database mongo
            $data = $attraction->getOne($attraction->collection, [
                '_id' => new \MongoDB\BSON\ObjectId($id)
            ]);
            //return json
            return json_encode(['status' => 200, 'message' => 'get data success','data' => $data]);
        }else{
            return json_encode(['status' => 401, 'message' => 'Unauthorized']);
        }
    }
}
?>