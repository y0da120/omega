
<!------------------------------------------Login/Sign In Buttons ---------------------------------->
		  <a class="btn btn-outline-primary text-white my-2 my-sm-0 m-1" data-toggle="modal" data-target="#loginModal"	 href="#">Bejelentkezés</a>
          <a class="btn btn-outline-success text-white my-2 my-sm-0" data-toggle="modal" data-target="#signModal" href="#">Regisztráció</a>
		 <!-------------------------- Login ------------------------------------------------>
		    <div id="loginModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
			<div class="modal-content">
					<div class="login-sign">
					<form class="form-signin" action = "controller/login_controller.php" method = "post">	
					  <h1 class="h3 mb-3 font-weight-normal">Bejelentkezés</h1>
					  <label for="inputText" class="sr-only">Felhasználó név</label>
					  <input type="text" name = "login_username" id="inputTextLog" class="form-control" placeholder="felhasználó" required >
					  <label for="inputPassword" class="sr-only" >Jelszó</label>
					  <input type="password" name = "login_pswd" id="inputPasswordLog" class="form-control" placeholder="******" required >
						<button class="btn btn-lg btn-primary btn-block" type="submit">Belépés</button>
					</form>
					</div>
					</div>
				</div>
			</div>
		   
		   
		   	<!-------------------------- Sign In ------------------------------------------------>
		   <div id="signModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
			<div class="modal-content">
					<div class="login-sign">
					<form class="form-signin" action = "controller/registration_controller.php" method = "post">	
					  <h1 class="h3 mb-3 font-weight-normal">Regisztráció</h1>
					  <label for="inputText" class="sr-only">Felhasználó név</label>
					  <input type="text" name="reg_username" id="inputTextReg" class="form-control" placeholder="felhasználó" required >
					  <label for="inputEmail" class="sr-only">Email cím</label>
					  <input type="email" name="reg_email"  id="inputEmail" class="form-control" placeholder="példa@gmail.com" required>
					  <label for="inputPasswordReg" class="sr-only">Jelszó</label>
					  <input type="password"  name="reg_pswd" id="inputPassword" class="form-control" placeholder="******" required>					 
						<button class="btn btn-lg btn-primary btn-block" type="submit">Regisztrálás</button>
					</form>
					</div>
					</div>
				</div>
			</div>
<!-------------------------------------------------------------------------------Login/SignIn End ---------------->