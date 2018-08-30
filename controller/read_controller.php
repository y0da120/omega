<?php
	include "core/dbconnect.php";
	//$sql = " SELECT * FROM News WHERE active = 1";
	//NEWS
	$sql = 'SELECT Users.name,News.*,interestedSum, correctSum
            FROM News 
            LEFT JOIN Users ON News.author_id =Users.idUsers  
            LEFT JOIN (SELECT News_IdNews, SUM(interested) AS interestedSum, SUM(correct) AS correctSum
            FROM Users_Connect_News
            GROUP BY News_IdNews) T2
            ON  News.idNews= T2.News_IdNews
			WHERE News.active=1 AND News.idNews = '.$_GET["news-id"].'';
	$result = mysqli_query($conn,$sql); //or die(mysqli_error($conn));
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	$count = mysqli_num_rows($result);
	if(!$result || $count != 1){
		 header("location: ../index.php");
	}
    //get themes for news 
    $themes =getThemes($conn,$_GET["news-id"]);
    $tags="";
    foreach($themes as $item)
    {
        $t = mb_convert_encoding($item['name'],"UTF-8");
        $tags =$tags.'<span class="badge badge-primary theme" data-tag-id="'.$item['idTheme'].'"> '.$t.'</span> ';
    }
	$imageDest ="";
	if(empty($row['image']) || $row['image']==="images/")
		$imageDest = "../images/news_thumb.jpeg";
	else 
		$imageDest =$row["image"];
    //interested-correct numbers
    $interestSum = is_null($row["interestedSum"]) ? 0 : $row["interestedSum"];
    $correctSum =  is_null($row["correctSum"]) ? 0 : $row["correctSum"];
	//Did USER rate
	if(isset($_SESSION['login_id'])){
		$sqlIc = " SELECT * FROM Users_Connect_News WHERE Users_idUsers = ".$_SESSION['login_id']." 
					AND News_idNews =".$_GET["news-id"]."";
		$resultIc = mysqli_query($conn,$sqlIc) or die(mysqli_error($conn));
		$rowIc = mysqli_fetch_array($resultIc, MYSQL_ASSOC);
		$countIc=mysqli_num_rows($resultIc);
		$showRateInterest=0;
		$showRateCorrect=0;
		if($countIc ==1){
			$showRateInterest=$rowIc['interested'];
			$showRateCorrect=$rowIc['correct'];
		}
	}
function getThemes($conn,$idNews){
    $sql = "SELECT Themes.idTheme,Themes.name 
             FROM Themes
             LEFT JOIN News_Connect_Themes
             ON News_Connect_Themes.idTheme =  Themes.idTheme
             WHERE News_Connect_Themes.idNews =".$idNews."";
    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $thems=array();
    while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
        $thems[] = $row;
    }
    return $thems;
}
?>