@extends('adm.common.layout')
@section('title')添加用户@stop
@section('content')

<div class="app_content_div" id="app_content_div_301Index">
		<h3>新增管理员</h3>
	</div>
<form class="form-horizontal"  method="post" action="/adm/user/add-user">
{{Form::token()}}

	 <div class="form-group">
		    <label for="username" class="col-sm-2 control-label"><span style="color:red;">*</span>用户名</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" style="width:300px;" id="username" name="username" >
		    </div>
	</div>
	<div class="form-group">
		    <label for="password" class="col-sm-2 control-label"><span style="color:red;">*</span>密码</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" style="width:300px;" id="password" name="password" >
		    </div>
	</div>
	<div class="form-group">
		    <label for="password_confirmation" class="col-sm-2 control-label"><span style="color:red;">*</span>确认密码</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" style="width:300px;" id="password_confirmation" name="password_confirmation" >
		    </div>
	</div>
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	    <input type="button",onclick="addUser" value="确定">
	      
	    </div>
	</div>
</form>
@if(isset($msg))
{{$msg}}
@endif
<script type="text/javascript" language="javascript">

function addUser()
{
	
		var url="/adm/adduser";
		var username=$('#username');
		var password=$('#password');
		var password_confirmation=$('password_confirmation');
		var token="{{csrf_token()}}";
		$.post(url,{'_token':token,'username':username,'password':password,'password_confirmation':password_confirmation},function(data){
				alert(data);
				location.reload();			
			});
		}	
}

</script>

@stop