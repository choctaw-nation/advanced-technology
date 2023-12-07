<?php
/**
 * The template for displaying the footer
 *
 * @package ChoctawNation
 */

?>

<footer>
	<div class="bootscore-footer pt-5 bg-lightgreen">
		<div class="container-fluid px-4">
			<div class="row justify-content-between">
				<div class="col-md-3 text-center mb-5">
					<a class="navbar-brand footer-logo" href="<?php echo esc_url( home_url() ); ?>">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/logo/ati-logo.svg" alt="logo" class="logo md">
					</a>
				</div>
				<div class="col-md-8 footer-nav mb-3">
					<!-- Footer Menu -->
					<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'secondary',
								'depth'           => 2,
								'container'       => 'div',
								'container_class' => 'bs-footer-menu',
								'container_id'    => 'footer-menu',
								'menu_class'      => 'nav',
							)
						);
						?>
					<!-- Footer Menu -->
				</div>
			</div>
		</div>
	</div>

</footer>

<div class="top-button">
	<a href="#to-top" class="btn btn-green shadow" aria-label="Go to the top of the page"><i class="fas fa-chevron-up"></i></a>
</div>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>
