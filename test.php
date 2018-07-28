<?php
readfile("includes/header-static.html");
$_GET["page"] = "test";
require("static.php");
readfile("includes/footer.html");
?>