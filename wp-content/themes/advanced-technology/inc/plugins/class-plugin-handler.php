<?php
/**
 * Class: Plugin Handler
 *
 * @package ChoctawNation
 */

namespace ChoctawNation\Plugins;

/**
 * Handles plugin functionality
 */
class Plugin_Handler {
	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'disable_plugins_per_environment' ) );
		add_filter( 'auto_update_plugin', array( $this, 'handle_auto_update_plugin' ) );
		$this->handle_acf();
		$this->handle_gravity_forms();
		$this->handle_yoast();
	}

	/**
	 * Disable certain plugins based on the environment type.
	 */
	public function disable_plugins_per_environment() {
		$env = wp_get_environment_type();
		if ( 'production' === $env ) {
			return;
		}

		$plugins_to_disable = array(
			'wordfence/wordfence.php'                 => array( 'local', 'development', 'staging' ),
			'wp-mail-smtp-pro/wp_mail_smtp.php'       => array( 'local', 'development', 'staging' ),
			'google-site-kit/google-site-kit.php'     => array( 'local', 'development', 'staging' ),
			'autoupdater/autoupdater.php'             => array( 'local', 'development', 'staging' ),
			'autoptimize/autoptimize.php'             => array( 'local', 'development' ),
			'wordpress-seo/wp-seo.php'                => array( 'local', 'development' ),
			'yoast-test-helper/yoast-test-helper.php' => array( 'local', 'development' ),
		);

		foreach ( $plugins_to_disable as $plugin => $environments ) {
			if ( in_array( $env, $environments, true ) ) {
				if ( is_plugin_active( $plugin ) ) {
					deactivate_plugins( $plugin );
				}
			}
		}
	}

	/**
	 * Handle automatic plugin updates based on environment.
	 *
	 * @param ?bool $update Whether to update the plugin.
	 * @return ?bool
	 */
	public function handle_auto_update_plugin( ?bool $update ): ?bool {
		if ( 'production' === wp_get_environment_type() ) {
			return $update;
		}
		return true;
	}

	/**
	 * Handle ACF functionality, including saving and loading JSON files from the theme directory.
	 */
	private function handle_acf() {
		$acf = new ACF_Handler();
		$acf->init_save_filters();
		add_filter( 'acf/settings/load_json', array( $acf, 'load_json_paths' ) );
	}

	/**
	 * Handle Gravity Forms functionality, such as adding Bootstrap classes to buttons.
	 */
	private function handle_gravity_forms() {
		$gravity_forms_handler = new Gravity_Forms_Handler();
		add_filter( 'gform_submit_button', array( $gravity_forms_handler, 'add_bootstrap_classes' ) );
	}

	/**
	 * Handle Yoast SEO functionality, such as using the excerpt or ACF brief description as the meta description if none is set.
	 */
	private function handle_yoast() {
		$yoast_handler = new Yoast_Handler();
		add_filter( 'wpseo_metadesc', array( $yoast_handler, 'meta_description_handler' ) );
		add_filter( 'wpseo_metabox_prio', fn() => 'low' );
		add_filter( 'wpseo_sitemap_entries_per_page', array( $yoast_handler, 'max_entries_per_sitemap' ) );
	}
}