<?php
	/*
	 * Template Post Type: staff
	 */
	  
	 get_header();
     $bio = get_field('bio'); ?>

<div id="content" class="site-content container py-5 mt-4">
    <div id="primary" class="content-area">
        <div class="row">
            <div class="col-12">
				<div class="col-md-7 col-sm-6 my-5 news-breadcrumbs"> <a href="/about/">About</a> <i class="fas fa-caret-right"></i> <a href="/staff/">Staff</a></div>
                <main id="main" class="site-main">
                    <header class="entry-header">
                        <?php the_title('<h1>', '</h1>'); ?>
                    </header>

                    <div class="entry-content">
                        <div class="container-fluid g-0">
                            <div class="row">
                                <div class="col-12 col-xl-4 staff-img">
                                    <?php the_post_thumbnail('staff-single-thumb') ?>
                                </div>
                                <div class="col-12 col-xl-8">
                                    <?php echo $bio; ?>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </main> <!-- #main -->
            </div><!-- col -->
        </div><!-- row -->

    </div><!-- #primary -->
</div><!-- #content -->

<?php get_footer(); ?>
