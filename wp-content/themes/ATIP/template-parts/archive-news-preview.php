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
<ul class="container list-unstyled">
	<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<li class="row mb-5" data-aos="<?php echo $is_even_index ? 'zoom-out-left' : 'zoom-out-right'; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="col-lg-5 mb-4">
			<a href="<?php the_permalink(); ?>">
				<?php
				the_post_thumbnail(
					'news-thumb',
					array(
						'class'   => 'mb-3 object-fit-cover',
						'loading' => 'lazy',
					)
				);
				?>
			</a>
		</div>
		<?php endif; ?>
		<div class="col">
			<h2 class="blog-post-title fs-1 news-content-preview">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<p class="text-body mb-3">
				<?php the_field( 'archive_content' ); ?>
			</p>
			<a class="read-more btn btn-green btn-lg text-light mt-auto" href="<?php the_permalink(); ?>">Read More</a>
		</div>
	</li>
	<?php $is_even_index = ! $is_even_index; ?>
	<?php endwhile; ?>
</ul>
