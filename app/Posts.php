<?php
/*
 * @Author: zhangtao 
 * @Date: 2017-12-04 15:55:48 
 * @Last Modified by: zhangtao
 * @Last Modified time: 2017-12-04 15:56:21
 */
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
class Posts extends Model
{
    public function getList()
    {
        return $this->select()->get();
    }
}