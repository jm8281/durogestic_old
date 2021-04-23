<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function showMessage($msg='', $url = 'goback', $ms = 1250)
	{
		return View::make('errors.showMessage')->with('msg',$msg)
									  ->with('url',$url)
									  ->with('ms',$ms);
	}
/**
	 * 
	 * 本函数的作用是根据传过来的参数生成二维码，并保存到一个固定的路径下。
	 * @param $data 二维码代表的信息，一般是一个url地址。
	 * @param $name 二维码生成之后，图片的名字
	 */
	public function getQrcode($data,$name)  
	{
    	ini_set('display_errors', 'on');  
		$PNG_TEMP_DIR = public_path().'/upload/2dbarcode/';   //保存的路径
		$PNG_WEB_DIR = '/upload/2dbarcode/';    //调用路径
		require app_path()."/extends/phpqrcode/qrlib.php";    // QRcode lib  
		$ecc = 'H'; // L-smallest, M, Q, H-best  
		$size = "50"; // 1-50  		
		$filename = $PNG_TEMP_DIR.$name.'.png';
		$code= $PNG_WEB_DIR.basename($filename);
		if(!file_exists($PNG_TEMP_DIR))
			$this->mkdirs($PNG_TEMP_DIR); 
		if(!file_exists($filename))
		{
			QRcode::png($data, $filename, $ecc, $size, 2);  
			chmod($filename, 0777);  
		}
		return $code;		
    }
	function mkdirs($path, $mode = 0777)
	{
    	if(!file_exists($path))
    	{
	        $this->mkdirs(dirname($path), $mode);
	        mkdir($path,$mode);
    	}
	}

}
