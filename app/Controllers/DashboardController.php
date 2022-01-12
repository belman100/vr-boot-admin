<?php

namespace App\Controllers;

class DashboardController extends BaseController
{

//dasboard
    public function dashboard()
    {
        $session = session();
        //check if user is already logged in
        if (session()->get('is_login')) {
            return view('admin/ManageData');
        }else{
            return redirect()->to(site_url('./admin/login'));
        }
    }

}