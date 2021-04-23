/**
 * 倒计时程序
 */
var day;
var hour;
var minute;
var second;
var timer; //定时器

$(function()
{
	var time=$("#meeting_start_time").val();
	var Current=Math.round(new Date().getTime()/1000);
    time=time-Current; 
	if(time < 0)
	{
		location.reload();
		return;			        			
	}
    day=parseInt(time/24/60/60);           
    time = time%(24*60*60);
   hour=parseInt(time/60/60);
    time = time%(60*60);
    minute=parseInt(time/60);
    time = time%(60);
    second=time;
    timmer();
});
function timmer()
{    
	timer=setInterval("fun()",1000);
}
function fun() //倒计时函数
{

	if(second == 0)
	{
		if(minute == 0)
		{
			if(hour == 0)
			{
				day --;
				if(day < 0)
				{
					clearInterval(timer);
					location.reload();
					return;			        			
				}
				hour = 24;
			}
			hour --;
			minute = 60;
		}
		minute --;
		second = 60;
	}
	second --;
	if(day < 0) return;//liuy 倒计时不要显示 -1天
	$("#time1").html(day);
	if(hour < 10)
		$("#time2").html("0"+hour);
	else
		$("#time2").html(hour);
	if(minute < 10)
		$("#time3").html("0"+minute);
	else
		$("#time3").html(minute);
	if(second < 10)
		$("#time4").html("0"+second);
	else
		$("#time4").html(second);

}					