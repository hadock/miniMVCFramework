<?php
	# No cache headers
	header("Expires: Mon, 05 June 2001 05:06:07 GMT");
  	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
    header('Cache-Control: pre-check=0, post-check=0, max-age=0');
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

	include_once "class.AbsAtomReader10.php";


	$xml = new AbsAtomReader10();
	$xml->Load('xml/atom_1.xml');
//	$xml->Load('http://weblogs.asp.net/scottgu/atom.aspx');


	// Get Base Tags
	$baseTags = $xml->GetBaseTags();
	if (is_array($baseTags) and count($baseTags)>0)
	{
		echo '<pre>';
		echo '<strong>Get Base Tags</strong><hr size="1" />';
		print_r($baseTags);
		echo '</pre>';
	}

echo '<p><br/></p>';

	// Get All Entries
	$entries = $xml->GetEntries();
	if (is_array($entries) and count($entries)>0)
	{
		echo '<pre>';
		echo '<strong>Get all entries</strong><hr size="1" />';
		print_r($entries);
		echo '</pre>';
	}


echo '<p><br/></p>';

	// Get ALL
	$all = $xml->GetAll();
	if (is_array($all) and count($all)>0)
	{
		echo '<pre>';
		echo '<strong>Get all tags</strong><hr size="1" />';
		print_r($all);
		echo '</pre>';
	}

?>