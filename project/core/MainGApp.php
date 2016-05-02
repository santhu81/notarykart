<?php
class Glob
{
	   static $G_MAIN_PATH=null;
	   static $G_MAIN_SRC=null;
	   static $user_cookie=null;
	   static $aobj_context=null;
	   static $G_ADD_URL=null;
	   static $G_MAIN_URL_INFO=null;
	   static $G_PAGE_NAME=null;
	   static $G_PAGE_FILE_NAME=null;
	function __construct()
    {	
		 require_once((dirname(__FILE__))."/cconfig.php");
		 self::$aobj_context=CConfig::GetDbContext();
		 
		 $this->FormGlobalVars();
		 // $this->AssignCookieDetails();
		 $this->GetAddressBarURL();
	}
	
	function GetAddressBarURL()
	{			
	    $s = &$_SERVER;
		$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
		$sp = strtolower($s['SERVER_PROTOCOL']);
		$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
		$port = $s['SERVER_PORT'];
		$port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
		$host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
		$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
		$uri = $protocol . '://' . $host . $s['REQUEST_URI'];
		$segments = explode('?', $uri, 2);
		$url = $segments[0];
		self::$G_ADD_URL=$url;
	}
	static function FormGlobalVars()
	{
		$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
		 
		 $page_name=($path_parts['filename']); 
		 $page_file_name=($path_parts['basename']); 
		 
	  self::$G_PAGE_NAME= $page_name;
	  self::$G_PAGE_FILE_NAME= $page_file_name;
	  self::$G_MAIN_PATH= self::$aobj_context->main_path;
	  self::$G_MAIN_SRC=self::$aobj_context->main_src;
	  self::$G_MAIN_URL_INFO=self::$aobj_context->main_url_info;
	   /* setcookie("G_PAGE_FILE_NAME", self::$G_PAGE_FILE_NAME,time()+36000333, self::$G_MAIN_PATH ); */
	   /* setcookie("G_MAIN_PATH", self::$G_MAIN_PATH,time()+36000333, self::$G_MAIN_PATH ); */
	   /* setcookie("G_MAIN_SRC", self::$G_MAIN_SRC,time()+36000333, self::$G_MAIN_PATH ); */
	   
	}
	static function RedirectUrl()
	{
		header("Location: ".self::$G_MAIN_PATH."404");
		
	}
	static function GetURLValues($page_id) {
	 
		$url=self::$G_ADD_URL;
		$parse = parse_url($url);
		$path = ltrim($parse['path'], '/');
		
		if( self::$G_MAIN_URL_INFO=="Local")
		{
		$exp_arr=explode("/{$page_id}/",$path);
		$path=$page_id."/".$exp_arr[1];
		$elements = explode('/', $path);
		
		}
		else
		{
		 $elements = explode('/', $path);
		}
		 
		$args = array();
		// Loop through each pair of elements.
		for( $i = 0; $i < count($elements); $i = $i + 2) {
		$args[$elements[$i]] = $elements[$i + 1];
		}
	 
		return $args;
	}
	function DisplayHtml()
	{
		echo $this->html;
	}
	
	function AssignCookieDetails()
	{	
		
		if(!isset($_COOKIE['bicpfafx'])) //playfair cipher for chargeit
		{
			$get_cookie="select cookie_id from cookies";
			$obj_cookie=self::$aobj_context->mobj_db->GetRow($get_cookie);
			self::$user_cookie=md5($obj_cookie[cookie_id]);
		
			$update_cookie="update cookies set cookie_id=cookie_id+1";
			self::$aobj_context->mobj_db->Execute($update_cookie);
			setcookie("bicpfafx", self::$user_cookie,time()+36000333,  "/" );
		}
		else
		{
		 self::$user_cookie=$_COOKIE['bicpfafx'];
		}
		
	}
	
}	
?>