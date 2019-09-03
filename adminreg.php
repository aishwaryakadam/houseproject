<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Registration Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="login-sec">
		<h1>Dream Choice</h1>
		<h3>Registration Form</h3>
		<hr class="hrcolor">
		<form action="" method="POST">
			<input type="text" name="username" id="username" placeholder="Enter Your Name">
			<input type="text" name="email" id="email" placeholder="Enter Your Email">
			<input type="password" name="password1" id="password1" placeholder="Enter Your password">
			<input type="password" name="password2" id="password2" placeholder="Enter Confirm password">
			<input type="submit" name="upload" id="upload" value="Register">
		</form>
		<p>If already registered, <a href="adminlogin.php">Go to Login Page...</a></p>
	</div>
</html>
<?php
//error_reporting(0);
if(isset($_POST['upload'])) {
	$username=addslashes($_POST['username']);
	$email=addslashes($_POST['email']);
	$password1=addslashes($_POST['password1']);
	$password2=addslashes($_POST['password2']);

	$sql = mysqli_query($db, "SELECT * FROM admintable WHERE email='$email'");
		$row=mysqli_num_rows($sql);
		if($row>0){
			echo "<script>alert('Email is already exit')</script>";
		}else{
		if ($password1==$password2) {
			$q="INSERT INTO admintable(username,email,password) VALUES('$username','$email','$password1')";
			if($db->query($q)==true){
				echo "Insert Successfully";
				echo '<script language="Javascript">';
		        echo 'document.location.replace("adminlogin.php")'; // -->
		        echo '</script>';
			}else{
				echo $db->error;
			}
		}else{
		echo "<script>alert('Password must be same');</script>";
		}
	}
}

?>