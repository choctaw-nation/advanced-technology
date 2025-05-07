<?php
/**
 * The template for displaying archive staff page
 *
 * @package ChoctawNation
 */

if ( ! have_posts() ) {
	return;
}
$is_even_index = true; ?>
<section class="container">
	<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 justify-content-center align-items-stretch row-gap-4 mb-5">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
		<div class="col d-flex flex-column align-items-stretch position-relative" data-aos="<?php echo $is_even_index ? 'zoom-out-left' : 'zoom-out-right'; ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail(
					'staff-archive-thumb',
					array(
						'class'   => 'mb-2 object-fit-cover',
						'loading' => 'lazy',
						'height'  => '400',
					)
				);
			}
			?>
			<div class="d-flex flex-column flex-grow-1">
				<?php the_title( '<h2 class="text-transform-none news-content-preview">', '</h2>' ); ?>
				<p><?php the_field( 'archive_content' ); ?></p>
				<a class="btn btn-primary btn-lg text-light mt-auto stretched-link align-self-start" href="<?php the_permalink(); ?>">Read Full Bio</a>
			</div>
		</div>
			<?php $is_even_index = ! $is_even_index; ?>
		<?php endwhile; ?>
	</div>
</section>
