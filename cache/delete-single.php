<?php
if(!defined('CACHE_PATH')){
    define('CACHE_PATH', SERVER_CACHE_PATH."/siteCache/");
}
// cache file name
$cachefile = CACHE_PATH . "cache_" . $filename;
if(file_exists($cachefile)) { @unlink($cachefile); }
?>