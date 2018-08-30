<?php

function allThemes(){
    include "dbconnect.php";
    $sql = "SELECT Themes.idTheme, Themes.name 
             FROM Themes ORDER BY idTheme";
    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $thems=array();
    while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
        $thems[] = $row;
    }
    return $thems;
}
?>