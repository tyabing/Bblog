<?php

namespace App\Http\Controllers\Admin;

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
        return view('Admin/Category/show');
    }
    public function add()
    {
        return view('Admin/Category/add');
    }




}
