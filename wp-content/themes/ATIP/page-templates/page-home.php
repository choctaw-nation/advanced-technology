<?php
/**
 * Template Name: Homepage
 *
 * @package ChoctawNation
 */

use ChoctawNation\ACF\Image;

wp_enqueue_script( 'particles' );
wp_enqueue_script( 'home' );
get_header();

$intro_paragraph = get_field( 'intro_paragraph' );
$video_or_image  = get_field( 'video_or_image' );
if ( 'image' === $video_or_image ) {
	$image = new Image( get_field( 'image' ) );
} elseif ( 'video' === $video_or_image ) {
	$video = get_field( 'video', false, false );
}

$featured_content_group = get_field( 'featured_content' );
$featured_subtitle      = $featured_content_group['subtitle'];
$featured_title         = $featured_content_group['title'];
$featured_content       = $featured_content_group['content'];
$featured_image         = new Image( $featured_content_group['image'] );
$featured_link_text     = $featured_content_group['link_text'];
$featured_link          = $featured_content_group['link'];
?>

<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<!-- Header Hero -->
			<section class="header-hero">

				<?php
				if ( ! is_plugin_active( 'smart-slider-3/smart-slider-3.php' ) ) {
					the_post_thumbnail(
						'full',
						array(
							'class'           => 'w-100',
							'loading'         => 'eager',
							'data-spai-eager' => 'true',
						)
					);
				} else {
					echo do_shortcode( '[smartslider3 slider="1"]' );
				}
				?>
			</section>
			<!-- Video -->
			<section class="home-video" data-aos="zoom-out-left">
				<div class="container-fluid">
					<div class="row">
						<div class="col gx-0">
							<div id="particles-js" class="w-100 position-relative z-0 bg-black">
								<div class="container py-5">
									<p class="text-light my-5">
										<?php echo $intro_paragraph; ?>
									</p>
									<?php
									if ( 'video' === $video_or_image ) {
										echo "<div class='ratio ratio-16x9'>";
										$video = cno_extract_vimeo_id( $video );
										echo $video ?: get_field( 'video' ); // phpcs:ignore Universal.Operators.DisallowShortTernary.Found
										echo '</div>';
									} else {
										$image->get_the_image( 'w-100' );
									}
									?>
								</div>
							</div><!-- particles.js container -->
						</div>
					</div>
				</div>
			</section>
			<!-- Test Site -->
			<section class='test-site-area z-2' data-aos="zoom-out-right">
				<div class="container">
					<div class="row g-0">
						<div class="col-lg-6 text-light">
							<div class="text-bg-black py-3 px-5" style="height: 200px;">
								<span class="h4 mb-3 d-block fw-medium">
									<?php echo $featured_subtitle; ?>
								</span>
								<p class="block-title text-light h1 fw-semibold">
									<?php echo $featured_title; ?>
								</p>
							</div>
							<div class="w-100 p-5 folded-block m-0" style="height: 450px;">
								<p class="text-light"><?php echo $featured_content; ?></p>
							</div>
						</div>
						<div class="col-lg-6 text-bg-black d-flex flex-column align-items-stretch">
							<?php $featured_image->the_image( 'w-100' ); ?>
							<a href="<?php echo $featured_link; ?>" class="align-self-center w-auto d-flex justify-content-center m-auto p-5 text-decoration-none">
								<i class="far fa-2x fa-arrow-alt-circle-right text-success"></i>
								<span class="text-light fs-root w-50 ps-4"><?php echo $featured_link_text; ?></span>
							</a>
						</div>
					</div>
				</div>
			</section>
			<!-- News -->
			<section class="news">
				<div class="pt-5 mt-5 w-100 d-flex flex-row-reverse">
					<div class="tab-top bg-secondary"></div>
				</div>
				<div class="bg-secondary py-5">
					<div class="container">
						<div class="grid" data-aos="zoom-out-left">
							<h2 class="grid__title text-success h4 fw-medium text-center">NEWS</h2>
							<div class="grid__content">
								<div class="container">
									<?php
										$post_in_feed    = 2;
										$news_posts_args = array(
											'post_type' => array( 'news' ),
											'posts_per_page' => $post_in_feed,
											'order'     => 'DESC',
											'orderby'   => 'date',
										);


										$featured_news_posts = new WP_Query(
											array(
												...$news_posts_args,
												'meta_query' => array(
													array(
														'key' => 'featured_post',
														'value' => 1,
														'compare' => '=',
													),
												),
											)
										);
										$featured_count      = 0;
										if ( $featured_news_posts->have_posts() ) {
											while ( $featured_news_posts->have_posts() ) {
												$featured_news_posts->the_post();
												++$featured_count;
												get_template_part( 'template-parts/content', 'news-preview' );
											}
										}
										wp_reset_postdata();

										$remaining_posts = $post_in_feed - $featured_count;
										if ( $remaining_posts > 0 ) {
											$news_posts = new WP_Query(
												array(
													...$news_posts_args,
													'posts_per_page' => $remaining_posts,
													'meta_query' => array(
														'relation' => 'OR',
														array(
															'key' => 'featured_post',
															'value' => 0,
															'compare' => '=',
														),
														array(
															'key' => 'featured_post',
															'compare' => 'NOT EXISTS',
														),
													),
												)
											);
										}
										if ( $news_posts->have_posts() ) {
											while ( $news_posts->have_posts() ) {
												$news_posts->the_post();
												get_template_part( 'template-parts/content', 'news-preview' );
											}
										}
										wp_reset_postdata();
										?>
								</div>
							</div>
							<a class='grid__more d-flex flex-column justify-content-center text-center text-decoration-none' href="/news/">
								<i class="far fa-2x fa-arrow-alt-circle-right text-success"></i>
								<div class="fs-root text-dark">Read more news</div>
							</a>
						</div>
					</div>
				</div>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();
