<?php 
class CRequestBroker
{
    # The important functions in the CRB are defined static, and hence
    # at the module level, the CRB can be accessed and functions executed
    
    private static $marr_actions = array();
	private static $instance;
       
    private function __construct()
    {
      
    }

    public static function GetInstance()
    {
		if (!isset(self::$instance)) 
		{
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
    }
       
    static function RegisterAction($astr_action, $astr_method)
    {
		
      $lbool_result = false;
      $larr_temp = self::$marr_actions;
      
      $lbool_result = array_key_exists($astr_action, self::$marr_actions);
      if (!$lbool_result)
        self::$marr_actions[$astr_action] = $astr_method;
        
      return (!$lbool_result);
    }

    static function UnregisterAction($astr_action)
    {
      $lbool_result = false;
      
      $lbool_result = array_key_exists($astr_action, self::$marr_actions);
      if ($lbool_result)
        unset(self::$marr_actions[$astr_action]);
        
      return ($lbool_result);
    }
    
    function Initialize()
    {
      self::$marr_actions = array();
    }
    
    static function GetAllRegisteredActions()
    {
      return (self::$marr_actions);
    }

    function GetAction($astr_action)
    {
      $lstr_result = "";
      
      if(array_key_exists($astr_action, self::$marr_actions))
        $lstr_result = self::$marr_actions[$astr_action];
        
      return ($lstr_result);
    }

    function ExecuteAction($astr_action, $aobj_data = NULL)
    {
		$lobj_result = false;
		$larr_method = null;
		
		$lstr_method = $this->GetAction($astr_action);
      if(!empty($lstr_method))
      {
        # split & extract method details and execute
        $larr_method = explode(".",$lstr_method);
        #**** if the php file being included contains errors then executeaction will break
        #**** error handling code has been introduced in coutput.php
		
        require_once(APP_PATH_G . "/project/source/controllers/". $larr_method[0].".php");
       
        // if(function_exists($larr_method[2]))
        if(class_exists($larr_method[1],false))
		{
			
			$class_obj = new $larr_method[1]($aobj_data);
			if(method_exists($class_obj,$larr_method[2]))
			{
				$class_obj->$larr_method[2]();
			}
			else
				echo("Exception: Call to undefined Method[{$larr_method[2]}] of class {$larr_method[1]} in {$larr_method[0]}.php");
			// call_user_func($larr_method[1],$aobj_data);
			//create class object 
		}
         
        else
          echo("Exception: Class {$larr_method[1]} undefined in {$larr_method[0]}.php");
      }
      else
      {
        throw new Exception("Exception executing undefined action : $astr_action");
      }
      
      // return ($lobj_result);
    }
  }
  
?>
