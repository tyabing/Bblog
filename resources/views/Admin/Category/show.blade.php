@include('Admin.Common._meta')
<title>分类栏目</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	系统管理
	<span class="c-gray en">&gt;</span>
	栏目管理
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<div class="text-c">
		<input type="text" name="" id="" placeholder="栏目名称、id" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
		<a class="btn btn-primary radius" onclick="system_category_add('添加分类','/category/add')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a>
		</span>
		<span class="r">共有顶级分类：<strong><?= count($catList)?></strong> 条</span>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" disabled></th>
					<th width="100">ID</th>
					<th>栏目名称</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
			@if(!empty($catList))
			@foreach($catList as $obj)
				<tr class="text-c">
					<td><input type="checkbox" name="" objue="{{$obj->cat_id}}"></td>
					<td>{{$obj->cat_id}}</td>
					<td class="text-l">{{$obj->cat_name}}</td>
					<td class="f-14">
						<a title="编辑" href="javascript:void(0)" onclick="system_category_edit('栏目编辑','/article/category/add', '{{$obj->cat_id}}','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="删除" href="javascript:void(0)" onclick="system_category_del(this, '{{$obj->cat_id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
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
// $('.table-sort').dataTable({
// 	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
// 	"bStateSave": true,//状态保存
// 	"aoColumnDefs": [
// 	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
// 	  {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
// 	]
// });
/*系统-栏目-添加*/
function system_category_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-编辑*/
function system_category_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-删除*/
function system_category_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}
</script>
</body>
</html>