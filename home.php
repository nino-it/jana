<?php include('config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/start.php'); ?>


<?php $posts = getAllBooks(); ?>

		<?php include(ROOT_PATH . '/navbar.php') ?>	

		<main role="main" class="col-md-9 col-xs-12 home">
		<h1>Poslednjih 5 knjiga</h1>	
			<!-- Display records from DB-->
			<div class="table-responsive">
				<!-- Display notification message -->
				<?php include(ROOT_PATH . '/includes/messages.php') ?>

				<?php if (empty($posts)): ?>
					<h1 style="text-align: center; margin-top: 20px;">Baza podataka je prazna</h1>
				<?php else: ?>
					<table class="table table-striped table-sm">
						<thead>
							<th>#</th>
							<th>Autor</th>
							<th>Naslov</th>
							<th>Godina</th>
							<th>Datum unosa</th>
							<th class='edel'>Izmena</th>
							<th class='edel'>Brisanje</th>
						</thead>
						<tbody>
						
						<?php foreach ($posts as $key => $post): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $post['author']; ?></td>
								<td><?php echo $post['title']; ?></td>
								<td><?php echo $post['year']; ?></td>
								<td><?php echo date("d. m. Y.", strtotime($post['created'])) ?></td>

								<td>
									<a class="fas fa-edit btn edit"
										href="unos.php?edit-book=<?php echo $post['id'] ?>">
									</a>
								</td>
								<td>
									<a class="fa fa-trash btn delete" 
										href="unos.php?delete-book=<?php echo $post['id'] ?>">
									</a>
								</td>
							</tr>
						<?php if ($key == 4) break; endforeach ?>
						</tbody>
					</table>
				<?php endif ?>
			</div>
		<h1>Statistika</h1>	

		<div class="row">
		<div class="col-md-6 col-xs-12">
			
			<ul class="list-group mb-3">
			<?php if (empty($posts)) echo "Prayno omg"; ?>

			<?php $stats = getAuthorByBooks();  ?>
			<?php foreach ($stats as $key => $stat): ?>				
				
				<li class="list-group-item d-flex justify-content-between lh-condensed">
				<div>
					<h6 class="my-0"><?php if ($stat['author'] == "") echo "Opšta literatura"; else echo $stat['author'];?></h6>
					<small class="text-muted"></small>
				</div>
				<span class="text-muted"><?php echo $stat['aCount']; ?></span>
				</li>

			<?php if ($key == 5) break; endforeach ?>
			
			</ul>
		  </div>
		

		<div class="col-md-6 col-xs-12">
			<ul class="list-group mb-3">
				<li class="list-group-item d-flex justify-content-between lh-condensed">
				<div>
					<h6 class="my-0">Knjiga:</h6>
					<small class="text-muted"></small>
				</div>
				<span class="text-muted"><?php getTotalBooks(); ?></span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
				<div>
					<h6 class="my-0">Pisaca:</h6>
					<small class="text-muted"> </small>
				</div>
				<span class="text-muted"><?php echo count(getAuthorByBooks()); ?></span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
				<div>
					<h6 class="my-0">Članaka:</h6>
					<small class="text-muted"> </small>
				</div>
				<span class="text-muted"><?php getArts(); ?></span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
				<div>
					<h6 class="my-0">Zbornika:</h6>
					<small></small>
				</div>
				<span class="text-muted"><?php getColls(); ?></span>
				</li>
			</ul>
	 	</div>
		</div>

		</main>
		
	</div>


	<?php include('end.php'); ?>

	
