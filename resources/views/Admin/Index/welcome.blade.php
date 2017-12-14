<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<!--[if lt IE 9]>
<script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/admin/lib/respond.min.js"></script>
<![endif]-->
	<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
	<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
	<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
	<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
	<title>我的桌面</title>
</head>

<body>
	<div class="page-container">
		<h3>欢迎使用Bblog开源博客系统
			<small>v1.0</small>
		</h3>
		<p>
			<span class="label label-warning radius">温馨提示：</span>如果您使用过程中，有任何问题，欢迎反馈。
			<span class="pipe">|</span>
			<a class="c-warning" href="https://github.com/dbing/Bblog/issues" target="_blank" title="tyabing">反馈</a>
		</p>

		<div class="page-container">
			<div class="row">
				<div class "col-xs-12 col-sm-12">
					<div id="container"></div>
				</div>

			</div>
		</div>

		<table class="table table-border table-bordered table-bg">
			<thead>
				<tr>
					<th colspan="7" scope="col">最近登录信息</th>
				</tr>
				<tr class="text-c">
					<th>管理员</th>
					<th>登录IP</th>
					<th>登录时间</th>
				</tr>
			</thead>
			<tbody>
				<tr class="text-c">
					<td>Admin</td>
					<td>222.35.131.79.1</td>
					<td>2014-6-14 11:19:55</td>
				</tr>
				<tr class="text-c">
					<td>Admin</td>
					<td>222.35.131.79.1</td>
					<td>2014-6-14 11:19:55</td>
				</tr>
				<tr class="text-c">
					<td>Admin</td>
					<td>222.35.131.79.1</td>
					<td>2014-6-14 11:19:55</td>
				</tr>
			</tbody>
		</table>
		<!--
		<table class="table table-border table-bordered table-bg mt-20">
			<thead>
				<tr>
					<th colspan="2" scope="col">服务器信息</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th width="30%">服务器计算机名</th>
					<td>
						<span id="lbServerName">http://127.0.0.1/</span>
					</td>
				</tr>
				<tr>
					<td>服务器IP地址</td>
					<td>192.168.1.1</td>
				</tr>
			</tbody>
		</table>
		-->
	</div>
	<footer class="footer mt-20">
		<div class="container">
			<p>感谢 必应科技技术团队核心成员
				<a href="https://github.com/itzt" target="_blank" title="itzt">itzt</a>
				<span class="pipe">|</span>
				<a href="https://github.com/tyabing" target="_blank" title="tyabing">tyabing</a>
				<span class="pipe">|</span>
				<a href="https://github.com/flyname" target="_blank" title="flyname">flyname</a>
				<span class="pipe">|</span>
				<a href="https://github.com/mengzhaolis" target="_blank" title="mengzhaolis">mengzhaolis</a>
				<span class="pipe">|</span>
				<a href="https://github.com/dbing" target="_blank" title="dbing">dbing</a>

				<br> Copyright &copy;2015-2017 北京必应科技有限公司
				<br> 本系统后台UI由
				<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供</p>
		</div>
	</footer>
	<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
	<script type="text/javascript" src="lib/hcharts/Highcharts/5.0.6/js/highcharts.js"></script>
	<script type="text/javascript" src="lib/hcharts/Highcharts/5.0.6/js/modules/exporting.js"></script>
	<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
	<script type="text/javascript">

		$(function () {
			//加载层
			var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
			$.ajax({
				method:'get',
				url:'/admin/welcome',
				dataType:'JSON',
				data:{'rand':Math.random()},
				success:function(result){
					drawingStatus(result);
					layer.close(index);
				},
				error:function(data){
                	var result = JSON.parse(data.responseText);
                	// 非200请求，获取错误消息
                	layer.msg(data.message,{icon:data.status});
					layer.close(index);
				}
			})
			

			function drawingStatus(result)
			{
				console.log(result.data.series);
				//return;
				var data = result.data.series;
				var month = result.data.month;
					//return;
				$('#container').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: '信息统计'
					},
					subtitle: {
						text: '本站'
					},
					xAxis: {
						categories: month
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Rainfall (mm)'
						}
					},
					tooltip: {
						headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
						pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
						footerFormat: '</table>',
						shared: true,
						useHTML: true
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0
						}
					},
					series: data
				});
			}



			
		});


	</script>


</body>

</html>