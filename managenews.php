<?php
session_start();
$user_id = $_SESSION['user_id']; 

//- if no value in $dir go to login page
if($user_id==""){
    echo '<script language="Javascript">';
    echo 'document.location.replace("./login.php")'; // -->
    echo '</script>';
}
?>
<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage a news</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php
	include 'menu2.php';

      if((!isset($_GET['id']))||trim($_GET['id'])==""){
      echo "No post like that !";
      }else{

    $post_id = addslashes($_GET['id']);
      $result = mysqli_query($db, "SELECT * FROM newstable WHERE id ='$post_id'");
      $row = mysqli_num_rows($result);

      if($row>0){
        while($rows = mysqli_fetch_assoc($result)) {
      	$post_id= $rows["id"];
      	$image=$rows['image'];
		$title=$rows['title'];
	    $area=$rows['area'];
	    $city=$rows['city'];
	    $kind=$rows['kind'];
	    $info=$rows['info'];
	    $contact=$rows['contact'];
	    $link=$rows['link'];
	   	
      
  ?>

	<div class="newspost-sec">
		<p>Edit The News That where Posted</p>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="up-img">
				<p>Prevoius Image is:</p>
				<center><?php echo "<img src=data:image/jpg;base64,$image width=20%>"; ?></center>
			</div>
			<label>Image of Property:</label>
			<input type="file" name="uploadimage" id="uploadimage">
			<input type="text" name="title" id="title" value="<?php echo $title; ?>">
			<input type="text" name="area" id="area" value="<?php echo $area; ?>">
			<input type="text" name="city" id="city" value="<?php echo $city; ?>">
			<label>Is it for :
			<select name="kind">
				<option value="Rent">Rent</option>
				<option value="Sell">Sell</option>
			</select></label>
			<textarea name="info" id="info" placeholder="Information about House"><?php echo $info; ?></textarea>
			<input type="text" name="contact" id="contact" value="<?php echo $contact; ?>">
			<input type="text" name="link" id="link" value="<?php echo $link;?>">
			<input type="submit" name="update" value="Update News">
		</form>
	</div>
	<?php
			}
		}
	}

	if (isset($_POST['update'])) {
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

			$q="UPDATE newstable SET image='$image',title='$title',area='$area',city='$city',kind='$kind',info='$info',contact='$contact',link='$link',datepost='$date' WHERE id='$post_id'";
		}else{
			$q="UPDATE newstable SET title='$title',area='$area',city='$city',kind='$kind',info='$info',contact='$contact',link='$link',datepost='$date' WHERE id='$post_id'";
		}
		if($db->query($q)==true){
     		echo "inserted successfully";
     		echo '<script language="Javascript">';
	        echo 'document.location.replace("./home.php")'; // -->
	        echo '</script>';
     	}
     	else{
     		echo $db->error;
     	}
	}
}

	?>
</body>
</html>