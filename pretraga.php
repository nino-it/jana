<?php include('config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/search.php'); ?>
<?php include(ROOT_PATH . '/start.php'); ?>

<script>

</script>

	<?php include(ROOT_PATH . '/navbar.php') ?>

	<main role="main" class="col-md-9 col-xs-12">
	<div class="btn-group btn-group-sm entry" role="group" aria-label="Basic example">
	<button type="button" class="btn btn-secondary"><span id="book">Knjiga </span></button>
	<button type="button" class="btn btn-secondary"><span id="article">Članak </span></button>
	<button type="button" class="btn btn-secondary"><span id="collection">Dnevnik</span></button>
	</div>

<div class="row">
<div class="book col-md-4">
    
<h3 class="page-title">Pretraga knjiga:</h3>
	<div class="form-style-2">
		<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'pretraga.php'; ?>" >

		<div class="form-group">
			
			<div class="">
			<label for="field1">Autor </label><input type="text" class="form-control" name="author" value="">
			</div>
			<div class="">
			<label for="field2">Naslov</label><input type="text" class="form-control" name="title" value="">
			</div>
			<div class="">
			<label for="field2">Izdavač </label><input type="text" class="form-control" name="publisher" value="">
			</div>
			<div class="">
			<label for="field2">Godina izdavanja</label><input type="text" class="form-control" name="year" value="">
			</div>	
			<div class="">
				<label><button type="submit" class="btn btn-primary" name="search">Pretraži knjigu</button></label>
			</div>

		</div>		
		</form>
</div>    
</div> 
<div class="article col-md-4">
	<h3 class="page-title">Pretraga članaka:</h3>

	<div class="form-style-2">
		<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'pretraga.php'; ?>" >

		<div class="form-group">
			
		<div class="">
		<label for="field1">Autor </label><input type="text" class="form-control" name="author" value="">
		</div>
		<div class="">
		<label for="field2">Naslov članka</label><input type="text" class="form-control" name="title" value="">
		</div>
		<div class="">
		<label for="field2">Ime časopisa </label><input type="text" class="form-control" name="magazine" value="">
		</div>
		<div class="">
		<label for="field2">Godina izdavanja</label><input type="text" class="form-control" name="year" value="">
		</div>	
		<div class="">
			<label><button type="submit" class="btn btn-primary" name="searchA">Pretraži članak</button></label>
		</div>

		</div>		
		</form>
	</div>
</div>

<div class="collection col-md-4">
	<h3 class="page-title">Pretraga zbornika:</h3>

	<div class="form-style-2">
		<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'pretraga.php'; ?>" >

		<div class="form-group">
			
		<div class="">
		<label for="field1">Autor </label><input type="text" class="form-control" name="author" value="">
		</div>
		<div class="">
		<label for="field2">Naslov teksta</label><input type="text" class="form-control" name="title" value="">
		</div>
		<div class="">
		<label for="field2">Ime zbornika </label><input type="text" class="form-control" name="publisher" value="">
		</div>
		<div class="">
		<label for="field2">Ime urednika </label><input type="text" class="form-control" name="editor" value="">
		</div>
		<div class="">
		<label for="field2">Godina izdavanja</label><input type="text" class="form-control" name="year" value="">
		</div>	
		<div class="">
			<label><button type="submit" class="btn btn-primary" name="searchC">Pretraži zbornik</button></label>
		</div>

		</div>		
		</form>
	</div>
</div>

	<div class="book col-md-8">
	<div class="table-responsive">

				<?php if ($_GET['rezultat']='1' && isset($books)): ?>
					<table class="table table-striped table-sm">
						<thead>
							<th>Autor</th>
							<th>Naslov</th>
							<th>Godina</th>
							<th>Lokacija</th>
							<th class='edel'>Izmena</th>
							<th class='edel'>Brisanje</th>
						</thead>
						<tbody>


						<?php foreach ($books as $key => $book): ?>
							<tr>
								<td><?php echo $book['author']; ?></td>
								<td><?php echo $book['title']; ?></td>
								<td><?php echo $book['year']; ?></td>
								<td><?php echo $book['place_id']; ?></td>

								<td>
									<a class="fas fa-edit btn edit"
										href="unos.php?edit-<?php echo $lel ?>=<?php echo $book['id'] ?>">
									</a>
								</td>
								<td>
									<a class="fa fa-trash btn delete" 
										href="unos.php?delete-<?php echo $lel ?>=<?php echo $book['id'] ?>">
									</a>
								</td>
							</tr>
						<?php if ($key == 20) break; endforeach ?>
						</tbody>

					</table>

					<ul class="pagination">
    <li class="page-item">
	  <a class="page-link" href="<?php if ($page>1) 
	  
	  {echo 'pretraga.php?'.$lel.'=1&author='.$author.'&title='.$title.'&publisher='.$publisher.'&year='.$year.'&page=' . --$page;} 
	  ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
	</li>
	<?php $start = $page - 2; 
		  $end = $page + 2; 
		  if ($end > $number_of_pages) {$end = $number_of_pages;}
	?>
					<?php for ($start;$page<=$end;$page++) {
						echo '<li class="page-item"><a class="page-link" href="pretraga.php?'.$lel.'=1&author='.$author.'&title='.$title.'&publisher='.$publisher.'&year='.$year.'&page=' . $page . '">' . $page . '</a></li>';
						} $page--;?>


    <li class="page-item">
      <a class="page-link" href="<?php if ($page<=$number_of_pages) 
	  {	
		  echo 'pretraga.php?'.$lel.'=1&author='.$author.'&title='.$title.'&publisher='.$publisher.'&year='.$year.'&page=' . $page;} 
	  ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
				<?php else: ?>
					<h1 style="text-align: center; margin-top: 20px;"></h1>
				<?php endif ?>
			</div>
	</div>
</div>
</div>
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