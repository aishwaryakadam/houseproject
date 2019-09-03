<?php
@ob_start();
session_start();

include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="login-sec">
		<h1>Dream Choice</h1>
		<h3>Login Form</h3>
		<hr class="hrcolor">
		<form action="" method="POST">
			<input type="text" name="email" id="email" placeholder="Enter Your Email">
			<input type="password" name="password" id="password" placeholder="Enetr Your password">
			<input type="submit" name="login" value="LOGIN">
		</form>
		<p>Want add one more Admin, <a href="adminreg.php">Register Here...</a></p>
	</div>
</body>
</html>
<?php
error_reporting(0);
if(isset($_POST['login'])) {
	$email=addslashes($_POST['email']);
	$password=addslashes($_POST['password']);

	$sql = mysqli_query($db, "SELECT * FROM admintable WHERE email='$email' AND password='$password'");
	$row=mysqli_num_rows($sql);
	if($row==0){
		echo "Incorrect Email or Password";
	}else{
		while ($rows=$sql->fetch_assoc()) {
			$user_id=$rows['id'];

	        $_SESSION["user_id"] = $user_id;
				
		echo "Login Successfully";

		echo '<script language="Javascript">';
        echo 'document.location.replace("./home.php")'; // -->
        echo '</script>';
	}
}
}


?>