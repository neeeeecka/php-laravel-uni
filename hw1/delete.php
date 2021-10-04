<?php 
	include 'db.php';
	
	$user_id=$_POST['user_id'];
	$sql="DELETE FROM `users` WHERE `id`=$user_id";
	if ($conn->query($sql)===TRUE) {
		// echo "recored add";
	}

    header('Location: /hw1/');

?>