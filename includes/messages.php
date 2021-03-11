<?php if (isset($_SESSION['message']) & isset($_GET['success']))  : ?>
    <div class="modal-dialog modal-sm">
      <div class="message">
      	<p>
          <?php 
          	echo $_SESSION['message']; 
          	unset($_SESSION['message']);
          ?>
      	</p>
      </div>
    </div>  
<?php endif ?>