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
    <li class="active"><a href="index.php">Home</a></li>
    <li><a href="example-cache.php">Example Cache</a></li>
    <li><a href="example-empty-cache.php">Empty Cache</a></li>
    <li><a href="documentation/index.html">Docs</a></li>
    <li><a href="http://codecanyon.net/user/techmynd">Support</a></li>
    </ul>

<hr />


<div>

<h4>Introduction</h4>

<p>PHP Metameric Cache is a disk based cache mechanism that lets you create cache for <strong>selected parts</strong> of PHP page or PHP website quickly and easily. It does not depend on URL structure of your website. You can store each cached part with a unique name and then retrieve it or delete it on rerquirement. This cache will create segmented cache for your web application for those parts that require heavy server processing. Use this to speed up your website, boost performance and loading time.</p>

<br />

<h4>PHP Metameric Cache Features</h4>

<ul>
<li>Easy to integrate in and configure with any website</li>
<li>Lightweight script</li>
<li>Only connects to the database or go through PHP scripts when cache has expired or cache page does not exist</li>
<li>Set cache time easily</li>
<li>Delete selected part (file) from cache or all cache files</li>
<li>Reduce server load, processing, resources consumption and increase website loading speed making it responsive</li>
<li>Reduce database queries requests</li>
</ul>

<br />

<h4>Explanation</h4>

<p>This script is for those who do not like 'full page caching' or 'full website caching'. Exclude login or user areas completely from caching. Take selected parts, from website or from PHP page - define their names and cahce those parts individually. This cache will get output from those parts and store them with their unique names in cache folder. Next time when the page loads, if those segments are stored in cache, will be displayed from cache and their real PHP code that generated those parts will not be executed. Real PHP code execution including database requests will be skipped and its already stored output will be displayed. You can cache as many parts of a page or a website as you like. This gives you full control over your website content. You can decide from where, what and how much to cache. Its simple and easy to use.
</p>

<br />

<h4>Implementation / Usage</h4>

<p>Its a 4 step process to cache any part of webpage</p>

<ul>
<li>Define name for cache file</li>
<li>Start cache</li>
<li>Put content or PHP code to cache</li>
<li>End cache</li>
</ul>

<pre>
--cachePARTname--
--start cache--
Code or Content no 1
--end cache--

--cachePARTname--
--start cache--
Code or Content no 2
--end cache--

more content of webpage

--cachePARTname--
--start cache--
Code or Content no 3
--end cache--
</pre>


<h4>Exact Implementation</h4>

<pre>
< ? p h p
$filename="fast-tiger";
include("start-cache.php");
if($cached!='yes') { ? >

Once upon a time there was a tiger in a jungle who was very very fast.

< ? p h p } include("end-cache.php");
? >
</pre>

<p>This will create a cache file named as cache_fast-tiger and store the data "Once upon a time there was a tiger in a jungle who was very very fast." in it.</p>

<h4>Custom Caching Time for Individual Section</h4>

<p>Some areas of website do not update often, its good idea to let them remain cached for longer time than other important areas. You can specify custom time for caching easily. For above example default time for individual cached pages is 12 hours after creation, unless they are deleted manually. If you like to set custom time then use the code like below:</p>

<pre>
< ? p h p
$filename="fast-tiger";
<strong>$cachetime=48 * 3600;</strong> //48 hours
include("start-cache.php");
if($cached!='yes') { ? >

Once upon a time there was a tiger in a jungle who was very very fast.

< ? p h p } include("end-cache.php");
? >
</pre>

<p>Only addition is <code>$cachetime=48 * 3600;</code> - right after we give name to that part of code. After using it, cache time for only this part will be changed. <code>$filename</code> is necessary and <code>$cachetime</code> is optional. If you do not use custom time, script will use default time that is 12 hours. You can change the default time for cache validity from main script file.</p>

<pre>
12 * 3600 = 12 hours
24 * 3600 = 24 hours
48 * 3600 = 48 hours
</pre>


<br /><br />
<hr />

&copy 2013 TechMynd

<br /><br />

</div>
</div>
</body>
</html>