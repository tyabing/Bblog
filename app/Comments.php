<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Config;
class Comments extends Model
{
	protected $primaryKey='com_id';//表的主键 
    const PARENTID = 0;
    /**
     * 获取所有分类信息
     *
     * @return void
     */
    public function getList($where=array())
    {
        return $this->where($where)->orderBy('parent_id','asc')->paginate(1);
    }
    /** 
     * 有条件查询
     * @param  [type] $where [description]
     * @return [type]        [description]
     */
    public function getWhere($where)
    {
    	return $this->select('com_id')->whereIn('parent_id',$where)->get()->toArray();
    }
    /** 
     * 有条件删除
     * @param  [type] $where [description]
     * @return [type]        [description]
     */
    public function delWhere($where)
    {
    	return $this->whereIn('com_id',$where)->delete();
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
            if($val->parent_id == $parentId && $val->com_id != $exclude)
            {
                $val->level = $level;
                $arr[] = $val;
                self::recursion($data, $exclude, $val->com_id, $level+1);
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
    static public function getCommentList($data = [])
    {
        $arr = [];
        $catList = self::recursion($data,'',$data[0]->parent_id);
        foreach($catList as $key => $val)
        {

        	$arr[$val->com_id]['content'] =$val->nickname."评论：".$val->content;
        	if($val->level!=0){        		
        		$arr[$val->com_id]['content'] = str_repeat("　　".$val->nickname."回复：", $val->level).$val->content;
        	}
        	$arr[$val->com_id]['created_at']=$val->created_at;
        	$arr[$val->com_id]['ip']=$val->ip;
        	$arr[$val->com_id]['email']=$val->email;
        	$arr[$val->com_id]['title']=$val->title;
        	$arr[$val->com_id]['level']=$val->level;            
        }

        return $arr;
    }
}