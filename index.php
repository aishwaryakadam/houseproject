<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Dream Choice</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php
	include 'menu.php';
	?>
	<?php

		$sql = mysqli_query($db,"SELECT * FROM newstable  ORDER BY id DESC");
		$num_rows=mysqli_num_rows($sql);
		
		if ($num_rows==0) {
			echo "No Post.........!";
		}
		else{
			while ($rows=$sql->fetch_assoc()) {
				$id=$rows['id'];
				$image=$rows['image'];
				$title=$rows['title'];
			    $area=$rows['area'];
			    $city=$rows['city'];
			    $kind=$rows['kind'];
			    $info=$rows['info'];
			    $contact=$rows['contact'];
			    $link=$rows['link'];
			    $date=$rows['datepost'];
			   

		?>
	<div class="news-sec">
		<div class="news-img">
			<?php echo "<img src=data:image/jpg;base64,$image width=70%>"; ?>
		</div>
		<div class="news-body">
			<div class="news-heading">
				<h2><?php echo $title; ?></h2>
				<p>Its is for <?php echo $kind; ?></p>
			</div>
			<div class="news-content">
				<p><b><?php echo $area; ?>,<?php echo $city; ?> :</b><br><?php echo $info; ?></p><a href="<?php echo $link; ?>">Read More Information</a>
			</div>
			<div class="news-footer">
				<p>Contact: <?php echo $contact; ?></p>
				<p>Date of Post: <?php echo $date; ?></p>
			</div>
		</div>
	</div>
	<?php
		}
	}
	?>
</body>
</html>