<?php
/**
 * The template for displaying the footer
 *
 * @package ChoctawNation
 */

?>

<footer class="pt-5 pb-3 bg-success">
	<div class="container-fluid">
		<div class="row justify-content-center justify-content-sm-between row-gap-5">
			<div class="col-12 col-md-3 text-center">
				<a class="navbar-brand footer-logo d-block" href="<?php echo esc_url( home_url() ); ?>">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/logo/ati-logo.svg" alt="logo" class="logo md" loading="lazy" />
				</a>
			</div>
			<div class="col-8 footer-nav">
				<!-- Footer Menu -->
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'secondary',
						'depth'           => 2,
						'container'       => 'div',
						'container_class' => 'bs-footer-menu',
						'container_id'    => 'footer-menu',
						'menu_class'      => 'nav list-unstyled ms-0 row-gap-3',
					)
				);
				?>
				<!-- Footer Menu -->
			</div>
		</div>
	</div>
</footer>

<div class="top-button position-fixed">
	<a href="#to-top" class="btn btn-primary shadow" aria-label="Go to the top of the page"><i class="fas fa-chevron-up"></i></a>
</div>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>