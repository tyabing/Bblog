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
		<form action="" method="get">
		<input type="text" name="nav_name" value="{{$navName}}" placeholder="{{trans('navigate.nav_name')}}" style="width:250px" class="input-text">
		<button name="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> {{trans('common.form_search')}}</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		<a href="javascript:;" onclick="batch_delete()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> {{trans('common.batch_delete')}}</a>
		<a class="btn btn-primary radius" onclick="system_navigate_add('{{trans('navigate.nav_create')}}','/navigate/create','800','400')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加导航</a>
		</span>
		<span class="r">{{trans('common.total_count')}}：<strong>{{$result->total()}}</strong> {{trans('common.item')}}</span>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th><input type="checkbox" name="" value=""></th>
					<th>{{trans('navigate.nav_name')}}</th>

					<th>{{trans('navigate.jump_url')}}</th>
					<th>{{trans('navigate.sort')}}</th>
					<th>{{trans('common.created_at')}}</th>
					<th>{{trans('common.updated_at')}}</th>
					<th>{{trans('navigate.is_new_open')}}</th>

					<th>{{trans('common.do')}}</th>
				</tr>
			</thead>
			<tbody>

				<!-- 来源于数据库 -->
                @foreach ($result as $nav)
				<tr class="text-c">

					<td><input type="checkbox" name="navid[]" value="{{$nav->nav_id}}"></td>
					<td>{{$nav->nav_name}}</td>
					<td>{{$nav->jump_url}}</td>
					<td>{{$nav->sort}}</td>
					<td>{{$nav->created_at}}</td>
					<td>{{$nav->updated_at}}</td>
					<td>
						<div class="switch size-S" data-on="success" data-off="warning">
							<input nav_id="{{$nav->nav_id}}" type="checkbox" @if($nav->is_open) checked @endif; />
						</div>
                    </td>						
					<td class="f-14"><a title="{{trans('common.do_update')}}" href="javascript:;" onclick="system_navigate_edit('{{trans('navigate.update')}}','/navigate/update','{{$nav->nav_id}}','800','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="{{trans('common.do_delete')}}" href="javascript:;" onclick="system_navigate_del(this,'{{$nav->nav_id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>

				</tr>
                @endforeach
											
			</tbody>
            
		</table>
        <div class="r">

            {{$result->appends(['nav_name'=>$navName])->links()}}        

        </div>
        
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
 <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->


/*系统-导航-添加*/
function system_navigate_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-导航-编辑*/
function system_navigate_edit(title,url,id,w,h){
	layer_show(title,url+"/"+id,w,h);
}
/*系统-导航-删除*/
function system_navigate_del(obj,id){
	layer.confirm('{{trans('common.ask_delete')}}',function(index){
		$.ajax({
			type: 'POST',
			url: '/navigate/delete',
			data:{'_token':"{{ csrf_token() }}",'nid':id},
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg(data.message,{icon:data.status});
				window.location.reload();
			},
			error:function(data) {
				
                var result = JSON.parse(data.responseText);
                // 非200请求，获取错误消息
                layer.msg(data.message,{icon:data.status});				
			},
		});
	});
}
</script>
</body>
</html>