<?php
/**
 * The News Preview Template
 *
 * @package ChoctawNation
 * @since 2.0
 */

$archive_content = get_field( 'archive_content' );
?>
<div class="row news-list my-5 my-lg-3">
	<div class="col-lg-3">
		<a href="<?php the_permalink(); ?>">
			<?php
			the_post_thumbnail(
				'home-block',
				array(
					'class'   => 'news-archive-img mb-3',
					'loading' => 'lazy',
				)
			);
			?>
		</a>
	</div>
	<div class="col-lg-9 news-detail news-content-preview">
		<a href="<?php the_permalink(); ?>" class="text-decoration-none">
			<?php the_title( '<h3 class="text-success fw-bold">', '</h3>' ); ?>
		</a>
		<p><?php echo $archive_content; ?></p>
	</div>
</div>
