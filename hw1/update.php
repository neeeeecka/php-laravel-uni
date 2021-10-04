<?php
	include 'db.php';

	$id = mysqli_real_escape_string($conn, $_POST["id"]);
	$name = mysqli_real_escape_string($conn, $_POST["name"]);
	$surname = mysqli_real_escape_string($conn, $_POST["surname"]);
	$dd = mysqli_real_escape_string($conn, $_POST["dd"]);
	$mm = mysqli_real_escape_string($conn, $_POST["mm"]);
	$yyyy = mysqli_real_escape_string($conn, $_POST["yyyy"]);

    var_dump($_POST);

	$sql = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `birthday` = '$yyyy-$mm-$dd' WHERE `id` = $id";
	$result = $conn->query($sql) or die($conn->error." query: $sql");
	
    header('Location: /hw1/');

?>