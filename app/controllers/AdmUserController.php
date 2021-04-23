<?php

/**
 * 
 * 用户管理模块，包括后台管理员用户的增删改查，以及用户登录模块
 * @author 
 *
 */
class AdmUserController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	/**
	 * 
	 * 后台用户列表模块
	 */
	public function getIndex()
	{ 
		$oUsers=User::All();

		return View::make('adm.user.list')->with('oUsers',$oUsers);
	}	
	
	/**
	 * 
	 * get后台管理员登录模块
	 */
	public function Login() // 
	{
		return View::make('adm.login');
	}
	
	/**
	 * 
	 * post后台管理员登录模块
	 */
	public function LoginDo() 
	{
		$username = Input::get('username');
		$password = Input::get('password');
		if(Auth::attempt(array('username' => $username, 'password' => $password)))
		{ 
			return Redirect::to('/adm');	
		}
		else 
		{
			echo '登录失败';
		}		
	}
	
	/**
	 * 
	 * 后台管理员注销模块
	 */
	public function LogOut()
	{
		Auth::logout();
		return Redirect::to('/adm/login');
	}

	/**
	 * 
	 * 删除用户
	 */
	public function getDelUser()
	{		
	}
	public function postDelUser()
	{
		$Uid=Input::get('id');
		$user=User::find($Uid);
		$user->delete();
		return "已删除";
	}
	/**
	 * 
	 *添加管理员
	 */
	public function getAddUser()
	{
		return View::make('adm.user.add');
	}
	public function postAddUser()
	{
		$UserRegisterErrors=array(
			'username.required'=>'用户名必须填写',
			'username.alpha_num'=>'用户名只能用字母或数字',
			'username.min'=>'用户名长度要大于4',
			'username.unique'=>'此用户名已被注册',
			'password.required'=>'必须填写密码',
			'password.alpha_num'=>'密码只能用字母或数字',
			'password.between'=>'密码长度要在6-12之间',
			'password.confirmed'=>'两次密码输入不一致'	
			);
		$UserRegisterRules=array(
				'username'=>'required|alpha_num|min:4|unique:users', //用户名：必填，字母或数字，大于4个字符，唯一
		    	'password'=>'required|alpha_num|between:6,12|confirmed',//密码：必填，字母或数字，长度在6-12字符之间，需要确认。
		    	
			);
		$validator = Validator::make(Input::all(),$UserRegisterRules,$UserRegisterErrors);
	    if ($validator->passes()) 
	    {
	        $aUser=Input::only('username','password');
				$aUser['password']=Hash::make($aUser['password']);
				$oUser=new User($aUser);
				$oUser->save();
			return View::make('adm.user.add')->with('msg','添加成功');
	    } 
	    else
	    {
	    	
	    	$errors="";
	    	$msg=$validator->messages()->toArray();
	    	foreach($msg as $k=>$v)
	    	{
	    		$errors=$errors."<br />".$v[0];
	    	}
	        return View::make('adm.user.add')->with('msg',$errors);
	    }
	}

	public function getResetPassword($id)
	{
		return View::make('adm.user.resetpassword')->with('id',$id);
	}
	public function postResetPassword()
	{
		$newPass=Input::get('password');
		$cofirm=Input::get('password_confirmation');
		if($newPass != $cofirm)
		    $msg="两次密码输入不一致";
		else 
		{
			$newPass=Hash::make($newPass);
			$id=Input::get('id');
			$oUser = User::find($id);
			$oUser->password=$newPass;
			$oUser->save();	
			$msg="密码重置成功";		
		}
		return View::make('adm.user.resetpassword')->with('id',$id)->with('msg',$msg);		    
	}
	
	

}