<?php
/**
 * Template Name: Gallery
 *
 * @package ChoctawNation
 */

wp_enqueue_script( 'gallery' );
get_header();
?>

<div id="content" class="site-content my-5">
	<div id="primary" class="content-area">
		<main id="main" class="site-main container">
			<header class="entry-header">
				<?php
				the_title( '<h1>', '</h1>' );
				the_field( 'intro_paragraph' );
				?>
			</header>
			<?php $images = get_field( 'images' ); ?>
			<?php if ( $images ) : ?>
			<section class="mt-5">
				<h2>Images</h2>
				<div class="row mt-4" data-masonry='{"percentPosition": true }'>
					<?php foreach ( $images as $image ) : ?>
					<div class="col-md-6 col-xl-4 mb-4">
						<?php
						echo wp_get_attachment_image(
							$image['ID'],
							'gallery-thumbnail',
							false,
							array(
								'class'   => 'object-fit-contain w-100 h-100',
								'loading' => 'lazy',
							)
						);
						?>
					</div>
					<?php endforeach; ?>
				</div>
			</section>
			<?php endif; ?>

			<?php if ( have_rows( 'videos' ) ) : ?>
			<section class="mt-5">
				<h2 class="mt-5">Videos</h2>
				<div class="row mt-4" data-masonry='{"percentPosition": true }'>
					<?php while ( have_rows( 'videos' ) ) : ?>
					<?php the_row(); ?>
					<div class="col-md-6 mb-4">
						<div class="ratio ratio-16x9">
							<?php the_sub_field( 'video' ); ?>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</section>
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();