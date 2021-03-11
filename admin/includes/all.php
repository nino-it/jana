<?php

//full library with pagination
function getAll(){

    global $conn, $page, $number_of_pages;
    // all rows in the table
    $sql = "SELECT COUNT(*) FROM books";
    $result = mysqli_query($conn, $sql)  or trigger_error("SQL", E_USER_ERROR);
    $r = mysqli_fetch_row($result);
    $numrows = $r[0];

    // number of rows to show per page
    $rowsperpage = 10;
    // find out total pages
    $totalpages = ceil($numrows / $rowsperpage);

    // get the current page or set a default
    if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
    // cast var as int
    $currentpage = (int) $_GET['currentpage'];
    } else {
    // default page num
    $currentpage = 1;
    } // end if

    // if current page is greater than total pages...
    if ($currentpage > $totalpages) {
    // set current page to last page
    $currentpage = $totalpages;
    } // end if
    // if current page is less than first page...
    if ($currentpage < 1) {
    // set current page to first page
    $currentpage = 1;
    } // end if

    // the offset of the list, based on current page 
    $offset = ($currentpage - 1) * $rowsperpage;

    // get the info from the db 
    $sql = "SELECT books.id AS bad, books.author, books.title, books.year, books.place_id, places.id, places.name
            FROM books 
            LEFT JOIN places
            ON books.place_id = places.id
            ORDER BY author 
            LIMIT $offset, $rowsperpage";

    $result = mysqli_query($conn, $sql) or trigger_error("SQL", E_USER_ERROR);

    // while there are rows to be fetched...
    echo    '<tbody>';
    while ($list = mysqli_fetch_assoc($result)) {

    // echo data
    echo    '<tr>';

    echo    '<td>'.$list['author'].'</td>'.
            '<td>'.$list['title'].'</td>'.
            '<td>'.$list['year'].'</td>'.
            '<td>'.$list['name'].'</td>'.
            '<td><a class="fas fa-edit btn edit" href="unos.php?edit-book='.$list['bad'].'"></a></td>'.
            '<td><a class="fa fa-trash btn delete" href="unos.php?delete-book='.$list['bad'].'"></a></td>';

    echo    '</tr>';

    } // end while
    echo '</tbody>';
    echo '</table>';
    echo '</ul>';

    /******  PAGINATION ******/
    echo '<ul class="pagination">';
    // range of num links to show
    $range = 3;

    // if not on page 1, don't show back links
    if ($currentpage > 1) {
    // show << link to go back to page 1
    echo "<li class='page-item'><a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=1'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
    // get previous page num
    $prevpage = $currentpage - 1;
    // show < link to go back to 1 page
    echo "<li class='page-item'><a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a></li>";
    } // end if 

    // loop to show links to range of pages around current page
    for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
    // if it's a valid page number...
    if (($x > 0) && ($x <= $totalpages)) {
        // if we're on current page...
        if ($x == $currentpage) {
            // 'highlight' it but don't make a link
            echo "<li class='page-item'><a class='page-link'><b>$x</b></a></li>";
        // if not current page...
        } else {
            // make it a link
            echo "<li class='page-item'><a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li>";
        } // end else
    } // end if 
    } // end for

    // if not on last page, show forward and last page links        
    if ($currentpage != $totalpages) {
    // get next page
    $nextpage = $currentpage + 1;
        // echo forward link for next page 
    echo "<li class='page-item'><a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a></li>";
    // echo forward link for lastpage
    echo "<li class='page-item'><a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a></li>";
    } 
}




function test(){
    global $conn, $page, $number_of_pages;

    $results_per_page = 20;
    $final_book = array();

    if (!isset($_GET['page'])) {
        $page = 1;
      } else {
        $page = $_GET['page'];
      }

    $sql = "SELECT * FROM books ORDER BY author";

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
?>