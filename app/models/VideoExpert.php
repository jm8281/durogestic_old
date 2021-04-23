<?php

/**
 * 
 * 视频/专家关系模型
 * @author MaQian
 *
 */
class VideoExpert extends Eloquent{
	protected $table = 'video_expert';
	protected $guarded = array('id');
    public $timestamps = false;
    /**
     * 
     * 增加视频和专家约束
     * $aDoc视频和专家约束内容
     */
    public function AddVideoExpert($aDoc){
		foreach($aDoc as $k=>$v){
			$this->$k = $v;
		}
		return $this;
	}
	
}