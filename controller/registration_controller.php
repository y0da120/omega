<?php
   include "../core/dbconnect.php";
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST"){
	   	$error=array();
	//username
	if(mb_strlen(trim($_POST["reg_username"]),"utf-8") < 3){
		$error["name"]="username_error";
	}else{
		$name=mysqli_real_escape_string($conn,$_POST['reg_username']);
	}
	//email
	$email=mysqli_real_escape_string($conn,$_POST['reg_email']);
	if( !filter_var($email,FILTER_VALIDATE_EMAIL) ){
		$error["email"]="email_error";
	}
	//password
	$pswd= mysqli_real_escape_string($conn,$_POST['reg_pswd']);
	if( mb_strlen($pswd,"utf-8") < 3  OR mb_strlen($pswd,"utf-8") > 15){
		$error["pswd"]="password_error";
	}
	if(empty($error)){
		$password = md5($pswd.'!S3cr3t_k3y!'); 
		$regDate = date('Y-m-d H:i:s',time());
	
		$qry = "INSERT INTO `Users` (`name`, `registration_date`, `password`, `email`, `permission_level`)
		VALUES ('".$name."', '".$regDate."','".$password."', '".$email."', '1')";
		$result = mysqli_query($conn,$qry); //or die(mysqli_error($conn));
		if($result){
            
            //insert users_connect_themes with rate =0 
            $qryUID = "SELECT idUsers FROM Users ORDER BY idUsers DESC LIMIT 1";
            $resultUID = mysqli_query($conn,$qryUID); //or die(mysqli_error($conn));
            $row =  mysqli_fetch_array($resultUID,MYSQLI_ASSOC);
            $count = mysqli_num_rows( $resultUID);
            $id = $row['idUsers'];
            echo "RowNumber:".$count."id:".$id;
            echo "</br>";
            $qryUidThemes = "INSERT INTO Users_Connect_Themes (idUser,idTheme,interestedRate)
                            SELECT ".$id.",idTheme,0 FROM Themes";
            echo   $qryUidThemes ;
            $resultUidThemes = mysqli_query($conn, $qryUidThemes) or die(mysqli_error($conn));
			$_SESSION['reg_succes'] = 1;
			header("location: ../index.php");
		}
		else{
		$_SESSION['reg_error']=1;
		header("location: ../index.php");
		} 
	}
	else{
		/*foreach ($error as $item)		{
			echo $item;
		}*/
		$_SESSION['reg_error']=1;
		header("location: ../index.php");
	}
   }
    
?>