<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
class NewsController extends HomeController
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return view('Themes/'.$this->theme.'Home/news');
    }
}
