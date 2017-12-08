<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
class SystemController extends Controller
{


    /**
     * 柱状图
     *
     * @return void
     */
    public function bar()
    {
        return view('Admin/System/bar');
    }
    /**
     * 屏蔽词
     *
     * @author BING
     * @return [type] [description]
     */
    public function shielding()
    {
        return view('Admin/System/shielding');
    }
    /**
     * 系统设置
     *
     * @author BING
     * @return [type] [description]
     */
    public function setting()
    {
        return view('Admin/System/setting');
    }



}
