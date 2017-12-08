@include('Admin.Common._meta')
<title>{{trans('navigate.nav_set')}}</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> {{trans('common.home')}}
	<span class="c-gray en">&gt;</span>
	{{trans('common.system_set')}}
	<span class="c-gray en">&gt;</span>
	{{trans('common.navigate_set')}}
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<div class="text-c">
		<input type="text" name="" id="" placeholder="{{trans('navigate.nav_name')}}" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> {{trans('common.form_search')}}</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> {{trans('common.batch_delete')}}</a>
		<a class="btn btn-primary radius" onclick="system_navigate_add('{{trans('navigate.nav_create')}}','/navigate/create')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加导航</a>
		</span>
		<span class="r">{{trans('common.total_count')}}：<strong>54</strong> {{trans('common.item')}}</span>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">排序</th>
					<th width="80">新标签打开</th>
					<th>导航名称</th>
					<th>导航链接</th>
					<th>创建时间</th>
					<th>更新时间</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
			
				<!-- 来源于数据库 -->
				<tr class="text-c">
					<td><input type="checkbox" name="" value=""></td>
					<td>1</td>
					<td>是</td>
					<td>是</td>
					<td>是</td>
					<td>是</td>
					<td class="text-l">一级栏目</td>
					<td class="f-14"><a title="编辑" href="javascript:;" onclick="system_navigate_edit('栏目编辑','/article/category/add','1','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="删除" href="javascript:;" onclick="system_navigate_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
											
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

$('.table-sort').dataTable({
		   
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
	]
});



/*系统-导航-添加*/
function system_navigate_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-导航-编辑*/
function system_navigate_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统-导航-删除*/
function system_navigate_del(obj,id){
	layer.confirm('{{trans('common.ask_delete')}}',function(index){
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