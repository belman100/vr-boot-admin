<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AttractionModel;
use App\Models\AttractionPointModel;

class AttractionController extends BaseController{
    public function index(){
        //return view('welcome_message');
    }
    public function setAttraction(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return view('attraction/setAttraction');
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }
    //update attraction view
    public function updateAttraction(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return view('attraction/updateAttraction');
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }
    //add attraction
    public function setAttractionPost(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            $attraction = new AttractionModel();
            //add date time to data
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');    
           //check data insert in database
            if($attraction->createOne($attraction->collection,[
                'type_id' => new \MongoDB\BSON\ObjectId($data['type_id']),
                'attr_name' => $data['attr_name'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
            ])){
                //returen json
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Insert success']));
            }else{
                //returen json
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Insert failed']));
            }
            
        }else{
            //return json unathorized
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }
    //update attraction
    public function updateAttractionPost(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            $attraction = new AttractionModel();
            //add date time to data
            $data['updated_at'] = date('Y-m-d H:i:s');
            //check data insert in database
            if($attraction->updateOne($attraction->collection,['_id' => new \MongoDB\BSON\ObjectId($data['_id'])],[    
                'type_id' => new \MongoDB\BSON\ObjectId($data['type_id']),
                'attr_name' => $data['attr_name'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
            ])){
                //returen json
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Update success']));
            }else{
                //returen json
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Update failed']));
            }
            
        }else{
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }
    //delete attraction
    public function deleteAttraction($id){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            $attraction = new AttractionModel();
            //add date time to data
            $data['updated_at'] = date('Y-m-d H:i:s');
            //check data insert in database
            if($attraction->deleteOne($attraction->collection,['_id' => new \MongoDB\BSON\ObjectId($id)])){
                //returen json
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Delete success']));
            }else{
                //returen json
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Delete failed']));
            }
            
        }else{
            return view('admin/login');
        }
    }
    //list all attraction and attraction point
    public function listAllAttraction(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $attraction = new AttractionModel();
            $attractionPoint = new AttractionPointModel();
            $attractionData = $attraction->getList($attraction->collection);            
            if(count($attractionData)>0){
                
                foreach ($attractionData as $key => $value) {
                    $attractionData[$key]['attraction_point'] = $attractionPoint->getList(
                        $attractionPoint->collection,
                        ['attr_id' => new \MongoDB\BSON\ObjectId($value['_id'])],
                        ['point_number' => 1]
                    );     
                }
            }            
            //returen json
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get success', 'attr' => $attractionData]));
        }else{
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }
    //get attraction by Type vr id
    public function getAttractionByType($id){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $attraction = new AttractionModel();
            $attractionPoint = new AttractionPointModel();
            $attractionData = $attraction->getList($attraction->collection,['type_id' => new \MongoDB\BSON\ObjectId($id)]);
            if(count($attractionData)>0){    
                foreach ($attractionData as $key => $value) {
                    $attractionData[$key]['attraction_point'] = $attractionPoint->getList(
                        $attractionPoint->collection,
                        ['attr_id' => new \MongoDB\BSON\ObjectId($value['_id'])],
                        ['point_number' => 1]
                    );     
                }
            } 
            //returen json
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get success', 'attr' => $attractionData]));
        }else{
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }

    //get select attraction
    public function getSelectAttraction($id){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $attraction = new AttractionModel();
            $attractionData = $attraction->getList($attraction->collection,['_id' => $id]);
            
            if(count($attractionData)>0){
                $attractionPoint = new AttractionPointModel();
                foreach ($attractionData as $key => $value) {
                    $attractionData[$key]['attraction_point'] = $attractionPoint->getList(
                        $attractionPoint->collection,
                        ['attr_id' => new \MongoDB\BSON\ObjectId($value['_id'])],
                        ['point_number' => 1]
                    );
                }
            }
            
            //returen json
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Get success', 'data' => $attractionData]));
        }else{
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }
    //check attraction name
    public function checkAttrName($attr_name){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $attraction = new AttractionModel();
            $attractionData = $attraction->getList($attraction->collection,['attr_name' => $attr_name]);
            if(count($attractionData)>0){
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Name attraction is found', 'data' => $attractionData]));
            }else{
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Name attraction is not found you can use this name']));
            }
        }else{
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }
    //get count attraction and attraction point
    public function getCountAttractionAndPont(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $attraction = new AttractionModel();
            $attractionPoint = new AttractionPointModel();
            $attractionData = $attraction->getList($attraction->collection);
            $attractionPointData = $attractionPoint->getList($attractionPoint->collection);
            //returen json
            return $this->response->setJSON(json_encode([
                'status' => 200, 
                'message' => 'Get success', 
                'attr_count' => count($attractionData), 
                'attr_point' => count($attractionPointData)
            ]));
        }else{
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }
    //get count attraction and attraction point with type id
    public function getCountAttractionAndPontWithType($id){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $attraction = new AttractionModel();
            $attractionPoint = new AttractionPointModel();
            $attractionData = $attraction->getList($attraction->collection,['type_id' => new \MongoDB\BSON\ObjectId($id)]);
            $attractionPointData=[] ;
            if(count($attractionData)>0){
                $attractionPoint = new AttractionPointModel();
                foreach ($attractionData as $key => $value) {
                    $dataTmp = $attractionPoint->getList(
                        $attractionPoint->collection,
                        ['attr_id' => new \MongoDB\BSON\ObjectId($value['_id'])]                      
                    );
                    if(count($dataTmp)>0){
                        $attractionPointData = array_merge($attractionPointData,$dataTmp);
                    }
                }
            }
            //returen json
            return $this->response->setJSON(json_encode([
                'status' => 200, 
                'message' => 'Get success', 
                'attr_count' => count($attractionData), 
                'attr_point' => count($attractionPointData)
            ]));
        }else{
            return $this->response->setJSON(json_encode(['status' => 401, 'message' => 'Unauthorized']));
        }
    }
}
?>