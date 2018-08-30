<?php
function indexCntr($_menu_){
	include "view/header.php";
	include "view/nav.php";
	//content
	
	switch ($_menu_){
		default: include "view/main.php"; break;
		case "home" 		:  	include "view/main.php"; break;
		case "add-article" 	:	include "view/add_article.php"; break;
		case "read-article" : 	include "view/article.php"; break;

	}
	
	
	include "view/footer.php";
	
}
?>