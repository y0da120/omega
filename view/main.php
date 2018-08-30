<div class="bg-faded">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-sm-8 col-8">
        <h2 class="pt-5"> <?php if (isset($_SESSION['login_user'])) echo "Népszerű híreink neked";
								else echo "Népszerű híreink";
		?></h2>
      </div>
	  <?php include "controller/mainpage_controller.php"; ?>
	  <?php 
	  if (isset($_SESSION['login_user']))
			echo  '
			<div class="col-lg-4 col-sm- col-4 d-flex justify-content-end">    
				<div class="pt-5">
				<a class="btn btn-outline-primary my-2 my-sm-0 m-1" href="index.php?page=add-article">Új hír hozzáadása</a>
				</div>
			</div>';
	  ?>
    </div>
	
	<?php if(!isset($_GET['tag'])) loggedNews("");
		  else loggedNews($_GET['tag']);
	?>
  </div>
</div>
<script src="js/deleteNews.js" > </script>