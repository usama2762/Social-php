<?php
define('SERVER_CACHE_PATH', getcwd()."/cache/");

/**
 * get files and data with cache 
 * @param type $page
 */
function get($page){
    $filename = $page;
    if(!in_array($page, array("coupons"))){
        include(SERVER_CACHE_PATH."delete-single.php");
    }
    //fix static files
    $cachefile = getcwd() . "/$page-body.php";
    if(file_exists($cachefile)) {
       $cachetime = 24 * 3600; //24 hours
       include(SERVER_CACHE_PATH."start-cache.php");
       if( !isset($cached) || $cached != 'yes' ) {
            require(getcwd() . "/$page-body.php");
       }
       include(SERVER_CACHE_PATH."end-cache.php"); 
    }else{
        readfile(getcwd() . "/$page.html");
    }
}

function getOld($page) {
	ob_start('ob_gzhandler');
	$cachefile = getcwd() . "/$page.html";
	if(file_exists($cachefile)) {
		echo "<!--cached-->";
		readfile($cachefile);
	} else {
		generate($cachefile, getcwd() . "/$page-body.php");
	}
	ob_end_flush();
}

function generate($cachefile, $controller) {
	require($controller);
	$fp = fopen($cachefile, 'w');
	fwrite($fp, ob_get_contents());
	fclose($fp);
}
?>
