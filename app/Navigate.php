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


    /**
     * 查询导航列表
     *
     * @return void
     */
    static public function getNavigates($skip=0,$take=15)
    {
        $count = DB::table('navigates')->count();
        $navigates = DB::table('navigates')->skip($skip)->take($take)->get();
        return ['draw'=>1,'recordsFiltered'=>'15','recordsTotal'=>$count,'data'=>$navigates];
    }

}
