<?php
$db=mysqli_connect('localhost','root','','house');
if(!$db){
	echo $db->error;
}
?>