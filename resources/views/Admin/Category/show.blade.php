@include('Admin.Common._meta')
<title>{{trans('category.show_title')}}</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> {{trans('common.home')}}
	<span class="c-gray en">&gt;</span>
	{{trans('common.system_set')}}
	<span class="c-gray en">&gt;</span>
	{{trans('category.show_break')}}
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="{{trans('common.refresh')}}" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		<!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> {{trans('common.batch_delete')}}</a> -->
		<a class="btn btn-primary radius" onclick="system_category_add('{{trans('category.show_add_category')}}','/category/add','600','400')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> {{trans('category.show_add_category')}}</a>
		</span>
		<span class="r">{{trans('common.total_count')}}：<strong><?= count($catList)?></strong> {{trans('common.item')}}</span>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" disabled></th>
					<th width="100">ID</th>
					<th>{{trans('category.show_list_catname')}}</th>
					<th width="100">{{trans('common.do')}}</th>
				</tr>
			</thead>
			<tbody>
			@if(!empty($catList))
			@foreach($catList as $key => $val)
				<tr class="text-c">
					<td><input type="checkbox" name="" objue="{{$key}}"></td>
					<td>{{$key}}</td>
					<td class="text-l">{{$val}}</td>
					<td class="f-14">
						<a title="{{trans('common.do_update')}}" href="javascript:void(0)" onclick="system_category_edit('{{trans('common.do_update')}}','/category/update', '{{$key}}','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="{{trans('common.do_delete')}}" href="javascript:void(0)" onclick="system_category_del(this, '{{$key}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
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
<!-- <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script> -->
<script type="text/javascript">
/*系统-栏目-添加*/
function system_category_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-编辑*/
function system_category_edit(title,url,id,w,h){
	layer_show(title,url+"/"+id,w,h);
}
/*系统-栏目-删除*/
function system_category_del(obj,id){
	layer.confirm('{{trans('common.ask_delete')}}',function(index){
		$.ajax({
			type: 'POST',
			url: '/category/delete',
			data:{'cat_id': id},
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg(data.message,{icon:data.status});
				window.location.reload();
			},
			error:function(data) {
				var result = JSON.parse(data.responseText);
				
				// 非200请求，获取错误消息
                layer.msg(result.message,{icon:result.status});	
			},
		});
	});
}
</script>
</body>
</html>