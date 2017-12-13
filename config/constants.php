<?php
/**
 * 全局常量定义
 * 
 */

return [
    /**
     * Ajax 状态说明
     * 1.成功（✔️）；0.警告（❗️）；2.错误（❌）；3.疑问（❓）4.权限（🔐）
     */
    'status_success'    => 1,
    'status_danger'     => 0,
    'status_error'      => 2,
    'status_doubt'      => 3,
    'status_refuse'     => 4,


    /**
     * Http 状态码
     * 
     */
    'http_status_conflict' => '409', // 冲突状态码
    'http_status_grammar'  => '400', // 语法错误，服务器不识别
    'http_status_no_accept'=> '406', // 服务器不接受

    /** 每页展示条数 */
    'page_size'         => 2,



    
];
