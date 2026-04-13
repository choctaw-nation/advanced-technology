<?php
/**
 * The main template file
 *
 * @package ChoctawNation
 */

get_header();
?>
<div id="content" class="site-content container-fluid gx-0">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="row">
				<!-- Header Hero -->
				<div class="col-12 header-hero">
					<?php
					echo do_shortcode( '[smartslider3 slider="1"]' );
					?>
				</div>

				<!-- Video -->
				<div class="col-12 home-video">
					<!-- particles.js container -->
					<div id="particles-js">
						<div class="container py-5">
							<div class="row pb-4">
								<div class="col-12 text-light">
									<p class="text-light">The department of Advanced Technology Iniatives (ATI) serves the Choctaw Nation by focusing on emerging technology opportunies that
										have the potential for a positive impact on the Choctaw Nation and the region.</p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 text-light">
									<div class="ratio ratio-16x9">
										<iframe title="vimeo-player" src="https://player.vimeo.com/video/710795263?h=c1a209975a" width="100%" height="700" frameborder="0"
												allowfullscreen></iframe>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Test Site -->
				<div class="col-12 test-site-area" style="z-index: 2;">
					<div class="container p-0 bg-black h-100">
						<div class="row g-0">
							<div class="col-lg-6 text-light">
								<div class="w-100 bg-black py-3 px-5 g-0" style="height: 200px;">
									<div class="text-success block-sub-title">TEST SITE</div>
									<div class="text-light block-title">$4 million grant from EDA</div>
								</div>
								<div class="w-100 p-5 folded-block m-0" style="height: 450px; padding-top: 5rem !important;">
									<div class="text-light">The CNO ATI program was awarded a $500K matching grant from USDA to develop a new "MakerSpace" at the test site. The USDA grant
										was matched with an additional $500K for $1,000,000 facility.</div>
								</div>
							</div>
							<div class="col-lg-6 text-light">
								<div class="w-100">
									<img class="w-100" src="https://advanced-technology.local/wp-content/uploads/2022/09/1296x729.png" alt="" />
								</div>
								<div class="w-100 p-5" style="padding-top: 5rem !important;">
									<div class="container">
										<div class="row">
											<div class="col-4">
											</div>
											<div class="col-6">
												<a href="#" class="d-flex"><i class="far fa-2x fa-arrow-alt-circle-right text-success w-25"></i><span
															class="text-light fs-root w-75 px-2">Learn more about the test site operations center.</span></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- News -->
				<div class="pt-5 mt-5 w-100 d-flex flex-row-reverse">
					<div class="tab-top bg-secondary"></div>
				</div>
				<div class="col-12 news-area py-5">
					<div class="container p-0 h-100">
						<div class="row g-0 flex-row">
							<div class="col-lg-3 text-center">
								<div class="container h-100">
									<div class="row h-100 flex-column justify-content-between">
										<div class="col-12">
											<div class="text-success block-sub-title">NEWS</div>
										</div>
										<div class="col-12 d-none d-lg-block">
											<a href="/news/">
												<i class="far fa-2x fa-arrow-alt-circle-right text-success"></i>
												<div class="fs-root text-dark">Read more news</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-9">
								<div class="container h-100">
									<div class="row h-100 news-list">

										<?php $post_in_feed = 2; ?>

										<?php
										$args = array(
											'post_type'  => array( 'news' ),
											'posts_per_page' => $post_in_feed,
											'order'      => 'DESC',
											'orderby'    => 'date',
											'meta_query' => array(
												array(
													'key' => 'featured_post',
													'value' => 1,
													'compare' => '=',
												),
											),
										);

										$query = new WP_Query( $args );
										?>

										<?php $featured_count = 0; ?>

										<?php if ( $query->have_posts() ) : ?>
											<?php
											while ( $query->have_posts() ) :
												$query->the_post();
												?>
												<?php ++$featured_count; ?>

												<?php $archive_content = get_field( 'archive_content' ); ?>

										<div class="col-lg-3 mb-3 news-img">
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'feed-side', array( 'class' => 'news-archive-img' ) ); ?></a></a>
										</div>
										<div class="col-lg-9 mb-3 news-detail news-content-preview">
											<a href="<?php the_permalink(); ?>">
												<div class="text-success"><b><?php the_title(); ?></b></div>
											</a>
											<p><?php echo $archive_content; ?></p>
										</div>
										<?php endwhile; ?>
										<?php endif; ?>

										<?php wp_reset_postdata(); ?>

										<?php $remaining_posts = $post_in_feed - $featured_count; ?>
										<?php
										if ( $remaining_posts < 0 ) {
											$remaining_posts = 0;
										}
										?>

										<?php
										$args = array(
											'post_type'  => array( 'news' ),
											'posts_per_page' => $remaining_posts,
											'order'      => 'DESC',
											'orderby'    => 'date',
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
										);

										$query = new WP_Query( $args );
										?>

										<?php if ( $query->have_posts() ) : ?>
											<?php
											while ( $query->have_posts() ) :
												$query->the_post();
												?>
												<?php $archive_content = get_field( 'archive_content' ); ?>

										<div class="col-lg-3 mb-3 news-img">
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'feed-side', array( 'class' => 'news-archive-img' ) ); ?></a></a>
										</div>
										<div class="col-lg-9 mb-3 news-detail news-content-preview">
											<a href="<?php the_permalink(); ?>">
												<div class="text-success"><b><?php the_title(); ?></b></div>
											</a>
											<p><?php echo $archive_content; ?></p>
										</div>
										<?php endwhile; ?>
										<?php endif; ?>

										<?php wp_reset_postdata(); ?>

									</div>
								</div>
							</div>
							<div class="col-12 d-lg-none text-center">
								<a href="/news/">
									<i class="far fa-2x fa-arrow-alt-circle-right text-success"></i>
									<div class="fs-root">Read more news</div>
								</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</main><!-- #main -->

	</div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();
