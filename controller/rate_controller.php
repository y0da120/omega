<?php 
	include "../core/dbconnect.php";
	
	switch ($_POST['rate']) {
		default 			: $interest=0;  $correct=0;  break;
		case "like-btn" 	: $interest=1;  $correct=0;  $updateValue=1;  $updateField="interested"; break;
		case "dislike-btn" 	: $interest=-1; $correct=0;  $updateValue=-1; $updateField="interested"; break;
		case "correct-btn" 	: $interest=0;  $correct=1;  $updateValue=1;  $updateField="correct";    break;
		case "wrong-btn" 	: $interest=0;  $correct=-1; $updateValue=-1; $updateField="correct";    break;
		
	}
    if($interest !=0 ){
        $sqlUpdateUCT="";
        //modify in user_connect thems
        $sqlUpdateUCT="";
        foreach($_POST['themeIds'] as $i){
            $sqlUpdateUCT = " UPDATE Users_Connect_Themes SET interestedRate=interestedRate + ".$interest." 
                            WHERE idUser=".$_POST["uId"]." AND idTheme=".$i."";
            $resultUpdateUCT=mysqli_query($conn,$sqlUpdateUCT) or die(mysqli_error($conn));
        }
  
    }
    //set Users_Connect_News
	$sqlInsert = "INSERT INTO `Users_Connect_News` (`Users_idUsers`, `News_idNews` , `interested` , `correct`) 
			VALUES ('".$_POST["uId"]."', '".$_POST["aId"]."', '".$interest."', '".$correct."')";
	
	$resultInsert = mysqli_query($conn,$sqlInsert);
	if(!$resultInsert){
		$sqlUpdate = "UPDATE Users_Connect_News SET ".$updateField." = ".$updateValue."
					WHERE Users_idUsers=".$_POST["uId"]." AND News_idNews=".$_POST["aId"]."";
		$resultUpdate=mysqli_query($conn,$sqlUpdate) or die(mysqli_error($conn));
	}
	//echo "Név: ".$_POST['uId']." ".$_POST['aId']." ".$_POST['rate'];


?>