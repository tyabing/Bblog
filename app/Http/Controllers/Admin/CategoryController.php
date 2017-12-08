<?php

namespace App\Http\Controllers\Admin;

use App\CategoriesModel;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show()
    {
        $model=new CategoriesModel();
        $res=$model->cateList();
        echo '<pre/>';
        var_dump($res);die;
        return view('Admin/Category/show');
    }
    public function add()
    {
        return view('Admin/Category/add');
    }





}
