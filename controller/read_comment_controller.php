<?php
include "core/dbconnect.php";
	$sql = 'SELECT text, create_date, name
            FROM News_Comments
            LEFT JOIN Users ON News_Comments.Users_idUsers = Users.idUsers  
			WHERE News_Comments.News_idNews = '.$_GET["news-id"].'
            ORDER BY create_date DESC';
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
    $output="";
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
        $comment = $row["text"];
        $user= $row["name"];
        $date = $row["create_date"];
        $output=$output.'  <div class="row pt-3 mt-2 comment">
            <div class="col-lg-12 col-sm-12 col-12 ">
				<p>'.$comment.'</p>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <img src="images/user-image.jpg" class="rounded-circle" width="20px">
                        <span class="text-info">'.$user.'</span>
                    </li>
                    <li class="list-inline-item">
                        <i class="fa fa-calendar" aria-hidden="true"></i> <span>'.$date.'</span>
                    </li>
                </ul>
            </div>          
        </div>';
    }



?>