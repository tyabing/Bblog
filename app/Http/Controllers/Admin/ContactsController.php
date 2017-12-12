<?php


namespace App\Http\Controllers\Admin;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use \Symfony\Component\Console\Input\Input;
use \Symfony\Component\HttpKernel\Exception\HttpException;
class ContactsController extends Controller
{
     /**
     * 验证失败返回格式自定义-暂未使用
     *
     * @param Validator $validator
     * @return void
     */
    protected function formatValidationErrors(Validator $validator)
    {

        return ajax_exception(implode("\n",$validator->errors()->all()));

    }

    //展示页面
    public function show(Request $request){

        $name = $request->input('name',null);

        $contactsList = \App\Contacts::where('name','like',"%$name%")->where(['status'=>0])->orderBy('id','desc')->paginate(Config::get('constants.page_size'));
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

                    throw new HttpException(trans('common.none_record'));
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
            return \App\Tools\ajax_exception($e->getMessage());
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
                    throw new HttpException(trans('common.none_record'));
                }

                $all = $request->except('_token');

                // 数据入库
                $result = \App\Contacts::where('id',$id)->update(['status'=>1]);

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
            return \App\Tools\ajax_exception($e->getMessage());
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
                throw new HttpException(trans('common.paramer_exception'));
            }
            if(!$Contacts = \App\Contacts::find($id))
            {
                throw new HttpException(trans('common.none_record'));
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
            return \App\Tools\ajax_exception($e->getMessage());
        }
    }


}
?>