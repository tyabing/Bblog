<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;

class CategoryController extends Controller
{


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
                'cat_name'  => 'required|unique:cat_name|max:60',
                'parent_id' => 'required',
            ]);
            $post = $request->except('_token');
            $res  = (new Categories)->insertAdd($post);
            if($res)
            {
                echo 1;die;
            }
            else
            {
                echo 0;die;
            }
        }
        return view('Admin/Category/add')->with('catList', $catList);
    }


}
