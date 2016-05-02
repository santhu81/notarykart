<?php
  
  class CSessions
  {
	public $user;
    static function Initialize()
    {
      session_start();
    }
    
    static function GetData($astr_key)
    {
      return ($_SESSION[$astr_key]);
    }

    static function SetData($astr_key, $aobj_value)
    {
      $_SESSION[$astr_key] = $aobj_value;
    }
    
    static function GetUser()
    {
      return ($_SESSION["user_id"]);
    }
    
    static function SetUser($aobj_value)
    {
      $_SESSION["user_id"] = $aobj_value;
    }
	
    
  }

?>
