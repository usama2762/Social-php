<?php
if($_SERVER["REQUEST_METHOD"] != 'POST')
{
	// absolute path of cache directory
	// important // If you get the notice that "Notice: Constant CACHE_PATH already defined", create a separate php file and 
	// copy line below in that file and include that file once at the top of every page that is using cache
	// the reason is start-cache.php is being used multiple times in a page - that's how we start the cache - but we should define a constant once
	// This path is really important - use it correctly
	
	if(!defined('CACHE_PATH')){
            define('CACHE_PATH', SERVER_CACHE_PATH."/siteCache/");
        }
	// for me at the localhost wamp - the path was as below
	//	define('CACHE_PATH', $_SERVER["DOCUMENT_ROOT"]."/codecanyon/updating/phpMetamericCache/siteCache/");
	
	// cache file name
	$cachefile = CACHE_PATH . "cache_" . $filename;
	// check if custom time is not already set for requested section to cache
	// if not, set a default time - cache validity time - 12 hours
	if(!isset($cachetime)) { $cachetime = 12 * 3600; }

	// echo time validity for individual cache
	// $cachetimee= $cachetime/3600; echo "<span class='muted'>This part of cache will expire after $cachetimee hours of its creation unless its deleted manually.</span> <br>";

	// Serve from the cache if it is not old than specified cachetime and if it exists
	if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile)))
	{
		include($cachefile);
		// if its cached - cached data will show - otherwise actual script or data will be executed
		$cached="yes";
	}
	// if not in cache - start buffer and create cached file
	else { ob_start(); }
}
?>