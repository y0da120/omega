<?php
	include "../core/dbconnect.php";
	//set news inactive
	$sql = "UPDATE News
            SET active = 0
			WHERE idNews = ".$_POST['nId']."";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if($result)
        echo "Hír sikeresen eltávolítva!";
    else
        echo "Sikertelen művelet!";
   
?>