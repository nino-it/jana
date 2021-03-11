<?php 
// Post variables
$book_id = 0;
$isEditingPost = false;
$isEditingPlace = false;
$isEditingColl = false;
$isEditingArticle = false;
$published = 0;
$author = "";
$title = "";
$publisher = "";
$year = ""; // OVOOOOOOOOOOOOOOOOOOOOOOOOOOO
$place = "";
$notes = "";
$name = "";
$description = "";
$name = "";
$desc = "";
$magazine = "";
$pages = ""; 
$place = ""; 
$editor = "";



// N ?
function getAllBooks()
{
	global $conn;

	if ($_SESSION) {
		$sql = "SELECT * FROM books ORDER BY created DESC;";
	
	}
	$result = mysqli_query($conn, $sql);
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
	//	$post['author'] = getPostAuthorById($post);
		array_push($final_posts, $post);
	}
	return $final_posts;
}

// get the author/username of a post
function getPostAuthorById($user_id)
{
	global $conn;
	$sql = "SELECT username FROM users WHERE id=$user_id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		// return username
		return mysqli_fetch_assoc($result)['username'];
	} else {
		return null;
	}
}

//-- BOOK

// if user clicks the create book button
if (isset($_POST['create-book'])) { createBook($_POST); }
// if user clicks the Edit book button
if (isset($_GET['edit-book'])) {
	$isEditingPost = true;
	$book_id = $_GET['edit-book'];
	editPost($book_id);
}
// if user clicks the update book button
if (isset($_POST['update-book'])) {
	updatePost($_POST);
}
// if user clicks the Delete book button
if (isset($_GET['delete-book'])) {
	$book_id = $_GET['delete-book'];
	deletePost($book_id);
}



//-- PLACE 
if (isset($_POST['create-place'])) { createPlace($_POST); }

if (isset($_GET['edit-place'])) {
	$isEditingPlace = true;
	$place_id = $_GET['edit-place'];
	editPlace($place_id);
}

if (isset($_POST['update-place'])) {
	updatePlace($_POST);
}

if (isset($_GET['delete-place'])) {
	$placeId = $_GET['delete-place'];
	deletePlace($placeId);
}

//modal display
if (isset($_GET['success'])) {
	echo '<style> #myModal {display: block;} </style>';
}


// -- PLACE --
function createPlace($request_values){
	global $conn, $name, $desc;

	$name = $request_values['name'];
	$desc = $request_values['description'];
	$query = "INSERT INTO places (name, description, created) VALUES ('$name', '$desc', now())";
	if(mysqli_query($conn, $query)){

		$_SESSION['message'] = "Lokacija uspešno dodata!";
		header('location: podesavanja.php?success=1');
		exit(0);
	}
	else echo "Nope";	
}

function editPlace($placeId){
	global $conn, $name, $desc;

	$sql = "SELECT * FROM places WHERE id=$placeId";
	$result = mysqli_query($conn, $sql);
	$places = mysqli_fetch_assoc($result);

	$name = $places['name'];
	$desc = $places['description'];

}

function updatePlace ($request_values){
	global $conn;
	$placeId = $request_values['place_id'];
	$name = $request_values['name'];
	$desc = $request_values['description'];
	$sql = "UPDATE places SET name='$name', description='$desc' WHERE id=$placeId";

	if(mysqli_query($conn, $sql)){

		$_SESSION['message'] = "Mesto uspešno izmenjeno!";
		header('location: podesavanja.php?success=1');
		exit(0);
	}
	else echo "Nope";
}

function deletePlace ($placeId){
	global $conn;
	$sql = "DELETE FROM places WHERE id=$placeId";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "Mesto uspešno obrisano!";
		header("location: podesavanja.php?success=1");
		exit(0);
	}
}



//-- BOOK --

function createBook($request_values)
	{
		global $conn, $errors, $title, $author, $place, $publisher, $year, $notes;

		$author = esc($request_values['author']);
		$title = esc($request_values['title']);
		$place = esc($request_values['place']);
		$publisher = esc($request_values['publisher']);
		$year = esc($request_values['year']);
		$notes = esc($request_values['notes']);

		// create post if there are no errors in the form
		if (count($errors) == 0) {
			$query = "INSERT INTO books (author, title, place_id, publisher, year, notes, created) VALUES ('$author', '$title', '$place', '$publisher', '$year', '$notes', now())";
		//	echo $query; exit;
			if(mysqli_query($conn, $query)){

				$_SESSION['message'] = "Knjiga uspešno dodata!";
				header('location: unos.php?success=1');
				exit(0);
			}
			else {
				header('location: unos.php?success=1');
				$_SESSION['message'] = "Knjiga nije dodata!";
		}}
	}

	function editPost($book_id)
	{
		global $conn, $errors, $title, $author, $book_id, $place, $place_id, $publisher, $year, $notes;
		$sql = "SELECT * FROM books LEFT JOIN places ON books.place_id = places.id WHERE books.id=$book_id LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$post = mysqli_fetch_assoc($result);
		// set form values on the form to be updated
		$author = $post['author'];
		$title = $post['title'];
		$place_id = $post['place_id'];
		$publisher = $post['publisher'];
		$year = $post['year'];
		$notes = $post['notes'];
	}

	function updatePost($request_values)
	{
		global $conn, $errors, $title, $author, $book_id, $place, $place_id, $publisher, $year, $notes;

		$author = esc($request_values['author']);
		$title = esc($request_values['title']);
		$place_id = esc($request_values['place']);
		$publisher = esc($request_values['publisher']);
		$year = esc($request_values['year']);
		$notes = esc($request_values['notes']);
		$book_id = esc($request_values['book_id']);

		// $book_id = esc($request_values['id']);
		if (isset($request_values['place_id'])) {
			$place_id = esc($request_values['place_id']);
		}

		// register topic if there are no errors in the form
		if (count($errors) == 0) {
			$query = "UPDATE books SET author='$author', title='$title', place_id='$place_id', year='$year', publisher='$publisher', updated=now() WHERE id=$book_id";
			
			if(mysqli_query($conn, $query)){ 
					$_SESSION['message'] = "Knjiga uspešno izmenjena!";
					header('location: unos.php?success=1');
					exit(0);
			}
		//	$_SESSION['message'] = "Knjiga uspešno izmenjena!";
			header('location: unos.php');
			exit(0);
		}
	}
	// delete blog post
	function deletePost($book_id)
	{
		global $conn;
		$sql = "DELETE FROM books WHERE id=$book_id";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['message'] = "Knjiga uspešno obrisana!";
			header("location: home.php?success=1");
			exit(0);
		}
	}

//-- COLLECTIONS --

if (isset($_POST['create-coll'])) { createColl($_POST); }

if (isset($_GET['edit-coll'])) {
	$isEditingColl = true;
	$collId = $_GET['edit-coll'];
	editColl($collId);
}

if (isset($_POST['update-coll'])) {
	updateColl($_POST);
}

if (isset($_GET['delete-coll'])) {
	$collId = $_GET['delete-coll'];
	deleteColl($collId);
}

	function createColl($request_values)
	{
		global $conn, $errors, $title, $author, $place, $publisher, $year, $notes;

		$author = esc($request_values['author']);
		$title = esc($request_values['title']);
		$place = esc($request_values['place']);
		$publisher = esc($request_values['publisher']);
		$editor = $request_values['editor'];
		$pages = $request_values['pages'];
		$year = esc($request_values['year']);
		$notes = esc($request_values['notes']);

		$query = "INSERT INTO collections (author, title, place_id, publisher, editor, pages, year, notes, created) VALUES ('$author', '$title', '$place', '$publisher', '$editor', '$pages', '$year', '$notes', now())";

		if(mysqli_query($conn, $query)){

			$_SESSION['message'] = "Zbornik uspešno dodat!";
			header('location: unos.php?success=1');
			exit(0);
		}
			else header('location: unos.php?success=1');
		
	}

	function editColl($collId)
	{
		global $conn, $errors, $title, $author, $collId, $place, $place_id, $publisher, $year, $notes;
		$sql = "SELECT * FROM collections LEFT JOIN places ON collections.place_id = places.id WHERE collections.id=$collId LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$coll = mysqli_fetch_assoc($result);
		// set form values on the form to be updated
		$author = $coll['author'];
		$title = $coll['title'];
		$place_id = $coll['place_id'];
		$editor = $coll['editor'];
		$pages = $coll['pages'];
		$publisher = $coll['publisher'];
		$year = $coll['year'];
		$notes = $coll['notes'];
	}

	function updateColl($request_values)
	{
		global $conn, $errors, $title, $author, $coll_id, $editor, $pages, $place, $place_id, $publisher, $year, $notes;

		$author = esc($request_values['author']);
		$title = esc($request_values['title']);
		$place_id = esc($request_values['place']);
		$editor = esc($request_values['editor']);
		$publisher = esc($request_values['publisher']);
		$year = esc($request_values['year']);
		$pages = esc($request_values['pages']);
		$notes = esc($request_values['notes']);
		$coll_id = esc($request_values['coll_id']);

		if (isset($request_values['place_id'])) {
			$place_id = esc($request_values['place_id']);
		}

		if (count($errors) == 0) {
			$query = "UPDATE collections SET author='$author', title='$title', place_id='$place_id', year='$year', editor='$editor', publisher='$publisher', pages='$pages', notes='$notes', updated=now() WHERE id=$coll_id";
			
			if(mysqli_query($conn, $query)){ 
					$_SESSION['message'] = "Zbornik uspešno izmenjen!";
					header('location: home.php?success=1');
					exit(0);
			}
			header('location: home.php');
			exit(0);
		}
	}

	function deleteColl($coll_id)
	{
		global $conn;
		$sql = "DELETE FROM collections WHERE id=$coll_id";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['message'] = "Zbornik uspešno obrisan!";
			header("location: home.php?success=1");
			exit(0);
		}
	}


//-- Articles --

if (isset($_POST['create-article'])) { createArticle($_POST); }

if (isset($_GET['edit-article'])) {
	$isEditingArticle = true;
	$articleId = $_GET['edit-article'];
	editArticle($articleId);
}

if (isset($_POST['update-article'])) {
	updateArticle($_POST);
}

if (isset($_GET['delete-article'])) {
	$articleId = $_GET['delete-article'];
	deleteArticle($articleId);
}

function createArticle($request_values)
{
	global $conn, $errors, $title, $author, $place, $publisher, $year, $notes;

	$author = $request_values['author'];
	$title = $request_values['title'];
	$magazine = $request_values['magazine'];
	$year = $request_values['year'];
	$number = $request_values['number'];
	$place = $request_values['place'];
	$pages = $request_values['pages'];
	$notes = $request_values['notes'];

	$query = "INSERT INTO articles (author, title, magazine, year, number, place_id, pages, notes, created) VALUES ('$author', '$title', '$magazine', '$year', '$number', '$place', '$pages', '$notes', now())";

	if(mysqli_query($conn, $query)){

		$_SESSION['message'] = "Članak uspešno dodat!";
		header('location: unos.php?success=1');
		exit(0);
	}
		else header('location: unos.php?success=1');
	
}

function editArticle($articleId)
{
	global $conn, $errors, $title, $author, $articleId, $place, $place_id, $publisher, $year, $notes;
	$sql = "SELECT * FROM articles LEFT JOIN places ON articles.place_id = places.id WHERE articles.id=$articleId LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$arts = mysqli_fetch_assoc($result);
	// set form values on the form to be updated
	$author = $arts['author'];
	$title = $arts['title'];
	$place_id = $arts['place_id'];
	$pages = $arts['pages'];
	$magazine = $arts['magazine'];
	$year = $arts['year'];
	$notes = $arts['notes'];
}

function updateArticle($request_values)
{
	global $conn, $errors, $title, $author, $coll_id, $editor, $pages, $place, $place_id, $publisher, $year, $notes;

	$author = $request_values['author'];
	$title = $request_values['title'];
	$place_id = $request_values['place'];
	$editor = $request_values['editor'];
	$publisher = $request_values['publisher'];
	$year = $request_values['year'];
	$pages = $request_values['pages'];
	$notes = $request_values['notes'];
	$coll_id = $request_values['coll_id'];

	if (isset($request_values['place_id'])) {
		$place_id = $request_values['place_id'];
	}

	if (count($errors) == 0) {
		$query = "UPDATE articles SET author='$author', title='$title', place_id='$place_id', year='$year', editor='$editor', publisher='$publisher', pages='$pages', notes='$notes', updated=now() WHERE id=$coll_id";
		
		if(mysqli_query($conn, $query)){ 
				$_SESSION['message'] = "Članak uspešno izmenjen!";
				header('location: home.php?success=1');
				exit(0);
		}
		header('location: home.php');
		exit(0);
	}
}

function deleteArticle($coll_id)
{
	global $conn;
	$sql = "DELETE FROM articles WHERE id=$coll_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "Članak uspešno obrisan!";
		header("location: home.php?success=1");
		exit(0);
	}
}



	// if user clicks the publish post button
	if (isset($_GET['publish']) || isset($_GET['unpublish'])) {
		$message = "";
		if (isset($_GET['publish'])) {
			$message = "Post published successfully";
			$coll_id = $_GET['publish'];
		} else if (isset($_GET['unpublish'])) {
			$message = "Post successfully unpublished";
			$book_id = $_GET['unpublish'];
		}
		togglePublishPost($book_id, $message);
	}
	// delete blog post
	function togglePublishPost($book_id, $message)
	{
		global $conn;
		$sql = "UPDATE posts SET published=!published WHERE id=$book_id";
		
		if (mysqli_query($conn, $sql)) {
			$_SESSION['message'] = $message;
			header("location: posts.php");
			exit(0);
		}
	}

	// total books
	function getTotalBooks()
	{
		global $conn;
	
		if ($_SESSION) {
			$sql = "SELECT COUNT(*) AS bcount FROM books;";
		
		}

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo $row["bcount"]; 
			}} else echo '0';

	}	

	// authors and count books
	function getAuthorByBooks()
	{
		global $conn;
	
		if ($_SESSION) {
			$sql = "SELECT author, COUNT(author) AS aCount FROM books GROUP BY author ORDER BY `aCount` DESC LIMIT 5;";
		}

		$result = mysqli_query($conn, $sql);
		$authors = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$enter = array();
		foreach ($authors as $author) {
			array_push($enter, $author);
		}
		return $enter;
	}	

	function getArts()
	{
		global $conn;
	
		$sql = "SELECT COUNT(id) AS CUNT FROM articles";

		$result = $conn->query($sql);
		$rere = $result->fetch_assoc();
		$arts = $rere['CUNT'];
		echo $arts;
	}	

	function getColls()
	{
		global $conn;
	
		$sql = "SELECT COUNT(id) AS CUNT FROM collections";

		$result = $conn->query($sql);
		$rere = $result->fetch_assoc();
		$colls = $rere['CUNT'];
		echo $colls;
	}