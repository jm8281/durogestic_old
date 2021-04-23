<?php
/**
 * 
 * 首页调用模块
 * @author Administrator
 *
 */
class HomeController extends BaseController
{
	/**
	 * 
	 * 首页功能调用
	 */
	public function Index()
	{
		$time=0;
		$ConfId=-1;
		$url=" ";
		$qrcode="";
		
		/**
		 * 模块1、精彩回顾模块参数调用
		 */
		$oReviews=Video::select('id','img_thumb','title','start_time')->where('type','=','1')->orderBy('created_at','desc')->take(3)->get();
		
		/**		 * 
		 * 模块2：直播倒计时模块参数调用（包含专家列表模块）
		 */
		$RecentConf=$this->RecentVideo(); //获取最近一期直播会议
		if($RecentConf == null)
		{
			$state=0; //无直播状态	
			$oExperts=Expert::select()->orderBy('created_at','DESC')->take(2)->get(); //如果没有近期直播，则获取最新添加的专家				
		}
		else 
		{
			$ConfId=$RecentConf->id; //直播的id号，调用二维码图片时使用。
			$backImg=$RecentConf->img_thumb;//获取视频的略缩图地址
			$oExperts=$this->RelateExperts($RecentConf); //获取会议相关专家
			$CurrentUrl=$RecentConf->url; //当前网址
			$filename=$RecentConf->id; //首页对应的二维码图片名
			$qrcode=$this->getQrcode($CurrentUrl, $filename); //获取二维码图片路径
			$now=time(); //获取当前时间
			
			if(strtotime($RecentConf->start_time)> $now) //开始时间大于当前时间
			{
				$state=1; //直播尚未开始
				$time=strtotime($RecentConf->start_time); //获取直播开始时间
			}
			else 
			{				
				$state=2; //直播正在进行
				$url=$RecentConf->url;  //获取直播地址(未带参数的)
			}						
		}
		
		return View::make('front.index')
					->with(array('oReviews' => $oReviews,'state'=>$state,
								 'oExperts'=>$oExperts,
								 'time'=>$time, 'ConfId'=>$ConfId, 
								 'url'=>$url,
					'qrcode'=>$qrcode));
	}
	/**
	 * 
	 *获取最近一期直播
	 */
	public function RecentVideo()
	{
		$now=date('Y-m-d H:i:s');
		$oVideos=Video::where('end_time','>',$now)->where('type','=','0')->orderBy('start_time','ASC')->first();
		return $oVideos;
		
	}
	/**
	 * 
	 * 获取直播相关专家
	 * @param unknown_type $RecentConf
	 */
	public function RelateExperts($oVideo)
	{
		if($oVideo==NULL)
			return NULL;
		$oExperts=$oVideo->experts()->get();		
		if(count($oExperts)==0) 
			$oExperts=Expert::select()->orderBy('created_at','DESC')->take(2)->get(); 
		return $oExperts;
		
	}
	
}