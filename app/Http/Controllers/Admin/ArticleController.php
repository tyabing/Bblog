<?php
/*
 * @Author: zhangtao 
 * @Date: 2017-12-11 16:29:53 
 * @Last Modified by: zhangtao
 * @Last Modified time: 2017-12-11 17:12:36
 */

namespace App\Http\Controllers\Admin;

use Config;
use App\Posts;
use App\Categories;
use zgldh\QiniuStorage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Symfony\Component\Console\Input\Input;
use Illuminate\Contracts\Validation\Validator;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class ArticleController extends Controller
{

    /**
     * 验证失败返回格式自定义-暂未使用
     *
     * @param Validator $validator
     * @return void
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return \App\Tools\ajax_exception(implode("\n",$validator->errors()->all()));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show()
    {
        $artList = Posts::getList();
        return view('Admin/Article/show', ['artList' => $artList]);
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
        if($request->isMethod('post'))
        {
            // 验证
            $this->validate($request, [
                'title'  => 'required|unique:posts|max:120',
                'slug'   => 'required|unique:posts|max:20',
            ]);
            $post = $request->all();
            empty($post['image']) ? $post['image'] = '' : $post['image'];
            // 1.是否有文件上传
            if($request->hasFile('image'))
            {
                $newFileName = $request->file('image')->getClientOriginalName();
                // 2.保存到该磁盘（通过检查/storage目录的.gitignore，了解该目录下的文件才能被提交，在软链接配置后直接可访问）
                // storage确认存储位置，file获取全部文件内容
                if(\Storage::disk('qiniu')->put($newFileName, \File::get($request->file('image')->path())))
                {
                    $post['image'] = (\Storage::disk('qiniu')->getDriver()->downloadUrl($newFileName))->getUrl();
                }
            }
            
            $post['html'] = $post['markdown'];
            if(Posts::create($post))
            {
                return ajax_success();
            }
            else
            {
                return ajax_error();
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
                $pid = intval($request->input('post_id'));
                if(!$article = Posts::find($pid))
                {
                    throw new HttpException(trans('common.none_record'));
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
            return \App\Tools\ajax_exception($e->getMessage());
        }
    }



}
