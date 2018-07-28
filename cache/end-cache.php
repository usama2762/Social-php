<?php
if($_SERVER["REQUEST_METHOD"] != 'POST')
{
	if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) { }
	else
	{
	// open the cache file for writing
        $cachefile = str_replace("\\", "/", $cachefile);    
	$fp = fopen($cachefile, 'w');
	// save the contents of output buffer to the file
	fwrite($fp, ob_get_contents());
	// close the file
	fclose($fp);
	// Send the output to the browser
	ob_end_flush();
	}

	// set the default time again
	$cachetime = 12 * 3600;
	// set the cached to no - required - otherwise if you delete single cached page it will not be cached again
	$cached="no";

}
?>