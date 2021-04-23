<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>@yield('title')</title>
<link href="{{ asset('assets/css/style.css')}}" type="text/css" rel="stylesheet" />
<script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script src="{{asset('assets/js/menu.js')}}"></script>
<script src="{{asset('assets/js/pop_on.js')}}"></script>
<script src="{{asset('assets/js/blockui/jquery.blockUI.js')}}"></script>

</head>

<body>

  
	<div class="head">
    	<div class="nav">
            <ul class="nav_body">
                <li><a id="1" class="current" href="/">首页</a></li>
                <li><a id="2" href="/conf">名家讲堂</a></li>
                <li><a id="3" href="/expert">名家风采</a></li>
                <li><a id="4" href="/review">往期视频</a></li>
               
            </ul>
            <input type="hidden" id="current_route" value="{{getRouteName()}}"></input> 
        </div>
    </div>
 @yield('content')

</body>
</html>