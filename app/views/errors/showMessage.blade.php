<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>提示信息</title>
<style type="text/css">
.tz_box{ border:1px solid #BABABA; width:350px; height:100px; margin:0 auto;margin-top:200px;}

.tz_box{ text-align:center;}
.tz_box a{ color:#5178CE; font-size:12px; font-weight:bold;}
.tz_box a.red{ color:red;}
</style>
</head>
<body>
<div class="tz_box">
	<p>{{$msg}}</p>
    <p>
    @if($url == "goback")
      <a href="javascript:history.go(-1);" >[ 点这里返回上一页 ]</a>
    @elseif($url)
		<a href="{{$url}}">如果您的浏览器没有自动跳转，请点击<span style="color:red">这里</span></a>
		<input type="hidden" value="{{$url}}" id="url"/>
		<script type="text/javascript">
			var url = document.getElementById('url').value;
			setTimeout(function(){
					location.href = url;
			},1000);
		</script>
	@endif
	</p>
</div>
</body>
</html>