<?php
/**
 * Theme Functions
 *
 * @package ChoctawNation
 */

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


/**
 * Adds dnt parameter to Vimeo oEmbed
 *
 * @param string $provider The provider URL.
 */
function dl_oembed( $provider ) {
	if ( strpos( $provider, 'vimeo.com' ) !== false ) {
		return add_query_arg( array( 'dnt' => false ), $provider );
	}
}
add_filter( 'oembed_fetch_url', 'dl_oembed', 10, 3 );