<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Hpcdd
 * @subpackage Hpcdd/includes
 * @author     Milen Karaganski <milenmk@gmail.com>
 */
class Hpcdd_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'hpcdd',
			false,
			dirname(plugin_basename(__FILE__), 2) . '/languages/'
		);

	}



}
