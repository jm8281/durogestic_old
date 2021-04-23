<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="{{ asset('assets/bootstrap3.3.5/css/bootstrap.css')}}" rel="stylesheet">

<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/bootstrap3.3.5/js/bootstrap.js')}}"></script>
<link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet">


<title>@yield('title')</title>

</head>
<body>
	<div class="navbar navbar-default">
	  <div class="container">
	    <div class="navbar-header">
	      <button data-target=".navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand hidden-sm">杨森多瑞吉管理后台</a>
	    </div>
	  </div>
	  <div style="float:right;font-size:14px;">{{Auth::user()->username}},欢迎您！<a href="/adm/logout">退出</a>&nbsp;&nbsp;&nbsp;</div>
	</div>
	<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
			<div class="accordion" id="accordion-11">
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" href="/adm">
						首页
						</a>
					</div>
				</div>
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" href="/adm/user">
						用户管理
						</a>
					</div>
				</div>
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" href="/adm/expert">
						专家管理
						</a>
					</div>
				</div>
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" href="/adm/video/video-list">
						直播/录播管理
						</a>
					</div>
				</div>
			</div>
		</div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
			<div class="col-md-12" id="content" >
			   @yield('content')
			</div>
        </div>
      </div>
    </div>
</body>
</html>
