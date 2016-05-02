<?php
/* 	Author		:	N@v!n
	Date		:	22-Apr-2016
	Descript	:	Deligator, which send ajax data to mentioned php files

 */

/* Add Ajax URL Funciton name below array to exclude in Session */
/* --------------------------------------------- Session Exclude ULR Funcitons------------------------------------------ */
$exclude_urls_for_session=array("RegisterUser","DoSignInUser","DoPasswordReset");

/* --------------------------------------------- Session Exclude ULR Funcitons------------------------------------------ */

	

CRequestBroker::RegisterAction("RegisterUser", "register_user.registration.RegisterUser");
CRequestBroker::RegisterAction("DoSignInUser", "signin.signin.DoSignInUser");
CRequestBroker::RegisterAction("DoPasswordReset", "signin.signin.DoPasswordReset");
