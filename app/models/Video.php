<?php
/**
 * 
 * 视频模型，会议预告的直播和往期回顾的录播都采用这一模型。
 * @author MaQian,JianGuangZhang
 *
 */
class Video extends Eloquent{
	protected $table = 'video';
	protected $guarded =array('id');
	protected $softDelete = true; //设置软删除
	
	/**
	 * 
	 * 通过experts()方法调用与视频相关的专家对象。
	 * 可以用$video->experts获取动态属性，并附加了pivot中间表字段order，规定order排序小的在前面。
	 */
	public function experts()
	{
		return $this->belongsToMany('Expert','video_expert','video_id','expert_id')->withPivot('order')->orderBy('video_expert.order');
	}
	

	
	/**
	 * 
	 * 向数据库中的video表保存一个Video对象，同时向video_expert表保存此Video与一组expert的关系
	 * @param 输入参数为一个形如（专家id=>order)键值对的数组。如果不填则不录入关系
	 */
	public function DoSave($aExpert_id_order=array())
	{
		$this->save();
		foreach($aExpert_id_order as $id=>$order)
		{			
			$this->AddAssoExpert($id, $order);	
		}
	}
	
	
	/**
	 * 
	 * 为视频对象添加一个关联的专家。
	 * @param  $expert_id：专家的id
	 * @param $order：此专家在这个会议中的顺序号
	 */
	public function AddAssoExpert($expert_id,$order)
	{
		$oExpert=$this->experts->find($expert_id);
		if($oExpert!=NULL)
		{
			//已存在关联专家，只需要更新order即可。
			$this->experts()->updateExistingPivot($expert_id, array('order'=>$order),false);			
			return;			
		}
		$this->experts()->attach($expert_id,array('order'=>$order));		
	}
	

	/**
	 * 
	 * 通过DoDelete()方法删除一个视频，并且同时删除相关的视频_专家关系。
	 */
	public function DoDelete()
	{
		$this->experts()->detach();//删除此视频与所有专家的关联。
		$this->delete();
	}
	
	/**
	 * 
	 * 获取视频的主持人（按order排序，order最小的专家）
	 */
	public function GetMainExpert()
	{
		$oExpert=$this->experts()->first();
		return $oExpert;
	}
	/**
	 * 
	 * 查询追加排序，按照created_at降序排列
	 * $query查询操作
	 */
    public function scopeOrderByCreatedAt($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
	/**
	 * 
	 * 获取所有视频
	 */
    public static function findAllVideo(){
		$oVideos = Video::orderByCreatedAt();
		return $oVideos;
	}
	/**
	 * 
	 * 插入指定视频
	 * $aDoc插入的视频数据
	 */
    public function AddVideo($aDoc){
		foreach($aDoc as $k=>$v){
			$this->$k = $v;
		}
		return $this;
	}


	
}