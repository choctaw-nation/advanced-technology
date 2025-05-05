<?php
/**
 * The template for displaying search results pages
 *
 * @package ChoctawNation
 */

get_header();
if ( is_search() ) {
	wp_safe_redirect( home_url( '/' ) );
	exit;
}
