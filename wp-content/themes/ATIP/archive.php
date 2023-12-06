<?php
/**
 * The template for displaying archive pages
 */

if ( is_post_type_archive( 'staff' ) ) {
	get_template_part( 'page-templates/archive', 'staff' );
}
get_header();
?>

<div id="content" class="site-content container py-5 mt-5">
	<div id="primary" class="content-area">

		<div class="row">
			<div class="col">

				<main id="main" class="site-main">

					<!-- Title & Description -->
					<header class="page-header mb-4">
						<h1><?php post_type_archive_title(); ?></h1>
					</header>

					<!-- Grid Layout -->
					<?php if ( have_posts() ) : ?>
					<?php $even = true; ?>
					<div class="container g-0">
						<?php
						while ( have_posts() ) :
							the_post();
							?>
						<?php $archive_content = get_field( 'archive_content' ); ?>
						<div class="row pb-4 aos-init aos-animate" data-aos="zoom-out-
							<?php
							if ( $even ) {
								echo 'left';
							} else {
								echo 'right';}
							?>
						">
							<!-- Featured Image-->
							<?php if ( has_post_thumbnail() ) { ?>
							<div class="col-lg-5 mb-3"><?php the_post_thumbnail( 'news-thumb' ); ?></div>
							<?php } ?>
							<div class="col">
								<div class="text-body">
									<!-- Title -->
									<h2 class="blog-post-title news-content-preview">
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h2>
									<!-- Excerpt & Read more -->
									<div class="mt-auto">
										<?php echo $archive_content; ?>
										<div><a class="read-more btn btn-primary btn-lg mt-3" href="<?php the_permalink(); ?>">Read More</a></div>
									</div>
								</div>
							</div>

						</div>
						<?php $even = ! $even; ?>
						<?php endwhile; ?>
					</div>
					<?php endif; ?>

					<!-- Pagination -->
					<div>
						<?php bootscore_pagination(); ?>
					</div>

				</main><!-- #main -->

			</div><!-- col -->
		</div><!-- row -->

	</div><!-- #primary -->
</div><!-- #content -->

<?php
get_footer();
