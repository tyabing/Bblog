<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
class Admins extends Model
{
    //读取用户数据
    public function admin_select()
    {
        $data = DB::table('admins')->where('name','=','admin')->first();
        return $data;
    }
    //用户更改数据
    public function admin_save($data)
    {
        if(empty($data))
        {
            return false;
        }else
        {
            // var_dump($data);die;
            $up=\App\Admins::where('id',$data['id'])->update($data);
            return $up;
        }
        
    }
}
