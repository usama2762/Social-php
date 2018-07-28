<?php
function fetchData($sheet) {
	$raw = file_get_contents("https://docs.google.com/spreadsheets/d/13LOyZC3pOQwTRKsrkkRMsOlMGZTlfcPNah5qsUsN8V0/gviz/tq?tqx=out:json&sheet=$sheet");
//	$raw = file_get_contents("data/$sheet.json");
	$start = strpos($raw, "(");
	if($start == FALSE) {
		echo "An error occurred while fetching data.";
		return;
	}
	$start++;
	$raw = substr($raw, $start, strrpos($raw, ")") - $start);
	return json_decode($raw);
}

function cell($row, $index) {
	if($row->c[$index])
		echo $row->c[$index]->v;
}
function KUBAhub($row, $index) {
	if($row->c[$index])
		return $row->c[$index]->v;
}
?>

