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
	<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 justify-content-center align-items-stretch mb-5 row-gap-4">
		<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div class="col d-flex flex-column align-items-stretch position-relative" data-aos="<?php echo $is_even_index ? 'zoom-out-left' : 'zoom-out-right'; ?>">
			<?php if ( has_post_thumbnail() ) : ?>
			<figure class="mb-2 ratio ratio-16x9">
				<?php
				the_post_thumbnail(
					'staff-archive-thumb',
					array(
						'class'   => 'object-fit-cover h-100 w-100',
						'loading' => 'lazy',
					)
				);
				?>
			</figure>
			<?php endif; ?>
			<?php the_title( '<h2 class="text-decoration-none text-transform-none">', '</h2>' ); ?>
			<p>
				<?php the_field( 'archive_content' ); ?>
			</p>
			<a class="btn btn-primary btn-lg mt-auto align-self-start stretched-link" href="<?php the_permalink(); ?>">Read Full Bio</a>
		</div>
		<?php $is_even_index = ! $is_even_index; ?>
		<?php endwhile; ?>
	</div>
</div>