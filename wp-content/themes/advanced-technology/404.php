<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ChoctawNation
 */

get_header();
?>
<div id="content" class="site-content container py-5 mt-5">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<div class="page-404">
					<h1 class="mb-3">404</h1>
					<!-- Remove this line and place some widgets -->
					<p class="alert alert-info mb-4">Page not found.</p>
					<a class="btn btn-primary" href="<?php echo esc_url( home_url() ); ?>" role="button">Back Home &raquo;</a>
				</div>
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->

<?php
get_footer();