<?php

/**
 * 
 * 后台直播/录播视频模块
 * @author 
 *
 */
class AdmVideoController extends  BaseController
{
	CONST  PAGESIZE = 10;
    public function __construct()
	{
			$this->beforeFilter('csrf', array('on'=>'post'));
		}
	/**
	 * 
	 * 后台往期视频列表页
	 */
	public function getIndex()   
	{
		return View::make('adm.video.list');		
	}
	
    public function getEditVideo($id){
		$oVideo = Video::find($id);
		$oDocsAsso=$oVideo->experts()->lists('name','expert_id');
		$oDocs = Expert::findAllDoc()->lists('name','id');
		return  View::make('adm.video.videoedit')
					->with('oVideo',$oVideo)
					->with('oDocs',$oDocs)
					->with('oDocsAsso',$oDocsAsso);
	}
       public function postUploadVideoThumb(){
		if($_FILES['upload_file']['error']>0){
			//$error = $_FILES['thumb']['error'];
			return json_encode(array('success'=>false,'msg'=>'上传失败'));
		}else{
			$attach_filename = $_FILES['upload_file']['name'];
    		$attach_fileext = get_filetype($attach_filename);
		    $rand_name = date('YmdHis', time()).rand(1000,9999);
		    
		    $sFileName = $rand_name.'.'.$attach_fileext;   
		    
		    $sPath = "/upload/video_thumb/$attach_fileext/".date('Ymd',time());
		    
		    $sRealPath = public_path().$sPath;
		    mkdirs($sRealPath);
//		    $attach_filesize = filesize($_FILES['upload_file']['tmp_name']);
		    move_uploaded_file($_FILES['upload_file']['tmp_name'], $sRealPath.DS.$sFileName);
		    
		    $sFileNameS = $rand_name . '_s.' . $attach_fileext;
			resizeImage ( $sRealPath.DS.$sFileName, $sRealPath.DS.$sFileNameS, 1060, 620 );
		    
		    $sFileUrl = $sPath.'/'.$sFileNameS;
		    $json=array('success'=>true,'img_thumb'=>$sFileUrl);
		    echo json_encode($json);
		    die;
		}
	}
     public function postEditVideoDo($id){ 
		$aInput = Input::all();
		$rules = array(
						'title'  		=> 'required',
		                'url'  		=> 'required',
		                'type'  		=> 'required',
		                'description'  		=> 'required',
		                'start_time'  		=> 'required',
		                'end_time'    => 'required',
		                'img_thumb'  	=> 'required',
				);
		$validator = Validator::make($aInput, $rules);
		//unset($aInput['upload_file']);
		//unset($aInput['_token']);
		$aInput = array(
		  					'title'           => trim(Input::get('title')),
	  						'url'       	=> Input::get('url'),
		  					'type'       	=> Input::get('type'),
	  						'description'     => trim(Input::get('description')),
		  	                'start_time'     => Input::get('start_time'),
		  	                'end_time'     => Input::get('end_time'),
		  					'img_thumb'     => Input::get('img_thumb'),
		  					'updated_at'			=> date('Y-m-d H:i:s'),
		                    'doc_id'     => Input::get('doc_id'),
		  					);
            $iOrder=1;
            if (empty($aInput['doc_id'])==1||$validator->fails())
            {
                return $this->showMessage('请填写必填字段','/adm/video/edit-video/'.$id);//爆出一个错误
            }
            else
            {   $aExpertIds=$aInput['doc_id'];
            	unset($aInput['doc_id']);
            	$oVideo = Video::find($id);
            	$bFlag = $aInput['url']==$oVideo->url?true:false;
            	$oVideo->addVideo($aInput)->save();
                VideoExpert::where('video_id',$id)->delete();
            	$iVideoId=$oVideo->id;
            	///////////  
                foreach($aExpertIds as $k=>$v)
		        {
		        	$oVideoExpert = array(
                   'expert_id' => $v,
                   'video_id' => $iVideoId,
			       'order' => $iOrder,
                          );
                   $aVideoExpert[]=$oVideoExpert;       
			       $iOrder=$iOrder+1; 
		        }
            	DB::table('video_expert')->insert($aVideoExpert);
            	if ($aInput['type']==0){
            		if(!$bFlag){
            			try{
            				unlink(public_path().'/upload/2dbarcode/'.$iVideoId.'.png');
            			}catch(Exception $e){}
            		}
            		$Test=$this->getQrcode($aInput['url'],$iVideoId);
            	}else{
            		$sUrl="http://".$_SERVER['SERVER_NAME']."/review/review-info/".$iVideoId;
            		$Test=$this->getQrcode($sUrl,$iVideoId);	
            	}
            	return $this->showMessage('修改视频成功','/adm/video/video-list');
            }
	}
    public function getDelVideo($id){
		$oVideo = Video::find($id);
		$oVideo->DoDelete();
		return $this->showMessage('删除视频成功','/adm/video/video-list');
	}
	
    public function getVideoList()
	{
		
		$oVideos = Video::findAllVideo()->paginate(self::PAGESIZE);
		$oVideos = Expert::findExpertByVideoId($oVideos);
		return  View::make('adm.video.videolist')
					->with('oVideos',$oVideos);
	}
     public function getAddVideo(){
		//取得所有专家
		$oDocs = Expert::findAllDoc()->lists('name','id');
		return  View::make('adm.video.videoadd')
						->with('oDocs',$oDocs);
	}
     public function postAddVideoDo(){
		$aInput = Input::all();
		$rules = array(
						'title'  		=> 'required',
		                'url'  		=> 'required',
		                'type'  		=> 'required',
		                'description'  		=> 'required',
		                'start_time'  		=> 'required',
		                'end_time'    => 'required',
		                'img_thumb'  	=> 'required',
				);
		$validator = Validator::make($aInput, $rules);
		//unset($aInput['upload_file']);
		//unset($aInput['_token']);
		$aInput = array(
		  					'title'           => trim(Input::get('title')),
	  						'url'       	=> Input::get('url'),
		  					'type'       	=> Input::get('type'),
	  						'description'     => trim(Input::get('description')),
		  	                'start_time'     => Input::get('start_time'),
		  	                'end_time'     => Input::get('end_time'),
		  					'img_thumb'     => Input::get('img_thumb'),
		  					'created_at'			=> date('Y-m-d H:i:s'),
		                    'doc_id'     => Input::get('doc_id'),
		  					);
             $iOrder=1;
            if (empty($aInput['doc_id'])==1||$validator->fails())
            {
                return $this->showMessage('请填写必填字段','/adm/video/add-video');//爆出一个错误
            }
            else
            {   $aExpertIds=$aInput['doc_id'];
            	unset($aInput['doc_id']);
            	$oVideo= new Video();
            	$oVideo->addVideo($aInput)->save();
            	$iVideoId=$oVideo->id;
            	
            	foreach($aExpertIds as $k=>$v)
		        {
		        	$oVideoExpert = array(
                   'expert_id' => $v,
                   'video_id' => $iVideoId,
			       'order' => $iOrder,
                          );
                   $aVideoExpert[]=$oVideoExpert;       
			       $iOrder=$iOrder+1; 
		        }
            	DB::table('video_expert')->insert($aVideoExpert);	
            	//$Test=$this->getQrcode($aInput['url'],$iVideoId);
                if ($aInput['type']==0){
            	$Test=$this->getQrcode($aInput['url'],$iVideoId);	
            	}else{
            	$sUrl='http://'.$_SERVER['SERVER_NAME']."/review/review-info/".$iVideoId;
            	$Test=$this->getQrcode($sUrl,$iVideoId);	
            	}
            	return $this->showMessage('新增视频成功','/adm/video/video-list');
            }
    }
		 
	 
	   
}