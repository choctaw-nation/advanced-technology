<?php
/**
 * The template for displaying archive news page
 *
 * @package ChoctawNation
 * @since 2.0
 */

if ( ! have_posts() ) {
	return;
}
$is_even_index = true;
?>
<ul class="container list-unstyled d-flex flex-column align-items-stretch row-gap-5 mb-5">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
	<li class="row row-gap-4 position-relative align-items-stretch my-4" data-aos="<?php echo $is_even_index ? 'zoom-out-left' : 'zoom-out-right'; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="col-lg-5">
			<figure class="mb-0 ratio ratio-4x3">
				<?php
				the_post_thumbnail(
					'news-thumb',
					array(
						'class'   => 'object-fit-cover h-100 w-100',
						'loading' => 'lazy',
					)
				);
				?>
			</figure>
		</div>
		<?php endif; ?>
		<div class="col d-flex flex-column">
			<?php the_title( '<h2 class="text-transform-none">', '</h2>' ); ?>
			<p class="text-body">
				<?php the_field( 'archive_content' ); ?>
			</p>
			<a class="read-more btn btn-primary btn-lg mt-auto align-self-start stretched-link" href="<?php the_permalink(); ?>">Read More</a>
		</div>
	</li>
		<?php $is_even_index = ! $is_even_index; ?>
	<?php endwhile; ?>
</ul>