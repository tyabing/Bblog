@include('Admin.Common._meta')

<title>{{trans('common.comment_list')}}</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> {{trans('common.home')}}
	<span class="c-gray en">&gt;</span>
	{{trans('common.com_of_mes')}}
	<span class="c-gray en">&gt;</span>
	{{trans('common.comment_list')}}
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<div class="text-c">
		<form action="" method="get">
		 	{{trans('common.date_range')}}
			<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;" name="start" value="@if(isset($search['start'])) {{$search['start']}}@endif">
			-
			<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;" name="end" value="@if(isset($search['end'])) {{$search['end']}}@endif">
			<input type="text" name="title" id="" placeholder="{{trans('comment.posts_name')}}" style="width:250px" class="input-text" value="@if(isset($search['title'])) {{$search['title']}}@endif">
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> {{trans('comment.find_comment')}}</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 

		<span class="l">
		</span>
		<span class="r">{{trans('common.total_count')}}：<strong>{{$comments->total()}}</strong> {{trans('common.item')}}</span>
</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="5"><input type="checkbox" disabled></th>
					<th width="25">{{trans('comment.comment_content')}}</th>
					<th width="15">{{trans('comment.belong_post')}}</th>
					<th width="15">IP</th>
					<th width="15">email</th>
					<th width="15">{{trans('common.created_at')}}</th>
					<th width="10">{{trans('common.do')}}</th>
				</tr>
			</thead>
			<tbody>
			@if(!empty($comments))
			@foreach($comments as $key => $obj)
				<tr class="text-c">
					<td><input type="checkbox" name="com_id[]" value="{{$key}}"></td>
					<td class="text-l">{{$obj['content']}}</td>
					<td class="text-l">{{$obj['title']}}</td>
					<td class="text-l">{{$obj['ip']}}</td>
					<td class="text-l">{{$obj['email']}}</td>
					<td class="text-l">{{$obj['created_at']}}</td>
					<td class="f-14">
					@if($obj['level']==0)
						<a title="{{trans('comment.replay')}}" href="javascript:void(0)"  onclick="comment_replay('{{trans('comment.replay')}}','/comment/replay', '{{$key}}','500','280')"  style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
					@endif
						<a title="{{trans('common.do_delete')}}" href="javascript:void(0)"  onclick="comment_del(this, '{{$key}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
			@endforeach
			@endif
				
			</tbody>
		</table>
		 <div class="r">
                {{$comments->appends(['title'=>$search['title'],'start'=>$search['start'],'end'=>$search['end']])->links()}}    
        </div>
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


/*评论列表-批量删除*/
function batch_delete()
{
	layer.confirm('{{trans('common.ask_delete')}}',function(index){
		var comids = [];
		// 获取选中ID
		$('input[name="com_id[]"]').each(function(index,obj){
			$(obj).prop('checked') ? comids.push($(obj).val()) : '';
		})
		// alert(comids);
		$.post('/comment/del',{'comids':comids,'_token':"{{ csrf_token() }}"},function(data){
			layer.msg(data.message,{icon:data.status});
			window.location.reload();
		})		
	});
}
/**进行回复**/
function comment_replay(title,url,id,w,h){
	layer_show(title,url+"/"+id,w,h);
}
/*评论-删除*/
function comment_del(obj,id){
	layer.confirm('{{trans('common.ask_delete')}}',function(index){
		$.ajax({
			type: 'POST',
			url: '/comment/del',
			data:{'_token':"{{ csrf_token() }}",'com_id':id},
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