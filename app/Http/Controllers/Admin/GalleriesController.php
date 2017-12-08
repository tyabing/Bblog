<?php
/*
 * @Author: zhangtao 
 * @Date: 2017-12-06 15:00:14 
 * @Last Modified by: zhangtao
 * @Last Modified time: 2017-12-07 14:43:48
 * @content    this is the gallery action
 */
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Variable;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Input;
//导入七牛相关类
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class GalleriesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('activeUsers');
    // }
    /**
     * this is the gallery show list
     *
     * @return void
     */
    public function show()
    {
        return view('Admin/Galleries/show');
    }

    public function add()
    {
        return view('Admin/Galleries/add');
    }

    

    public function getIndex()
    {
        var_dump(isset($ret));
        $data=$this->getPageData();//获取页面显示所需数据
        $data['uploadSelected']=true;

        return view('portal/upload')->with('data',$data);
    }

    /**
     * 获取页面显示所需数据
     * @return multitype:boolean \Illuminate\Support\Facades\mixed NULL
     */
    private function getPageData(){
        $data = [];//返回视图数据

        $data['loginCount']       = Redis::get('loginNum');//登陆人数
        $data['activeUsersCount'] = Input::get('activeUsers');//活跃人数
        return $data;
    }

    public function postDoupload(){
        $token   = $this->getToken();
        $uploadManager = new UploadManager();
        $name    = $_FILES['file']['name'];
        $filePath= $_FILES['file']['tmp_name'];
        $type    = $_FILES['file']['type'];
        list($ret,$err) = $uploadManager->putFile($token,$name,$filePath,null,$type,false);
        if($err){//上传失败
            var_dump($err);
            return redirect()->back()->with('err',$err);//返回错误信息到上传页面
        }else{//成功
            //添加信息到数据库
            return redirect()->back()->with('key',$ret['key']);//返回结果到上传页面
        }
    }

    /**
     * 生成上传凭证
     * @return string
     */
    private function getToken(){
        $accessKey = config('qiniu.accessKey');
        $secretKey = config('qiniu.secretKey');
        $auth      = new Auth($accessKey, $secretKey);
        $bucket    = config('qiniu.bucket');//上传空间名称
        //设置put policy的其他参数
        //$opts=['callbackUrl'=>'http://www.callback.com/','callbackBody'=>'name=$(fname)&hash=$(etag)','returnUrl'=>"http://www.baidu.com"];
        return $auth->uploadToken($bucket);//生成token      
    }
}
