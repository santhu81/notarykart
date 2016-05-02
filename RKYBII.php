<?php
/* 	Author		:	N@v!n 
	Date		:	22-Apr-2016
	Description	:	Accepts all Ajax Request and deligate to respective files as per defined in "ckregister file".
	Version		:	V2.0
	File Path	: 	Root Directory of application
*/
	
	ini_set("memory_limit",-1);
	require_once(dirname($_SERVER["SCRIPT_FILENAME"])."/project/core/cconfig.php");
	require_once(dirname($_SERVER["SCRIPT_FILENAME"])."/project/core/format.php");
	require_once(  APP_SRC_G. "/cappcontext.php");
	require_once(  APP_SRC_G . "/pkeys.php");
	$g_application = new CApplicationContext();
	$g_application->Initialize();
	$LOGIN_USER = isset($_SESSION['LOGIN_USER']);
	
	if(empty($LOGIN_USER) && !in_array($g_application->mobj_data["CPKP"],$exclude_urls_for_session) )
	{
		$msg="Session Expired, Please Login!";
		echo $g_application->mobj_output->ToJSONEnvelope($msg,-9,"failure");
	}
	else
	{
		$g_application->mobj_orb->ExecuteAction($g_application->mobj_data["CPKP"], $g_application);
		$g_application->mobj_output->Render();
	}
?>
