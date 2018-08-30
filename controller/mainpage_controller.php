<?php 
function loggedNews($tag)
{
	include "core/dbconnect.php";
	
	switch ($tag)
	{
		default 		: $tag=""; break;
		case 'belfold' 	: $tag="belf%ld"; break;
		case 'kulfold' 	: $tag="k%lf%ld"; break;
		case 'tudomany'	: $tag="tudom%ny"; break;
		case 'sport' 	: $tag="sport"; break;
	}
    $sqlThemeTag="";
    if(!empty($tag) ){
        $sqlThemeTag = "AND idNews = ANY (SELECT idNews
                            FROM Themes
                            LEFT JOIN News_Connect_Themes
                            ON News_Connect_Themes.idTheme =  Themes.idTheme
                            WHERE Themes.name LIKE '".$tag."')";
    }
    if(!isset($_SESSION['login_id'])){
        $sql = "SELECT * FROM 
                (SELECT Users.name,News.*
                FROM News 
                LEFT JOIN Users ON News.author_id =Users.idUsers  
                WHERE News.active=1 ".$sqlThemeTag.") T1
                LEFT JOIN (SELECT News_IdNews, SUM(interested) AS interestedSum, SUM(correct) AS correctSum
                FROM Users_Connect_News
                GROUP BY News_IdNews) T2
                ON  T1.idNews= T2.News_IdNews
                ORDER BY interestedSum DESC";
    }
    else{
        $sql ="SELECT T1 . * , T2.interestedSum, T2.correctSum FROM 
                (SELECT Users.name,News.*
                FROM News 
                LEFT JOIN Users ON News.author_id =Users.idUsers  
                WHERE News.active=1 ".$sqlThemeTag.") T1
                LEFT JOIN (SELECT News_IdNews, SUM(interested) AS interestedSum, SUM(correct) AS correctSum
                FROM Users_Connect_News
                GROUP BY News_IdNews) T2
                ON  T1.idNews= T2.News_IdNews 
                LEFT JOIN
                (SELECT Users_Connect_Themes.idTheme, SUM(interestedRate) AS NewsValue, News_Connect_Themes.idNews
                FROM Users_Connect_Themes 
                RIGHT JOIN News_Connect_Themes ON News_Connect_Themes.idTheme = Users_Connect_Themes.idTheme 
                WHERE idUser = ".$_SESSION['login_id']."
                GROUP BY News_Connect_Themes.idNews) T3
                ON  T3.idNews = T1.idNews
                ORDER BY  NewsValue DESC";
    }
			
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$output="";
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
	{
		$length = strlen($row['attention_text']) < 380 ? strlen($row['attention_text']) :380;
		$attText = $length < 380 ? substr($row['attention_text'], 0, $length) : substr($row['attention_text'], 0, $length)."...";
        
        //get themes for news 
        $themes =getThemes($conn,$row['idNews']);
        $tags="";
        foreach($themes as $item)
		{
              //$t = mb_convert_encoding($item,"UTF-16");
			 $tags =$tags.'<span class="badge badge-primary"> '.$item.'</span> ';
		}
		$baseThumpImage="";
		if(empty($row['image']) || $row['image']==="images/")
			$thumpImage = "../images/news_thumb.jpeg";
		else 
			$thumpImage =$row["image"];
        
        //Interest Correct numbers
		$interestSum = is_null($row["interestedSum"]) ? 0 : $row["interestedSum"];
		$correctSum =  is_null($row["correctSum"]) ? 0 : $row["correctSum"];
        $iText= $interestSum ==0 ? ' '.$interestSum  : sprintf("%+d",$interestSum );
        $cText= $correctSum ==0 ? ' '.$correctSum  : sprintf("%+d",$correctSum );
        
        //Delete button
        $DelBtn ="";
        if(isset($_SESSION['login_id']) && isAdmin($conn,$_SESSION['login_id']))
            $DelBtn = '<button href="" class="btn btn-secondary btn-sm active delete-news" data-news-id="'.$row['idNews'].'"><i class="fa fa-remove" aria-hidden="true"></i> Törlés </button>';
        
		$output =  '<hr>
    <div class="row">
      <div class="col-lg-12 col-sm-12 col-12">
        <div class="row">
          <div class="col-lg-2 col-sm-2 col-5">
            <img src="'.$thumpImage.'" class="img-thumbnail" width="150px">
          </div>
          <div class="col-lg-10 col-sm-10 col-7">
            <h4 class="text-primary">'.$row["title"].'</h4>
            <p class="text-justify">
              '.$attText.'
            </p>
			<a href="index.php?page=read-article&news-id='.$row["idNews"].'" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">Olvasd tovább</a> '.$DelBtn.' 
          </div>
        </div>
        <div class="row post-detail">
          <div class="col-lg-12 col-sm-12 col-12">
            <ul class="list-inline">
			 <li class="list-inline-item">
				<img src="images/user-image.jpg" class="rounded-circle" width="20px">
                <span class="text-info">'.$row["name"].'</span>
              </li>
              <li class="list-inline-item">
                <i class="fa fa-calendar" aria-hidden="true"></i> <span>'.$row["create_date"].'</span>
              </li>
           

              <li class="list-inline-item">
                <i class="fa fa-tags" aria-hidden="true"></i>
                <span>Tagek:</span>
				'.$tags.'
              </li>
			  <li class="list-inline-item float-right">
			    <strong class="d-inline-block mb-2 pr-3 text-muted">Érdekes: <span class="ic"> '.$iText.' </span></strong>
				<strong class="d-inline-block mb-2 pr-3 text-muted">Korrekt: <span class="ic"> '.$cText.'</span></strong>
			  </li>
            </ul>
          </div>
        </div>
      </div>
    </div>';
	echo $output;
	}



		
}
function getThemes($conn,$idNews){
    $sql = "SELECT Themes.name 
             FROM Themes
             LEFT JOIN News_Connect_Themes
             ON News_Connect_Themes.idTheme =  Themes.idTheme
             WHERE News_Connect_Themes.idNews =".$idNews."";
    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $thems=array();
    while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
        $thems[] = $row['name'];
    }
    return $thems;
}
function isAdmin($conn,$idUser){
      $sql = "SELECT idUsers FROM Users WHERE idUsers= ".$idUser." AND permission_level = 0";
      $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      return $count == 1;
}

function test($conn)
{

        
    $sql= "SELECT * FROM 
                (SELECT Users.name,News.*
                FROM News 
                LEFT JOIN Users ON News.author_id =Users.idUsers  
                WHERE News.active=1  AND idNews = ANY (SELECT idNews
                            FROM Themes
                            LEFT JOIN News_Connect_Themes
                            ON News_Connect_Themes.idTheme =  Themes.idTheme
                            WHERE Themes.idTheme= 3)
                ) T1
                LEFT JOIN (SELECT News_IdNews, SUM(interested) AS interestedSum, SUM(correct) AS correctSum
                FROM Users_Connect_News
                GROUP BY News_IdNews) T2
                ON   T1.idNews= T2.News_IdNews
                ORDER BY interestedSum DESC";
    

    
    

 
	$articleValue;
	 $userId = 12;

  
    
        

	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	 while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
		 foreach($row as $item){
			 echo $item.'  ';
		 }
		 echo "</br>";
	 }

}

?>
