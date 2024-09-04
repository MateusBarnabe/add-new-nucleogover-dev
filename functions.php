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


function create_default_pages() {

    $default_pages = [
        [
            'title'    => 'Noticias',
            'slug'     => 'noticias',
            'template' => 'page-noticias'
        ]
    ];

    foreach ( $default_pages as $page ) {
        $page_exists = get_page_by_path( $page['slug'] );

        if ( ! $page_exists ) {
            $page_data = array(
                'post_title'  => $page['title'],
                'post_status' => 'publish',
                'post_type'   => 'page',
                'post_name'   => $page['slug'],
            );

            $page_id = wp_insert_post( $page_data );

            if ( ! is_wp_error( $page_id ) ) {
                update_post_meta( $page_id, '_wp_page_template', $page['template'] );
            } else {
                echo 'Error creating/updating page: ' . $page_id->get_error_message();
            }
        }
    }
}

add_action( 'after_setup_theme', 'create_default_pages' );
