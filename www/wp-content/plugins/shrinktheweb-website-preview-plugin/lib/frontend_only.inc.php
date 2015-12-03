<?php


/**
 * Shortcode to show the thumbnail for a website.
 * 
 * Example with link for thumbnail: 
 * [stwthumb link="true"]http://www.shrinktheweb.com[/stwthumb]
 * 
 * Example with just thumbnail:
 * [stwthumb]http://www.wpdoctors.co.uk[/stwthumb]
 * 
 */
function STWWT_shortcode_showThumbnail($atts, $content) 
{
	extract( shortcode_atts( array(
		'size' 			=> '',
		'link'			=> '',	
		'full_length'	=> ''
	), $atts ) );

	
	
	
	// If link="true" appears in the shortcode, then add the link too.
	$showLink = false;
	if ($link == 'true') {
		$showLink = true;
	}
	
	
	// Check for a full length parameter. Completely ignore the parameter
	// if we don't have access to that parameter. 
	$showFullLength = false;
	if ($full_length && STWWT_account_featuredAllowed('embedded_pro_full_length'))
	{
		 $full_length = strtolower($full_length);
		 if ($full_length == 'true') {
		 	$showFullLength = 'full';
		 } else {
		 	$showFullLength = 'normal'; // Allows for situation where user does not want a full length
		 }
	}
	
	return STWWT_thumbnail_createThumbnail($content, $showLink, $size, $showFullLength);
}





?>