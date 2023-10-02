<?php
	/**
	 * Template part for displaying a news single
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package Bootscore
	 */

get_header();
$subheading = get_field('subheading');
$photo_credit = get_field('photo_credit');
$photo_caption = get_field('photo_caption');
$article = get_field('article');
$video = get_field('video');
?>

<div id="content" class="site-content container-fluid g-0">
	<div id="primary" class="content-area">
		<div class="row">
			<div class="col-12">
				<main id="main" class="site-main">
					<header class="entry-header pt-5">
						<div class="container">
							<div class="row">
								<?php the_title('<h1>', '</h1>'); ?>
								<?php if ($subheading) { ?>
									<h2 class="news-subtitle"><?php echo $subheading; ?></h2>
								<?php } ?>
								<?php bootscore_post_thumbnail(); ?>
								<div class="photoby mb-4">
									<?php if ($photo_credit) { ?>
										<p class="caption-title mb-1"><?php echo $photo_credit; ?></p>
									<?php } ?>
									<?php if ($photo_caption) { ?>
										<p class="caption"><?php echo $photo_caption; ?></p>
									<?php } ?>
								</div>
							</div>
						</div>
					</header>

					<div class="mb-4 w-100 d-flex flex-row">
						<div class="tab-bottom"></div>
					</div>
					<div class="entry-content container">
						<div class="row">
							<div class="col-12">
								<p>
									<small><a href="<?php echo esc_url(home_url()); ?>">Advanced Technology Initiatives</a> <i class="fas fa-caret-right"></i> <a href="/news/">News</a></small>
								</p>
								<p class="entry-meta mb-5">
									<small>
										Published <?php the_date(); ?>
									</small>
								</p>
								<?php the_content(); ?>
								<?php echo $article; ?>

								<?php if (have_rows('full_article')) : ?>
									<?php while (have_rows('full_article')) : the_row();
										$article_name = get_sub_field('article_name');
										$article_link = get_sub_field('article_link');
										$article_author = get_sub_field('article_author');
										$article_date = get_sub_field('article_date');
									?>
										<?php if ($article_name) { ?>
											<div class="col-12 col-lg-6 p-4 mt-4 mb-5 full-article position-relative">
												<a class="stretched-link" href="<?php echo $article_link; ?>" target="_blank" rel="noopener noreferrer">
													<div class="container g-0">
														<div class="row align-items-center">
															<div class="col-10">
																<h2 class="text-dark">Read the Full Article</h2>
																<p><b><?php echo $article_name; ?></b><br />
																	<?php if ($article_author) { ?>
																		<span class="text-dark">By <?php echo $article_author; ?><br /></span>
																	<?php } ?>
																	<span class="text-dark"><?php echo $article_date; ?>
																</p></span>
															</div>
															<div class="col-2 text-end">
																<i class="fas fa-angle-right fa-4x"></i>
															</div>
														</div>
													</div>
												</a>
											</div>
										<?php } ?>
									<?php endwhile; ?>
								<?php endif; ?>

								<?php if ($video) { ?>
									<div class="embed-container">
										<?php echo $video; ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

					<!-- Boilerplates -->
					<div class="mt-4 w-100 d-flex flex-row-reverse">
						<div class="tab-top bg-tan"></div>
					</div>
					<div class="col-12 bg-tan py-5">
						<div class="container p-0 py-4 h-100">
							<div class="row g-0 flex-row">
								<div class="col-12">
									<h3>About the UAS IPP Program</h3>
									<p>The Unmanned Aircraft System (UAS) Integration Pilot Program (IPP) is an opportunity for state, local, and tribal governments to partner with private sector entities, such as UAS operators or manufacturers, to accelerate safe UAS integration. The program will help the U.S. Department of Transportation (USDOT) and Federal Aviation Administration (FAA) craft new enabling rules that allow more complex low-altitude UAS operations by:</p>
									<ul>
										<li>Identifying ways to balance local and national interests related to UAS integration</li>
										<li>Improving communications with local, state and tribal jurisdictions</li>
										<li>Addressing security and privacy risks</li>
										<li>Accelerating the approval of operations that currently require special authorizations</li>
									</ul>
									<p>The program is expected to foster a meaningful dialogue on the balance between local and national interests related to UAS integration, and provide actionable information to the USDOT on expanded and universal integration of UAS into the National Airspace System.</p>
								</div>
							</div>

							<hr />
							
							<div class="row g-0 flex-row">
								<div class="col-12">
									<h3>About the Choctaw Nation of Oklahoma</h3>
									<p>The Choctaw Nation is the third-largest Indian Nation in the United States with more than 212,000 tribal members and 12,000-plus associates. This ancient people has an oral tradition dating back over 13,000 years. The first tribe over the Trail of Tears, its historic reservation boundaries are in the southeast corner of Oklahoma, covering 10,923 square miles. The Choctaw Nation's vision, "Living out the Chahta Spirit of faith, family and culture," is evident as it continues to focus on providing opportunities for growth and prosperity. For more information about the Choctaw Nation, its culture, heritage, and traditions, please visit <a href="https://www.choctawnation.com/" target="_blank" rel="noreferrer noopener">choctawnation.com</a>.</p>

									<h3>Inquiries</h3>
									<p>Contact Kristina Humenesky for any media relations needs at <a href="mailto:khumensky@choctwnation.com">khumensky@choctwnation.com</a></p>
								</div>
							</div>

							<?php
							$additional_boilerplates = get_field('additional_boilerplates');
							if ($additional_boilerplates) : ?>
								<?php foreach ($additional_boilerplates as $additional_boilerplate) :
									$permalink = get_permalink($additional_boilerplate->ID);
									$title = get_the_title($additional_boilerplate->ID);
									$about_company = get_field('about_company', $additional_boilerplate->ID);
									$media_inquiry = get_field('media_inquiry', $additional_boilerplate->ID);
								?>
									<hr />
									<div class="row py-3">
										<h3>About <?php echo $title; ?></h3>
										<?php echo $about_company; ?>
										<?php if ($media_inquiry) { ?>
											<h3>Media Inquiries</h3>
											<?php echo $media_inquiry; ?>
										<?php } ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>

				</main> <!-- #main -->

			</div><!-- col -->
		</div><!-- row -->

	</div><!-- #primary -->
</div><!-- #content -->

<?php get_footer(); ?>