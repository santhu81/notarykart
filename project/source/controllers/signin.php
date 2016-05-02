<?php
/* 	Author		:	N@v!n
	Date		:	26-Apr-2016
	Desc		:	Handle User Signins	
 */

class signin
{
	public $internal_code;
	
	function __construct($aobj_context)
	{
		
		$aobj_context->mobj_db->SetFetchMode(ADODB_FETCH_ASSOC);
		$this->aobj_context=$aobj_context;
	}
	
	function DoSignInUser()
	{
		$username =  $this->aobj_context->mobj_data["username"];	 
		$password =  DecodeFormData($this->aobj_context->mobj_data["password"]);	 
		
	
		
		$check_user = "	Select 	COUNT(1) as cnt,
								icode
							FROM user_registrations 
							WHERE email='{$username}'
							AND password='{$password}'
							";
		
		$check_user_lobj = $this->aobj_context->mobj_db->GetRow($check_user);
		$cnt = $check_user_lobj[cnt];
		$icode = encryptData(check_user_lobj[icode]);
		$_SESSION['LOGIN_USER'] = $icode;
		setcookie("_nk", $icode, time()+3600, "/");
		if($cnt==0)
		{
			$msg ='Invalid combination of username/password.';
			echo $this->aobj_context->mobj_output->ToJSONEnvelope($msg,-1,"failed");
		}
		else
		{
			$msg ='Login Success.';
			echo $this->aobj_context->mobj_output->ToJSONEnvelope($msg,0,"success");

		}
			
		
	}
	
	function DoPasswordReset()
	{
		$username =  $this->aobj_context->mobj_data["username"];	 
		$password = RandomString(8);
		
		$check_user = "	Select 	COUNT(1) as cnt,
								icode
							FROM user_registrations 
							WHERE email='{$username}'
							
							";
		
		$check_user_lobj = $this->aobj_context->mobj_db->GetRow($check_user);
		$cnt = $check_user_lobj[cnt];
		
		if($cnt==0)
		{
			$msg ='Invalid Uername.';
			echo $this->aobj_context->mobj_output->ToJSONEnvelope($msg,-1,"failed");
		}
		else
		{
			$password_reset_qry = "	UPDATE user_registrations
										SET password='{$password}'
										WHERE email = '{$username}'
									";
			$password_reset_qry_lobj = $this->aobj_context->mobj_db->Execute($password_reset_qry);
			$error = $this->aobj_context->mobj_db->errorMSG();
			
			if(empty($error))
			{
				
				$msg ='Password reset successfull and sent to registered Email id.';
				echo $this->aobj_context->mobj_output->ToJSONEnvelope($msg,0,"success");
				
			}
			else
			{
				$msg ='Password reset failed, We regret the inconvenience caused to you, please after sometime';
				echo $this->aobj_context->mobj_output->ToJSONEnvelope($msg,-1,"failed");

			}

		}
		
			
		
	}
}


?>