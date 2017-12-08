<?php
/*
 * @Author: zhangtao 
 * @Date: 2017-12-04 15:55:48 
 * @Last Modified by: zhangtao
 * @Last Modified time: 2017-12-08 22:12:17
 */
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Config;
use zgldh\QiniuStorage;
use Illuminate\Http\Request;

class Posts extends Model
{
    protected $fillable = ['title','cat_id','excerpt','author','is_allow','is_page','markdown','image','slug'];
    /**
     * get article list info
     *
     * @return void
     */
    public function getList()
    {
        return $this->select()->get();
    }

   

}