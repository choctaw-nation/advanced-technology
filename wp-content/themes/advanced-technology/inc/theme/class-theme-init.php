<?php
/**
 * Initializes the Theme
 *
 * @package ChoctawNation
 * @since 1.3
 */

namespace ChoctawNation\Theme;

use ChoctawNation\Theme\Assets\Asset_Loader;
use ChoctawNation\Theme\Assets\Enqueue_Type;

/** Builds the Theme */
class Theme_Init {
	/** Constructor */
	public function __construct() {
		$this->load_required_files();
		$this->disable_discussion();
		$this->edit_roles();
		$this->init_block_editor();
		$this->allow_svgs();
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_cno_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'cno_theme_support' ) );
		add_action( 'init', array( $this, 'alter_post_types' ) );
		add_filter( 'allowed_redirect_hosts', array( $this, 'add_allowed_redirect_hosts' ) );
		add_filter( 'wp_speculation_rules_configuration', array( $this, 'handle_speculative_loading' ) );
		add_filter( 'wp_resource_hints', array( $this, 'add_resource_hints' ), 10, 2 );
		add_filter( 'style_loader_tag', array( $this, 'preload_stylesheets' ), 10, 3 );
	}

	/** Load required files. */
	private function load_required_files() {
		require __DIR__ . '/theme-functions.php';
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

	/**
	 * Create custom roles and add capabilities for the Block Editor
	 */
	private function edit_roles() {
		$role_editor = new Role_Editor();
		add_action( 'after_switch_theme', array( $role_editor, 'create_custom_roles' ) );
	}

	/**
	 * Initializes the Block Editor by registering blocks, enqueuing assets, and setting up theme supports and filters.
	 */
	private function init_block_editor() {
		$gutenberg_handler = new Gutenberg_Handler();
		add_action( 'init', array( $gutenberg_handler, 'init_block_theme' ) );
		add_action( 'enqueue_block_editor_assets', array( $gutenberg_handler, 'enqueue_block_assets' ) );
		add_action( 'after_setup_theme', array( $gutenberg_handler, 'cno_block_theme_support' ), 50 );
		add_filter( 'block_editor_settings_all', array( $gutenberg_handler, 'restrict_gutenberg_ui' ), 10, 1 );
		add_filter( 'allowed_block_types_all', array( $gutenberg_handler, 'restrict_block_types' ), 10, 2 );
		add_filter( 'use_block_editor_for_post_type', array( $gutenberg_handler, 'handle_page_templates' ) );
	}

	/**
	 *  Allow SVG uploads and add necessary styles to display them correctly in the admin area.
	 */
	private function allow_svgs() {
		$allow_svg = new Allow_SVG();
		add_filter( 'upload_mimes', array( $allow_svg, 'cc_mime_types' ) );
		add_action( 'admin_head', array( $allow_svg, 'fix_svg' ) );
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

		new Asset_Loader( 'bootstrap', Enqueue_Type::both, 'vendors' );
		new Asset_Loader( 'global', Enqueue_Type::both, null, array( 'bootstrap' ) );
		wp_add_inline_script( 'global', 'window.cnoSiteData = ' . wp_json_encode( array( 'rootUrl' => home_url() ) ) . ';' );

		// style.css
		wp_enqueue_style(
			'main',
			get_stylesheet_uri(),
			array( 'global' ),
			null, // phpcs:ignore
		);

		$this->remove_wordpress_styles(
			array(
				'classic-theme-styles',
				'dashicons',
				'wc-block-style',
			)
		);

		$gallery = require_once get_template_directory() . '/dist/pages/gallery.asset.php';
		wp_register_script(
			'gallery',
			get_template_directory_uri() . '/dist/pages/gallery.js',
			array(),
			$gallery['version'],
			array( 'strategy' => 'defer' )
		);

		$front_page = require_once get_template_directory() . '/dist/pages/frontPage.asset.php';
		wp_register_script(
			'home',
			get_template_directory_uri() . '/dist/pages/frontPage.js',
			array(),
			$front_page['version'],
			array( 'strategy' => 'defer' )
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
		add_post_type_support( 'page', 'excerpt' );
		add_image_size( 'home-block', 720, 1200, false );
		add_image_size( 'news-thumb', 696, 392, true );
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

		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
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
		$supports = array( 'comments' );
		foreach ( $supports as $support ) {
			if ( post_type_supports( $post_type, $support ) ) {
				remove_post_type_support( $post_type, $support );
			}
		}
	}

	/**
	 * Adds allowed redirect hosts for `wp_safe_redirect`
	 *
	 * @param array $hosts Current allowed hosts.
	 * @return array
	 */
	public function add_allowed_redirect_hosts( array $hosts ): array {
		$allowed_hosts = array(
			'choctawnation.com',
			'www.choctawnation.com',
		);
		return array_merge( $hosts, $allowed_hosts );
	}

	/**
	 * Handle speculative loading
	 *
	 * @since WP 6.8.0
	 * @link https://make.wordpress.org/core/2025/03/06/speculative-loading-in-6-8/
	 *
	 * @param ?array $config the configuration array. Null if user is logged-in.
	 * @return ?array The new config file, or null
	 */
	public function handle_speculative_loading( ?array $config ): ?array {
		if ( is_array( $config ) ) {
			$config['mode']      = 'auto';
			$config['eagerness'] = 'moderate';
		}
		return $config;
	}

	/**
	 * Add resource hints for Typekit
	 *
	 * @param array  $hints         The array of resource hints.
	 * @param string $relation_type The relation type the hints are for.
	 * @return array The modified array of resource hints.
	 */
	public function add_resource_hints( array $hints, string $relation_type ) {
		if ( 'preconnect' === $relation_type ) {
			$hints[] = array(
				'href'        => 'https://use.typekit.net',
				'crossorigin' => 'anonymous',
			);
		}
		return $hints;
	}

	/**
	 * Preload specific stylesheets
	 *
	 * @param string $html   The link tag HTML.
	 * @param string $handle The style handle.
	 * @param string $href   The stylesheet URL.
	 * @return string The modified link tag HTML.
	 */
	public function preload_stylesheets( string $html, string $handle, string $href ): string {
		$preload_handles = array(
			'typekit'   => 'external',
			'bootstrap' => null,
		);
		if ( in_array( $handle, array_keys( $preload_handles ), true ) ) {
			$is_crossorigin = 'external' === $preload_handles[ $handle ];
			// Add a preload link before the stylesheet link.
			$preload = sprintf(
				"<link rel='preload' as='style' href='%s' %s />\n",
				$href,
				$is_crossorigin ? 'crossorigin="anonymous"' : ''
			);
			// Add crossorigin attribute if needed.
			if ( $is_crossorigin && ! str_contains( $html, 'crossorigin' ) ) {
				$html = str_replace( "/>\n", ' crossorigin="anonymous" />' . "\n", $html );
			}
			$html = $preload . $html;
		}
		return $html;
	}
}
