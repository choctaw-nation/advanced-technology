<?php
/**
 * The template for displaying all pages
 *
 * @package ChoctawNation
 */

get_header();
?>

<div id="content" class="site-content container py-5 mt-5">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="entry-content">
				<?php
				the_post_thumbnail();
				the_title( '<h1>', '</h1>' );
				the_field( 'page_content' );
				if ( have_rows( 'content' ) ) {
					while ( have_rows( 'content' ) ) {
						the_row();
						if ( 'text_content' === get_row_layout() ) {
							the_sub_field( 'content' );
						} else {
							echo '<h2>' . esc_textarea( get_sub_field( 'title' ) ) . '</h2>';
							if ( 'image_content' === get_row_layout() ) {
								echo wp_get_attachment_image(
									get_sub_field( 'image' ),
									'full',
									'',
									array( 'class' => 'mb-3' )
								);
							} elseif ( 'video_content' === get_row_layout() ) {
								echo '<div class="ratio ratio-16x9 mb-3">' . get_sub_field( 'video' ) . '</div>';
							}
						}
					}
				}
				?>
			</div>
		</main>
	</div>
</div>
<?php
get_footer();
