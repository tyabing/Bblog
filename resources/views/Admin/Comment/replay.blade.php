@include('Admin.Common._meta')

<title>{{trans('common.comment_list')}}</title>
</head>
<body>
<div class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-navigate-add">
		<div id="tab-navigate" class="HuiTab">
            {{ csrf_field() }}
			<div class="tabCon">
				
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						{{trans('comment.replay')}}：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="" placeholder="" id="" name="content">
						<input type="hidden" name="parent_id" value="{{$Comments->com_id}}">
						<input type="hidden" name="post_id" value="{{$Comments->post_id}}">
					</div>
					<div class="col-3">
					</div>
				</div>
            
				
			</div>

		</div>
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;{{trans('common.form_submit')}}&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</div>

<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
 <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<!-- <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> -->
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
	
	$("#tab-navigate").Huitab({
		index:0
	});
	$("#form-navigate-add").validate({
		rules:{
			nav_name:{
				required:true,
			},
			jump_url:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
                'type':'post',
                'url' :'/comment/replay',
                'success':function(data)
                {
                    // 200 请求，获取服务器消息与状态
                    layer.msg(data.message,{icon:data.status});
					parent.window.location.reload();

                    // 自动关闭弹窗
                    // var index = parent.layer.getFrameIndex(window.name);
			        // parent.$('.btn-refresh').click();
			        // parent.layer.close(index);
                },
                'error':function(data)
                {                
                    var result = JSON.parse(data.responseText);
                    // 非200请求，获取错误消息
                    layer.msg(result.message,{icon:result.status});
                }
            });

		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>