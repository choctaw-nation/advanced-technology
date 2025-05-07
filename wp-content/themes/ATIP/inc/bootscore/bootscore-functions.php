<?php // phpcs:ignoreFile
/**
 * Bootscore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bootscore
 */

// Pagination Categories
function bootscore_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;
	global $paged;
	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;

		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo '<nav aria-label="Page navigation" role="navigation">';
		echo '<span class="sr-only">Page navigation</span>';
		echo '<ul class="pagination justify-content-center ft-wpbs mb-4">';

		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( 1 ) . '" aria-label="First Page">&laquo;</a></li>';
		}

		if ( $paged > 1 && $showitems < $pages ) {
			echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $paged - 1 ) . '" aria-label="Previous Page">&lsaquo;</a></li>';
		}

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? '<li class="page-item active"><span class="page-link"><span class="sr-only">Current Page </span>' . $i . '</span></li>' : '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $i ) . '"><span class="sr-only">Page </span>' . $i . '</a></li>';
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $paged + 1 ) . '" aria-label="Next Page">&rsaquo;</a></li>';
		}

		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $pages ) . '" aria-label="Last Page">&raquo;</a></li>';
		}

		echo '</ul>';
		echo '</nav>';
	}
}
// Pagination Categories End


// Pagination Buttons Single Posts
add_filter( 'next_post_link', 'post_link_attributes' );
add_filter( 'previous_post_link', 'post_link_attributes' );

function post_link_attributes( $output ) {
	$code = 'class="page-link"';
	return str_replace( '<a href=', '<a ' . $code . ' href=', $output );
}
// Pagination Buttons Single Posts End