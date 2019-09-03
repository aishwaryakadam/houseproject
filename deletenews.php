<?php
session_start();
$user_id = $_SESSION['user_id']; 

//- if no value in $dir go to login page
if($user_id==""){
    echo '<script language="Javascript">';
    echo 'document.location.replace("./adminlogin.php")'; // -->
    echo '</script>';
}
?>
<?php
include 'connection.php';

    if((!isset($_GET['id']))||trim($_GET['id'])==""){
    	echo "No post like that !";
    }else{

    	$del_id=$_GET['id'];

		$result = "DELETE FROM newstable WHERE id='$del_id'";

	    if ($db->query($result)==true) {
	    	echo "Deleting records successfully";
     		echo '<script language="Javascript">';
	        echo 'document.location.replace("./home.php")'; // -->
	        echo '</script>';
	    }else{
	    	echo "Error deleting record: " . $db->error;
	    }
	}
	?>