<?php
session_start();
$user_id = $_SESSION['user_id']; 

//- if no value in $user_id go to login page
if($user_id==""){
    echo '<script language="Javascript">';
    echo 'document.location.replace("./adminlogin.php")'; // -->
    echo '</script>';
}
?>
<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Make a news</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php
	include 'menu2.php';
	?>
	<div class="newspost-sec">
		<p>Post News For House</p>
		<form action="" method="POST" enctype="multipart/form-data">
			<label>Image of Property:</label>
			<input type="file" name="uploadimage" id="uploadimage">
			<input type="text" name="title" id="title" placeholder="Heading of News">
			<input type="text" name="area" id="area" placeholder="Name of Area">
			<input type="text" name="city" id="city" placeholder="Name of City">
			<label>Is it for :
			<select name="kind">
				<option value="Rent">Rent</option>
				<option value="Sell">Sell</option>
			</select></label>
			<textarea name="info" id="info" placeholder="Information about House"></textarea>
			<input type="text" name="contact" id="contact" placeholder="Give Contact Number or Email">
			<input type="text" name="link" id="link" placeholder="Website Link for more info">
			<input type="submit" name="post" value="Upload Your News">
		</form>
	</div>
</body>
</html>
<?php
//error_reporting(0);
if(isset($_POST['post'])) {
	$title=addslashes($_POST['title']);
	$area=addslashes($_POST['area']);
	$city=addslashes($_POST['city']);
	$kind=addslashes($_POST['kind']);
	$info=addslashes($_POST['info']);
	$contact=addslashes($_POST['contact']);
	$link=addslashes($_POST['link']);
	$date=date('y-m-d');

	if (isset($_FILES['uploadimage'])) {
		$image_path= $_FILES['uploadimage']['tmp_name'];

		if ($image_path!="") {
			$image_binary=fread(fopen($image_path, "r"), filesize($image_path));
			$image=base64_encode($image_binary);

			$q="INSERT INTO newstable(image,title,area,city,kind,info,contact,link,user_id,datepost) VALUES('$image','$title','$area','$city','$kind','$info','$contact','$link','$user_id','$date')";
			if($db->query($q)==true){
				echo "Insert Successfully";
				echo '<script language="Javascript">';
		        echo 'document.location.replace("home.php")'; // -->
		        echo '</script>';
			}else{
				echo $db->error;
			}
		}else{
			echo "<script>alert('Select image');</script>";
		}
	}
}

?>