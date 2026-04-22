<?php
/**
 * The header for our theme
 *
 * @package ChoctawNation
 */

use ChoctawNation\Theme\Navwalkers\Navwalker;

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#000000">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'overflow-x-hidden' ); ?> data-aos-easing="ease-out-back" data-aos-duration="1000" data-aos-delay="0">
	<?php wp_body_open(); ?>
	<div id="to-top"></div>
	<div id="page" class="site position-relative">
		<header id="masthead" class="site-header text-bg-black z-2 position-sticky sticky-top start-0 end-0 py-3 container-fluid">
			<nav id="nav-main" class="navbar navbar-expand-lg container-xxl justify-content-lg-between">
				<a class="d-block col-9 col-md-6 col-lg-4 navbar-brand me-0 px-xxl-0 align-items-md-center" href="<?php echo esc_url( site_url() ); ?>" class="logo d-block"
				   aria-label="to Home Page">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo/ati-logo.svg' ); ?>" alt="Choctaw Nation Advanced Technology Initiatives Logo">
				</a>
				<button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar" aria-expanded="false"
						aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="offcanvas offcanvas-end flex-lg-grow-0" tabindex="-1" data-bs-hideresize="true" id="offcanvas-navbar">
					<div class="offcanvas-header hover cursor-pointer" data-bs-dismiss="offcanvas">
						<i class="fas fa-chevron-left"></i> <?php esc_html_e( 'Close menu', 'bootscore' ); ?>
					</div>
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary_menu',
							'container'       => 'div',
							'container_class' => 'offcanvas-body',
							'menu_class'      => 'nav navbar-nav justify-content-end',
							'walker'          => new Navwalker(),
						)
					);
					?>
				</div>
			</nav>
		</header><!-- #masthead -->