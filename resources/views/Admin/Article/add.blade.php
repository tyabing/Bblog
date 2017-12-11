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
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>{{trans('article.add_slug')}}：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="slug" name="slug">
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

		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" id="articlesort" name="articlesort">
			</div>
		</div> -->
		<!-- <div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="keywords" name="keywords">
			</div>
		</div> -->
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>{{trans('article.add_excerpt')}}：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="excerpt" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>{{trans('article.add_author')}}：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="author" name="author">
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
				<!-- <button onClick="mobanxuanze()" class="btn btn-default radius ml-10">选择模版</button> -->
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">{{trans('article.add_image')}}：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="uploader-thum-container">
					<input type="file" name="image">
				</div>
			</div>
		</div>
		<div class="row cl">
			<!-- <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>{{trans('article.add_markdown')}}：</label> -->
			<div id="test-editormd">
				<textarea name="markdown" id="article_content" style="display:none;"></textarea>
			</div>
			@include('markdown::encode',['editors'=>['test-editormd']])
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<!-- <input class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核 -->
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
				<!-- <button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button> -->
				<button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
 <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<!-- <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> -->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<!-- <script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script> -->
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	//表单验证
	$("#form-article-add").validate({
		rules:{
			title:{
				required:true,
			},
			slug:{
				required:true,
			},
			cat_id:{
				required:true,
			},
			articlecolumn:{
				required:true,
			},
			excerpt:{
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
				'success': function (data) {
					layer.msg(data.message, {icon:data.status});
					parent.window.location.reload();
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