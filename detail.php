<?php
readfile("includes/header-page.html");
readfile("services/" . $_GET["page"] . ".html");
?>

<div class="border"></div>
<?php
readfile("contact-row.html");
readfile("includes/footer-page.html");
?>
