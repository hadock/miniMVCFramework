<?php
	# No cache headers
	header("Expires: Mon, 05 June 2001 05:06:07 GMT");
  	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
    header('Cache-Control: pre-check=0, post-check=0, max-age=0');
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

	include_once "class.AbsAtomWriter10.php";


	$xml = new AbsAtomWriter10();


	// START DOCUMENT
	$xml->StartDocument();

	// ADD NAMESPACES
	$xml->AddNamespaces(); // could be empty, but the function call is required to close the feed tag !

	// ADD BASE TAGS
	$xml->AddBaseTags('June Framework Blog', 'Latest entries on: June Framework Blog',
					  	'http://june-js.com/blog/', 'self', 'Mon, 20 Apr 2009 22:00:40', 'Costin Trifan');


	// ADD ENTRIES
	$c1 = "Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis
doloribus asperiores repellat";
	$c2 = "Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis
doloribus asperiores repellat";
	$xml->AddEntry('AbsTemplate - A simple PHP Template Engine', 'http://june-js.com/blog/post.php?pid=11', 'Sun, 12 Apr 2009 02:01:52 GMT', $c1);
	$xml->AddEntry('XLog - A Log class for PHP', 'http://june-js.com/blog/post.php?pid=10', 'Wed, 18 Mar 2009 14:05:29', $c2);


	// END DOCUMENT
	$xml->EndDocument();

	// SAVE THE FEED'S CONTENT INTO AN XML FILE
	$dir = getcwd().DIRECTORY_SEPARATOR.'xml'.DIRECTORY_SEPARATOR;
	$xml->SaveDocument($dir,'atom_1.xml');

?>