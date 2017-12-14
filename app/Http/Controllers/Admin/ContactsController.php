<?php


namespace App\Http\Controllers\Admin;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Symfony\Component\Console\Input\Input;
use \Symfony\Component\HttpKernel\Exception\HttpException;
class ContactsController extends CommonController
{


    //展示页面
    public function show(Request $request){

        $name = $request->input('name',null);

        $contactsList = \App\Contacts::where('name','like',"%$name%")->orderBy('status','asc')->paginate(Config::get('constants.page_size'));
        return view('Admin/Contacts/show', ['contactsList' => $contactsList,'name'=>$name]);
    
    }
    /**
     * 留言删除
     *
     * @return void
     */
    public function delete(Request $request)
    {

        try
        {
            if($request->ajax() && $request->isMethod('post'))
            {
                $id = $request->input('id');

                if(!$Contacts = \App\Contacts::find($id))
                {
                    throw new HttpException(\Config::get('constants.http_status_no_accept'),trans('common.none_record'));
                }
                if($res = $Contacts->delete())
                {

                    return \App\Tools\ajax_success();
                }
                else
                {
                    return \App\Tools\ajax_error();
                }
            }
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getStatusCode(), $e->getMessage());
        }
    }

    /**
     * 留言修改
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        try
        {
            $id = $request->id;

            $Contacts = \App\Contacts::find($id);
            if($request->ajax() && $request->isMethod('post'))
            {
                if(!$Contacts)
                {
                    throw new HttpException(\Config::get('constants.http_status_no_accept'),trans('common.none_record'));
                }

                $all = $request->except('_token');
                $all['status']=1;
                // 数据入库
                $result = \App\Contacts::where('id',$id)->update($all);
            
                if($result)
                {
                    return \App\Tools\ajax_success();
                }
                else
                {
                    return \App\Tools\ajax_error();
                }
            }
            return view('Admin/Contacts/update',['Contacts'=>$Contacts]);
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getStatusCode() ,$e->getMessage());
        }
    }
    /**
     * 切换状态前台展示状态
     *
     * @param Request $request
     * @return void
     */
    public function switchIsNewOpen(Request $request)
    {
        try
        {
            $id = $request->input('id',null);
            $value = $request->input('value',null);
            if(!isset($id) || !isset($value))
            {
                throw new HttpException(\Config::get('constants.http_status_no_accept'),trans('common.paramer_exception'));
            }
            if(!$Contacts = \App\Contacts::find($id))
            {
                throw new HttpException(\Config::get('constants.http_status_no_accept'),trans('common.none_record'));
            }
            $Contacts->status = $value;

            if($Contacts->save())
            {
                return \App\Tools\ajax_success();
            }
            else
            {
                return \App\Tools\ajax_error();
            }
        }
        catch(\Exception $e)
        {
            return \App\Tools\ajax_exception($e->getStatusCode(), $e->getMessage());
        }
    }


}
?>