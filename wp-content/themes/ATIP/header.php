<?php
/**
 * The header for our theme
 *
 * @package ChoctawNation
 */

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

<body <?php body_class( 'overflow-x-hidden position-relative' ); ?> data-aos-easing="ease-out-back" data-aos-duration="1000" data-aos-delay="0">
	<?php wp_body_open(); ?>
	<div id="to-top" class="position-absolute top-0"></div>
	<div id="page" class="site">
		<header id="masthead" class="site-header">

			<nav id="nav-main" class="navbar navbar-expand-lg navbar-dark bg-black sticky-top py-0">

				<div class="container nav-container">

					<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>"><strong>Choctaw Nation</strong> <span class="d-none d-md-inline">Advanced Technology
							Initiatives</span><span class="d-inline d-md-none">ATI</span></a>

					<!-- Top Nav Search Mobile -->
					<div class="top-nav-search-md d-lg-none ms-2">
						<div class="dropdown">
							<button class="btn btn-outline-secondary btn-dropdown right" type="button" id="dropdown-search" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-search"></i>
							</button>
							<div class="dropdown-search dropdown-menu position-fixed border-0 bg-light rounded-0 start-0 end-0" aria-labelledby="dropdown-search">
								<div class="container">
									<?php if ( is_active_sidebar( 'top-nav-search' ) ) : ?>
									<div class="mb-2">
										<?php dynamic_sidebar( 'top-nav-search' ); ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>

					<button class="navbar-toggler border-0 focus-0 py-2 pe-0 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar"
							aria-controls="offcanvas-navbar" aria-label="Menu">
						<i class="text-secondary fas fa-bars"></i>
					</button>

					<div class="offcanvas offcanvas-end" tabindex="-1" data-bs-hideresize="true" id="offcanvas-navbar">
						<div class="offcanvas-header hover cursor-pointer bg-black text-light" data-bs-dismiss="offcanvas">
							<i class="fas fa-chevron-left"></i> <?php esc_html_e( 'Close menu', 'bootscore' ); ?>
						</div>
						<div class="offcanvas-body">
							<!-- Wp Bootstrap Nav Walker -->
							<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'primary',
										'depth'           => 2,
										'container'       => 'div',
										'container_class' => 'ms-auto',
										'container_id'    => 'bootscore-navbar',
										'menu_class'      => 'nav navbar-nav justify-content-end',
										'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
										'walker'          => new WP_Bootstrap_Navwalker(),
									)
								);
								?>
						</div>
					</div>


				</div><!-- container -->

			</nav>

		</header><!-- #masthead -->
