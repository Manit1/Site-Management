<?php

session_start();

$userid="";

if(!isset($_SESSION['loggedin']) && !isset($_COOKIE['loggedin']))
{
	echo "<script> location='login.php'; </script>";
}
else if(isset($_SESSION['loggedin'])){
	$userid=$_SESSION['username'];
}
else
	{
		$userid=$_COOKIE['username'];
	}

$data=array("opassword"=>"","npassword"=>"","rpassword"=>"");
$error=array("opassword"=>"","npassword"=>"","rpassword"=>"","notmatch"=>"");
$errorcount=0;

if($_SERVER['REQUEST_METHOD']=='POST')
{
	if($_POST['oldpassword']!="")
	{
		$data['opassword']=$_POST['oldpassword'];
	}
	else {
		$error['opassword']="Exisiting Password is required";
		$errorcount++;
	}

	if($_POST['newpassword']!="")
	{
		$data['npassword']=$_POST['newpassword'];
	}
	else {
		$error['npassword']="New Password is required";
		$errorcount++;
	}


	if($_POST['rpassword']!="")
	{
		$data['rpassword']=$_POST['rpassword'];
	}
	else {
		$error['rpassword']="Repeat Password is required";
		$errorcount++;
	}
	
	if($_POST['rpassword']!=$_POST['newpassword'])
	{
		$error['notmatch']="Password doesn't match.";
		$errorcount++;
	}

	if($errorcount==0)
	{
		$con=mysqli_connect('localhost','root','','flipkart');
		
		$query = "update login set password='" . $data['npassword'] ."' where userid='" . $userid . "' and password='" . $data['opassword'] . "'";
		
		$result=mysqli_query($con,$query);
		
		
		if($result>0)
		{
			echo "Password Updated Successfully";
		}
		else {
			echo "Try Again";
		}
		
		
	}

}

?>

<html>
	<form action="updatepassword.php" method="post">
	<table>
		<tr>
			<th colspan="3">
				Change Password
			</th>
		</tr>
		<tr>
			<td>Existing Password</td>
			<td><input type='password' name='oldpassword'></td>
			<td><?php echo $error['opassword']; ?></td>
		</tr>
		<tr>
			<td>New Password</td>
			<td><input type='password' name='newpassword'></td>
			<td><?php echo $error['npassword']; ?></td>
		</tr>
		<tr>
			<td>Repeat Password</td>
			<td><input type='password' name='rpassword'></td>
			<td><?php echo $error['rpassword']; ?></td>
		</tr>
		<tr>
			<td colspan="3"><?php echo $error['notmatch']; ?></td>
		</tr>
		<tr>
			<td><input type="submit" value="Update" name="command"></td>
		</tr>

	</table>
	</form>
</html>