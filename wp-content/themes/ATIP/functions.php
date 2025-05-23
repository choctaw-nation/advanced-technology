<?php
/**
 * Theme Functions
 */

// Load Bootscore Functions
require_once get_template_directory() . '/inc/bootscore/bootscore-functions.php';

/** Get the theme init class */
require_once get_template_directory() . '/inc/theme/class-cno-theme-init.php';
$init_theme = new CNO_Theme_Init();



function dl_oembed( $provider, $url, $args ) {
	if ( strpos( $provider, 'vimeo.com' ) !== false ) {
		return add_query_arg( array( 'dnt' => false ), $provider );
	}
}
add_filter( 'oembed_fetch_url', 'dl_oembed', 10, 3 );
