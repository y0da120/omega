<?php
if (!array_key_exists("page",$_GET)){
	$_GET["page"]="home";
}

include_once "controller/index_controller.php";
indexCntr($_GET["page"]);

?>