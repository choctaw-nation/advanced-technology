<?php

/**
 * Image size functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bootscore
 */

add_action( 'after_setup_theme', 'register_image_sizes' );
function register_image_sizes() {
	add_image_size( 'home-block', 720, 1200, false );
	add_image_size( 'news-thumb', 696, 392, true ); // (cropped)
	add_image_size( 'staff-archive-thumb', 1200, 400, false );
	add_image_size( 'staff-single-thumb', 1200, 500, false );
	add_image_size( 'gallery-thumbnail', 516, 920, false );
}

?>