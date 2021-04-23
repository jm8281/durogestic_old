<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="{{ asset('assets/bootstrap3.3.5/css/bootstrap.css')}}" rel="stylesheet">
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/bootstrap3.3.5/js/bootstrap.js')}}"></script>
<link href="{{ asset('assets/css/font-awesome.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet">


<title>管理后台登录</title>
</head>
<body>
<div>
	<div class="page-header">
	  <h1> <small>管理系统后台登录</small></h1>
	</div>

		<form method="POST" action="/adm/login" accept-charset="UTF-8" class="form-horizontal" style="margin-top:200px;width:400px;margin-left:500px;">
		<input name="_token" type="hidden" value="{{csrf_token()}}" />

	  
	  <div class="form-group" style="">
	    <label for="username" class="col-sm-2 control-label" style="width:100px;">用户名：</label>
	    <div class="col-sm-10" style="width:300px;">
	      <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="password" class="col-sm-2 control-label" style="width:100px;">密码：</label>
	    <div class="col-sm-10" style="width:300px;">
	      <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default" style="margin-left:27px;">登录</button>
	    </div>
	  </div>
	</form>
</div>
</body>
</html>