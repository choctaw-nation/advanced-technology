<?php
/**
 * The template for displaying all pages
 *
 * @package ChoctawNation
 */

get_header();
$page_content = get_field( 'page_content' );
?>

<div id="content" class="site-content container py-5 mt-5">
	<div id="primary" class="content-area">
		<div class="row">
			<div class="col-12">
				<main id="main" class="site-main">
					<div class="entry-content">
						<!-- Featured Image -->
						<?php the_post_thumbnail(); ?>
						<!-- Title -->
						<?php the_title( '<h1>', '</h1>' ); ?>
						<!-- Content -->
						<?php echo $page_content; ?>
						<?php
						if ( have_rows( 'content' ) ) {
							while ( have_rows( 'content' ) ) {
								the_row();
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
										echo '<div class="embed-container mb-3">';
										echo $video;
										echo '</div>';
									}
								}
							}
						}
						?>
						<!-- .entry-content -->
					</div>

				</main><!-- #main -->

			</div><!-- col -->
		</div><!-- row -->

	</div><!-- #primary -->
</div><!-- #content -->

<?php
get_footer();