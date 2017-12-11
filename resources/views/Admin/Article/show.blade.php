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
			<option value="0">全部分类</option>
			<option value="1">分类一</option>
			<option value="2">分类二</option>
		</select>
		</span> {{trans('article.show_datetime')}}：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
		<input type="text" name="" id="" placeholder=" {{trans('article.show_search')}}" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> {{trans('common.form_search')}}</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> {{trans('common.batch_delete')}}</a> <a class="btn btn-primary radius" data-title="{{trans('article.add_header')}}" data-href="/article/add" onclick="Hui_admin_tab(this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> {{trans('article.show_now_create')}}</a></span> <span class="r">{{trans('common.total_count')}}：<strong>{{$artList->count()}}</strong> {{trans('common.item')}}</span> </div>
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
				<!-- <tr class="text-c">
					<td><input type="checkbox" value="" name=""></td>
					<td>10002</td>
					<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10002')" title="查看">资讯标题</u></td>
					<td>行业动态</td>
					<td>H-ui</td>
					<td>2014-6-11 11:11:42</td>
					<td>21212</td>
					<td class="td-status"><span class="label label-success radius">草稿</span></td>
					<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_shenhe(this,'10001')" href="javascript:;" title="审核">审核</a> <a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr> -->
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
								<a style="text-decoration:none" onClick="article_shenhe(this,'{{$val->post_id}}')" href="javascript:;" title="{{trans('article.show_list_check')}}">{{trans('article.show_list_check')}}</a>
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('{{trans('article.show_list_edit')}}','article-add.html','{{$val->post_id}}')" href="javascript:;" title="{{trans('article.show_list_edit')}}"><i class="Hui-iconfont">&#xe6df;</i></a> 
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
<!-- <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
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
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm("{{trans('common.ask_delete')}}",function(index){
		$.ajax({
			type: 'POST',
			url: '/article/delete',
			data: {'post_id': id},
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

/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		layer.msg('已下架!',{icon: 5,time:1000});
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});
	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

</script> 
</body>
</html>