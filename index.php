
<?php 

session_start();
// connect to database
// $conn = mysqli_connect("sql305.epizy.com", "epiz_26740930", "qmvx6qtNpDAf", "epiz_26740930_lib");
$conn = mysqli_connect("localhost", "root", "", "library");

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
define('BASE_URL', '');

?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>


<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<link rel="stylesheet" href="static/css/style.css">
	<title>Janina biblioteka</title>
</head>
<body style="
    position: relative;
    height: 200px;
    width: 60%;
    margin: 0 auto;
    padding: 20px;
    resize: both;
    overflow: auto;
">
	
		
		<?php 
		
		if (!empty($_SESSION)) {
			header('location: home.php');
			exit();
		}
		
		?>

		
		<?php include( ROOT_PATH . '/includes/banner.php') ?>
		



	<?php include('end.php'); ?>
