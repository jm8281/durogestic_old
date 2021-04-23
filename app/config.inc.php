<?php
define('TOP_DOMAIN', 'medlive.test');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(dirname(__FILE__))));
define('APP_ROOT', ROOT . DS .'app');
define('ROOT_DIR', ROOT . DS .'public');
define("PHP_IMG",'/assets/images');
define("LIVE_LIMIT",40);		//直播积分上限
define("REVIEW_LIMIT",40);		//录播积分上限
define('HOTLINE','010-64405225-802');
define('SORT','cdma@kingyee&ghy');
define('WX','wx');
define('MOBILE','mobile');



define('SCHEME', $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://');
