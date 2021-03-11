<?php 

	session_start();
	// connect to database
	if (empty($_SESSION)){
	header('location: index.php');
	exit();
	}
	$conn = mysqli_connect("localhost", "root", "", "library");
//	$conn = mysqli_connect("sql305.epizy.com", "epiz_26740930", "qmvx6qtNpDAf", "epiz_26740930_lib");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
	
	if (!mysqli_set_charset($conn, "utf8")) {
		printf("Error loading character set utf8: %s\n", mysqli_error($conn));
		exit();
	} else {
	//	printf("Current character set: %s\n", mysqli_character_set_name($conn));
	}





	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define ('BASE_URL', '');


?>