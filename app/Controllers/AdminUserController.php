<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AdminModel;

class AdminUserController extends BaseController
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
    public function login()
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return redirect()->to(site_url('./admin/dashboard'));
        }else{
            return view('admin/Login');
        }    
    }
    public function loginPost()
    {
        $session = session();
        $data = $this->request->getPost();
        //var_dump($data);
        $admin = new AdminModel();
        /**
         * username : admin
         * password : rasmuslerdorf
         * **
         */
         
        $user = $admin->getOne($admin->collection, ['username' => $data['username']]);
        //var_dump($user);
        if ($user) {
            if (password_verify($data['password'], $user->password)) {
                $session->set('user', $user);
                $session->set('is_login', true);
                //returen json
                return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Login success','user_data' => $user]));
            }else{
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Wrong password']));    
            }
        }
    }
    //password_verify
    public function password_verify($pasword_client, $password_server)
    {
        if($pasword_client == $password_server){
            return true;
        }else{
            return false;
        }
    }
    //logout
    public function logout()
    {
        $session = session();
        $session->remove('user');
        $session->set('is_login', false);
        return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Logout success']));
    }
    //register
    public function register()
    {
        return view('register');
    }
    public function registerPost(){

        $session = session();
        $data = $this->request->getPost();
        $admin = new AdminModel();
        //check if username is already exist
        $userCheck = $admin->getOne($admin->collection, ['username' => $data['username']]);
        if ($userCheck) {
            return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Username already exist']));
        }else{
            $user = $admin->createOne($admin->collection, [
                'username' => $data['username'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            //check data        
            if ($user) {
                $session->set('user', $user);
                return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Username already exists']));
            }
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $this->db->table('users')->insert($data);
            return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Register success']));
        }        
    }
    //username validation
    public function usernameValidation($username)
    {
        $admin = new AdminModel();
        $user = $admin->getOne($admin->collection, ['username' => $username]);
        if ($user) {
            return $this->response->setJSON(json_encode(['status' => 400, 'message' => 'Username already exists']));
        }
        return $this->response->setJSON(json_encode(['status' => 200, 'message' => 'Username available']));
    }
    
}
