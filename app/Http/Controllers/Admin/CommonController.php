<?php
/*
 * @Author: DingBing 
 * @Date: 2017-12-14 19:49:06 
 * @Last Modified by: DingBing
 * @Last Modified time: 2017-12-14 19:57:20
 */

namespace App\Http\Controllers\Admin;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;

class CommonController extends Controller
{

    /**
     * 重写基类-自定义验证失败返回格式
     *
     * @param Validator $validator
     * @return void
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return ['status'=>Config::get('constants.http_status_no_accept'),'message'=>implode("\n",$validator->errors()->all())];
    }

}