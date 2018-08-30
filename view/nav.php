<body>
  <div class="bg-info">
  <div class="container">
    <nav class="navbar navbar-toggleable-md navbar-light" id="commRollover">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
      <a class="navbar-brand" href="index.php?page=home"><strong>Omega Hírek</strong></a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=home" >Kezdőlap<span class="sr-only">(current)</span></a> <!-- href="index.php?page=home"--> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=home&tag=belfold">Belföld</a> <!-- href="index.php?page=home&tag=belfold"--> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=home&tag=kulfold">Külföld</a> <!-- href="index.php?page=home&tag=kulfold""--> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=home&tag=tudomany">Tudomány</a> <!-- href="index.php?page=home&tag=tudomany"--> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=home&tag=sport">Sport</a> <!-- href="index.php?page=home&tag=sport"--> 
          </li>
        </ul>
		</div>
		<div class="col-4 d-flex justify-content-end align-items-center">
	<?php
		 session_start();
		 if (isset($_SESSION['login_error'])){
			 include "view/message.php";
			 unset($_SESSION['login_error']);
		 }
		 elseif (isset($_SESSION['reg_error']) || isset($_SESSION['reg_succes'])){
			 include "view/message.php";
			 unset($_SESSION['reg_error']);
			 unset($_SESSION['reg_succes']);
		 }
		if (!isset($_SESSION['login_user']))
			include "view/guest.php";
		else
			include "view/logged.php";
	?>
		</div>


    
    </nav>
  </div>
</div>

<!-- NAV VÉGE -->