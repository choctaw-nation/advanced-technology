<?php
/**
 * Template Name: Gallery
 *
 * @package ChoctawNation
 */

wp_enqueue_script( 'gallery' );
get_header();


$intro_paragraph = get_field( 'intro_paragraph' );
$images          = get_field( 'images' );
?>

<div id="content" class="site-content container-fluid py-5 mt-5">
	<div id="primary" class="content-area">
		<main id="main" class="site-main container">
			<header class="entry-header">
				<?php
				the_title( '<h1>', '</h1>' );
				echo $intro_paragraph;
				?>
			</header>
			<?php $images = get_field( 'images' ); ?>
			<?php if ( $images ) : ?>
			<h2 class="mt-5">Images</h2>
			<div class="row mt-4" data-masonry='{"percentPosition": true }'>
				<?php
				foreach ( $images as $image ) {
					$gallery_content  = '<div class="col-md-6 col-xl-4 mb-4">';
					$gallery_content .= wp_get_attachment_image( $image['ID'], 'gallery-thumbnail' );
					$gallery_content .= '</a>';
					$gallery_content .= '</div>';
					echo $gallery_content;
				}
				?>
			</div>
			<?php endif; ?>

			<?php if ( have_rows( 'videos' ) ) : ?>
			<h2 class="mt-5">Videos</h2>
			<div class="row mt-4" data-masonry='{"percentPosition": true }'>
				<?php while ( have_rows( 'videos' ) ) : ?>
					<?php the_row(); ?>
					<?php $video = get_sub_field( 'video' ); ?>
				<div class="col-md-6 mb-4">
					<div class="embed-container">
						<?php echo $video; ?>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();
