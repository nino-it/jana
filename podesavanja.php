<?php include('config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/start.php'); ?>

<?php $places = getAllPlaces();	?>

<?php include(ROOT_PATH . '/navbar.php') ?>


		<main role="main" class="col-md-9 ml-sm-auto col-lg-10">
			<h1>Podešavanja</h1>
			<table class="table table-striped table-sm" onload="myFunction()">
			<thead>
						<th>#</th>
						<th>Naziv</th>
						<th>Opis</th>
						<th class='edel'>Izmena</th>
						<th class='edel'>Brisanje</th>
					</thead>
					<tbody>
			
			<?php foreach ($places as $key => $place): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $place['name']; ?></td>
							<td><?php echo $place['description']; ?></td>

							<td>
								<a class="fas fa-edit btn edit"
									href="podesavanja.php?edit-place=<?php echo $place['id'] ?>">
								</a>
							</td>
							<td>
								<a class="fas fa-trash btn delete" 
									href="podesavanja.php?delete-place=<?php echo $place['id'] ?>">
								</a>
							</td>
						</tr>
			<?php if ($key == 20) break; endforeach ?>
			</table>

			<div class="form-style-2 bejy">
				<?php if ($isEditingPlace === true): ?>
					<h2>Izmeni mesto</h2>
				<?php else: ?>
					<h2>Dodaj novo mesto</h2>
				<?php endif ?>

				<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'podesavanja.php'; ?>" >

				<?php if ($isEditingPlace === true): ?>
					<input type="hidden" name="place_id" value="<?php echo $place_id; ?>">
				<?php endif ?>

				<div class="col-md-5 mb-1">
					<label for="field1">Naziv</label>
				</div>
				<div class="col-md-5 mb-1">
					<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
				</div>

				<div class="col-md-5 mb-1">		
					<label for="field5">Opis</label>
				</div>

				<div class="col-md-5 mb-1">
					<textarea name="description" class="form-control textarea-field" id="description" cols="30" rows="10"><?php echo $desc; ?></textarea>
				</div>
				
				<div class="col-md-5 mb-1">	
				<?php if ($isEditingPlace === true): ?> 
					<label><span> </span><button type="submit" id="myBtn" class="btn btn-primary" name="update-place">Sačuvaj izmene</button></label>
				<?php else: ?>
					<label><span> </span><button type="submit" id="myBtn" class="btn btn-primary" name="create-place">Sačuvaj mesto</button></label>
				<?php endif ?>
				</div>

				</form>
			</div>			


<?php include('modal.php'); ?>

		</main>
		

<?php include('end.php'); ?>