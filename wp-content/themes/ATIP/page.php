<?php
/**
 * The template for displaying all pages
 *
 * @package ChoctawNation
 */

get_header();
?>

<div id="content" class="site-content container my-5">
	<div id="primary" class="content-area">
		<main id="main" class="site-main d-flex flex-column align-items-stretch row-gap-4">
			<section>
				<?php
				the_post_thumbnail(
					'full',
					array(
						'class'           => 'w-100 h-auto',
						'loading'         => 'eager',
						'data-spai-eager' => 'true',
					)
				);
				the_title( '<h1>', '</h1>' );
				the_field( 'page_content' );
				?>
			</section>
			<?php
			if ( have_rows( 'content' ) ) {
				while ( have_rows( 'content' ) ) {
					the_row();
					if ( 'text_content' === get_row_layout() ) {
						echo '<section>';
						the_sub_field( 'content' );
						echo '</section>';
					} else {
						echo '<section>';
						echo empty( get_sub_field( 'title' ) ) ? '' : '<h2>' . esc_textarea( get_sub_field( 'title' ) ) . '</h2>';
						if ( 'image_content' === get_row_layout() ) {
							echo wp_get_attachment_image(
								get_sub_field( 'image' ),
								'full',
								'',
								array( 'loading' => 'lazy' )
							);

							echo '</section>';
						} elseif ( 'video_content' === get_row_layout() ) {
							echo '<section class="ratio ratio-16x9 mb-3">' . get_sub_field( 'video' ) . '</section>';
						}
					}
				}
			}
			?>
		</main>
	</div>
</div>
<?php
get_footer();
