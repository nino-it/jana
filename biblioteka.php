<?php include('config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/all.php'); ?>
<?php include(ROOT_PATH . '/start.php'); ?>


<?php include(ROOT_PATH . '/navbar.php') ?>

<?php $books = test(); ?>

<main role="main" class="search col-md-9 col-xs-12">
	<h1>Sve knjige</h1>
	</br>
	<div class="row">

		<div class="book col-md-10">

			<?php if (isset($books)) : ?>
				<table class="table table-striped table-sm">
					<thead>
						<th>Autor</th>
						<th>Naslov</th>
						<th>Godina</th>
						<th>Lokacija</th>
						<th class='edel'>Izmena</th>
						<th class='edel'>Brisanje</th>
					</thead>
					
						<?php getAll(); ?>

				</table>
				</ul>

			<?php else : ?>
				<h1 style="text-align: center; margin-top: 20px;"></h1>
			<?php endif ?>
		</div>
	</div>

	</div>
</main>

</body>

</html>