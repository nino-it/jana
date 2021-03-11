<?php include('config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/switch.php'); ?>
<?php include(ROOT_PATH . '/start.php'); ?>

<?php $places = getAllPlaces();	?>

	<?php include(ROOT_PATH . '/navbar.php') ?>

	<main role="main" class="entry col-md-9 col-xs-12">

	<div class="btn-group btn-group-sm enter" role="group" aria-label="Basic example">
	<button type="button" class="btn btn-secondary"><span id="book">Knjiga </span></button>
	<button type="button" class="btn btn-secondary"><span id="article">Članak </span></button>
	<button type="button" class="btn btn-secondary"><span id="collection">Dnevnik</span></button>
	</div>

		

		<!-- BOOK -->
		<div class="book">
		<h1 class="page-title page2">Unos knjiga</h1>

		<div class="form-style-2">
			<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'unos.php'; ?>" >

			<div class="form-group ">
			<?php if ($isEditingPost === true): ?>
				<input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
			<?php endif ?>
				
			<div class="col-md-5 mb-1">
			<label for="field1">Autor </label><input type="text" class="form-control" name="author" value="<?php if ($isEditingPost === true) echo $author; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Naslov</label><input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Izdavač </label><input type="text" class="form-control" name="publisher" value="<?php echo $publisher; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Godina izdavanja</label><input type="text" class="form-control" name="year" value="<?php echo $year; ?>">
			</div>	
			<div class="col-md-5 mb-1">
			<label for="field4">Lokacija</label>
				<select name="place" class="form-control elect-field">
					<option value="">Izaberi mesto</option>
					<?php foreach ($places as $place): ?>
						<option value="<?php echo $place['id']; ?>" 
							<?php if (isset($place_id))
									if ($place_id==$place['id']) 
									echo "selected"; 
							?>>
						
							<?php echo $place['name']; ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>	
			<div class="col-md-5 mb-1">
			<label for="field5">Beleška</label>
				<textarea name="notes" class="form-control textarea-field" id="notes" cols="30" rows="10"><?php echo $notes; ?></textarea>
			</div>
			
			<?php if ($isEditingPost === true): ?> 
			<div class="col-md-5 mb-1">
				<label><span> </span><button type="submit" class="btn btn-primary" name="update-book">Sačuvaj izmene</button></label>
			</div>	
			<?php else: ?>
			<div class="col-md-5 mb-1">
				<label><span> </span><button type="submit" class="btn btn-primary" name="create-book">Sačuvaj knjigu</button></label>
			</div>
			<?php endif ?>

			</div>		
			</form>
		</div>	
		</div>

		<!-- ARTICLE -->
		<div class="article">
		<h1 class="page-title">Unos članka</h1>

		<div class="form-style-2">
			<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'unos.php'; ?>" >

			<div class="form-group">
			<?php if ($isEditingArticle === true): ?>
				<input type="hidden" name="articleId" value="<?php echo $articleId; ?>">
			<?php endif ?>
				
			<div class="col-md-5 mb-1">
			<label for="field1">Autor </label><input type="text" class="form-control" name="author" value="<?php echo $author; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Naslov</label><input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Izdavač </label><input type="text" class="form-control" name="magazine" value="<?php echo $magazine; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Godina izdavanja</label><input type="text" class="form-control" name="year" value="<?php echo $year; ?>">
			</div>	
			<div class="col-md-5 mb-1">
			<label for="field4">Lokacija</label>
				<select name="place" class="form-control elect-field">
					<option value="">Izaberi mesto</option>
					<?php foreach ($places as $place): ?>
						<option value="<?php echo $place['id']; ?>" 
							<?php if (isset($place_id))
									if ($place_id==$place['id']) 
									echo "selected"; 
							?>>
						
							<?php echo $place['name']; ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>	
			<div class="col-md-5 mb-1">
			<label for="field5">Beleška</label>
				<textarea name="notes" class="form-control textarea-field" id="notes" cols="30" rows="10"><?php echo $notes; ?></textarea>
			</div>
			
			<?php if ($isEditingPost === true): ?> 
			<div class="col-md-5 mb-1">
				<label><span> </span><button type="submit" class="btn btn-primary" name="update-article">Sačuvaj izmene</button></label>
			</div>	
			<?php else: ?>
			<div class="col-md-5 mb-1">
				<label><span> </span><button type="submit" class="btn btn-primary" name="create-article">Sačuvaj članak</button></label>
			</div>
			<?php endif ?>

			</div>		
			</form>
		</div>	
		</div>		

<!-- COLLECTION -->

		<div class="collection">
		<h1 class="page-title">Unos zbornika</h1>

		<div class="form-style-2">
			<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'unos.php'; ?>" >

			<div class="form-group">
			<?php if ($isEditingColl === true): ?>
				<input type="hidden" name="coll_id" value="<?php echo $coll_id; ?>">
			<?php endif ?>
				
			<div class="col-md-5 mb-1">
			<label for="field1">Autor </label><input type="text" class="form-control" name="author" value="<?php echo $author; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Naslov</label><input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Ime zbornika</label><input type="text" class="form-control" name="editor" value="<?php echo $editor; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Izdavač</label><input type="text" class="form-control" name="publisher" value="<?php echo $publisher; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Strane </label><input type="text" class="form-control" name="pages" value="<?php echo $pages; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field2">Godina </label><input type="text" class="form-control" name="year" value="<?php echo $year; ?>">
			</div>
			<div class="col-md-5 mb-1">
			<label for="field4">Lokacija</label>
				<select name="place" class="form-control elect-field">
					<option value="0">Izaberi mesto</option>
					<?php foreach ($places as $place): ?>
						<option value="<?php echo $place['id']; ?>" 
							<?php if (isset($place_id))
									if ($place_id==$place['id']) 
									echo "selected"; 
							?>>
						
							<?php echo $place['name']; ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>	
			<div class="col-md-5 mb-1">
			<label for="field5">Beleška</label>
				<textarea name="notes" class="form-control textarea-field" id="notes" cols="30" rows="10"><?php echo $notes; ?></textarea>
			</div>
			
			<?php if ($isEditingPost === true): ?> 
			<div class="col-md-5 mb-1">
				<label><span> </span><button type="submit" class="btn btn-primary" name="update-coll">Sačuvaj izmene</button></label>
			</div>	
			<?php else: ?>
			<div class="col-md-5 mb-1">
				<label><span> </span><button type="submit" class="btn btn-primary" name="create-coll">Sačuvaj dnevnik</button></label>
			</div>
			<?php endif ?>

			</div>		
			</form>
		</div>	
		</div>	
		<?php include('modal.php'); ?>
	</main>

	<?php switcheroo($_GET); ?>


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

<?php include('end.php'); ?>



