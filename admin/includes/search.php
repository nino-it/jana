<?php

$author = '';
$title = '';
$publisher = '';
$year = '';
$page = '';
$magazine = '';
$lel='';


if (isset($_GET['book'])) { $lel='book'; }
if (isset($_GET['article'])) { $lel='article'; }
if (isset($_GET['collection'])) { $lel='coll'; }

if (isset($_POST['search'])) { getBook($_POST); }

if (isset($_GET['book']) && (!empty($_GET['author']) ||  !empty($_GET['title']) ||  !empty($_GET['publisher']) ||  !empty($_GET['year']))) { $books = searchBook($_GET); }

if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }

function getBook($search){
    global $conn;

    $author = $search['author'];
    $title = $search['title'];
    $publisher = $search['publisher'];
    $year = $search['year'];

    header("location: pretraga.php?book=1&author=$author&title=$title&publisher=$publisher&year=$year");
    exit(0);
}

function searchBook($search){
    global $conn, $author, $title, $publisher, $year, $page, $number_of_pages;

    $author = $search['author'];
    $title = $search['title'];
    $publisher = $search['publisher'];
    $year = $search['year'];
    $results_per_page = 10;
    $final_book = array();

    if (!isset($_GET['page'])) {
        $page = 1;
      } else {
        $page = $_GET['page'];
      }

    $sql = "SELECT * FROM books 
            WHERE 
            author LIKE '%{$search['author']}%' AND 
            title LIKE '{$search['title']}%' AND 
            publisher LIKE '{$search['publisher']}%' AND                
            year LIKE '{$search['year']}%'";

    $query = mysqli_query($conn, $sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $number_of_results = mysqli_num_rows($query); //broj redova
    $number_of_pages = ceil($number_of_results/$results_per_page);
    $this_page_first_result = ($page-1)*$results_per_page;

    $sql = $sql.' LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
    
    $query = mysqli_query($conn, $sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

    foreach ($results as $result) {

        $rez = $result['place_id'];
        
        $sql = "SELECT * FROM places WHERE id=$rez";
        $query = mysqli_query($conn, $sql);
        $rez2 = mysqli_fetch_assoc($query);

        $result['place_id'] = $rez2['name'];

        array_push($final_book, $result);

    }

    return $final_book; 


}
 //  var_dump($rez); exit;
//    print_r($results[1]['place_id']); exit;


if (isset($_POST['searchA'])) { getArticle($_POST); }

if (isset($_GET['article']) && (!empty($_GET['author']) ||  !empty($_GET['title']) ||  !empty($_GET['magazine']) ||  !empty($_GET['year']))) { $books = searchArticle($_GET); }


function getArticle($searchA){
    global $conn;

    $author = $searchA['author'];
    $title = $searchA['title'];
    $magazine = $searchA['magazine'];
    $year = $searchA['year'];

    header("location: pretraga.php?article=1&author=$author&title=$title&magazine=$magazine&year=$year");
    exit(0);
}

function searchArticle($search){
    global $conn, $author, $title, $publisher, $year, $page, $number_of_pages, $magazine;

    $author = $search['author'];
    $title = $search['title'];
    $magazine = $search['magazine'];
    $year = $search['year'];
    $results_per_page = 10;
    $final_book = array();

    if (!isset($_GET['page'])) {
        $page = 1;
      } else {
        $page = $_GET['page'];
      }

    $sql = "SELECT * FROM articles 
            WHERE 
            author LIKE '%{$search['author']}%' AND 
            title LIKE '%{$search['title']}%' AND 
            magazine LIKE '%{$search['magazine']}%' AND                
            year LIKE '{$search['year']}%'";

    $query = mysqli_query($conn, $sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $number_of_results = mysqli_num_rows($query); //broj redova
    $number_of_pages = ceil($number_of_results/$results_per_page);
    $this_page_first_result = ($page-1)*$results_per_page;

    $sql = $sql.' LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
   // var_dump($sql); exit;
    $query = mysqli_query($conn, $sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

    foreach ($results as $result) {

        $rez = $result['place_id'];
        
        $sql = "SELECT * FROM places WHERE id=$rez";
        $query = mysqli_query($conn, $sql);
        $rez2 = mysqli_fetch_assoc($query);

        $result['place_id'] = $rez2['name'];

        array_push($final_book, $result);

    }

    return $final_book; 

  }
// COLLECTIONS 


if (isset($_POST['searchC'])) { getColl($_POST); }

if (isset($_GET['collection']) && (!empty($_GET['author']) ||  !empty($_GET['title']) ||  !empty($_GET['publisher']) || !empty($_GET['editor']) || !empty($_GET['year']))) { $books = searchColl($_GET); }


function getColl($searchA){
    global $conn;

    $author = $searchA['author'];
    $title = $searchA['title'];
    $publisher = $searchA['publisher'];
    $editor = $searchA['editor'];
    $year = $searchA['year'];

    header("location: pretraga.php?collection=1&author=$author&title=$title&publisher=$publisher&editor=$editor&year=$year");
    exit(0);
}

function searchColl($search){
    global $conn, $author, $title, $publisher, $year, $page, $number_of_pages, $magazine;

    $author = $search['author'];
    $title = $search['title'];
    $editor = $search['editor'];
    $publisher = $search['publisher'];
    $year = $search['year'];
    $results_per_page = 10;
    $final_book = array();

    if (!isset($_GET['page'])) {
        $page = 1;
      } else {
        $page = $_GET['page'];
      }

    $sql = "SELECT * FROM collections 
            WHERE 
            author LIKE '%{$author}%' AND 
            title LIKE '%{$title}%' AND 
            editor LIKE '%{$editor}%' AND    
            publisher LIKE '%{$publisher}%' AND                
            year LIKE '{$search['year']}%'";
            
    $query = mysqli_query($conn, $sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $number_of_results = mysqli_num_rows($query); //broj redova
    $number_of_pages = ceil($number_of_results/$results_per_page);
    $this_page_first_result = ($page-1)*$results_per_page;

    $sql = $sql.' LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
   // var_dump($sql); exit;
    $query = mysqli_query($conn, $sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

    foreach ($results as $result) {

        $rez = $result['place_id'];
        
        $sql = "SELECT * FROM places WHERE id=$rez";
        $query = mysqli_query($conn, $sql);
        $rez2 = mysqli_fetch_assoc($query);

        $result['place_id'] = $rez2['name'];

        array_push($final_book, $result);

    }

    return $final_book; 


 //  var_dump($rez); exit;
//    print_r($results[1]['place_id']); exit;
}




?>
