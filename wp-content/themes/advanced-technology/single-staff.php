<?php
/**
 * Template Post Type: staff
 *
 * @package ChoctawNation
 */

get_header();
?>

<div id="content" class="site-content container py-5 mt-4">
	<div id="primary" class="content-area">
		<div class="row">
			<div class="col-12">
				<?php get_template_part( 'template-parts/nav', 'breadcrumbs' ); ?>
				<main id="main" class="site-main">
					<header class="entry-header">
						<?php the_title( '<h1>', '</h1>' ); ?>
					</header>
					<div class="entry-content">
						<div class="container-fluid g-0">
							<div class="row">
								<div class="col-12 col-xl-4 staff-img">
									<?php
									the_post_thumbnail(
										'staff-single-thumb',
										array(
											'class'   => 'object-fit-cover w-100 h-auto mb-3',
											'loading' => 'eager',
											'data-spai-eager' => 'true',
										)
									);
									?>
								</div>
								<div class="col-12 col-xl-8">
									<?php the_field( 'bio' ); ?>
								</div>
							</div>
						</div>
					</div>
				</main> <!-- #main -->
			</div><!-- col -->
		</div><!-- row -->

	</div><!-- #primary -->
</div><!-- #content -->

<?php get_footer(); ?>
