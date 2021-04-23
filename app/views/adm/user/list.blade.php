@extends('adm.common.layout')
@section('title')用户管理@stop
@section('content')

<div class="app_content_div" id="app_content_div_301Index">
		<h3>管理员用户列表</h3>
</div>

<div>
		<div style="float:right;">
			<button type="button" class="btn btn-primary" onclick="window.location.href='/adm/user/add-user'">添加管理员</button>
		</div>
</div>
<table class="table table-striped">
      <thead>
        <tr>
          <th>id</th>

          <th>用户名</th>
          <th>更改密码</th>
          <th>删除<th>
        </tr>
      </thead>
      <tbody>

      	@foreach($oUsers as $v)
        <tr>
          <th scope="row">{{$v->id}}</th>
          <td>{{$v->username}}</td>

          <td><a style="cursor:pointer;" href="/adm/user/reset-password/{{$v->id}}">更改密码</a></td>
          <td>
          		
          		<a onclick="delUser({{$v->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a></span>
          </td>
        </tr>
        @endforeach
      </tbody>
</table>

<script type="text/javascript" language="javascript">

function delUser(id)
{
	if(id=={{Auth::user()->id}})
	{
		alert("不能删除当前登录用户");
		return;
	}
	var r = confirm("确认删除吗？");
	if( r == true )
	{

		var url="/adm/user/del-user";
		var token="{{csrf_token()}}";
		$.post(url,{'_token':token,'id':id},function(data){
				alert(data);
				location.reload();			
			});
		}	
}

</script>
@stop