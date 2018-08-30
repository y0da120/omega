<?php
   include "../core/dbconnect.php";
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['login_username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['login_pswd']); 
	  $mypassword = md5($mypassword.'!S3cr3t_k3y!');
	  echo $mypassword;
      $sql = "SELECT idUsers FROM Users WHERE name = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
		 $_SESSION['login_id']=$row['idUsers'];
         
        header("location: ../index.php?page=home");
      }else {
		  $_SESSION['login_error']=1;
		  header("location: ../index.php?page=home");
      }
   }
?>