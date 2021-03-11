<?php if (isset($_SESSION['users'])) { ?>
	<div class="xx">
		<span>welcome <?php echo $_SESSION['users'] ?></span>
		|
		<span><a href="logout.php">logout</a></span>
	</div>
<?php }else{ ?>

		<div class="xx">
			<form class="x" action="<?php echo BASE_URL . 'index.php'; ?>" method="post" >
				<div style="width: 60%; margin: 0px auto;">
					<?php include(ROOT_PATH . '/includes/errors.php') ?>
				</div>
				<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Korisničko ime">
				<input type="password" name="password"  placeholder="Šifra"> 
				<button class="btn" type="submit" name="login_btn">Prijava</button>
			</form>
		</div>
<?php } ?>
