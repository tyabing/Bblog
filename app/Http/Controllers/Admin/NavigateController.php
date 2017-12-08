<?php

namespace App\Http\Controllers\Admin;

use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;

class NavigateController extends Controller
{
    /**
     * 验证失败返回格式自定义-暂未使用
     *
     * @param Validator $validator
     * @return void
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return ['status'=>Config::get('constants.status_danger'),'message'=>implode("\n",$validator->errors()->all())];
    }

    /**
     * 导航设置
     *
     * @return void
     */
    public function show(Request $request)
    {
        if($request->ajax())
        {
            // echo '<pre>';
            $start = $request->input('start',0);
            $length = $request->input('length',10);
            // echo $start,'===';
            // print_r($request->all());
            // die;
            return \App\Navigate::getNavigates($start,$length); 
        
        }
        //var_dump($navigates->links());
        return view('Admin/Navigate/show');
    }

    /**
     * 导航创建
     *
     * @return void
     */
    public function create(Request $request)
    {
        if($request->isMethod('post'))
        {
            // 验证数据
            $this->validate($request, [
                'nav_name' => 'required|unique:navigates|max:30',
                'jump_url' => 'required',
            ]);
            // 数据入库
            $result = \App\Navigate::create($request->all());
            if($result)
            {   
                return ['status'=>Config::get('constants.status_success'),'message'=>trans('common.message_success')];
            }
            else
            {
                return ['status'=>Config::get('constants.status_error'),'message'=>trans('common.message_failure')];
            }
        }
        return view('Admin/Navigate/create');
    }    
}
