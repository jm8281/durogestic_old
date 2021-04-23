<?php
/**
 * 
 * 专家模型
 * @author MaQian
 *
 */
class Expert extends Eloquent{
	
	protected  $table = 'expert';
	protected  $guarded = array('id');
	protected  $softDelete = true;
	
	
	/**
	 * 
	 * 通过videos()方法调用与视频相关的专家对象。可以用$expert->videos获取动态属性
	 * 
	 */
	public function videos()
	{
		
		return $this->belongsToMany('Video','video_expert','expert_id','video_id');

	}
	
	
	/**
	 * 
	 * 通过DoDelete()方法删除一个专家，并且同时删除相关的视频_专家关系。
	 */
	public function DoDelete()
	{
		$this->videos()->detach();//删除此视频的所有视频——专家关系
		$this->delete();
	}
/**
	 * 
	 *获取此专家的最近一期直播/录播
	 */
	public function GetRecentVideo()
	{
		$oVideo=$this->videos()->orderBy('created_at','DESC')->first();
		return $oVideo;		
	}

	/**
	 * 
	 * 获取相关专家（与本专家同时参加最近一期会议的专家）
	 */
	public function GetOtherExperts()
	{
		$oVideo=$this->GetRecentVideo();
		$oExperts=$oVideo->experts()->where('expert_id','<>',$this->id)->get();
		return $oExperts;
	}
	
	/**
	 * Author:ZhangJianGuang
	 * 通过视频ID获取相关专家
	 */
    public static function findExpertByVideoId($avideo){
        foreach($avideo as $k=>$v){
         			
			$oVideoExpert = VideoExpert::where('video_id', $v->id)->first();
			if(empty($oVideoExpert)==0)	
			{
				$v->oDocs =Expert::where('id', $oVideoExpert->expert_id)->first();	
			}	
         }
		return $avideo;
	}
	/**
	 * 
	 * 追加排序约束，按ID升序排列
	 * @param 数据库访问语句
	 */
    public function scopeOrderByCreatedAt($query)
    {
        return $query->orderBy('id', 'ASC');
    }
    /**
     * 
     * 获得所有专家
     * @param  $count为获取专家的数目
     */
    public static function findAllDoc($count = 0){
		if(!$count){
			$oDocs = Expert::orderByCreatedAt()->get();
		}else{
			$oDocs = Expert::orderByCreatedAt()->take($count)->get();
		}
		return $oDocs;
	}
}