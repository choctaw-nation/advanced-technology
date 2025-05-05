<?php
/**
 * The template for displaying search results pages
 *
 * @package ChoctawNation
 */

get_header();
?>

<?php
if ( is_search() ) {
	wp_redirect( home_url( '/' ) );
	die;
}
