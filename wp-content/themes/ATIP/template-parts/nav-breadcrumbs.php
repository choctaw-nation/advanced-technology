<?php
/**
 * Breadcrumbs for the News and Staff post types
 *
 * @package ChoctawNation
 */

$breadcrumbs = array(
	'Advanced Technology Initiatives'                     => esc_url( home_url() ),
	get_post_type_object( get_post_type() )->labels->name => get_post_type_archive_link( get_post_type() ),
	get_the_title()                                       => null,
);

$breadcrumb_links = array_map(
	function ( $name, $link ) {
		if ( is_null( $link ) ) {
			return '<li class="breadcrumb-item active fs-6" aria-current="page">' . esc_html( $name ) . '</li>';
		} else {
			return '<li class="breadcrumb-item"><a href="' . esc_url( $link ) . '" class="breadcrumb-item text-decoration-none fs-6">' . esc_html( $name ) . '</a></li>';

		}
	},
	array_keys( $breadcrumbs ),
	array_values( $breadcrumbs )
);
?>

<nav aria-label="breadcrumb" class="mb-2">
	<ol class="breadcrumb m-0 column-gap-2 align-items-baseline" style="--bs-breadcrumb-divider: ''">
		<?php echo implode( '<i class="fas fa-caret-right" aria-hidden="true"></i>', $breadcrumb_links ); ?>
	</ol>
</nav>
