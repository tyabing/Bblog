<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use zgldh\QiniuStorage;
use Illuminate\Contracts\Validation\Validator;
use App\Comments;
use App\Posts;
class CommentController extends Controller
{

    /**
     * 验证失败返回格式自定义-暂未使用
     *
     * @param Validator $validator
     * @return void
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return ['status'=>Config::get('constants.status_danger'),'message'=>implode("\n",$validator->errors()->all())];
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show(Request $req)
    {
        
        //查询评论
        $ment=(new Comments)->getList();
        //查找对应的文章
        $mentData=(new Posts)->getPost($ment);
        $mentList=(new Comments)->getCommentList($mentData);        
        return view('Admin/Comment/show')->with('mentList',$mentList);
    }
    /**
     * 删除
     * @param  Request $req [description]
     * @return [type]       [description]
     */
    public function del(Request $req){
       $com_id=$req->com_id;
       $level=$req->level;
       $del_ids=array();
       if($level==0){
        //删除该评论下的所有留言
            $ids=(new Comments)->getWhere($com_id);
            foreach ($ids as $key => $value) {
                $del_ids[]=$value['com_id'];
            }
            $del_ids[].=$com_id;
       }else{
             $del_ids[]=$com_id;
       }
       //删除评论
       $result=(new Comments)->delWhere($del_ids);
       if(!$result){
            echo json_encode(0);die;
       }
       echo json_encode(1);
       
    }



}

