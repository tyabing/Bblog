@include('Admin.Common._meta')

<title>{{trans('navigate.nav_set')}}</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> {{trans('common.home')}}
	<span class="c-gray en">&gt;</span>
	{{trans('common.com_of_mes')}}
	<span class="c-gray en">&gt;</span>
	{{trans('common.message_list')}}
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<div class="text-c">
		<form action="" method="get">
		<input type="text" name="name" value="<?php if(isset($name))echo $name ?>" placeholder="{{trans('contacts.con_name')}}" style="width:250px" class="input-text">
		<button name="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> {{trans('common.form_search')}}</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		<a href="javascript:;" onclick="batch_delete()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> {{trans('common.batch_delete')}}</a>
		</span>
		<span class="r">{{trans('common.total_count')}}：<strong>{{count($contactsList)}}</strong> {{trans('common.item')}}</span>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th><input type="checkbox" name="" value=""></th>
					<th>{{trans('contacts.con_name')}}</th>
					<th>{{trans('contacts.con_subject')}}</th>
					<th>{{trans('contacts.con_email')}}</th>
					<th>{{trans('contacts.con_status')}}</th>
					<th>{{trans('common.do')}}</th>
				
				</tr>
			</thead>
			<tbody>

				<!-- 来源于数据库 -->
				@if(!empty($contactsList))
                @foreach ($contactsList as $con)
				<tr class="text-c">
					<td><input type="checkbox" name="id[]" value="{{$con->id}}"></td>
					<td>{{$con->name}}</td>
					<td>{{$con->subject}}</td>
					<td>{{$con->email}}</td>
					<td>
						<div class="switch size-S" data-on="success" data-off="warning">
							<input id="{{$con->id}}" type="checkbox" @if($con->status) checked @endif; />
						</div>
                    </td>						
					<td class="f-14"><a title="{{trans('common.do_update')}}" href="javascript:;" onclick="system_navigate_edit('{{trans('navigate.update')}}','/Contacts/update','{{$con->id}}','800','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="{{trans('common.do_delete')}}" href="javascript:;" onclick="system_navigate_del(this,'{{$con->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
                @endforeach
				@endif						
			</tbody>
            
		</table>
        <div class="r">
		{{$contactsList->appends(['name'=>$name])->links()}}
        </div>
        
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
@include('Admin.Common._footer')
 <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<!-- <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> -->
<!-- <script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script> -->

<script type="text/javascript">
/**是否新标签打开状态切换 */
$('.switch').on('switch-change', function (e, data) {
	var $el = $(data.el)
		, _this = $(this)
		, id = $el.attr('id')
	  	, value = (data.value) ? 1 : 0;
	  
	$.get('/Contacts/switch',{'id':id,'value':value},function(data){
		layer.msg(data.message,{icon:data.status});
		//如果后台有异常仅语言提示、暂不自动切换回来
		//$(_this).bootstrapSwitch('setState', !$el.prop('checked'));
	})
});
/*系统-导航-编辑*/
function system_navigate_edit(title,url,id,w,h){
    layer_show(title,url+"/"+id,w,h);
}

/*系统-导航-批量删除*/
function batch_delete()
{
	layer.confirm('{{trans('common.ask_delete')}}',function(index){
		var navids = [];
		// 获取选中ID
		$('input[name="id[]"]').each(function(index,obj){
			$(obj).prop('checked') ? navids.push($(obj).val()) : '';
		})
		$.post('/navigate/batch',{'navids':navids,'_token':"{{ csrf_token() }}"},function(data){
			layer.msg(data.message,{icon:data.status});
			window.location.reload();
		})		
	});
}

/*系统-导航-删除*/
function system_navigate_del(obj,id){
	layer.confirm('{{trans('common.ask_delete')}}',function(index){
		$.ajax({
			type: 'POST',
			url: '/Contacts/delete',
			data:{'_token':"{{ csrf_token() }}",'id':id},
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