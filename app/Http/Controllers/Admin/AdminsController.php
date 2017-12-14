<?php

namespace App\Http\Controllers\Admin;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminsController extends Controller
{
  //登陆
   public function login(){

   }
   //注册
   public function register(){

   } 
   //退出
   public function sign(){
     return view('Admin/Login/index');
   }

}
