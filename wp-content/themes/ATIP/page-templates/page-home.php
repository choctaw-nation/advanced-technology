<?php
	/**
	 * Template Name: Homepage
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package Bootscore
	 */
	
	get_header();
	
    $intro_paragraph = get_field('intro_paragraph');
    $video_or_image = get_field('video_or_image');
    $image = get_field('image');
    $video = get_field('video');
    
    if( have_rows('featured_content') ): ?>
        <?php while( have_rows('featured_content') ): the_row(); 
            $featured_subtitle = get_sub_field('subtitle');
            $featured_title = get_sub_field('title');
            $featured_content = get_sub_field('content');
            $featured_image = get_sub_field('image');
            $featured_link_text = get_sub_field('link_text');
            $featured_link = get_sub_field('link');
            ?>
        <?php endwhile; ?>
    <?php endif; ?>

<div id="content" class="site-content container-fluid gx-0">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="row">
                <!-- Header Hero -->
                <div class="col-12 header-hero">
                    <?php
                    echo do_shortcode('[smartslider3 slider="1"]');
                    ?>
                </div>

                <!-- Video -->
                <div class="col-12 home-video aos-init aos-animate" data-aos="zoom-out-left">
                    <!-- particles.js container -->
                    <div id="particles-js">
                        <div class="container py-5">
                            <div class="row pb-4">
                                <div class="col-12 text-light">
                                    <p class="text-light"><?php echo $intro_paragraph; ?></p>
                                </div>
                            </div>
                            <?php if ( $video_or_image == 'video' ) { ?>
                                <div class="row">
                                    <div class="col-12 text-light">
                                        <div class="embed-container">
                                            <?php echo $video; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-12 text-light">
                                        <img class="w-100" src="<?php echo $image['sizes']['1536x1536']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Test Site -->
                <div class="col-12 test-site-area aos-init aos-animate" style="z-index: 2;" data-aos="zoom-out-right">
                    <div class="container p-0 bg-dark h-100">
                        <div class="row g-0">
                            <div class="col-lg-6 text-light">
                                <div class="w-100 bg-dark py-3 px-5 g-0" style="height: 200px;">
                                    <div class="text-lightgreen block-sub-title"><?php echo $featured_subtitle; ?></div>
                                    <div class="text-light block-title"><?php echo $featured_title; ?></div>
                                </div>
                                <div class="w-100 p-5 folded-block m-0" style="height: 450px; padding-top: 5rem !important;">
                                    <div class="text-light"><?php echo $featured_content; ?></div>
                                </div>
                            </div>
                            <div class="col-lg-6 text-light">
                                <div class="w-100">
                                <img class="w-100" src="<?php echo $featured_image['sizes']['home-block']; ?>" alt="<?php echo $featured_image['alt']; ?>"/>
                                </div>
                                <div class="w-100 p-5" style="padding-top: 5rem !important;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4">
                                            </div>
                                            <div class="col-6">
                                                <a href="<?php echo $featured_link; ?>" class="d-flex"><i class="far fa-2x fa-arrow-alt-circle-right text-lightgreen w-25"></i><span class="text-light text-sm w-75 ps-4"><?php echo $featured_link_text; ?></span></a>
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
                    <div class="tab-top bg-tan"></div>
                </div>
                <div class="col-12 news-area py-5">
                    <div class="container p-0 h-100">
                        <div class="row g-0 flex-row aos-init aos-animate" data-aos="zoom-out-left">
                            <div class="col-lg-3 text-center">
                                <div class="container h-100">
                                    <div class="row h-100 flex-column justify-content-between">
                                        <div class="col-12">
                                            <div class="text-lightgreen block-sub-title">NEWS</div>
                                        </div>
                                        <div class="col-12 d-none d-lg-block">
                                            <a href="/news/">
                                                <i class="far fa-2x fa-arrow-alt-circle-right text-lightgreen"></i>
                                                <div class="text-sm text-dark">Read more news</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="container h-100">
                                    <div class="row h-100 news-list">

                                        <?php $post_in_feed = 2; ?>

                                        <?php $args = array(
                                            'post_type'              => array('news'),
                                            'posts_per_page'         => $post_in_feed,
                                            'order'                  => 'DESC',
                                            'orderby'                => 'date',
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'featured_post',
                                                    'value' => 1,
                                                    'compare' => '='
                                                ),
                                            ),
                                        );

                                        $query = new WP_Query($args); ?>

                                        <?php $featured_count = 0; ?>

                                        <?php if ($query->have_posts()) : ?>
                                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                                <?php $featured_count++; ?>

                                                <?php $archive_content = get_field('archive_content'); ?>

                                                <div class="col-lg-3 mb-3 news-img">
                                                    <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('home-block', array('class' => 'news-archive-img')); ?></a>
                                                </div>
                                                <div class="col-lg-9 mb-3 news-detail news-content-preview">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <div class="text-lightgreen"><b><?php the_title(); ?></b></div>
                                                    </a>
                                                    <p><?php echo $archive_content; ?></p>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php endif; ?>

                                        <?php wp_reset_postdata(); ?>

                                        <?php $remaining_posts = $post_in_feed - $featured_count; ?>
                                        <?php if ($remaining_posts < 0) {
                                            $remaining_posts = 0;
                                        } ?>

                                        <?php $args = array(
                                            'post_type'              => array('news'),
                                            'posts_per_page'         => $remaining_posts,
                                            'order'                  => 'DESC',
                                            'orderby'                => 'date',
                                            'meta_query' => array(
                                                'relation' => 'OR',
                                                array(
                                                    'key' => 'featured_post',
                                                    'value' => 0,
                                                    'compare' => '='
                                                ),
                                                array(
                                                    'key' => 'featured_post',
                                                    'compare' => 'NOT EXISTS'
                                                ),
                                            ),
                                        );

                                        $query = new WP_Query($args); ?>

                                        <?php if ($query->have_posts()) : ?>
                                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                                <?php $archive_content = get_field('archive_content'); ?>

                                                <div class="col-lg-3 mb-3 news-img">
                                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('home-block', array('class' => 'news-archive-img')); ?></a></a>
                                                </div>
                                                <div class="col-lg-9 mb-3 news-detail news-content-preview">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <div class="text-lightgreen"><b><?php the_title(); ?></b></div>
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
                                    <i class="far fa-2x fa-arrow-alt-circle-right text-lightgreen"></i>
                                    <div class="text-sm">Read more news</div>
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
