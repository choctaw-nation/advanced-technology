<?php

/**
 * Preload functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bootscore
 */

/**
 * Add preload to css
 */
function preload_for_css( $html, $handle, $href, $media ) {

	if ( is_admin() ) {
		return $html;
	}

	echo '<link rel="stylesheet preload" as="style" href="' . $href . '" media="all" lazyload>';
}

add_filter( 'style_loader_tag', 'preload_for_css', 10, 4 );
