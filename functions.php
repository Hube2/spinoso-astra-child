<?php
	/**
	 * Astra Child Theme functions and definitions
	 *
	 * @link https://developer.wordpress.org/themes/basics/theme-functions/
	 *
	 * @package Astra Child
	 * @since 1.0.0
	 */

	/**
	 * Define Constants
	 */
	define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

	/**
	 * Enqueue styles
	 */
	function child_enqueue_styles() {
		wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	}
	add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );
	
	// modify the atra portfolio post type to set with_front to false
	add_filter('register_post_type_args', 'astra_portfolio_post_type_not_with_front', 20, 2);
	function astra_portfolio_post_type_not_with_front($args, $post_type) {
		if ($post_type == 'astra-portfolio') {
			if (empty($args['rewrite'])) {
				$args['rewrite'] = array();
			}
			$args['rewrite']['with_front'] = false;
		}
		return $args;
	}
	
	// modify the atra portfolio taxonomies to set with_front to false
	add_filter('register_taxonomy_args', 'astra_portfolio_taxonomy_mods', 20, 2);
	function astra_portfolio_taxonomy_mods($args, $taxonomy) {
		if (in_array($taxonomy, array('astra-portfolio-categories','astra-portfolio-other-categories','astra-portfolio-tags'))) {
			$args['rewrite']['with_front'] = false;
		}
		return $args;
	}

	// disable automatic them and plugin updates	
	add_filter('auto_update_plugin', '__return_false');
	add_filter('auto_update_theme', '__return_false');
	
	// disable admin email check
	add_filter('admin_email_check_interval', '__return_false');
	
	// anyone that can edit this site can put anything they wantinto ACF fields
	add_filter('acf/shortcode/allow_unsafe_html', 'allow_unsafe_html_in_acf', 20, 1);
	add_filter('acf/the_field/allow_unsafe_html', 'allow_unsafe_html_in_acf', 20, 1);
	function allow_unsafe_html_in_acf($allowed) {
		return true;
	}