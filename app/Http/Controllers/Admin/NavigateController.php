<?php
/*
 * @Author: DingBing 
 * @Date: 2017-12-11 15:49:44 
 * @Last Modified by: DingBing
 * @Last Modified time: 2017-12-11 15:53:22
 */

namespace App\Http\Controllers\Admin;

use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use \Symfony\Component\Console\Input\Input;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class NavigateController extends Controller
{
    /**
     * 验证失败返回格式自定义
     *
     * @param Validator $validator
     * @return void
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return \App\Tools\ajax_exception(implode("\n",$validator->errors()->all()));
    }

    /**
     * 导航列表展示
     *
     * @return void
     */
    public function show(Request $request)
    {
        $navName = $request->input('nav_name',null);
        $result = \App\Navigate::where('nav_name','like',"%$navName%")->orderBy('nav_id','desc')->paginate(Config::get('constants.page_size'));
        return view('Admin/Navigate/show',['result'=>$result,'navName'=>$navName]);
    }

    /**
     * 切换导航前台展示状态
     *
     * @param Request $request
     * @return void
     */
    public function switchIsNewOpen(Request $request)
    {
        try
        {
            $navId = $request->input('nav_id',null);
            $value = $request->input('value',null);
            if(!isset($navId) || !isset($value))
            {
                throw new HttpException(trans('common.paramer_exception'));
            }
            if(!$navigate = \App\Navigate::find($navId))
            {
                throw new HttpException(trans('common.none_record'));
            }
            $navigate->is_open = $value;
            if($navigate->save())
            {
                return \App\Tools\ajax_success();
            }
            else
            {
                return \App\Tools\ajax_error();
            }
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getMessage());
        }

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
            $all = $request->all();
            $all['is_open'] = $request->has('is_open') ? 1 : 0;
            // 数据入库
            $result = \App\Navigate::create($all);
            if($result)
            {   
                return \App\Tools\ajax_success();
            }
            else
            {
                return \App\Tools\ajax_error();
            }
        }
        return view('Admin/Navigate/create');
    }
    
    
    /**
     * 导航修改
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        try
        {
            $nid = $request->id;
            $navigate = \App\Navigate::find($nid);
            if($request->ajax() && $request->isMethod('post'))
            {
                if(!$navigate)
                {
                    throw new HttpException(trans('common.none_record'));
                }
                // 验证数据
                $this->validate($request, [
                    'nav_name' => 'required|max:30',
                    'jump_url' => 'required',
                ]);

                $all = $request->except('_token');
                $all['is_open'] = $request->has('is_open') ? 1 : 0;
                // 数据入库
                $result = \App\Navigate::where('nav_id',$nid)->update($all);
                if($result)
                {   
                    return \App\Tools\ajax_success();
                }
                else
                {
                    return \App\Tools\ajax_error();
                }
            }
            return view('Admin/Navigate/update',['navigate'=>$navigate]);
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getMessage());
        }
    }

    /**
     * 导航删除
     *
     * @return void
     */
    public function delete(Request $request)
    {
        try
        {
            if($request->ajax() && $request->isMethod('post'))
            {
                $nid = $request->input('nid');
                if(!$navigate = \App\Navigate::find($nid))
                {
                    throw new HttpException(trans('common.none_record'));
                }

                if($res = $navigate->delete())
                {
                    return \App\Tools\ajax_success();
                }
                else
                {
                    return \App\Tools\ajax_error();
                }

            }
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getMessage());
        }
    }

    /**
     * 导航批量删除
     */
    public function batchDelete(Request $request)
    {
        try
        {
            if($request->ajax() && $request->isMethod('post'))
            {
                $navids = $request->input('navids');
                if($result = \App\Navigate::destroy($navids))
                {
                    return \App\Tools\ajax_success();
                }
                else
                {
                    return \App\Tools\ajax_error();
                }

            }
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getMessage());
        }        
    }
}
