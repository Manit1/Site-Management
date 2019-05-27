<?php

session_start();

?>

<html>
	<head>
		
	</head>
	
	<body>
		
		<?php
		require 'header.php';
		include 'menu.php';
		?>
		
		<h1 style="float:left;width:300px">Home Page</h1>
		<div style="float:right:width:400px;">			
			<?php
				if(isset($_SESSION['loggedin']))
				{
					echo "<a href='updatepassword.php'>Welcome " . $_SESSION['username'] . " | Change Password</a> | <a href='logout.php'>Logout</a>"; 
				}
				else if(isset($_COOKIE['loggedin']))
				{
					echo "<a href='#'>Welcome " . $_COOKIE['username'] . " | Change Password</a> | <a href='logout.php'>Logout</a>"; 					
				}
				else {
					echo "<a href='#'>Create Account</a> | <a href='login.php'>Login</a>"; 					
				}
			?>
		</div>
		
		<?php
		include 'footer.php';
		?>
		
	</body>
</html>