<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Categories;
use Illuminate\Http\Request;

class ArticleController extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show()
    {
        return view('Admin/Article/show');
    }
<<<<<<< HEAD
    /**
     * create the new article 
     *
     * @param Request $request
     * @return void
     */
    public function add(Request $request)
=======

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
>>>>>>> 392affd9aebfe0c449a7831a412805cede2976bc
    {
        $catList = (new Categories)->levelCatList(); // 获取前台所需要的层级分类列表
        if($request->isMethod('post'))
        {
            // 验证
            $this->validate($request, [
                'title'  => 'required|unique:posts|max:120',
            ]);
            
            $post = $request->except('_token');
            echo '<pre>';
        print_r($post);die;
        }
        return view('Admin/Article/add')->with('catList', $catList);
    }



}
