@include('Admin.Common._meta')

<title>{{trans('article.add_article_title')}} - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>{{trans('article.add_title')}}：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="articletitle" name="title">
			</div>
		</div>
		{{csrf_field()}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>{{trans('article.add_cat_id')}}：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="cat_id" class="select">
					<option value="">{{trans('article.add_cat_value')}}</option>
					@if(!empty($catList))
						@foreach($catList as $key => $val)
							<option value="{{$key}}">{{$val}}</option>
						@endforeach
					@endif
				</select>
				</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>{{trans('article.add_author')}}：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="xxx" placeholder="" id="author" name="author">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">{{trans('article.add_is_allow')}}：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="check-box">
					<input type="checkbox" id="is_allow" name="is_allow" value="1">
					<label for="checkbox-pinglun">&nbsp;</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">{{trans('article.add_is_page')}}：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="check-box">
					<input type="checkbox" name="is_page" value="1" id="checkbox-moban">
					<label for="checkbox-moban">&nbsp;</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<div id="test-editormd">
				<textarea name="markdown" id="article_content" style="display:none;"></textarea>
			</div>
			@include('markdown::encode',['editors'=>['test-editormd']])
		</div>
	</form>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius"   type="submit"><i class="Hui-iconfont">&#xe632;</i> {{trans('article.add_submit')}}</button>
				<button class="btn btn-secondary radius" type="submit" ><i class="Hui-iconfont">&#xe632;</i> {{trans('article.add_temp_submit')}}</button>
				<button class="btn btn-default radius"   type="reset" >&nbsp;&nbsp;{{trans('common.form_cancel')}}&nbsp;&nbsp;</button>
			</div>
		</div>
	
</article>

<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
 <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
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
	// 保存并提交
	$('.btn-primary').mousedown(function(){
		status = 'PUBLISH';
		$("#form-article-add").submit();
	});

	// 保存草稿操作
	$('.btn-secondary').mousedown(function(){
		status = 'DRAFT';
		$("#form-article-add").submit();
	});

		// 表单验证 && 提交
	$("#form-article-add").validate({
		rules:{
			title:{
				required:true,
			},
			cat_id:{
				required:true,
			},
			author:{
				required:true,
			},
			markdown:{
				required:true,
			}
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				'type'   : 'post',
				'url'    : "/article/add",
				'data'   : {'status': status},
				'success': function (data) {
					layer.msg(data.message, {icon:data.status});
					// parent.window.location.reload();
				},
				error: function (data) {
					var result = JSON.parse(data.responseText);
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