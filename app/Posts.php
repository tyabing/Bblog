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
    /**
     * 获取一条
     * @param  [type] $where [description]
     * @return [type]        [description]
     */
    public function getOne($where){
        return $this->select('title')->where(['post_id'=>$where])->first()->toArray();
    }
    /**
     * 获取对应的文章名称
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function getPost($data)
    {
        foreach ($data as $key => $value) {
            $title=$this->getOne($value['post_id']);
            $data[$key]['title']=$title['title'];
        }
        return $data;        
    }

   

}