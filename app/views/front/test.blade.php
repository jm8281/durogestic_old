<html>
<head>
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript">
$(function(){
	var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
	if(userAgent.indexOf("MicroMessenger")>-1)
		$("#show").html("微信端浏览器");
	else
		$("#show").html("PC浏览器");
});
</script>

</head>
<body>
<div id="show"></div>
</body>

</html>