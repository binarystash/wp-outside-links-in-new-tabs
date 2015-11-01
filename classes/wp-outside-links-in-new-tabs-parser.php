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
		$doc->loadXML("<div>".(htmLawed($content))."</div>");
		$links = $doc->getElementsByTagName('a');
		
		$blogurl = get_bloginfo("url");
		$components = parse_url( $blogurl );
		$host = $components["host"];
		
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

		return $doc->saveXML();
		
	}
	
}