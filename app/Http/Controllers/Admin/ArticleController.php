<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Categories;
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
    public function add()
    {
        $catList = (new Categories)->levelCatList(); // 获取前台所需要的层级分类列表
        return view('Admin/Article/add')->with('catList', $catList);
    }



}
