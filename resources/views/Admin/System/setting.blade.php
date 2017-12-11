@include('Admin.Common._meta')

<title>基本设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	系统管理
	<span class="c-gray en">&gt;</span>
	基本设置
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add" action="" method="post">
		{{csrf_field()}}

		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>{{trans('sets.set_basic')}}</span>
				<span>{{trans('sets.set_security')}}</span>
				<span>{{trans('sets.set_email')}}</span>
				<span>{{trans('sets.set_message')}}</span>
				<span>{{trans('sets.set_shield')}}</span>
				<span>{{trans('sets.set_other')}}</span>
			</div>

			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						{{trans('sets.set_web')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-title" placeholder="控制在25个字、50个字节以内" value="<?= isset($array['WebSiteName'])?$array['WebSiteName']:'';?>" class="input-text" name="WebSiteName">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						{{trans('sets.set_keyword')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-Keywords" placeholder="5个左右,8汉字以内,用英文,隔开" value="<?= isset($array['KeyWord'])?$array['KeyWord']:'';?>" class="input-text" name="KeyWord">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						{{trans('sets.set_content')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-description" placeholder="空制在80个汉字，160个字符以内" value="<?= isset($array['Content'])?$array['Content']:'';?>" class="input-text" name="Content">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						{{trans('sets.set_path')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-static" placeholder="默认为空，为相对路径" value="<?= isset($array['Path'])?$array['Path']:'';?>" class="input-text" name="Path">
					</div>
				</div>
				{{--<div class="row cl">--}}
					{{--<label class="form-label col-xs-4 col-sm-2">--}}
						{{--<span class="c-red">*</span>--}}
						{{--上传目录配置：</label>--}}
					{{--<div class="formControls col-xs-8 col-sm-9">--}}
						{{--<input type="text" id="website-uploadfile" placeholder="默认为uploadfile" value="" class="input-text">--}}
					{{--</div>--}}
				{{--</div>--}}
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						{{trans('sets.set_footnews')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-copyright" placeholder="&copy; 2016 H-ui.net" value="<?= isset($array['FootNews'])?$array['FootNews']:'';?>" class="input-text" name="FootNews">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_recordnum')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="website-icp" placeholder="京ICP备00000000号" value="<?= isset($array['RecordNum'])?$array['RecordNum']:'';?>" class="input-text" name="RecordNum">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_group')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea class="textarea" name="Group"><?= isset($array['Group'])?$array['Group']:'';?></textarea>
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_allow_ip')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea class="textarea" name="AllowIp"  placeholder="请以（|）为分割符" id=""><?= isset($array['AllowIp'])?$array['AllowIp']:'';?></textarea>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_failnum')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?= isset($array['FailNum'])?$array['FailNum']:'';?>" id="" name="FailNum" >
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_pattern')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text"  class="input-text" value="<?= isset($array['Pattern'])?$array['Pattern']:'';?>" id="" name="Pattern">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_server')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="" value="<?= isset($array['Server'])?$array['Server']:'';?>" class="input-text" name="Server">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_port')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?= isset($array['Port'])?$array['Port']:'';?>" id="" name="Port" >
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_email_user')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?= isset($array['EmailUser'])?$array['EmailUser']:'';?>" id="emailName" name="EmailUser" >
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_email_pwd')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="password" id="email-password" value="<?= isset($array['EmailPwd'])?$array['EmailPwd']:'';?>" class="input-text" name="EmailPwd">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_email_accept')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="email-address" value="<?= isset($array['EmailAccept'])?$array['EmailAccept']:'';?>" name="EmailAccept" class="input-text">
					</div>
				</div>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_appkey')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text"  class="input-text" value="<?= isset($array['Appkey'])?$array['Appkey']:'';?>" id="" name="Appkey">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_secrekey')}}</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="" value="<?= isset($array['Secrekey'])?$array['Secrekey']:'';?>" class="input-text" name="Secrekey">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">{{trans('sets.set_after_time')}}</label>
					<div class="formControls col-xs-8 col-sm-3">
						<input type="text" id="" value="<?= isset($array['AfterTime'])?$array['AfterTime']:'';?>" class="input-text" name="AfterTime">

					</div>
				</div>
			</div>

			<div class="tabCon">
				<div>
					<textarea class="textarea" style="width:98%; height:300px; resize:none" name="Shielding"><?= isset($array['Shielding'])?$array['Shielding']:'';?></textarea>
				</div>
			</div>
			<div class="tabCon">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> {{trans('common.form_preservation')}}</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;{{trans('common.form_cancel')}}&nbsp;&nbsp;</button>
			</div>
		</div>

	</form>
</div>

<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$("#tab-system").Huitab({
		index:0
	});
    //表单验证
    $("#form-article-add").validate({
        rules:{
            WebSiteName:{required:true},
            FootNews:{required:true},
            RecordNum:{required:true}
        },
        messages:{
            WebSiteName:"网站名不能为空",
            FootNews:"底部版权信息：",
            RecordNum:"备案号不能为空"
            },
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            $(form).ajaxSubmit({
                type:'post',
                url:'/system/setadd',
				success:function ($data) {
					layer.msg('修改成功',{icon:1,time:1000});
                },
				error:function ($data) {
                    layer.msg('修改失败',{icon:0,time:1000});
                }
			})
        }
    });
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
