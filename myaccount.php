<?PHP
	session_start();
	$LOGIN_USER = isset($_SESSION['LOGIN_USER']);
	
	if(empty($LOGIN_USER))
	{
		header("LOCATION:/notarykart");
	}
	else
	{
		$myaccount_page = file_get_contents('main-page.html');
		echo $myaccount_page;
	}
		

?>