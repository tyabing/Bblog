<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SetsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function setting(Request $request)
    {
        $array= (new SetsModel())->setlist();

        return view('Admin/System/setting',['array'=>$array]);
    }

    public function setadd(Request $request){

        if($request->isMethod('POST')) {
            $res = $request->all();
            $return= (new SetsModel())->saveSet($res);
        }

        return redirect('system/setting');
    }

}
