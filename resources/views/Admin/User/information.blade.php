@include('Admin.Common._meta')

<title>H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
@include('Admin.Common._header')
@include('Admin.Common._menu')
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span title="个人信息" data-href="welcome.html">个人信息</span>
					<em></em></li>
		</ul>
	</div>
		
</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
             <form action="" method="post" class="form form-horizontal" id="demo2">
							   <legend>个人信息</legend>
                               <input type="hidden" name="_token" value="{{csrf_token()}}">
                               <input type="hidden" name="id" value="{{$data->id}}">
							<div class="row cl">
                                <label class="form-label col-xs-4 col-sm-3">用户名：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" class="input-text"  placeholder="4~16个字符，字母/中文/数字/下划线" name="name" id="username" value="{{$data->name}}">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">邮箱：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="email" email:true class="input-text" placeholder="@" name="email" id="email" value="{{$data->email}}">
								</div>
							</div>
							<!--<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">账户：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" class="input-text" autocomplete="off" placeholder="手机/邮箱" name="account" id="account">
								</div>
							</div>-->
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">密码：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="password" class="input-text" autocomplete="off" placeholder="密码" name="pass" id="password" value="{{$data->password}}">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">密码验证：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="password" class="input-text" autocomplete="off" placeholder="密码" name="password" id="password2" value="{{$data->password}}">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">职业：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" class="input-text" autocomplete="off" placeholder="职业" name="profession" id="job" value="{{$data->profession}}">
								</div>
							</div>
                            <div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">居住地：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" class="input-text" autocomplete="off" placeholder="居住地" name="address" id="address" value="{{$data->address}}">
								</div>
							</div>
							<!--<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">单选框：</label>
								<div class="formControls skin-minimal col-xs-8 col-sm-9">
									<div class="radio-box">
										<input type="radio" id="sex-1" name="sex">
										<label for="sex-1">男</label>
									</div>
									<div class="radio-box">
										<input type="radio" id="sex-2" name="sex">
										<label for="sex-2">女</label>
									</div>
									<div class="radio-box">
										<input type="radio" id="sex-3" name="sex">
										<label for="sex-3">保密</label>
									</div>
								</div>
							</div>-->
							<!--<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">爱好：</label>
								<div class="formControls skin-minimal col-xs-8 col-sm-9">
									<div class="check-box">
										<input type="checkbox" id="aihao-5" name="aihao">
										<label for="checkbox-5">上网</label>
									</div>
									<div class="check-box">
										<input type="checkbox" id="aihao-6" name="aihao">
										<label for="checkbox-6">摄影</label>
									</div>
								</div>
							</div>-->
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">上传头像：</label>
								<div class="formControls col-xs-8 col-sm-9"> <span class="btn-upload">
                                <a href="javascript:void();" class="btn btn-primary radius"><i class="iconfont">&#xf0020;</i> 上传头像</a>
                                <input type="file" multiple name="avatar" class="input-file">
                            </span> </div>
							</div>
							<!--<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">所在城市：</label>
								<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
									<select class="select" size="1" name="city">
										<option value="" selected>请选择城市</option>
										<option value="1">北京</option>
										<option value="2">上海</option>
										<option value="3">广州</option>
									</select>
									</span> </div>
							</div>-->
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">网址：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" class="input-text" placeholder="http://" name="website" id="url" value="{{$data->website}}">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-3">个人简介：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<textarea class="textarea"  placeholder="说点什么...最少输入10个字符" name="introduce" onKeyUp="member_jian(this,500)">{{$data->introduce}}</textarea>
									<p class="textarea-numberbar"><em class="textarea-length">0</em>/500</p>
								</div>
							</div>
							<div class="row cl">
								<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
									<input class="btn btn-primary" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
								</div>
							</div>
						</form>
            
	</div>
</div>
</section>

<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeall">关闭全部 </li>
</ul>
</div>

<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
 <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	var lang = $('textarea').text().length;
    var num = 500 - lang;
    $('.textarea-length').html(num);
});
/*个人信息*/
function myselfinfo(){
	layer.open({
		type: 1,
		area: ['300px','200px'],
		fix: false, //不固定
		maxmin: true,
		shade:0.4,
		title: '查看信息',
		content: '<div>管理员信息</div>'
	});
}

/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
$("#demo2").validate({
		rules:{
            email:{
				required:true,
				email:true,
			},
			username:{
				required:true,
				minlength:4,
				maxlength:16
			},
			password:{
				required:true,
			},
			password2:{
				required:true,
				equalTo: "#password"
			},
			url:{
				url:true
			},
			
		},
		
	});
function member_jian(key,val)
{
    var nums = $('.textarea').val().length;
    // alert(nums)
    var num = val - nums;
    $('.textarea-length').html(num);
}
// function go(){}
</script> 

<!--此乃百度统计代码，请自行删除-->

<!--/此乃百度统计代码，请自行删除-->
</body>
</html>