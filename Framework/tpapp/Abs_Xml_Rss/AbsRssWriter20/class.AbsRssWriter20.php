<?php
/**
* class AbsRssWriter20
*
* Create an RSS 2.0 xml feed.
*
* @package    Abs_Xml_Rss
* @category   XML, RSS
* @author     Costin Trifan <costintrifan@yahoo.com>
* @copyright  2009 Costin Trifan
* @licence    http://en.wikipedia.org/wiki/MIT_License   MIT License
* @version    1.0
* 
* Copyright (c) 2009 Costin Trifan <http://june-js.com/>
* 
* Permission is hereby granted, free of charge, to any person
* obtaining a copy of this software and associated documentation
* files (the "Software"), to deal in the Software without
* restriction, including without limitation the rights to use,
* copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the
* Software is furnished to do so, subject to the following
* conditions:
* 
* The above copyright notice and this permission notice shall be
* included in all copies or substantial portions of the Software.
* 
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
* OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
* HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
* WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
* OTHER DEALINGS IN THE SOFTWARE.
*/
class AbsRssWriter20
{
	private function __clone(){}

	// Constructor
	public function __construct(){}


	/**
	* Holds the feed's content
	* @type string
	*/
	protected static $_doc = '';



	/**
	* Start the xml document
	*
	* @param string $xmlStylesheetFile  The path to the associated xml stylesheet file.
	* @return void
	*/
	final public function StartDocument( $xmlStylesheetFile = '' )
	{
		self::$_doc = '<?xml version="1.0" encoding="utf-8"?>';

		if (strlen($xmlStylesheetFile) > 0)
			self::$_doc .= '<?xml-stylesheet type="text/xsl" href="../'.$xmlStylesheetFile.'"?>';

		self::$_doc .= '<rss version="2.0"'."\n\t";
	}

	/**
	* Add xml namespaces
	*
	* @param array $xmlns  The list of namespaces to add to the document. (As an associative array: 'namespace-name' => 'namespace url')
	* @return void
	*/
	final public function AddNamespaces( $xmlns = array() )
	{
		if (count($xmlns) < 1) {
			self::$_doc .= '>'; // close tag
			return;
		}

		foreach ($xmlns as $name=>$value)
			self::$_doc .= " xmlns:$name=\"$value\"\n\t";

		self::$_doc .= '>'; // close tag
	}

	/**
	* Add channel's tags
	* @return void
	*/
	final public function AddChannelTags( array $channelTags )
	{
		self::$_doc .= "<channel>\n";
		if (count($channelTags) > 0)
		{
			foreach ($channelTags as $tagName=>$tagValue)
				self::$_doc .= "<$tagName>$tagValue</$tagName>\n";
		}
	}

	/**
	* Add channel items
	* @return void
	*/
	final public function AddItems( $itemTags = array() )
	{
		if (count($itemTags) > 0)
		{
			foreach ($itemTags as $entries)
			{
				self::$_doc .= "<item>";

				foreach ($entries as $tagName=>$tagValue)
					self::$_doc .= "<$tagName>$tagValue</$tagName>";

				self::$_doc .= "</item>\n";
			}
		}
	}

	/**
	* Write the xml document's closing tags
	* @return void
	*/
	final public function EndDocument()
	{
		self::$_doc .= '</channel></rss>';
	}

	/**
	* Display the feed's content
	* @return void
	*/
	final public function Display()
	{
		echo self::$_doc;
	}

	/**
	* Retrieve the document's content
	* @return string
	*/
	final public function GetDocument()
	{
		return self::$_doc;
	}

	/**
	* Save the generated xml document
	* @return void
	*/
	final public function SaveDocument( $dirPath, $fileName )
	{
		if ( ! @is_dir($dirPath))
		{
			// try to create the directory
			if ( ! @mkdir($dirPath))
				exit("The directory where to store the rss file was not found nor be created. Please create it manually.");
		}

		$filePath = $dirPath.DIRECTORY_SEPARATOR.$fileName;

		$content = self::GetDocument();

		if (($h = @fopen ($filePath, "w")) !== FALSE)
		{
			@fwrite ($h, $content, strlen($content));
			@fclose ($h);
		}
		else exit("Error: The rss file could not be saved into the specified location.");
	}

}
// >> END
?>