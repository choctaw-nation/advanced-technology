<?php
/**
 * Template part for displaying a news single
 *
 * @package ChoctawNation
 */

get_header();

$photo_credit  = esc_textarea( get_field( 'photo_credit' ) );
$photo_caption = esc_textarea( get_field( 'photo_caption' ) );
?>

<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="entry-header pt-5 text-bg-black">
				<header class="container">
					<?php
					the_title( '<h1>', '</h1>' );
					$subheading = get_field( 'subheading' );
					echo $subheading ? "<h2>{$subheading}</h2>" : '';
					the_post_thumbnail(
						'full',
						array(
							'class'           => 'w-100 h-auto',
							'loading'         => 'eager',
							'data-spai-eager' => 'true',
						)
					);
					echo $photo_credit ? "<p class='text-uppercase fs-6 mb-1'>{$photo_credit}</p>" : '';
					echo $photo_caption ? "<p class='fs-6 lh-sm mb-0'>{$photo_caption}</p>" : '';
					?>
					<div class="pb-5">
					</div>
				</header>
			</div>
			<div class="mb-4 w-100 d-flex flex-row">
				<div class="tab-bottom"></div>
			</div>
			<!-- Breadcrumbs -->
			<div class="container">
				<nav>
					<ol class="breadcrumb ms-0 d-flex gap-2">
						<li class="breadcrumb-item">
							<a class="text-decoration-none" href="<?php echo esc_url( home_url() ); ?>">Advanced Technology Initiatives</a>
						</li>
						<li>
							<i class="fas fa-caret-right"></i>
						</li>
						<li class="breadcrumb-item">
							<a class="text-decoration-none" href="/news/">News</a>
						</li>
					</ol>
				</nav>
			</div>
			<article class="entry-content container">
				<p class="mb-5">
					Published <?php the_date(); ?>
				</p>
				<?php
				the_content();
				the_field( 'article' );
				if ( have_rows( 'full_article' ) ) {
					echo '<div class="row row-gap-4 my-4">';
					while ( have_rows( 'full_article' ) ) {
						the_row();
						if ( get_sub_field( 'article_name' ) ) {
							get_template_part( 'template-parts/content', 'full-article-link' );
						}
					}
					echo '</div>';
				}
				if ( get_field( 'video' ) ) {
					echo '<div class="ratio ratio-16x9">';
					the_field( 'video' );
					echo '</div>';
				}
				?>
			</article>

			<?php get_template_part( 'template-parts/aside', 'boilerplates' ); ?>

		</main> <!-- #main -->

	</div><!-- #primary -->
</div><!-- #content -->

<?php get_footer(); ?>