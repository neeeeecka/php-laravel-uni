<?php
	include 'db.php';

	$name = mysqli_real_escape_string($conn, $_POST["name"]);
	$surname = mysqli_real_escape_string($conn, $_POST["surname"]);
	$dd = mysqli_real_escape_string($conn, $_POST["dd"]);
	$mm = mysqli_real_escape_string($conn, $_POST["mm"]);
	$yyyy = mysqli_real_escape_string($conn, $_POST["yyyy"]);

    var_dump($_POST);

	$sql = "INSERT INTO `users` (`name`, `surname`, `birthday`) values ('$name', '$surname', '$yyyy-$mm-$dd')";
	$result = $conn->query($sql) or die($conn->error." query: $sql");
	
    header('Location: /hw1/');

?>