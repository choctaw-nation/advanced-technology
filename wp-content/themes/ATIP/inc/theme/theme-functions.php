<?php
/**
 * Theme Functions
 */

// Add <link rel=preload> to Fontawesome
add_filter( 'style_loader_tag', 'cno_style_loader_tag' );
/** Add `rel='preload' to fontawesome css
 *
 * @param string $tag The link tag for the enqueued style.
 */
function cno_style_loader_tag( $tag ) {
	$tag = preg_replace( "/id='font-awesome-css'/", "id='font-awesome-css' online=\"if(media!='all')media='all'\"", $tag );

	return $tag;
}
// Add <link rel=preload> to Fontawesome End

/**
 * Move Yoast to bottom
 */
function move_yoast_to_bottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'move_yoast_to_bottom' );

/**
 *  Limit the number of sitemap entries for Yoast SEO
 */
function max_entries_per_sitemap() {
	return 200;
}

add_filter( 'wpseo_sitemap_entries_per_page', 'max_entries_per_sitemap' );
