<?php
/**
 * Preload functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ChoctawNation
 */

/**
 * Add preload to css
 *
 * @link https://developer.wordpress.org/reference/hooks/style_loader_tag/
 * @param string $html The HTML markup for the stylesheet.
 * @param string $handle The stylesheet handle.
 * @param string $href The stylesheet URL.
 * @param string $media The media attribute for the stylesheet.
 * @return string The modified HTML markup for the stylesheet.
 */
function preload_for_css( $html, $handle, $href, $media ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
	if ( is_admin() ) {
		return $html;
	}

	echo '<link rel="stylesheet preload" as="style" href="' . $href . '" media="all" lazyload>'; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet
}

add_filter( 'style_loader_tag', 'preload_for_css', 10, 4 );
