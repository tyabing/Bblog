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
		<span class="r">{{trans('common.total_count')}}：<strong>{{$result->total()}}</strong> {{trans('common.item')}}</span>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th><input type="checkbox" name="" value=""></th>
					<th>{{trans('navigate.nav_name')}}</th>
					<th>{{trans('navigate.is_new_open')}}</th>
					<th>{{trans('navigate.sort')}}</th>
					<th>{{trans('navigate.jump_url')}}</th>
					<th>{{trans('common.created_at')}}</th>
					<th>{{trans('common.updated_at')}}</th>
					<th>{{trans('common.do')}}</th>
				</tr>
			</thead>
			<tbody>

				<!-- 来源于数据库 -->
                @foreach ($result as $nav)
				<tr class="text-c">
					<td><input type="checkbox" name="" value=""></td>
					<td>{{$nav->nav_name}}</td>
					<td>{{$nav->is_open}}</td>
					<td>{{$nav->sort}}</td>
					<td>{{$nav->jump_url}}</td>
					<td>{{$nav->created_at}}</td>
					<td>{{$nav->updated_at}}</td>
					<td class="f-14"><a title="{{trans('common.do_update')}}" href="javascript:;" onclick="system_navigate_edit('{{trans('navigate.update')}}','/article/category/add','1','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="{{trans('common.do_delete')}}" href="javascript:;" onclick="system_navigate_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
                @endforeach
											
			</tbody>
            
		</table>
        <div class="r">
            {{$result->links()}}        
        </div>
        
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
 <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<!-- <script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script> -->
<script type="text/javascript">


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