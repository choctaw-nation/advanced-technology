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

						// Check value exists.
						if ( have_rows( 'content' ) ) :

							// Loop through rows.
							while ( have_rows( 'content' ) ) :
								the_row();

								// Case: Content layout.
								if ( get_row_layout() == 'text_content' ) :
									$content = get_sub_field( 'content' );
									echo $content;

									// Case: Image layout.
								elseif ( get_row_layout() == 'image_content' ) :
									$title = get_sub_field( 'title' );
									$image = get_sub_field( 'image' );
									echo '<h2>' . $title . '</h2>';
									echo wp_get_attachment_image( $image, 'full', '', array( 'class' => 'mb-3' ) );

									// Case: Image layout.
								elseif ( get_row_layout() == 'video_content' ) :
									$title = get_sub_field( 'title' );
									$video = get_sub_field( 'video' );
									echo '<h2>' . $title . '</h2>';
									echo '<div class="embed-container mb-3">';
									echo $video;
									echo '</div>';

								endif;
							endwhile;
						endif;
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