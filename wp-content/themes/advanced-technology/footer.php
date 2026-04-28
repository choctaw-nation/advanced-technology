<?php
/**
 * The template for displaying the footer
 *
 * @package ChoctawNation
 */

?>

<footer class="bootscore-footer py-5 bg-success ">
	<div class="container gx-5">
		<div class="row align-items-start">
			<div class="col-12 col-md-auto text-start mb-4 mb-md-0 justify-content-center justify-content-md-start d-flex">
				<a class="navbar-brand footer-logo" href="<?php echo esc_url( home_url() ); ?>">
					<img src="<?php echo esc_url( get_theme_file_uri( '/img/logo/ati-logo-stacked.svg' ) ); ?>" alt="Choctaw Nation Advanced Technology Initiatives logo"
						 class="img-fluid d-block w-100">
				</a>
			</div>
			<div class="col-12 col-md-auto ms-md-auto footer-nav my-3 me-md-5">
				<h2 class="text-white h6">Resources</h2>
				<!-- Footer Menu -->
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer_menu',
						'depth'           => 2,
						'container'       => 'nav',
						'container_class' => 'bs-footer-menu',
						'container_id'    => 'footer-menu',
						'menu_class'      => 'nav flex-column ms-0 text-capitalize text-nowrap',
					)
				);
				?>
				<!-- Footer Menu -->
			</div>
		</div>
	</div>
</footer>

<div class="top-button">
	<a href="#to-top" class="btn btn-primary shadow" aria-label="Go to the top of the page"><i class="fas fa-chevron-up"></i></a>
</div>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>