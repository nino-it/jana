<?php

$buk = '<script>
$(document).ready(function(){
    $(".book").show();
    $(".article").hide();
    $(".collection").hide();
});
</script>';

$art = '<script>
$(document).ready(function(){
    $(".book").hide();
    $(".article").show();
    $(".collection").hide();
});
</script>';

$kol = '<script>
$(document).ready(function(){
    $(".book").hide();
    $(".article").hide();
    $(".collection").show();
});;
</script>';

function switcheroo($gec){
    global $buk, $art, $kol;
    
    switch (isset($_GET['edit-book'])){
        case 'edit-book';
        echo $buk;
    }
    switch (isset($_GET['edit-article'])){
        case 'edit-article';
        echo $art;
    }
    switch (isset($_GET['edit-coll'])){
        case 'edit-coll';
        echo $kol;
    }
}
//var_dump($gec); exit;
?>