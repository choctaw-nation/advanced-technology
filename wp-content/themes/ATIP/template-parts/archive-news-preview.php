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
<ul class="container list-unstyled d-flex flex-column row-gap-5 align-items-stretch mb-5" style="padding-left:calc(var(--bs-gutter-x)*.5);">
	<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<li class="row position-relative row-gap-4 align-items-stretch" data-aos="<?php echo $is_even_index ? 'zoom-out-left' : 'zoom-out-right'; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="col-lg-5">
			<?php
				the_post_thumbnail(
					'news-thumb',
					array(
						'class'   => 'mb-2 object-fit-cover w-100 h-auto',
						'loading' => 'lazy',
					)
				);
			?>
		</div>
		<?php endif; ?>
		<div class="col d-flex flex-column align-items-stretch">
			<?php the_title( '<h2 class="text-transform-none">', '</h2>' ); ?>
			<p class="text-body mb-3">
				<?php the_field( 'archive_content' ); ?>
			</p>
			<a class="btn btn-primary btn-lg mt-auto align-self-start stretched-link" href="<?php the_permalink(); ?>">Read More</a>
		</div>
	</li>
	<?php $is_even_index = ! $is_even_index; ?>
	<?php endwhile; ?>
</ul>