<?php
/**
 * Gravity Forms Handler
 *
 * @package ChoctawNation
 * @subpackage Gravity Forms
 */

namespace ChoctawNation\Plugins;

/**
 * Gravity Forms Handler
 */
class Gravity_Forms_Handler {
	/**
	 * Add Bootstrap classes to Gravity Forms buttons.
	 *
	 * @param string $button The button HTML.
	 * @return string The modified button HTML.
	 */
	public function add_bootstrap_classes( string $button ): string {
		$fragment = \WP_HTML_Processor::create_fragment( $button );
		$fragment->next_token();
		$fragment->add_class( 'btn-menu' );
		return $fragment->get_updated_html();
	}
}
