<?php

ini_set("display_errors","On");
error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE & ~E_DEPRECATED); //& ~E_DEPRECATED
  define("APP_LANDPAGE_G","pclass.php");
  define("APP_PATH_G", dirname($_SERVER["SCRIPT_FILENAME"]));
  define("APP_SRC_G", APP_PATH_G."/project/core");
  define("APP_LIB_G", APP_PATH_G . "/project/core/libs");
  define("APP_DB_G", APP_LIB_G . "/adodb5");
  define("APP_SRC", dirname(dirname($_SERVER["SCRIPT_FILENAME"])));
 
  
  class CConfig
  {
    public $mstr_host;
    public $mstr_user;
    public $mstr_password;
    public $mstr_db;
    public $mbool_debug;
  function __construct($abool_debug = false)
    {
		$this->mstr_host = "localhost";  
		$this->mstr_user = "root";
		$this->mstr_password = "tarka";
		$this->mstr_db = "notarykart";	
		$this->mbool_debug = $abool_debug;      
		ini_set("magic_quotes_gpc", 0);  
    }
	 static function GetDbContext()
		{
			require_once("ccustomappcontext.php");
			$live_aobj_context=new CCustomApplicationContext();
			$live_aobj_context->Initialize();
			$live_aobj_context->mobj_db->SetFetchMode(ADODB_FETCH_ASSOC);		
			return $live_aobj_context;
		}
	 
  }  
?>