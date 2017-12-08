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

        return view('Admin/Category/show');
    }
    public function add()
    {
        return view('Admin/Category/add');
    }





}
