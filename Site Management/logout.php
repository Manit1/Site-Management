<?php

session_start();

	if(isset($_SESSION['loggedin']))
	{
		session_destroy();
	}
	
	if(isset($_COOKIE['loggedin']))
	{
		setcookie('loggedin',false,time()-3600);
		setcookie('username','',time()-3600);
	}
	
	echo "<script> location='home.php'; </script>";

?>


