<?php

session_start();

$data=array('username'=>'','password'=>'');
$error=array('username'=>'','password'=>'');
$errorcount=0;

if($_SERVER['REQUEST_METHOD']=='POST')
{		
		if($_POST['username']!="")
		{
			$data['username']=$_POST['username'];
		}
		else {
			$error['username']='User name cannot be Empty';
			$errorcount++;
		}
		
		if($_POST['password']!="")
		{
			$data['password']=$_POST['password'];
		}
		else
			{
				$error['password']='Password Cannot Be Empty';
				$errorcount++;
			}
		
	
		if($errorcount==0)
		{
			
		$con=mysqli_connect('localhost','root','','flipkart');
		
		$query="select * from login where userid='" . $data['username'] . "' and password='" . $data['password'] . "'";
		
		$result=mysqli_query($con,$query);
		
		if(mysqli_num_rows($result)==1)
		{
			
		
		$_SESSION['loggedin']=true;
		$_SESSION['username']=$_POST['username'];
		
		if(isset($_POST['continue']))
		{
			setcookie('loggedin',true,time()+60*60*24*30);
			setcookie('username',$_POST['username'],time()+60*60*24*30);
		}
		
		echo "<script> location='home.php'; </script>";
		}
		else {
			echo "Invalid Username or Password Specified";
		}
		
		
		}
}


?>



<html>
	<head></head>
	
	<body>
		<form action="login.php" method="post">
		<table>
			<tr>
				<th colspan="3">Login</th>
			</tr>
			<tr>
				<td>User Name</td>
				<td><input type="text" name="username"></td>
				<td><?php echo $error['username']; ?></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
				<td><?php echo $error['password']; ?></td>
			</tr>
			<tr>
				<td colspan="3"><input type="checkbox" name="continue" > Keep Me Logged In </td>
			</tr>
			<tr>
				<td><input type="submit" value="Login" name="login"></td>
			</tr>
		</table>
		</form>
	</body>
</html>