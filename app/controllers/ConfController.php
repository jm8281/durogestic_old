<?php
/**
 * 
 * 前台会议预告模块
 * @author 
 *
 */
class ConfController extends  BaseController
{
	/**
	 * 
	 * 前台直播预告页
	 */
	public function getIndex()
	{	
		$url=""; //会议直播地址
		$time=0; //会议开始时间
		$qrcode=""; //二维码图片地址
		
		$RecentConf = $this->RecentVideo(); //获取最近一期直播会议
		if($RecentConf == null)
		{
			$state = 0; //无直播状态
			return View::make('front.conference.index')
					->with('state' , $state)
					->with('qrcode' ,$qrcode);			
		}
		else 
		{
			$CurrentUrl=$RecentConf->url; //当前二维码要分享的网址
			$filename=$RecentConf->id; //首页对应的二维码图片名
			$qrcode=$this->getQrcode($CurrentUrl, $filename); //获取二维码图片路径
			$backImg = $RecentConf->img_thumb;//获取视频的略缩图地址
			$oExpert = $RecentConf->GetMainExpert(); //获取会议主持人
			$description= $RecentConf->description; //获取直播简介
			$now = time(); //获取当前时间
			
			if(strtotime($RecentConf->start_time)> $now) //开始时间大于当前时间
			{
				$state = 1; //直播尚未开始
				$time = strtotime($RecentConf->start_time); //获取直播开始时间	
				return View::make('front.conference.index')
					->with(array('state'=>$state,
								 'oExpert'=>$oExpert,								 
								 'time'=>$time, 
								 'description' => $description,
								 'url'=>$CurrentUrl,
								 'qrcode' => $qrcode));			
			}
			else 
			{				
				$state = 2; //直播正在进行
				return View::make('front.conference.index')
					->with(array('state' => $state,
								 'url' => $CurrentUrl,
								 'oExpert' => $oExpert,								 				
								 'description' => $description,
								 'qrcode' => $qrcode));		
			}						
		}	
	}
	/**
	 * 
	 *获取最近一期直播
	 */
	public function RecentVideo()
	{
		$now=date('Y-m-d H:i:s');
		$oVideo=Video::where('end_time','>',$now)->where('type','=','0')->orderBy('start_time','ASC')->first();
		return $oVideo;		
	}
	
}
