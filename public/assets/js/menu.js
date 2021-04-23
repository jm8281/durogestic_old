/**
 * 前台菜单栏的动态显示
 */ 
$(function()
	{
		var current=$("#current_route").val();
		if(current=='conf')
		{
		 	$("#1").attr("class","");
		 	$("#2").attr("class","current");
			return;
		}
		if(current=='expert')
		{
		 	$("#1").attr("class","nomal");
		 	$("#3").attr("class","current");
			return;
		}
		if(current=='review')
		{
		 	$("#1").attr("class","nomal");
		 	$("#4").attr("class","current");
			return;
		}	 
	 })