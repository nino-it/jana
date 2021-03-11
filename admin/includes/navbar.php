<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">Janina Biblioteka</a>
</nav>
<ul class="pure-menu-list">
                    <li class="pure-menu-item">
                        <a href="<?php echo BASE_URL . 'home.php'; ?>" class="pure-menu-link">Početna</a>
                    </li>
                    <li class="pure-menu-item">
                        <a href="" class="pure-menu-link">Pretraga</a>
					</li>
                    <li class="pure-menu-item menu-item-divided">
                        <a href="<?php echo BASE_URL . 'unos.php'; ?>" class="pure-menu-link">Unos</a>
                    </li>					
                    <li class="pure-menu-item menu-item-divided">
                        <a href="<?php echo BASE_URL . 'podesavanja.php'; ?>" class="pure-menu-link">Podešavanja</a>
                    </li>

                </ul>




<div class="header">
	<div class="logo">
		<a href="<?php //echo BASE_URL .'admin/dashboard.php' ?>">
			<h1></h1>
		</a>
	</div>

</div>

<div class="user-info">
		Dobro došli <span><?php echo $_SESSION['user']['username']; ?></span> &nbsp; &nbsp; <a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">Izloguj se</a>
</div>

