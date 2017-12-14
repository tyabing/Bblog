@include('Admin.Common._meta')

<title>评论列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 评论留言 <span class="c-gray en">&gt;</span> 评论列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>
	 <span class="select-box inline">
		<select name="" class="select">
			<option value="0">全部文章</option>
			<option value="1">文章一</option>
			<option value="2">文章二</option>
		</select>
		</span> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
		<input type="text" name="" id="" placeholder=" 文章名称" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜评论</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" disabled></th>
					<th width="100">ID</th>
					<th>评论内容</th>
					<th width="100">所属文章</th>
					<th width="100">IP</th>
					<th width="75">email</th>
					<th width="50">评论时间</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
			@if(!empty($mentList))
			@foreach($mentList as $key => $obj)
				<tr class="text-c">
					<td><input type="checkbox" name="" objue="{{$key}}"></td>
					<td>{{$key}}</td>
					<td class="text-l">{{$obj['content']}}</td>
					<td class="text-l">{{$obj['title']}}</td>
					<td class="text-l">{{$obj['ip']}}</td>
					<td class="text-l">{{$obj['email']}}</td>
					<td class="text-l">{{$obj['created_at']}}</td>
					<td class="f-14">
					@if($obj['level']==0)
						<a title="回复" href="javascript:void(0)" onclick="system_category_edit('回复评论','/comment/add', '{{$key}}','700','480')"  style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
					@endif
						<a title="删除" href="javascript:void(0)"  onclick="comment_del(this, '{{$key}}',{{$obj['level']}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
			@endforeach
			@endif
				
			</tbody>
		</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
 <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">


// /*资讯-编辑*/
// function article_edit(title,url,id,w,h){
// 	var index = layer.open({
// 		type: 2,
// 		title: title,
// 		content: url
// 	});
// 	layer.full(index);
// }
/*评论-删除*/
function comment_del(obj,id,level){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'GET',
			url: '/comment/del',
			data:'com_id='+id+'&level='+level,
			dataType: 'json',
			success: function(data){
				alert(data);
				if(data==1){
					$(obj).parents("tr").remove();
					layer.msg('已删除!',{icon:1,time:1000});
				}else{
					console.log(data.msg);
				}
				
			},
		});		
	});
}


</script> 
</body>
</html>