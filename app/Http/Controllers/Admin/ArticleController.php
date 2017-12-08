<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Categories;
use Illuminate\Http\Request;
use Config;
use zgldh\QiniuStorage;
use Illuminate\Contracts\Validation\Validator;
use App\Posts;

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
        return ['status'=>Config::get('constants.status_danger'),'message'=>implode("\n",$validator->errors()->all())];
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show()
    {
        return view('Admin/Article/show');
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
            ]);
            // 1.是否有文件上传
            if($request->hasFile('image'))
            {
                $newFileName = $request->file('image')->getClientOriginalName();
                // 2.保存到该磁盘（通过检查/storage目录的.gitignore，了解该目录下的文件才能被提交，在软链接配置后直接可访问）
                // storage确认存储位置，file获取全部文件内容
                if(\Storage::disk('qiniu')->put($newFileName, \File::get($request->file('image')->path())))
                {
                    $image = (\Storage::disk('qiniu')->getDriver()->downloadUrl($newFileName))->getUrl();
                }
            }
            $post = $request->all();
            $post['image'] = $image;
            $post['slug']  = $post['title'];
            if(Posts::create($post))
            {
                return ['status' => Config::get('constants.status_success'), 'message' => trans('common.message_success')];
            }
            else
            {
                return ['status' => Config::get('constants.status_error'), 'message' => trans('common.message_failure')];
            }  

        }
        return view('Admin/Article/add')->with('catList', $catList);
    }



}
