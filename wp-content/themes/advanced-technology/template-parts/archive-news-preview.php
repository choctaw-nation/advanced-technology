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
?>
<ul class="container list-unstyled d-flex flex-column row-gap-5 align-items-stretch mb-5" style="padding-left:calc(var(--bs-gutter-x)*.5);">
	<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<?php $is_even_index = 0 === $wp_query->current_post % 2; ?>
	<li class="row position-relative row-gap-2 align-items-stretch" data-aos="<?php echo $is_even_index ? 'zoom-out-left' : 'zoom-out-right'; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="col-lg-5">
			<?php
				the_post_thumbnail(
					'news-thumb',
					array(
						'class'   => 'object-fit-cover w-100 h-auto',
						'loading' => 'lazy',
					)
				);
			?>
		</div>
		<?php endif; ?>
		<div class="col d-flex flex-column align-items-stretch">
			<?php the_title( '<h2>', '</h2>' ); ?>
			<p>
				<?php the_field( 'archive_content' ); ?>
			</p>
			<a class="btn btn-primary btn-lg mt-auto align-self-start stretched-link" href="<?php the_permalink(); ?>">Read More</a>
		</div>
	</li>
	<?php endwhile; ?>
</ul>