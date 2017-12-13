@include('Admin.Common._meta')

<title>{{trans('contacts.con_details')}}</title>
</head>
<body>
<div class="page-container">
	<form action="/Contacts/update/{{$Contacts->id}}" method="post" class="form form-horizontal" id="form-navigate-editor">
		<div id="tab-navigate" class="HuiTab">
            {{ csrf_field() }}
			<div class="tabCon">
            <h4 align="center">用户：<span style="color: red;">{{$Contacts->name}}</span>为您留的言</h4>

					<textarea class="textarea" style="width:98%; height:250px; resize:non">
							@if(isset($Contacts->message))
								{{$Contacts->message}}
								@endif
					</textarea>

			</div>

		</div>
		<div class="row cl">
			<div class="col-6 col-offset-6">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;{{trans('contacts.con_close')}}&nbsp;&nbsp;">
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
	$("#form-navigate-editor").validate({
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
                // 'url' :'/Contacts/update',
                'success':function(data)
                {
                    // 200 请求，获取服务器消息与状态
                    layer.msg(data.message,{icon:data.status});
                    console.log(data);
                    // 自动关闭弹窗
                    //var index = parent.layer.getFrameIndex(window.name);
			        //parent.$('.btn-refresh').click();
                    //parent.layer.close(index);
                   parent.window.location.reload();
                },
                'error':function(data)
                {                
                    var result = JSON.parse(data.responseText);
                    // 非200请求，获取错误消息
                    layer.msg(data.message,{icon:data.status});
                }
            });

		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>