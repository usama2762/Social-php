<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Metameric Cache</title>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
<br />
<h1 class="pull-left">PHP Metameric Cache</h1>
<div class="clearfix"></div>
<hr />
    <ul class="nav nav-pills">
    <li><a href="index.php">Home</a></li>
    <li class="active"><a href="example-cache.php">Example Cache</a></li>
    <li><a href="example-empty-cache.php">Empty Cache</a></li>
    <li><a href="documentation/index.html">Docs</a></li>
    <li><a href="http://codecanyon.net/user/techmynd">Support</a></li>
    </ul>
<hr />

<p>
On page load, below some sections will be cached separately in separate files and other won't. Verify those cached pages by clicking links below in live example section. Open cached page and compare its contents with contents at this page.
</p>

<br />

<?php
// get all variables
function getVar(&$value, $default = null) { return isset($value) ? $value : $default; }
// usage example for above function
// $act = getVar($_REQUEST["act"]);
$filename = getVar($_REQUEST["filename"]);
$cached = getVar($_REQUEST["cached"]);
?>

<blockquote>
<?php $filename="fast-tiger"; $cachetime=24 * 3600; include("start-cache.php"); if($cached!='yes') { ?>
<strong>Fast Tiger</strong><br />
Once upon a time there was a tiger in a jungle who was very very fast.<br />
<?php } include("end-cache.php"); ?>
</blockquote>

<br />
[ This section will not be cached. ]
<br /><br />

<blockquote>
<?php $filename="lazy-fox"; $cachetime=48 * 3600; include("start-cache.php"); if($cached!='yes') {  ?>
<strong>Lazy Fox</strong><br />
Once upon a time a lazy fox was sleeping in the jungle.<br />
<?php } include("end-cache.php"); ?>
</blockquote>

<br />

[ This section will also not be cached. ]
<br /><br />

<blockquote>
<?php $filename="more-text"; include("start-cache.php"); if($cached!='yes') { ?>
<strong>More Text</strong><br />
Lorem Ipsum.....<br />
<?php } include("end-cache.php"); ?>
</blockquote>

<br />

<blockquote>
<?php $filename="some-more"; include("start-cache.php"); if($cached!='yes') {  ?>
<strong>Some More</strong><br />
Here is some more text<br />
<?php } include("end-cache.php"); ?>
</blockquote>

<br />





<h4>Live Example - Current Cached Pages</h4>

<div class='alert alert-success'>
<?php
if ($handle = opendir('siteCache')) {
	while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $filess="Yes";
			echo "<a href='siteCache/$entry' target='_blank'>$entry</a><br />";
        }
    }

if($filess=='Yes')
	{ echo "<br /><a href='example-empty-cache.php'>Delete all cache</a>"; }

closedir($handle);
}

if($filess!='Yes')
{
echo "No page in cache";
}
?>
</div>








<hr />
&copy 2013 TechMynd
<br /><br />

</div>
</body>
</html>