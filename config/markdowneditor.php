<?php
/*
 * @Author: zhangtao 
 * @Date: 2017-12-07 21:19:37 
 * @Last Modified by: zhangtao
 * @Last Modified time: 2017-12-07 21:26:47
 */

return [
    "default"     => 'qiniu', //默认返回存储位置url
    "dirver"      => ['qiniu'], //存储平台 ['local', 'qiniu', 'aliyun']
    "connections" => [
        "local"  => [
            'prefix' => 'uploads/markdown', //本地存储位置，默认uploads
        ],
        "qiniu"  => [
            'access_key' => 'Z3d8_OrnyWSfGaYmA0e82QZ5hazwPc4ieHimShmp',
            'secret_key' => 'xcyIoVUgflrEqVH_LN80CMRvUUZi6iZSd_QANUU8',
            'bucket'     => 'bblog',
            'prefix'     => '', //文件前缀 file/of/path
            'domain'     => 'http://p0len7s39.bkt.clouddn.com' //七牛自定义域名
        ],
        "aliyun" => [
            'ak_id'     => '',
            'ak_secret' => '',
            'end_point'  => '',
            'bucket'    => '',
            'prefix'    => '',
        ],
    ],
];