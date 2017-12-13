@include('Admin.Common._meta')

<title>{{trans('article.show_title')}}</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> {{trans('common.home')}} <span class="c-gray en">&gt;</span> {{trans('article.show_header')}} <span class="c-gray en">&gt;</span> {{trans('article.show_title')}} <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="{{trans('common.refresh')}}" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<button onclick="removeIframe()" class="btn btn-primary radius">{{trans('article.show_close_select')}}</button>
	 <span class="select-box inline">
		<select name="" class="select">
			<option value="">全部分类</option>
			@if(!empty($catList))
			@foreach($catList as $key => $val)
				<option value="{{$key}}">{{$val}}</option>
			@endforeach 
			@endif
		</select>
		</span> {{trans('article.show_datetime')}}：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
		<input type="text" name="keyword" id="keyword" placeholder=" {{trans('article.show_search')}}" style="width:250px" class="input-text">
		<button name="" id="search" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> {{trans('common.form_search')}}</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> {{trans('common.batch_delete')}}</a> 
		<a class="btn btn-primary radius" data-title="{{trans('article.add_header')}}" data-href="/article/add" onclick="Hui_admin_tab(this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> {{trans('article.show_now_create')}}</a></span> 
		<span class="r">{{trans('common.total_count')}}：<strong>{{$artList->count()}}</strong> {{trans('common.item')}}</span> 
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>{{trans('article.show_list_title')}}</th>
					<th width="80"> {{trans('article.show_list_category')}}</th>
					<th width="80"> {{trans('article.show_list_author')}}</th>
					<th width="120">{{trans('article.show_list_create_at')}}</th>
					<th width="75"> {{trans('article.show_list_read_num')}}</th>
					<th width="60"> {{trans('article.show_list_status')}}</th>
					<th width="120">{{trans('common.do')}}</th>
				</tr>
			</thead>
			<tbody>
				@if(!empty($artList))
					@foreach($artList as $key => $val)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$val->post_id}}</td>
							<td class="text-l">{{$val->title}}</td>
							<td>{{$val->cat->cat_name}}</td>
							<td>{{$val->author}}</td>
							<td>{{$val->updated_at}}</td>
							<td>{{$val->read_num}}</td>
							<td class="td-status">
								@if($val->status == 'DRAFT')
									<span class="label label-success radius">{{trans('article.show_list_draft')}}</span>
								@else
									<span class="label label-success radius">{{trans('article.show_list_publish')}}</span>
								@endif
							</td>
							<td class="f-14 td-manage">
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('{{trans('common.do_update')}}','/article/update','{{$val->post_id}}')" href="javascript:;" title="{{trans('common.do_update')}}"><i class="Hui-iconfont">&#xe6df;</i></a> 
								<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'{{$val->post_id}}')" href="javascript:;" title="{{trans('common.do_delete')}}"><i class="Hui-iconfont">&#xe6e2;</i></a>
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		<div class="r">
				{{$artList->appends(['title'])->links()}}
		</div>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
 <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<!-- <script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script> -->
<script type="text/javascript">


/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	layer_show(title,url+"/"+id);
}
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm("{{trans('common.ask_delete')}}",function(index){
		$.ajax({
			type: 'POST',
			url: '/article/delete',
			data: {'post_id': id, 'status' : 'DRAFT'},
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