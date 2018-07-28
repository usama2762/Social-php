<?php
if(!isset($_GET["page"]))
	exit();
require_once("generator.php");
get($_GET["page"]);
?>

