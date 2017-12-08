<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navigate extends Model
{
    /**
     * 可以被批量赋值的属性
     *
     * @var array
     */
    protected $fillable = ['nav_name','jump_url','is_open'];


}
