<?php

/**
 * 
 * 后台专家模块，可以实现对专家的增删改
 * @author 
 *
 */
class AdmExpertController extends  BaseController{
	
	  	CONST  PAGESIZE = 10; 
	  
	
		 public function __construct()
		{
			$this->beforeFilter('csrf', array('on'=>'post'));
		}
	   	/**
     	 * 
     	 * 后台专家列表模块
     	 */
		public function getIndex()
		{	
			//取出所有专家
			$oExpert = Expert::orderby('id','desc')->paginate(self::PAGESIZE);
			return View::make('adm.expert.list')
						->with('oExpert',$oExpert);
		}
		/**
		 * 
		 * 新增专家
		 */
		public function getAdd()
		{
		return View::make('adm.expert.add');
		}

		/**
		 * 
		 * 新增提交
		 */
	 	public function postAdd()
	 	 { //验证
		   $rules = array(
						'name'  		=> 'required',
		                'photo'  		=> 'required',
		                'title'  		=> 'required',
		                'postion'  		=> 'required',
		                'department'    => 'required',
		                'hospital'  	=> 'required',
		                'description'   => 'required',
		                'education'   => 'required'
				);
		  $validator = Validator::make(Input::all(), $rules);
		  if($validator->passes()) {
			//验证成功，插入数据
			//插入
		  	$aExpert = array(
		  					'name'           => trim(Input::get('name')),
	  						'photo'       	=> Input::get('photo'),
		  					'title'       	=> Input::get('title'),
	  						'postion'     => trim(Input::get('postion')),
		  	                'department'     => trim(Input::get('department')),
		  	                'hospital'     => trim(Input::get('hospital')),
		  					'description'     => trim(Input::get('description')),
		  					'education'     => trim(Input::get('education')),
		  					'created_at'			=> date('Y-m-d H:i:s'),
		  					);
	    	$oExpert = new Expert($aExpert);
		  	$oExpert->save();
		  	return $this->showMessage('专家添加成功','/adm/expert');
		}else{
			return $this->showMessage("请按照要求输入您的数据");
		}
	  
	  }
  		/**
  		 * 
  		 * 编辑专家
  		 * @param unknown_type $id为要编辑的专家的id
  		 */
	    public function getEdit($id){
			$oExpertone = Expert::find($id);
			if($oExpertone)
			{
			return  View::make('adm.expert.edit')
							->with('oExpertone',$oExpertone);
			}
			else 
			return $this->showMessage("没有该专家");
		} 
		
		/**
		 * 
		 * 编辑提交
		 * @param unknown_type $id为要编辑的专家的id
		 */
    	public function postEdit($id){
		//验证
		$rules = array(
				'name'  		=> 'required',
                'photo'  		=> 'required',
                'title'  		=> 'required',
                'postion'  		=> 'required',
                'department'    => 'required',
                'hospital'  	=> 'required',
                'description'   => 'required',
                'education'   => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
    	if ($validator->fails()){
		    return $this->showMessage('请填写必填字段');
		}
		$oExpert=Expert::find($id);
		if ($oExpert) {
	  		$oExpert->name = trim(Input::get('name'));
	  		$oExpert->photo = Input::get('photo');
	  		$oExpert->title = trim(Input::get('title'));
		  	$oExpert->postion = trim(Input::get('postion'));
		  	$oExpert->department = trim(Input::get('department'));
		  	$oExpert->hospital = trim(Input::get('hospital'));
			$oExpert->description =  trim(Input::get('description'));
			$oExpert->education =  trim(Input::get('education'));
			$oExpert->save();
			return $this->showMessage('专家编辑成功','/adm/expert');
		}else
		{
			return $this->showMessage("专家编辑失败");
		}
	   }
   
	   	/**
	   	 * 
	   	 * 删除专家
	   	 * @param unknown_type $id为要删除的专家的id
	   	 */
   		public function getDel($id)
		{   $oExpert = Expert::find($id);
			if($oExpert){
		    $oExpert->delete(); 
			$oVideoExpert = VideoExpert::where('expert_id',$id )->delete();
			return $this->showmessage("删除成功",'/adm/expert');}
			else {			
			return $this->showMessage("没有该专家");}
		}
		
	   /**
	    * 
	    * 上传图片
	    */
		public function postUploadDocThumb(){
			if($_FILES['upload_file']['error']>0){
				return json_encode(array('success'=>false,'msg'=>'上传失败'));
				//$error = $_FILES['thumb']['error'];
			}else{
				$attach_filename = $_FILES['upload_file']['name'];
	    		$attach_fileext = get_filetype($attach_filename);
			    $rand_name = date('YmdHis', time()).rand(1000,9999);
			    
			    $sFileName = $rand_name.'.'.$attach_fileext;   
			    
			    $sPath = "/upload/expert_thumb/$attach_fileext/".date('Ymd',time());
			    
			    $sRealPath = public_path().$sPath;
			    mkdirs($sRealPath);
	//		    $attach_filesize = filesize($_FILES['upload_file']['tmp_name']);
			    move_uploaded_file($_FILES['upload_file']['tmp_name'], $sRealPath.DS.$sFileName);
			    
			    $sFileNameS = $rand_name . '_s.' . $attach_fileext;
				resizeImage ( $sRealPath.DS.$sFileName, $sRealPath.DS.$sFileNameS, 1000, 1000 );
			    
			    $sFileUrl = $sPath.'/'.$sFileNameS;
			    
			    $json = array('success'=>true,'photo'=>$sFileUrl);
			    echo json_encode($json);
			    die;
			}
		}
	   
  }