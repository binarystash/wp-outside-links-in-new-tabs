<?php

class WP_Outside_Links_In_New_Tabs_Parser {
	
	/*
	 * Sets target attribute of external links to '_blank'
	 * @param string $content - content to be parsed
	 *
	 * @return string
	 */
	function parse($content) {
		
		$doc = new DOMDocument();
		$doc->loadHTML("<div>".$content."</div>");
		$links = $doc->getElementsByTagName('a');
		
		$blogurl = get_bloginfo("url");
		$components = parse_url( $blogurl );
		$host = $components["host"];
		
		/* Set target attribute of all external links to "_blank" */
		
		foreach( $links as $link ) {

			$href = $link->getAttribute("href");
			$components = parse_url( $href );

			if( !isset( $components["host"] ) ) {
				continue;
			}

			if ( $components["host"] != $host ) {
				$link->setAttribute("target","_blank");
			}

		}
		
		/*
		 * Extract the HTML fragment.
		 * Credits: http://stackoverflow.com/questions/29493678/loadhtml-libxml-html-noimplied-on-an-html-fragment-generates-incorrect-tags
		 */
		
		$temporary_wrapper = $doc->getElementsByTagName('div')->item(0);
		$temporary_wrapper = $temporary_wrapper->parentNode->removeChild($temporary_wrapper);
		
		while ($doc->firstChild) {
			$doc->removeChild($doc->firstChild);
		}

		while ($temporary_wrapper->firstChild ) {
			$doc->appendChild($temporary_wrapper->firstChild);
		}
		
		/* Return HTML */
		
		return $doc->saveHTML();
		
	}
	
}