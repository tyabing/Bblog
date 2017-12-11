<?php

namespace App\Tools;
/**
 * 应用公共函数库
 * 
 */ 
use Config;


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
    return ['status'=>Config::get('constants.status_success'),'message'=>trans('common.message_success')];                    
}

/** Ajax 操作失败响应消息 */
function ajax_error()
{
    return ['status'=>Config::get('constants.status_error'),'message'=>trans('common.message_failure')];
}

/** Ajax 操作异常响应消息 */
function ajax_exception($message="")
{
    return ['status'=>Config::get('constants.status_danger'),'message'=>$message];
}



