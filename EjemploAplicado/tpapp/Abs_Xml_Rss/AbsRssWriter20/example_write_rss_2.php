<?php
	include "class.AbsRssWriter20.php";


	$xml = new AbsRssWriter20();


	// START DOCUMENT
	$xml->StartDocument('xsl_stylesheet.xsl');


	// ADD NAMESPACES
	$ns = array(
		 'slash' => 'http://purl.org/rss/1.0/modules/slash/'
		,'content' => 'http://purl.org/rss/1.0/modules/content/'
		,'wfw' => 'http://wellformedweb.org/CommentAPI/'
		,'dc' => 'http://purl.org/dc/elements/1.1/'
	);
	$xml->AddNamespaces($ns);


	// ADD CHANNEL TAGS
	$channelTags = array(
		 'title' => 'Latest entries on: Blog Name Here'
		,'link' => 'http://blog-url-here/'
		,'description' => "Coding is fun!"
		,'pubDate' => 'Mon, 10 Apr 2009 22:00:40'
		,'generator' => 'Blog Name Here'
		,'language' => 'en-us'
		,'dc:publisher' => 'Costin Trifan'
		,'copyright' => 'Copyright (c) 2008 Costin Trifan. All rights reserved. blah blah..'
	);
	$xml->AddChannelTags($channelTags);


	// ADD ENTRIES // A bidimensional array is required!
	$itemTags = array(
		array(
			 'title' => 'Post 1'
			,'link' => 'http://blog-url-here/post.php?pid=11'
			,'description' => "<![CDATA[Posts's short description goes here]]>"
			,'slash:comments' => 40
			,'comments' => 'http://blog-name-here/post.php?pid=11#comments'
			,'pubDate' => 'Sun, 12 Apr 2009 02:01:52 GMT'
			,'category' => 'PHP'
		),
		array(
			 'title' => 'Post 2'
			,'link' => 'http://blog-url-here/post.php?pid=10'
			,'description' => "<![CDATA[Posts's short description goes here]]>"
			,'slash:comments' => 120
			,'comments' => 'http://blog-name-here/post.php?pid=10#comments'
			,'pubDate' => 'Sun, 11 Apr 2009 02:01:52 GMT'
			,'category' => 'WEB'
		)
	);
	$xml->AddItems($itemTags);


	// END DOCUMENT
	$xml->EndDocument();


	// SAVE THE FEED'S CONTENT INTO AN XML FILE
	$dir = getcwd().DIRECTORY_SEPARATOR.'xml'.DIRECTORY_SEPARATOR;
	$xml->SaveDocument($dir,'rss_2.xml');

?>