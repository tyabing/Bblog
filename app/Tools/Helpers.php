<?php
namespace App\Tools;

/*
 * 应用公共函数库
 * 
 * @Author: DingBing 
 * @Date: 2017-12-11 15:43:03 
 * @Last Modified by: zhangtao
 * @Last Modified time: 2017-12-11 17:35:47
 */

use \Symfony\Component\HttpKernel\Exception\HttpException;


/** 开发调试函数 */
function p($data,$isBreak=true)
{
    if(is_array($data) || is_object($data))
    {
        echo '<pre>';
        print_r($data);
    }
    else
    {
        var_dump($data);
    }
    if($isBreak) exit();
}

/** Ajax 操作成功响应消息 */
function ajax_success()
{
    return ['status'=>\Config::get('constants.status_success'),'message'=>trans('common.message_success')];                    
}

/** Ajax 操作失败响应消息 */
function ajax_error()
{
    return ['status'=>\Config::get('constants.status_error'),'message'=>trans('common.message_failure')];
}

/** Ajax 操作异常响应消息 */
function ajax_exception($statusCode,$message='')
{
    if(empty($message)) $message = trans('common.server_exception');
    $data = ['status'=>\Config::get('constants.status_danger'),'message'=>$message];
    return response()->json($data, $statusCode);
}



