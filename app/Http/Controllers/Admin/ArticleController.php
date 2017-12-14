<?php
/*
 * @Author: zhangtao 
 * @Date: 2017-12-11 16:29:53 
 * @Last Modified by: DingBing
 * @Last Modified time: 2017-12-14 20:01:45
 */

namespace App\Http\Controllers\Admin;

use Config;
use App\Posts;
use App\Categories;
use zgldh\QiniuStorage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Symfony\Component\Console\Input\Input;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class ArticleController extends CommonController
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show()
    {
        $artList = Posts::getPublishList();
        $catList = (new Categories)->levelCatList();
        return view('Admin/Article/show', ['artList' => $artList, 'catList' => $catList]);
    }
    /**
     * 草稿文件列表
     *
     * @return void
     */
    public function draft()
    {
        $artList = Posts::getDraftList();
        $catList = (new Categories)->levelCatList();
        return view('Admin/Article/draft', ['artList' => $artList, 'catList' => $catList]);
    }
    /**
     * create the new article 
     *
     * @param Request $request
     * @return void
     */
    public function add(Request $request)
    {
        $catList = (new Categories)->levelCatList(); // 获取前台所需要的层级分类列表
        if($request->isMethod('post') && $request->ajax())
        {
            $post = $this->publicAddAndUpdate($request, $type = 'add'); // 调用公共的添加和修改方法
            if(Posts::create($post))
            {
                return \App\Tools\ajax_success();
            }
            else
            {
                return \App\Tools\ajax_error();
            }  

        }
        return view('Admin/Article/add')->with('catList', $catList);
    }


    /**
     * article the delete
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        try
        {
            if($request->method('post') && $request->ajax())
            {
                $pid    = intval($request->input('post_id'));
                $status = $request->input('status');
                if(!$article = Posts::find($pid))
                {
                    throw new HttpException(\Config::get('constants.http_status_no_accept'),trans('common.none_record'));
                }
                if($res = $article->delete())
                {
                    return \App\Tools\ajax_success();
                }
                else
                {
                    return \App\Tools\ajax_error();
                }
            }
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getStatusCode(),$e->getMessage());
        }
    }
    /**
     * update the article
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $aid     = $request->id; // 获取当前修改操作id
        $artFind = Posts::find($aid);
        $catList = (new Categories)->levelCatList();
        try
        {
            if($request->ajax() && $request->method('post'))
            {
                if(!$artFind)
                {
                    throw new HttpException(trans('common.none_record'));
                }
                // 调用公共的添加和修改的方法
                $post = $this->publicAddAndUpdate($request, $type = 'update', $artFind);
                $res  = Posts::where(['post_id' => $aid])->update($post); // 修改入库
                if($res)
                {
                    return \App\Tools\ajax_success();
                }
                else
                {
                    return \App\Tools\ajax_error();
                }
            }
        }
        catch (\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getMessage());
        }
        return view('/Admin/Article/update', ['artFind' => $artFind, 'catList' => $catList]);
        
    }

    /**
     * 公共的添加和修改操作数据
     *
     * @return void
     */
    protected function publicAddAndUpdate($request, $type, $artFind = '')
    {
        if($type == 'add')
        {
            // 验证
            $this->validate($request, [
                'title'  => 'required|unique:posts|max:120',
                'slug'   => 'required|unique:posts|max:20',
            ]);
            $post = $request->all();
            empty($post['image']) ? $post['image'] = '' : $post['image'] = $this->uploadFile($request);
        }
        else
        {
            // 验证
            $this->validate($request, [
                'title'  => 'required|max:120',
                'slug'   => 'required|max:20',
            ]);
            $post = $request->except('_token');
            empty($post['image']) ? $post['image'] = $artFind['image'] : $post['image'] = $this->uploadFile($request);
        }
        $post['html'] = $post['markdown'];
        return $post;
    }

    /**
     * 文件上传
     *
     * @return void
     */
    protected function uploadFile($request)
    {
        // 1.是否有文件上传
            if($request->hasFile('image'))
            {
                $newFileName = $request->file('image')->getClientOriginalName();
                // 2.保存到该磁盘（通过检查/storage目录的.gitignore，了解该目录下的文件才能被提交，在软链接配置后直接可访问）
                // storage确认存储位置，file获取全部文件内容
                if(\Storage::disk('qiniu')->put($newFileName, \File::get($request->file('image')->path())))
                {
                    $img = (\Storage::disk('qiniu')->getDriver()->downloadUrl($newFileName));
                    return $img->getUrl();
                }
            }
    }

}
