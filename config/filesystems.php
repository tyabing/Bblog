<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root'   => storage_path('app'),
        ],
        "qiniu"  => [
            'driver' => 'qiniu',
            'domains'=> [
                'default' => 'p0len7s39.bkt.clouddn.com', // 七牛域名
                'https'   => '', // https域名
                'custom'  => '', // Useles 没什么用，直接使用default即可

            ],
            'access_key' => 'Z3d8_OrnyWSfGaYmA0e82QZ5hazwPc4ieHimShmp',
            'secret_key' => 'xcyIoVUgflrEqVH_LN80CMRvUUZi6iZSd_QANUU8',
            'bucket'     => 'bblog',
            'notify_url' => '', // 持久化处理回调地址（类似于加水印这样的二次操作才需要，avatar在这里的使用）
            'access'     => 'public', // 空间访问控制 public or private
        ],

        'public' => [
            'driver'     => 'local',
            'root'       => storage_path('app/public'),
            'url'        => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key'    => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],



    ],

];
