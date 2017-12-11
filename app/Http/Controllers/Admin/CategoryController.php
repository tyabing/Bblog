<?php
/*
 * @Author: zhangtao 
 * @Date: 2017-12-08 19:29:53 
 * @Last Modified by: zhangtao
 * @Last Modified time: 2017-12-08 19:44:25
 */

namespace App\Http\Controllers\Admin;

use App\CategoriesModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use Config;
use Illuminate\Contracts\Validation\Validator;

class CategoryController extends Controller
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

        $catList = (new Categories)->getList();
        
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



}
