<?php
/**
 * The News Preview Template
 *
 * @package ChoctawNation
 * @since 2.0
 */

$archive_content = get_field( 'archive_content' );
?>
<div class="row row-gap-3 position-relative">
	<div class="col-lg-3">
		<figure class="mb-0 ratio ratio-16x9">
			<?php
			the_post_thumbnail(
				'home-block',
				array(
					'class'   => 'w-100 h-auto object-fit-cover',
					'loading' => 'lazy',
				)
			);
			?>
		</figure>
	</div>
	<div class="col-lg-9">
		<a href="<?php the_permalink(); ?>" class="text-decoration-none stretched-link">
			<?php the_title( '<h3 class="text-success fw-bold">', '</h3>' ); ?>
		</a>
		<p class="mb-0"><?php echo $archive_content; ?></p>
	</div>
</div>