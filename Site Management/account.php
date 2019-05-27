<?php

session_start();

if(!isset($_SESSION['loggedin']) && !isset($_COOKIE['loggedin']))
{
	echo "<script> location='login.php'; </script>";
}



?>


<html>
	<head>
		
	</head>
	
	<body>
		
		<?php
		
		require 'header.php';
		require 'menu.php';
		
		?>
		<h1 style="float:left;width:300px">Account Page</h1>
		<div style="float:right:width:400px;">
			<?php			
				if(isset($_SESSION['loggedin']))
				{
					echo "<a href='updatepassword.php'>Welcome ".  $_SESSION['username'] . " | Change Password</a> | <a href='logout.php'>Logout</a>"; 
				}
			?>
		</div>
		<?php
		require 'footer.php';
		?>
	</body>
</html>