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
    <li><a href="example-cache.php">Example Cache</a></li>
    <li class="active"><a href="example-empty-cache.php">Empty Cache</a></li>
    <li><a href="documentation/index.html">Docs</a></li>
    <li><a href="http://codecanyon.net/user/techmynd">Support</a></li>
    </ul>
<hr />

<?php
// get all variables
function getVar(&$value, $default = null) { return isset($value) ? $value : $default; }
// usage example for above function
// $act = getVar($_REQUEST["act"]);
?>

<?php
$delete = getVar($_REQUEST["delete"]);
if($delete!='' && $delete=='lazy-fox')
{
$filename ="lazy-fox";
define('CACHE_PATH', $_SERVER["DOCUMENT_ROOT"]."/siteCache/");
// cache file name
$cachefile = CACHE_PATH . "cache_" . $filename;
if(file_exists($cachefile))
	{
	@unlink($cachefile);
	echo "<div class='alert alert-success'><strong>cache_lazy-fox</strong> cache file deleted successfully. See below to verify.</div>";
	}
		else { echo "<div class='alert'>No such file to delete.</div>"; }
}
?>



<?php 
$act = getVar($_REQUEST["act"]);
?>
<?php if($act=='' && $delete=='') { ?>
<p><a href="example-empty-cache.php?act=deleteall" class="btn">Delete all cached pages from cache...</a></p>
<?php } ?>



<?php if($act=='' && $delete=='') { ?>
<p>Delete all cache by including a file.</p>
<pre>include("empty-cache.php");</pre>
<?php } ?>


<?php
if($act!='' && $act=='deleteall')
	{
	include("empty-cache.php");
	echo "<div class='alert alert-success'>All cache deleted.</div>";
	}
?>




<br />


<h4>Current Cached Pages</h4>

<div class='alert alert-success'>
<?php
if ($handle = opendir('siteCache')) {
	while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $filess="Yes";
			echo "$entry<br />";
        }


    }
closedir($handle);
}

if($filess!='Yes')
{
echo "No page in cache.";
}
?>
</div>

<br>

<?php if($delete=='' && $act=='') { ?>
<h4>Delete Single Selected Cached Page</h4>

<p>Just give the name of cached file that you used to store it and include a file to unlink desired cache file.</p>

<pre>
$filename ="lazy-fox";
include("delete-single.php");
</pre>

<p>Above code will delete the specified cache file (in this case, lazy-fox). lazy-fox was the name we assigned to a section to create its cache. So we will delete that by using the same name of it.</p>


<p>Here is an example to delete single part of cache. Let's delete <strong>cache_lazy-fox</strong> cache file.</p>
<a href="example-empty-cache.php?delete=lazy-fox" class="btn">Delete Lazy Fox Cache</a>
<?php } ?>


<br>

<hr />
&copy 2013 TechMynd
<br /><br />

</div>
</body>
</html>