<?php
/*
 * @Author: zhangtao 
 * @Date: 2017-12-08 19:29:53 
 * @Last Modified by: DingBing
 * @Last Modified time: 2017-12-14 10:28:48
 */

namespace App\Http\Controllers\Admin;
use Config;
use App\Posts;
use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class CategoryController extends Controller
{
    /**
     * 验证失败返回格式自定义
     *
     * @param Validator $validator
     * @return void
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return \App\Tools\ajax_exception(\Config::get('constants.http_status_no_accept'),implode("\n",$validator->errors()->all()));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show()
    {
        $catList = (new Categories)->levelCatList();
        return view('Admin/Category/show')->with('catList', $catList);
    }
    /**
     * 分类列表的添加
     *
     * @return void
     */
    public function add(Request $request)
    {
        $catList = (new Categories)->levelCatList();
        if($request->isMethod('post'))
        {
            // 验证
            $this->validate($request, [
                'cat_name'  => 'required|unique:categories|max:60',
                'parent_id' => 'required',
            ]);
            $post = $request->except('_token');
            $res  = (new Categories)->insertAdd($post);
            if($res)
            {
                return \App\Tools\ajax_success();
            }
            else
            {
                return \App\Tools\ajax_error();
            }
        }
        return view('Admin/Category/add')->with('catList', $catList);
    }
    /**
     * 分类删除
     *
     * @return void
     */
    public function delete(Request $request)
    {
        try
        {
            if($request->ajax() && $request->method('post'))
            {
                $cid     = intval($request->input('cat_id'));
                $catFind = Categories::find($cid); // 获取当前要删除的数据
                // 如果当前分类下有已发布的文章  无法直接删除
                if((Posts::where(['cat_id' => $catFind->cat_id, 'status' => Posts::STATUS_PUBLISH])->count()) > 0)
                {
                    throw new HttpException(\Config::get('constants.http_status_conflict'),trans('category.del_art_message'));
                }
                // 如果当前分类下有子分类  无法直接删除
                if((Categories::where(['parent_id' => $catFind->cat_id])->count()) > 0)
                {
                    throw new HttpException(\Config::get('constants.http_status_conflict'),trans('category.delete_message'));
                }
                // 执行删除
                if($res = $catFind->delete())
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
     * 分类修改
     *
     * @return void
     */
    public function update(Request $request)
    {
        $cid         = $request->id;
        $catFind     = Categories::find($cid); // 获取单条数据
        // 获取排除当前分类下（含子分类）列表数据
        $excludeList = Categories::recursion((new Categories)->select()->get()->toArray(), $cid);
        // 获取前台展示的无限极分类列表
        $catList     = (new Categories)->getCategoryList($excludeList);
        if($request->ajax() && $request->method('post'))
        {
            // 验证
            $this->validate($request, [
                'cat_name'  => 'required|max:60',
                'parent_id' => 'required',
            ]);
            $data = $request->except('_token');
            $res  = $catFind::where(['cat_id' => $cid])->update($data);
            if($res)
            {
                return \App\Tools\ajax_success();
            }
            else
            {
                return \App\Tools\ajax_error();
            }
        }
        return view('Admin/Category/update', ['catFind' => $catFind, 'catList' => $catList]);
    }

}
