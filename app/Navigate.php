<?php
/*
 * @Author: DingBing 
 * @Date: 2017-12-11 15:50:57 
 * @Last Modified by:   DingBing 
 * @Last Modified time: 2017-12-11 15:50:57 
 */

namespace App;

use \Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Navigate extends Model
{
    protected $primaryKey = 'nav_id';

    /**
     * 可以被批量赋值的属性
     *
     * @var array
     */
    protected $fillable = ['nav_name','jump_url','is_open'];


}
