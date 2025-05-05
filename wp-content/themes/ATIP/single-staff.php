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
			<nav class="col col-sm-6 col-md-7 my-5" aria-label="breadcrumb">
				<ol class="breadcrumb m-0 gap-2" --bs-breadcrumb-divider="">
					<li class="breadcrumb-item">
						<a href="/about/" class="fs-base text-decoration-none">About</a>
					</li>
					<li><i class="fas fa-caret-right fs-6"></i></li>
					<li class="breadcrumb-item">
						<a href="/staff/" class="fs-base text-decoration-none">Staff</a>
					</li>
				</ol>
			</nav>
		</div>
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
									'class' => 'object-fit-cover',
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
	</div><!-- #primary -->
</div><!-- #content -->

<?php get_footer(); ?>