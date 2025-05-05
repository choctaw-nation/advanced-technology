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
 *
 * @param string $html The HTML markup for the stylesheet link tag.
 * @param string $handle The handle of the stylesheet.
 * @param string $href The URL of the stylesheet.
 * @param string $media The media attribute of the stylesheet.
 */
function preload_for_css( $html, $handle, $href, $media ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
	if ( is_admin() ) {
		return $html;
	}
	echo '<link rel="stylesheet preload" as="style" href="' . $href . '" media="all" lazyload>'; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet
}

add_filter( 'style_loader_tag', 'preload_for_css', 10, 4 );
