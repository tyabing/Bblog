<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use zgldh\QiniuStorage;
use Illuminate\Contracts\Validation\Validator;
use App\Comments;
use App\Posts;
use \Symfony\Component\HttpKernel\Exception\HttpException;
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
        try
        {
            $where=array(); 
            $find=['title'=>'','start'=>'','end'=>''];

            //搜索条件
            $title=$req->has('title')?$req->title:NULL;
            if($title){
                //查找post_id
                $post_id=(new Posts)->getOne(['title'=>$title]);
                $where[]=array('post_id','=',$post_id['post_id']);                    
            }
            $find['title']=$title;
            //开始时间
            $where[]=$req->has('start')?array('created_at','>',$req->start):NULL;
            $find['start']=$req->has('start')?$req->start:NULL;
            //结束时间
            if($req->has('start')){
                $where[]=$req->has('end')?array('created_at','<',$req->end):array('created_at','<',date('Y-m-d',time()));
                $find['end']=$req->has('end')?$req->end:date('Y-m-d',time());
            }else{
                $where[]=$req->has('end')?array('created_at','<',$req->end):NULL;
                $find['end']=$req->has('end')?$req->end:NULL;
            }
            $where=array_filter($where);

            //查询评论
            $ment=(new Comments)->getList($where);
            $ments=json_decode(json_encode($ment));
            //查找对应的文章
            $mentData=(new Posts)->getPost($ments->data);
            $mentList=(new Comments)->getCommentList($mentData);
            return view('Admin/Comment/show')->with('mentList',$mentList)
                                             ->with('find',$find)
                                             ->with('ment',$ment);
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getStatusCode(), $e->getMessage());
        }
        
        
    }
    /**
     * 回复评论
     * @param  Request $req [description]
     * @return [type]       [description]
     */
    public function replay(Request $req)
    {
        try
        {            
            if($req->ajax() && $req->isMethod('post'))
            {
                $all = $req->except('_token');
                $all['created_at']=date("Y-m-d H:i:s",time());
                $all['admin_id']=env('BLOGGER_ID','1');//ahmad
                $all['nickname']=env('BLOGGER_NAME','ahmad');
                $all['email']=env('BLOGGER_EMAIL','ahmad@sina.com');
                // var_dump($all);die;
                if(empty($all))
                {
                    throw new HttpException(\Config::get('constants.http_status_no_accept'),trans('common.message_failure'));
                }
                //数据入库
                $result = \App\Comments::create($all);
                if($result)
                {   
                    return \App\Tools\ajax_success();
                }
                else
                {
                    return \App\Tools\ajax_error();
                }
            }
            $com_id = $req->id;
            $Comments = \App\Comments::find($com_id);
            return view('Admin/Comment/replay',['Comments'=>$Comments]);        
        }            
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getStatusCode(), $e->getMessage());
        }
    }
    /**
     * 删除
     * @param  Request $req [description]
     * @return [type]       [description]
     */
    public function del(Request $req){

        try
        {
            if($req->ajax() && $req->isMethod('post'))
            {
                if($req->has('com_id')){
                    //单删
                    $com_id[] = $req->input('com_id');
                }

                if($req->has('comids')){
                    //批量删除
                    $com_id = $req->input('comids');                    
                }
                if(!$com_id)
                {
                    throw new HttpException(\Config::get('constants.http_status_no_accept'),trans('common.message_failure'));
                }
                $del_ids=array();
                $ids=(new Comments)->getWhere($com_id);
                if($ids){
                    $del_ids=$com_id;
                    foreach ($ids as $key => $value) {
                        $del_ids[]=$value['com_id'];
                    }                    
                }else{
                    $del_ids=$com_id;
                }                
                //删除评论
                $result=(new Comments)->delWhere($del_ids);
                if(!$result){
                    return \App\Tools\ajax_error();
                }
                return \App\Tools\ajax_success();
            }
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getStatusCode(), $e->getMessage());
        }            
       
    }



}

