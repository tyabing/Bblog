<?php

namespace App\Http\Controllers\Admin;
use Config;
use App\Http\Controllers\Controller;
use App\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //个人信息
    public function user_information(Request $request)
    {
         $data = $request->input();
         $data=$request->except('_token','pass');
         if(empty($data))
         {
            $data = (new Admins())->admin_select();
            // var_dump($data);die;
            return view('Admin.User.information',['data'=>$data]);
         }else
         {
            // var_dump($data);die;
            $up = (new Admins())->admin_save($data);
            var_dump($up);die;
         }
        
    }
}


?>