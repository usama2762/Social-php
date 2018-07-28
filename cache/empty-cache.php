<?php 
//Delete All files from cache folder
// absolute path of files
$files = glob(SERVER_CACHE_PATH."/siteCache/");
foreach($files as $file)
	{
	if(is_file($file))
	unlink($file);
	} 
?>