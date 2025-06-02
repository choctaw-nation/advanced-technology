<?php
/**
 * The template for displaying all pages
 *
 * @package ChoctawNation
 */

get_header();
?>

<div id="content" class="site-content container my-5">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
			the_post_thumbnail(
				'full',
				array(
					'class'           => 'w-100 h-auto object-fit-cover mb-3',
					'loading'         => 'eager',
					'data-spai-eager' => 'true',
				)
			);
			the_title( '<h1>', '</h1>' );
			the_field( 'page_content' );
			if ( have_rows( 'content' ) ) {
				while ( have_rows( 'content' ) ) {
					the_row();
					echo '<section>';
					if ( 'text_content' === get_row_layout() ) {
						$content = get_sub_field( 'content' );
						echo $content;
					} else {
							echo '<h2>' . esc_textarea( get_sub_field( 'title' ) ) . '</h2>';
						if ( 'image_content' === get_row_layout() ) {
							$image = get_sub_field( 'image' );
							echo wp_get_attachment_image( $image, 'full', '', array( 'class' => 'mb-3' ) );
						} elseif ( 'video_content' === get_row_layout() ) {
							$video = get_sub_field( 'video' );
							echo '<div class="ratio ratio-16x9 mb-3">';
							echo $video;
							echo '</div>';
						}
					}
					echo '</section>';
				}
			}
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->

<?php
get_footer();
