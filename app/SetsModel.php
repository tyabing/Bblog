<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class SetsModel extends Model
{

    public  function setlist(){

        $setList = DB::table('sets')->select()->get()->toArray();

        $array=array();
        foreach ($setList as $key => $value) {

            $array[$value->name]=$value->value;
        }
        return $array;
    }

    //修改
    public function saveSet($res)
    {

        $setList = DB::table('sets')->select()->get()->toArray();
        if(empty($setList)){
            foreach ($res as $k => $v) {

                $return = DB::table('sets')->insert(['name' => $k,'value' => $v]);
                if(!$return){
                    return false;
                }
            }
        }else{
            foreach ($res as $k => $v) {

                $return = DB::table('sets')->where(['name' => $k])->update(['value' => $v]);
                if(!$return){
                    return false;
                }
            }
        }
            return  true;
    }
}
