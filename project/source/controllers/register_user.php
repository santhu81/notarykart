<?php
/* 	Author		:	N@v!n
	Date		:	26-Apr-2016
	Desc		:	Save User details to user_registrations table
	
 */

class registration
{
	public $internal_code;
	
	function __construct($aobj_context)
	{
		
		$aobj_context->mobj_db->SetFetchMode(ADODB_FETCH_ASSOC);
		$this->aobj_context=$aobj_context;
	}
	
	function RegisterUser()
	{
		$name =  $this->aobj_context->mobj_data["name"];	 
		$email =  $this->aobj_context->mobj_data["email"];	 
		$phone_no =  $this->aobj_context->mobj_data["phone_no"];	 
		
	
		$check_user_exsist = " SELECT  count(1) as cnt
									FROM user_registrations
									WHERE email=?
							";
		$cde_data_prepare = $this->aobj_context->mobj_db->Prepare($check_user_exsist);
		$cde_data = $this->aobj_context->mobj_db->GetRow($cde_data_prepare,$email);
		
		$cnt=empty($cde_data[cnt])?0:$cde_data[cnt];
		
		if($cnt>0)
		{
			$msg="Sorry, Email id already exsist, signup with different email id.";
			echo $this->aobj_context->mobj_output->ToJSONEnvelope($msg,-1,"failure");
		}
		else
		{
			$password = RandomString(8);
			$registration_qry = "	INSERT INTO user_registrations
												(email,
												name,
												phone_no,
												PASSWORD
												)
									VALUES ('{$email}',
											'{$name}',
											'{$phone_no}',
											'{$password}'
											)
								";
			$registration_qry_lobj = $this->aobj_context->mobj_db->Execute($registration_qry);
			
			if(empty($registration_qry_lobj))
				$msg="Registration failed, try again";
			else
				$msg="Registration in successfully.";
				
				
			echo $this->aobj_context->mobj_output->ToJSONEnvelope($msg,0,"success");
			
		}
	}
}


?>