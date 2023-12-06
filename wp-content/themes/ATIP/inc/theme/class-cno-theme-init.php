<?php
/**
 * Initializes the Theme
 *
 * @package ChoctawNation
 * @since 1.3
 */

/** Builds the Theme */
class CNO_Theme_Init {
	/** Constructor */
	public function __construct() {
		$this->load_required_files();
		$this->disable_discussion();
		$this->cno_set_environment();
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_cno_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'cno_theme_support' ) );
		add_action( 'init', array( $this, 'alter_post_types' ) );
	}

	/** Load required files. */
	private function load_required_files() {

		$this->load_acf_classes(
			array(
				'generator',
				'image',
				'hero',
			)
		);

		require_once __DIR__ . '/asset-loader/enum-enqueue-type.php';
		require_once __DIR__ . '/asset-loader/class-asset-loader.php';
		require_once __DIR__ . '/navwalkers/class-cno-navwalker.php';
		require_once __DIR__ . '/theme-functions.php';
		require_once __DIR__ . '/preload-fix.php';
	}

	/** Takes an array of file names to load
	 *
	 * @param string[] $classes the classes to load
	 */
	private function load_acf_classes( array $classes ) {
		$path = dirname( __DIR__, 1 ) . '/acf';
		foreach ( $classes as $class_file ) {
			require_once $path . '/acf-classes/class-' . $class_file . '.php';
		}
	}

	/** Remove comments, pings and trackbacks support from posts types. */
	private function disable_discussion() {
		// Close comments on the front-end
		add_filter( 'comments_open', '__return_false', 20, 2 );
		add_filter( 'pings_open', '__return_false', 20, 2 );

		// Hide existing comments.
		add_filter( 'comments_array', '__return_empty_array', 10, 2 );

		// Remove comments page in menu.
		add_action(
			'admin_menu',
			function () {
				remove_menu_page( 'edit-comments.php' );
			}
		);

		// Remove comments links from admin bar.
		add_action(
			'init',
			function () {
				if ( is_admin_bar_showing() ) {
					remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
				}
			}
		);
	}

	/** Sets an Environment Variable */
	private function cno_set_environment() {
		$server_name = $_SERVER['SERVER_NAME'];

		if ( false !== strpos( $server_name, '.local' ) ) {
			$_ENV['CNO_ENV'] = 'dev';
		} elseif ( false !== strpos( $server_name, 'wpengine' ) ) {
			$_ENV['CNO_ENV'] = 'stage';
		} else {
			$_ENV['CNO_ENV'] = 'prod';
		}
	}

	/**
	 * Adds scripts with the appropriate dependencies
	 */
	public function enqueue_cno_scripts() {
		wp_enqueue_style(
			'typekit',
			'https://use.typekit.net/jky5sek.css',
			array(),
			null // phpcs:ignore
		);

		$bootstrap = new Asset_Loader( 'bootstrap', Enqueue_Type::both, 'vendors' );

		wp_enqueue_style(
			'fontawesome',
			get_template_directory_uri() . '/css/lib/fontawesome.min.css',
			array(),
			'5.14.0'
		);

		$global_scripts = new Asset_Loader( 'global', Enqueue_Type::both, null, array( 'bootstrap' ) );
		wp_localize_script( 'global', 'cnoSiteData', array( 'rootUrl' => home_url() ) );

		// style.css
		wp_enqueue_style(
			'main',
			get_stylesheet_uri(),
			array( 'global' ),
			null, // phpcs:ignore
		);

		// News Single CSS
		if ( is_singular( 'news' ) ) {
			wp_enqueue_style(
				'news-single',
				get_template_directory_uri() . '/src/styles/pages/single-news.css',
				array( 'global' )
			);
		}

		// Staff Single CSS
		if ( is_singular( 'staff' ) ) {
			wp_enqueue_style(
				'staff-single',
				get_template_directory_uri() . '/src/styles/pages/single-staff.css',
				array( 'global' )
			);
		}

		// Staff Archive CSS
		if ( is_archive( 'staff' ) ) {
			wp_enqueue_style(
				'staff-archive',
				get_template_directory_uri() . '/src/styles/pages/archive-staff.css',
				array( 'global' )
			);
		}

		$this->remove_wordpress_styles(
			array(
				'classic-theme-styles',
				'wp-block-library',
				'wp-block-library-theme',
				'dashicons',
				'global-styles',
				'wc-block-style',
			)
		);

		wp_register_script(
			'particles',
			get_template_directory_uri() . '/src/js/vendors/particles.js',
			array(),
			'20151215',
			array( 'strategy' => 'defer' )
		);
		$front_page = require_once get_template_directory() . '/dist/pages/frontPage.asset.php';
		wp_register_script(
			'home',
			get_template_directory_uri() . '/dist/pages/frontPage.js',
			array( 'particles' ),
			$front_page['version'],
			array( 'strategy' => 'defer' )
		);
		wp_register_style(
			'home',
			get_template_directory_uri() . '/dist/pages/frontPage.css',
			array( 'global' ),
			$front_page['version']
		);
	}

	/**
	 * Provide an array of handles to dequeue.
	 *
	 * @param array $handles the script/style handles to dequeue.
	 */
	private function remove_wordpress_styles( array $handles ) {
		foreach ( $handles as $handle ) {
			wp_dequeue_style( $handle );
		}
	}

	/** Registers Theme Supports */
	public function cno_theme_support() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_image_size( 'home-block', 720, 1200, false );
		add_image_size( 'news-thumb', 696, 392, true ); // (cropped)
		add_image_size( 'staff-archive-thumb', 1200, 400, false );
		add_image_size( 'staff-single-thumb', 1200, 500, false );
		add_image_size( 'gallery-thumbnail', 516, 920, false );

		register_nav_menus(
			array(
				'primary_menu' => __( 'Primary Menu', 'cno' ),
				'mobile_menu'  => __( 'Mobile Menu', 'cno' ),
				'footer_menu'  => __( 'Footer Menu', 'cno' ),
			)
		);
	}

	/** Remove post type support from posts types. */
	public function alter_post_types() {
		$post_types = array( 'post', 'page', 'staff' );
		foreach ( $post_types as $post_type ) {
			$this->disable_post_type_support( $post_type );
		}
	}

	/** Disable post-type-supports from posts
	 *
	 * @param string $post_type the post type to remove supports from.
	 */
	private function disable_post_type_support( string $post_type ) {
		$supports = array( 'editor', 'comments' );
		// $supports = array( 'editor', 'comments', 'trackbacks', 'revisions', 'author' );
		foreach ( $supports as $support ) {
			if ( post_type_supports( $post_type, $support ) ) {
				remove_post_type_support( $post_type, $support );
			}
		}
	}
}
