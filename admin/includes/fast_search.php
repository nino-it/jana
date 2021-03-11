<?php

if (isset($_POST['query'])) {

    $query = "SELECT * FROM books WHERE title LIKE '{$_POST['query']}%' LIMIT 100";
 //   echo $query; exit;
    $result = mysqli_query($conn, $query);
 
  if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      echo $user['title']."<br/>".$user['place_id']; exit;
    }
  } else {
    echo "<p style='color:black'>Nema podataka u bazi...</p>"; exit;
  }
 
}

?>
