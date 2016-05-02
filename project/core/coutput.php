<?php

  require_once(  APP_SRC_G . "/json.php");
  
	function fatal_error_handler($buffer) 
	{
		
		if (preg_match('/(error<\/b>:)(.+)(<br)/', $buffer, $regs) ) 
		{
			
			$err = preg_replace("/<.*?>/","",$regs[2]);
			error_log($err);
			return "ERROR CAUGHT : " . $err;
		}
		return $buffer;
	}

	function handle_error ($errno, $errstr, $errfile, $errline)
	{
		error_log("$errstr in $errfile on line $errline");
		if($errno == FATAL || $errno == ERROR)
		{
		  ob_end_flush();
		  echo "ERROR CAUGHT check log file";
		  exit(0);
		}
	}
  
	class CEnvelope
	{
		public $resp_code = 0;
		public $message = "";
		public $data = NULL;
	}
  
	class COutput
	{

		public $mobj_jsonsvc;
    
		function Initialize()
		{
		  $this->mobj_jsonsvc = new Services_JSON();
		  ob_start("fatal_error_handler");
		  set_error_handler("handle_error");
		}
    
		function Render()
		{
		  ob_end_flush();
		}
    
		function Cancel()
		{
		  ob_clean();  
		}
    
		function Redirect($astr_url)
		{
			if(!headers_sent())
				header("Location: $astr_url");
			else
				throw new Exception("Headers have been sent Already! Can't Redirect!");
		}
		function ToJSONEnvelope(&$aobj_data = NULL, $aint_errorcode = 0, $astr_errormsg = "")
		{
			$lstr_result = "";

			$lobj_temp = new CEnvelope();
			$lobj_temp->resp_code = $aint_errorcode;
			$lobj_temp->message = $astr_errormsg;
			$lobj_temp->data = $aobj_data;


			$lstr_result = $this->mobj_jsonsvc->encode($lobj_temp);
			return( $lstr_result );
		}
		function ToJSONRaw($aobj_data = NULL)
		{
			$lstr_result = $this->mobj_jsonsvc->encode($aobj_data);
			return( $lstr_result );
		}
	}
?>