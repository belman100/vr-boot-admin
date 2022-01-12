<?php
namespace App\Con;

use App\Model\TypeVRModel;

class TypeVRController extends BaseController
{
    public function index()
    {
        //return view('welcome_message');
    }
    //set data veiw
    public function setTypeVr(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return view('typevr/setTypeVr');
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }
    //update data veiw
    public function updateTypeVr($id){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return view('typevr/updateTypeVr');
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }
    //set data post
    public function setTypeVrPost(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $typevr = new TypeVRModel();
            $data = $typevr->createOne($typevr->collection, [
                'name' => $data['name'],
                'type_number' => $data['type_number'],
                'description' => $data['description'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            if($data){
                return json_encode(['status' => 200, 'message' => 'Insert success']);
            }else{
                return json_encode(['status' => 400, 'message' => 'Insert failed']);
            }
        }else{
            return json_encode(['status' => 401, 'message' => 'Unauthorized']);
        }

        
    }
    //update data post
    public function updateTypeVrPost(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $data = $this->request->getPost();
            $data['updated_at'] = date('Y-m-d H:i:s');

            $typevr = new TypeVRModel();
            $data = $typevr->updateOne($typevr->collection, ['_id' => $data['_id']], [
                'name' => $data['name'],
                'type_number' => $data['type_number'],
                'description' => $data['description'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at']
            ]);
            if($data){
                return json_encode(['status' => 200, 'message' => 'Update success']);
            }else{
                return json_encode(['status' => 400, 'message' => 'Update failed']);
            }
        }else{
            return json_encode(['status' => 401, 'message' => 'Unauthorized']);
        }
        
    }
    //delete data get
    public function deleteTypeVr($id){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $typevr = new TypeVRModel();
            $data = $typevr->deleteOne($typevr->collection, ['_id' => $id]);
            if($data){
                return json_encode(['status' => 200, 'message' => 'Delete success']);
            }else{
                return json_encode(['status' => 400, 'message' => 'Delete failed']);
            }
        }else{
            return redirect()->to(site_url('./admin/login'));
        }    
    }
    //list all type vr
    public function listAllTypeVr(){
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            $typevr = new TypeVRModel();
            $data = $typevr->getList($typevr->collection);
            return json_encode(['status' => 200, 'data' => $data]);
        }else{
            return json_encode(['status' => 401, 'message' => 'Unauthorized']);
        }
    }

}   
       
?>