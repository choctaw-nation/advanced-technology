<?php
/**
 * Template Post Type: post
 *
 * @package ChoctawNation
 */

get_header();
?>

<div id="content" class="site-content container py-5 mt-4">
	<div id="primary" class="content-area">
		<div class="row">
			<div class="col-12">
				<main id="main" class="site-main">
					<header class="entry-header">
						<?php the_title( '<h1>', '</h1>' ); ?>
						<?php bootscore_post_thumbnail(); ?>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</main> <!-- #main -->
			</div><!-- col -->
		</div><!-- row -->

	</div><!-- #primary -->
</div><!-- #content -->

<?php
get_footer();