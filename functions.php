<?php
/**
 * Teste Nucleo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Teste Nucleo
 * @since Teste Nucleo 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'testeNucleo_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Teste Nucleo 1.0
	 * @return void
	 */
	function testeNucleo_pattern_categories() {

		register_block_pattern_category(
			'testeNucleo_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'testeNucleo' ),
				'description' => __( 'A collection of full page layouts.', 'testeNucleo' ),
			)
		);
	}
endif;

add_action( 'init', 'testeNucleo_pattern_categories' );

require "inc/aplication.php";
