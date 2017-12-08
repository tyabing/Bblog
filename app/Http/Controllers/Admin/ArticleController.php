<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('Admin/Article/add');
    }



}
