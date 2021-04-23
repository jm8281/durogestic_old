<?php
function Images(){
		//图片表情
		$tips = array ('微笑', '撇嘴', '色', '得意', '流泪', '睡觉', '大哭', '尴尬', '发火', '调皮', '大笑', '郁闷', '抓狂', '吐', '偷笑', '可爱', '白眼', '傲慢', '犯困', '惊恐', '流汗', '奋斗', '疑惑', '晕', '衰', '敲打', '再见', '擦汗', '抠鼻', '鼓掌', '糗', '坏笑', '左哼哼', '右哼哼', '哈欠', '鄙视', '委屈', '快哭了', '阴险', '可怜', '潜水', '石化','安慰','鲜花','手势-棒','手势-逊','握手','胜利' );
		$imageli = '';
		for($i = 0; $i <= 47; $i++) {
			
			if($i<=9){
					$imageli .= '<img src = "'.PHP_IMG.'/front/emotion/' . $i . '.gif"   title="' . $tips [$i] . '"
			               style = \'cursor:pointer;display:inline;\' onclick="insertIcon(\''.PHP_IMG.'/front/emotion/' . $i . '.gif\')" /> ';
			}else{
					$imageli .= '<img src = "'.PHP_IMG.'/front/emotion/' . $i . '.gif"   title="' . $tips [$i] . '"
			               style = \'cursor:pointer;display:inline;\' onclick="insertIcon(\''.PHP_IMG.'/front/emotion/' . $i . '.gif\')" /> ';	
				
			}
		if (($i==15||$i==31||$i==47)&& $i > 0) {
		$imageli .= "<br/>";
			}
		}
			return $imageli;  
}  
function get_filetype($filename) {
    $extend = explode("." , $filename);
    return strtolower($extend[count($extend) - 1]);
}

function mkdirs($path, $mode = 0777)
{
    if(!file_exists($path))
    {
        mkdirs(dirname($path), $mode);
        mkdir($path,$mode);
    }
}



function str_cut_cms($string, $length, $dot = ' ...')
{
	$string = strip_tags($string);
	return mb_strimwidth($string, 0, $length,"...","UTF-8");
}

function resizeImage($im, $dest, $maxwidth, $maxheight) {
    $img = getimagesize($im);
    switch ($img[2]) {
        case 1:
            $im = @imagecreatefromgif($im);
            break;
        case 2:
            $im = @imagecreatefromjpeg($im);
            break;
        case 3:
            $im = @imagecreatefrompng($im);
            break;
    }

    $pic_width = imagesx($im);
    $pic_height = imagesy($im);
	$resizewidth_tag = false;
	$resizeheight_tag = false;
    if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
        if ($maxwidth && $pic_width > $maxwidth) {
            $widthratio = $maxwidth / $pic_width;
            $resizewidth_tag = true;
        }

        if ($maxheight && $pic_height > $maxheight) {
            $heightratio = $maxheight / $pic_height;
            $resizeheight_tag = true;
        }

        if ($resizewidth_tag && $resizeheight_tag) {
            if ($widthratio < $heightratio)
                $ratio = $widthratio;
            else
                $ratio = $heightratio;
        }


        if ($resizewidth_tag && !$resizeheight_tag)
            $ratio = $widthratio;
        if ($resizeheight_tag && !$resizewidth_tag)
            $ratio = $heightratio;
        $newwidth = $pic_width * $ratio;
        $newheight = $pic_height * $ratio;

        if (function_exists("imagecopyresampled")) {
            $newim = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
        } else {
            $newim = imagecreate($newwidth, $newheight);
            imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
        }

        imagejpeg($newim, $dest);
        imagedestroy($newim);
    } else {
        imagejpeg($im, $dest);
    }
	}
	
	
	function mb_unserialize($serial_str) {
		$out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
		return unserialize($out);
	}
	
	function writeFile($filename, $content) {
	    $handle = fopen($filename, 'a');
	    fwrite($handle,$content);
	    fclose($handle);
	}
	
	function recordLog($filename, $content,$dir) {
	    if (!file_exists($dir)) {
	        mkdir($dir, 0777, true);
	    }
	    $fileFullName = $dir . '/' . $filename . '.txt';
	    writeFile($fileFullName, $content);
	}
	
	function user_agent_is_mobile() {
		$agent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';
		if (preg_match('/iphone|android|ipad|windows phone|micromessenger/', $agent)) {
			return true;
		}
		return false;
    }
    /**
     * 与接口通信工具
     *
     * @param string $url
     * @param array $data
     * @param string $method
     * @param int $timeout
     * @return array
     */
    function requestApiByCurl($sUrl, $aData, $sMethod = 'Post', $iTimeout = 10) {
    	$sMethod = strtolower ( $sMethod );
    	$ch = curl_init ();
    	if ($sMethod == 'get') {
    		$sUrl .= '?' . http_build_query ( $aData );
    	}
    	curl_setopt ( $ch, CURLOPT_URL, $sUrl );
    	if ($sMethod == 'post') {
    		curl_setopt ( $ch, CURLOPT_POST, 1 );
    		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $aData );
    	}
    	$iTimeout = intval ( $iTimeout );
    	if ($iTimeout) {
    		curl_setopt ( $ch, CURLOPT_TIMEOUT, $iTimeout );
    	}
    	ob_start ();
    	curl_exec ( $ch );
    	$sOut = ob_get_clean ();
    	curl_close ( $ch );
    	return json_decode ($sOut, true);
    }
    
    function isMobile(){    
	    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';    
	    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';      
	    function CheckSubstrs($substrs,$text){    
	        foreach($substrs as $substr)    
	            if(false!==strpos($text,$substr)){    
	                return true;    
	            }    
	            return false;    
	    }  
	    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');  
	    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');    
	                
	    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||    
	              CheckSubstrs($mobile_token_list,$useragent);    
	                
	    if ($found_mobile){    
	        //return true;
	        if ( strpos(strtolower($useragent), 'micromessenger') !== false ) {
				return WX;
			}else{	
				return MOBILE;
			}    
	    }else{    
	        return false;    
	    }    
	}  