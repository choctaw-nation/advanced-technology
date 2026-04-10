<?php
/**
 * Theme Functions
 *
 * @package ChoctawNation
 */

use ChoctawNation\Theme\Theme_Init;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$autoload_path = get_stylesheet_directory() . '/vendor/autoload.php';
if ( file_exists( $autoload_path ) ) {
	require $autoload_path;
} else {
	wp_die(
		'Autoload file not found. Please run composer install inside the theme directory.',
		'Error',
		'ATI Theme Error',
		array( 'response' => 500 )
	);
}

/** Get the theme init class */
$theme = new Theme_Init( 'commerce' );
add_action( 'after_setup_theme', array( $theme, 'setup_theme' ) );
