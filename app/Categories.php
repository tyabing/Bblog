<?php
/*
 * @Author: zhangtao 
 * @Date: 2017-12-04 15:23:26 
 * @Last Modified by: zhangtao
 * @Last Modified time: 2017-12-07 17:09:49
 */

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    const PARENTID = 0;
    protected $primaryKey = 'cat_id';
    /**
     * 获取所有分类信息
     *
     * @return void
     */
    public function getList()
    {
        return $this->select('cat_id', 'cat_name')->get()->toArray();
    }
    /**
     * 添加操作
     *
     * @param [type] $post
     * @return void
     */
    public function insertAdd($post)
    {
        return $this->insertGetId($post); // 返回自增id
    }
    /**
     * 层级关系分类列表
     */
    public function levelCatList()
    {
        return $this->getCategoryList($this->select()->get()->toArray());
    }

    /**
     * 递归实现无限极分类
     *
     * @param [type] $data
     * @param string $exclude
     * @param integer $parentId
     * @param integer $level
     * @return void
     */
    static public function recursion($data, $exclude = '', $parentId = 0, $level = 0)
    {
        static $arr = []; //静态数组
        foreach($data as $key => $val)
        {
            //判断当前父id是否和获取到的一致
            if($val['parent_id'] == $parentId && $val['cat_id'] != $exclude)
            {
                $val['level'] = $level;
                $arr[] = $val;
                self::recursion($data, $exclude, $val['cat_id'], $level+1);
            }
        }
        return $arr;
    }

    /**
     * 添加需要的层级关系的分类列表
     *
     * @param array $data
     * @return void
     */
    static public function getCategoryList($data = [])
    {
        $arr = [];
        $catList = self::recursion($data);
        
        foreach($catList as $key => $val)
        {
            $arr[$val['cat_id']] = str_repeat("　　|", $val['level']).$val['cat_name'];
        }
        return $arr;
    }

}