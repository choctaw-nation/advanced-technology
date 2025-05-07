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

/**
 * Takes raw ACF field (vimeo only) URL and converts it to `<lite-vimeo>` web component.
 * (Pass `false` as 3rd parameter in `get_field` to return raw url string.)
 * Returns web component or `false` if video is unlisted.
 *
 * @param string $url the Vimeo URL
 * @return string|false the web component or false
 */
function cno_extract_vimeo_id( ?string $url ): string|false {
	if ( empty( $url ) ) {
		return false;
	}
	$vimeo_id = str_replace( 'https://vimeo.com/', '', $url );
	$ids      = explode( '/', $vimeo_id );
	if ( count( $ids ) !== 1 ) {
		return false;
	} else {
		return "<lite-vimeo videoid='{$vimeo_id}' enableTracking></lite-vimeo>";
	}
}