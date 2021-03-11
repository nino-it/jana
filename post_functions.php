<?php 
// Post variables
$book_id = 0;
$isEditingPost = false;
$published = 0;
$author = "";
$title = "";
$publisher = "";
$year = ""; // OVOOOOOOOOOOOOOOOOOOOOOOOOOOO
$place = "";
$notes = "";



// Not used ???
function getAllBooks()
{
	global $conn;

	if ($_SESSION) {
		$sql = "SELECT * FROM collections ORDER BY created DESC";
	
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
// not used
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

/* - - - - - - - - - - 
-  Post actions
- - - - - - - - - - -*/
// if user clicks the create post button
if (isset($_POST['create_post'])) { createBook($_POST); }
// if user clicks the Edit post button
if (isset($_GET['edit-post'])) {
	$isEditingPost = true;
	$book_id = $_GET['edit-post'];
	editPost($book_id);
}
// if user clicks the update post button
if (isset($_POST['update_post'])) {
	updatePost($_POST);
}
// if user clicks the Delete post button
if (isset($_GET['delete-post'])) {
	$book_id = $_GET['delete-post'];
	deleteBook($book_id);
}

/* - - - - - - - - - - 
-  Post functions
- - - - - - - - - - -*/
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
				header('location: unos.php');
				exit(0);
			}
			else echo "Nope";
		}
	}

	/* * * * * * * * * * * * * * * * * * * * *
	* - Takes post id as parameter
	* - Fetches the post from database
	* - sets post fields on form for editing
	* * * * * * * * * * * * * * * * * * * * * */
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
/////////var_dump($array)
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
					header('location: unos.php');
					exit(0);
			}
		//	$_SESSION['message'] = "Knjiga uspešno izmenjena!";
			header('location: unos.php');
			exit(0);
		}
	}
	// delete blog post
	function deleteBook($book_id)
	{
		global $conn;
		$sql = "DELETE FROM books WHERE id=$book_id";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['message'] = "Post successfully deleted";
			header("location: home.php");
			exit(0);
		}
	}

	// if user clicks the publish post button
	if (isset($_GET['publish']) || isset($_GET['unpublish'])) {
		$message = "";
		if (isset($_GET['publish'])) {
			$message = "Post published successfully";
			$book_id = $_GET['publish'];
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





?>