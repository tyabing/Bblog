<?php

namespace App\Http\Controllers\Admin;

use Config;
use App\Comments;
use App\Posts;
use Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\HttpException;
class CommentController extends CommonController
{

    /**
     * 评论列表展示
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {
        if($request->isMethod('get'))
        {
            $result = $this->getFilter($request);
        }
        $comments = Comments::getList($result['map']);       
        return view('Admin/Comment/show')->with('comments',$comments)->with('search',$result['search']);
    }

    /**
     * 处理评论搜索条件
     *
     * @param object $request
     * @return void
     */
    private function getFilter($request)
    {
        $map = [];          // DB使用
        $search = [];       // 原搜索条件
        $search['title'] = $request->input('title',null);
        $search['start'] = $request->input('start',null);
        $search['end'] = $request->input('end',null);
        if(isset($search['title']) && !empty(trim($search['title'])))
        {
            $map[] = ['content','like',"%$search[title]%"];
        }
        if(isset($search['start']) && !empty($search['start']))
        {
            $map[] = ['created_at','>=',$search['start']];
        }
        if(isset($search['end']) && !empty($search['end']))
        {
            $map[] = ['created_at','<=',$search['end']];
        }
        return ['map'=>$map,'search'=>$search];
    }

    /**
     * 待删除
     * 
     * @return void
     */
    public function show2(Request $req)
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
            $where[]=$req->has('end')?array('created_at','<',$req->end):NULL;
            $find['end']=$req->has('end')?$req->end:NULL;
            
            $where=array_filter($where);
            echo '<pre>';
            print_r($where);die;
            //查询评论
            $ment=(new Comments)->getList($where);
            
            $mentList=array();
            if($ment)
            {
                $ments=json_decode(json_encode($ment));
                //查找对应的文章
                $mentData=(new Posts)->getPost($ments->data);
                $mentList=(new Comments)->getCommentList($mentData);               
            }
            
            return view('Admin/Comment/show')->with('mentList',$mentList)
                                             ->with('find',$find)
                                             ->with('ment',$ment);
        }
        catch(\Exception $e)
        {
           echo $e->getMessage(); 
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
                if(empty($all))
                {
                    throw new HttpException(\Config::get('constants.http_status_no_accept'),trans('common.message_failure'));
                }
                //数据入库
                $result = (new Comments)->insertGetId($all);
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

