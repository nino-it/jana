<?php include('config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/fast_search.php'); ?>
<?php include(ROOT_PATH . '/start.php'); ?>

<script>
    $(document).ready(function(){
       $("#search").keyup(function(){
          var query = $(this).val();
          if (query != "") {
            $.ajax({
              url: 'brza-pretraga.php',
              method: 'POST',
              data: {query:query},
              success: function(data){
 
                $('#output').html(data);
                $('#output').css('display', 'block');
 
                $("#search").focusout(function(){
                    $('#output').css('display', 'none');
                });
                $("#search").focusin(function(){
                    $('#output').css('display', 'block');
                });
              }
            });
          } else {
          $('#output').css('display', 'block');
        }
      });
    });
</script>


	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/navbar.php') ?>

	<main role="main" class="col-md-9 col-xs-12">


        <h2>Brza pretraga po delu: </h2>
         <input type="text" name="search" id="search" autocomplete="off" placeholder="Upiši naslov...">
         <div id="output"></div>



    </main>

<script>
	$(document).ready(function(){
	$("#book").click(function(){
		$(".book").show();
		$(".article").hide();
		$(".collection").hide();
	});
	$("#article").click(function(){
		$(".article").show();
		$(".book").hide();
		$(".collection").hide();
	});
	$("#collection").click(function(){
		$(".collection").show();
		$(".book").hide();
		$(".article").hide();
	});
});
</script>


</body>
</html>