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
<div class="container">
	<div class="row justify-content-center row-cols-lg-2 row-cols-xl-3 mb-5 ">
		<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div class="mb-4 staff-archive position-relative" data-aos="<?php echo $is_even_index ? 'zoom-out-left' : 'zoom-out-right'; ?>">
			<?php if ( has_post_thumbnail() ) : ?>
			<?php
				the_post_thumbnail(
					'staff-archive-thumb',
					array(
						'class'   => 'mb-3 object-fit-cover',
						'loading' => 'lazy',
						'height'  => '400',
					)
				);
				?>
			<?php endif; ?>
			<div class="col">
				<?php the_title( '<h2 class="text-transform-none news-content-preview">', '</h2>' ); ?>
				<p class="text-body mb-3">
					<?php the_field( 'archive_content' ); ?>
				</p>
				<a class="read-more btn btn-primary btn-lg text-light mt-auto stretched-link" href="<?php the_permalink(); ?>">Read Full Bio</a>
			</div>
		</div>
		<?php $is_even_index = ! $is_even_index; ?>
		<?php endwhile; ?>
	</div>
</div>