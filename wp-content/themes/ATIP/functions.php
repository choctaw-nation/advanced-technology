<?php
/**
 * Theme Functions
 */

use ChoctawNation\CNO_Theme_Init;

/** Get the theme init class */
require_once get_template_directory() . '/inc/theme/class-cno-theme-init.php';
$init_theme = new CNO_Theme_Init();


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