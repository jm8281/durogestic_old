<?php

/**
 * 
 * 前台名家风采模块
 * @author 
 *
 */
class ExpertController extends  BaseController
{
	/**
	 * 
	 * 前台名家风采列表模块
	 */
	CONST  PAGESIZE = 9;
	
	public function getIndex()
	{	
		$oExpert = Expert::orderby('id','desc')->paginate(self::PAGESIZE);
				
		return View::make('front.expert.list')
						->with('oExpert',$oExpert);
	}
	

		
     /**
      * 
      * 前台专家风采详细
      * @param unknown_type $iId为要显示详细页面的专家id
      */
	public function getInfo($iId)
	{
		
		$oExpert = Expert::find($iId);
		$oVideoExpert=$oExpert->GetRecentVideo();
		if(count($oVideoExpert))
		{  
		   $oOtherExperts=$oExpert->GetOtherExperts()->take(3);
		   if(count( $oOtherExperts))
		   {
		      return View::make('front.expert.info')
						      ->with('oExpert',$oExpert)
 						      ->with('oVideoExpert',$oVideoExpert)
 						      ->with('oOtherExperts',$oOtherExperts);
		   }
		  else
		  {   return View::make('front.expert.info')
						      ->with('oExpert',$oExpert)
 						      ->with('oVideoExpert',$oVideoExpert)
		                      ->with('oOtherExperts',$oOtherExperts);
		  }
		}
		else
		{  
		     return View::make('front.expert.info')
						      ->with('oExpert',$oExpert)
		                      ->with('oVideoExpert',$oVideoExpert);
		                     
		}
		
					
	}

}