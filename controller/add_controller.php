<?php
	include "../core/dbconnect.php";
	session_start();
	$error=array();
	$thems="";
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["imageFile"]["name"]);
	$uploadOk = 1;
	$minimum = array('width' => '150', 'height' => '150');
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		//image check
		if($_FILES['imageFile']['name'] != ""){
			$check = getimagesize($_FILES["imageFile"]["name"]);
			$width= $check[0];
			$height =$check[1];
			if($check == false   ) {
				$error["image"]="A fálj nem kép!";			
				$uploadOk = 0;
			} 
			//Check minimum width&height
			else if( $width < $minimum["width"] || $height < $minimum["height"]){
				$error["image"]="A kép túl kicsi!";			
				$uploadOk = 0;
			}
			// Check file size
			elseif ($_FILES["imageFile"]["size"] > 1000000) {
				$error["image"]="Túl nagy fálj!";
				$uploadOk = 0;
			}
			// Allow certain file formats
			elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$error["image"]= "Csak JPG, JPEG, PNG & GIF kiterjesztésű fálj lehet!";
				$uploadOk = 0;
			}
			// if everything is ok, try to upload file
			if ($uploadOk == 1) {
				if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
					//echo "The file ". basename( $_FILES["imageFile"]["name"]). " has been uploaded.";
				} else {
					$error["image"] ="A fájl feltöltés nem sikerült.";
				}
			}
		}
	
		//title
		if(mb_strlen(trim($_POST["artTitle"]),"utf-8") < 3){
			$error["title"]="Hibás cím hossz!";
		}else{
			$title=mysqli_real_escape_string($conn,$_POST['artTitle']);
		}
		//attention text
		if(mb_strlen(trim($_POST["artAttentionText"]),"utf-8") < 3){
			$error["attentionText"]="Hibás szöveg hossz!";
		}
		else{
			$attentionText=mysqli_real_escape_string($conn,$_POST['artAttentionText']);
		}
		//main text
		if(mb_strlen(trim($_POST["artText"]),"utf-8") < 3){
			$error["text"]="Hibás szöveg hossz!";
		}
		else{
			$text=mysqli_real_escape_string($conn,$_POST['artText']);
		}
		//themes
		$thems=array();
		if(!isset($_POST['artThemes']))
		{
			$error['thems']="Egy témát kötelező választani!";;
		}
		else
		{
			$thems=$_POST['artThemes'];
        }
		if(empty($error)){
			//INSERT NEWS
			$createDate = date('Y-m-d H:i:s',time());
			$id = $_SESSION['login_id'];
			$qry = "INSERT INTO `News` (`title`, `attention_text`, `content`, `author_id`, `create_date`,`image` ,`active` )
			VALUES ('".$title."', '".$attentionText."','".$text."', '".$id."', '".$createDate."', '".$target_file."', '1')";
			$result = mysqli_query($conn,$qry) or die(mysqli_error($conn));
            
            //INSERT NEWS THEMES
            if($result){
                $qryNid = "SELECT idNews FROM News ORDER BY idNews DESC LIMIT 1";
                $resultNid = mysqli_query($conn,$qryNid) or die(mysqli_error($conn));
                $row =  mysqli_fetch_array($resultNid,MYSQLI_ASSOC);
                $nid = $row['idNews'];
                echo $nid;
                $qryThemesBegin = "INSERT INTO  News_Connect_Themes (idNews,idTheme) VALUES ";
                $qryThemesEnd="";
          
                foreach($thems as $item){
                    if($item ==  end($thems))
                        $comma="";
                    else{
                        $comma=" , ";
                    }
                    $qryThemesEnd = $qryThemesEnd." ('".$nid."', '".$item."')".$comma."";
                }
                $qryThemes = $qryThemesBegin.$qryThemesEnd;
                echo  $qryThemes."</br>";
                $resultThemes = mysqli_query($conn, $qryThemes) or die(mysqli_error($conn));
                //if all good
                if($resultThemes){
                    header("location: ../index.php?page=home");
                }
            }
		}
		else{
			$urlPortion= '&error='.urlencode(serialize($error));
			header('location: ../index.php?page=add-article'.$urlPortion.'');
		}
	}
	
?>