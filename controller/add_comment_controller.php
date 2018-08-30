<?php
   include "../core/dbconnect.php";
   session_start();
    $error =false;
   if($_SERVER["REQUEST_METHOD"] == "POST"){
	//comment
	if(mb_strlen(trim($_POST["commentText"]),"utf-8") < 3){
		$error=true;
	}else{
		$comment=mysqli_real_escape_string($conn,$_POST['commentText']);
	}
    if(!isset($_GET["idNews"])){
       $error=true;
	}
    if(!isset($_SESSION['login_id'])){
       $error=true;
	}
     $createDate = date('Y-m-d H:i:s',time());
     $idUser=$_SESSION['login_id'];
     $idNews=$_GET["idNews"];
	if(!$error){
		$qry = "INSERT INTO `News_Comments` (`text`, `create_date`, `News_idNews`, `Users_idUsers`)
		VALUES ('".$comment."', '".$createDate."','".$idNews."', '".$idUser."')";
		$result = mysqli_query($conn,$qry); //or die(mysqli_error($conn));
		
	}
    header("location: ../index.php?page=read-article&news-id=".$idNews."");
   }
?>