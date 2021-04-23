<?php

/**
 * 
 * 前台往期视频模块
 * @author 
 *
 */
class ReviewController extends  BaseController
{	  
	/**
	 * 获取多个往期视频
	 * Enter description here ...
	 */
	public function getIndex()
	{		
		$oVideos=Video::where('type','1')->orderBy('end_time','Desc')->paginate(9);
		
		foreach($oVideos as &$v){
			$oExpertInfo=$v->GetMainExpert();
			$v->expertinfo=$oExpertInfo;			
		}
		
		return View::make('front.review.list')->with('oVideos',$oVideos);		
	}	
	/**
	 * 
	 * 获取单个往期视频
	 * @param unknown_type $id
	 */
	public  function getReviewInfo($id){ 		
		$oVideo = Video::find($id);
		$sUrl="http://".$_SERVER['SERVER_NAME']."/review/review-info/".$id;
		$oVideo->d2bar=$this->getQrcode($sUrl,$oVideo->id);	
		$oVideoOther = Video::where('type','1')
						->where('id',"<>",$id)
						->orderBy('end_time','Desc')
						->first();	
								
		return View::make('front.review.info')
							->with('oVideo',$oVideo)
							->with('oVideoOther',$oVideoOther);
						
	}
	
}