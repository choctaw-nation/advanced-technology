<?php
/**
 * The template for displaying archive pages
 *
 * @package ChoctawNation
 */

get_header();
?>

<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row my-5 pt-4">
					<!-- Title & Description -->
					<header class="col">
						<h1><?php post_type_archive_title(); ?></h1>
					</header>
				</div>
			</div>
			<?php
			if ( is_post_type_archive( 'staff' ) ) :
				get_template_part( 'template-parts/archive', 'staff-preview' );
			elseif ( is_post_type_archive( 'news' ) ) :
				get_template_part( 'template-parts/archive', 'news-preview' );
			else :
				?>
			<div class="container">
				<div class="row row-cols-lg-2 row-cols-xl-3">
					<div class="col">
						<?php
						the_title( '<h2 class="h1">', '</h2>' );
						the_post_thumbnail( 'news-thumb' );
						$post_excerpt = empty( get_field( 'archive_content' ) ) ? get_the_excerpt() : esc_textarea( get_field( 'archive_content' ) );
						?>
						<p><?php echo $post_excerpt; ?></p>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<!-- Pagination -->
			<div>
				<?php bootscore_pagination(); ?>
			</div>

		</main><!-- #main -->

	</div><!-- #primary -->
</div><!-- #content -->

<?php
get_footer();
