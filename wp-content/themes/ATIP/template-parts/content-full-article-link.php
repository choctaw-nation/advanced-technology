<?php
/**
 * Full Article Link
 * Used when housing a copy of an external news article on the site
 *
 * @package ChoctawNation
 */

$article_name   = get_sub_field( 'article_name' );
$article_link   = get_sub_field( 'article_link' );
$article_author = esc_textarea( get_sub_field( 'article_author' ) );
?>
<div class="col-12 col-lg-6">
	<a class="row align-items-center text-decoration-none" href="<?php echo $article_link; ?>" target="_blank" rel="noopener noreferrer">
		<div class="col">
			<h2 class="text-black">Read the Full Article</h2>
			<p class="mb-0">
				<span class="fw-bold">
					<?php the_sub_field( 'article_name' ); ?>
				</span>
				<br />
				<?php echo $article_author ? "<span class='text-black'>By {$article_author}<br /></span>" : ''; ?>
				<span class="text-black">
					<?php the_sub_field( 'article_date' ); ?>
				</span>
			</p>
		</div>
		<div class="col-2">
			<i class="fas fa-angle-right fa-4x"></i>
		</div>
	</a>
</div>