    
/**
 * 显示微信分享对话框
 * @returns
 */
function Pop_on_wx()
    { 
	
	var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
	if(userAgent.indexOf("MicroMessenger")>-1)//如果是微信浏览器
		{
			$("#cover").show();		
		}
	else
		{
		$.blockUI({ 
			message: $("#char_pop"),
	        css:{border:'none' }    
			}); 
		}
	
    }
/**
 * 显示输入姓名对话框
 * @returns
 */
function Pop_on_input()
{
	$.blockUI({ 
		message: $("#name_pop"),
		css:{border:'none' }  
		});	
}

/**
 * 输入姓名，加入会议
 */
function join_meeting()
{
	var nick_name=$("#nick_name").val();
	
	var url=$("#url").val();
	if(nick_name=="")
		{
		alert("请输入姓名");
		return;
		}
		
	url=url+"?nickName="+nick_name;
	window.open(url);
}  
/**
 * 什么也不做的空函数
 */
function nothing()
{
	}
/**
 * 弹出框关闭
 * @returns
 */
    function Pop_close()
    {
    	 $.unblockUI();     
    }
    /**
     * 关闭微信浏览器时的分享遮罩层
     */
    function quit_pop()
    {
    	$("#cover").hide();    	
    }
    
	
	 