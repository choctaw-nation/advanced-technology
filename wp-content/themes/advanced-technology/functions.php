<?php
/**
 * Theme Functions
 *
 * @package ChoctawNation
 */

use ChoctawNation\Plugins\Plugin_Handler;
use ChoctawNation\Theme\Theme_Init;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( file_exists( ABSPATH . 'vendor/autoload.php' ) ) {
	require ABSPATH . 'vendor/autoload.php';
}

/** Get the theme init class */
new Theme_Init( 'commerce' );

/** Init Plugins */
new Plugin_Handler();

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