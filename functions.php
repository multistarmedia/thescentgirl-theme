<?php
/**
 * The Scent Girl — WooCommerce catalog theme.
 *
 * Recreates the Scentsy Warmers & Wax category experience using
 * WordPress + WooCommerce product categories and products.
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TSG_VERSION', '1.0.0' );
define( 'TSG_DIR', get_template_directory() );
define( 'TSG_URI', get_template_directory_uri() );

require_once TSG_DIR . '/inc/defaults.php';
require_once TSG_DIR . '/inc/customizer.php';
require_once TSG_DIR . '/inc/settings.php';
require_once TSG_DIR . '/inc/catalog-meta.php';
require_once TSG_DIR . '/inc/external-cart.php';
require_once TSG_DIR . '/inc/woocommerce.php';
require_once TSG_DIR . '/inc/demo-catalog.php';
require_once TSG_DIR . '/inc/nav.php';

/**
 * Theme supports.
 */
function tsg_setup() {
	load_theme_textdomain( 'the-scent-girl', TSG_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary'        => __( 'Primary', 'the-scent-girl' ),
			'footer_life'    => __( 'Footer — Scentsy life', 'the-scent-girl' ),
			'footer_helpful' => __( 'Footer — Helpful links', 'the-scent-girl' ),
		)
	);

	add_image_size( 'tsg-category-tile', 600, 600, true );
	add_image_size( 'tsg-product-card', 600, 600, true );
	add_image_size( 'tsg-gallery-tall', 720, 1280, true );
	add_image_size( 'tsg-gallery-wide', 960, 504, true );
}
add_action( 'after_setup_theme', 'tsg_setup' );

/**
 * Assets.
 */
function tsg_assets() {
	wp_enqueue_style( 'tsg-typekit-gotham', 'https://use.typekit.net/fqf3ejs.css', array(), null );
	wp_enqueue_style( 'tsg-typekit-club', 'https://use.typekit.net/wcn8zzy.css', array(), null );
	wp_enqueue_style( 'tsg-theme', TSG_URI . '/assets/css/theme.css', array( 'tsg-typekit-gotham' ), TSG_VERSION );
	wp_enqueue_style( 'tsg-woocommerce', TSG_URI . '/assets/css/woocommerce.css', array( 'tsg-theme' ), TSG_VERSION );
	wp_enqueue_style( 'tsg-style', get_stylesheet_uri(), array( 'tsg-woocommerce' ), TSG_VERSION );
	wp_enqueue_script( 'tsg-theme', TSG_URI . '/assets/js/theme.js', array(), TSG_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'tsg_assets' );

/**
 * Theme mod helper.
 *
 * @param string $key     Option key without tsg_ prefix.
 * @param mixed  $default Fallback.
 * @return mixed
 */
function tsg_get_option( $key, $default = '' ) {
	$defaults = tsg_default_options();
	if ( '' === $default && isset( $defaults[ $key ] ) ) {
		$default = $defaults[ $key ];
	}
	return get_theme_mod( 'tsg_' . $key, $default );
}

/**
 * Whether WooCommerce is active.
 */
function tsg_is_woocommerce() {
	return class_exists( 'WooCommerce' );
}

/**
 * Primary Warmers & Wax category term (from Customizer slug).
 *
 * @return WP_Term|null
 */
function tsg_get_primary_category() {
	if ( ! tsg_is_woocommerce() ) {
		return null;
	}
	$slug = tsg_get_option( 'primary_category_slug', 'warmers-and-wax' );
	$term = get_term_by( 'slug', $slug, 'product_cat' );
	return ( $term && ! is_wp_error( $term ) ) ? $term : null;
}

/**
 * Child product categories for tiles (Wax Bars, Warmers, etc.).
 *
 * @param int $parent_id Parent term ID.
 * @return WP_Term[]
 */
function tsg_get_category_children( $parent_id ) {
	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'parent'     => (int) $parent_id,
			'hide_empty' => false,
			'orderby'    => 'menu_order',
			'order'      => 'ASC',
		)
	);
	return ( is_array( $terms ) && ! is_wp_error( $terms ) ) ? $terms : array();
}

/**
 * Category thumbnail URL (WooCommerce thumbnail or placeholder).
 *
 * @param WP_Term $term Category.
 * @param string  $size Image size.
 * @return string
 */
function tsg_get_term_image_url( $term, $size = 'tsg-category-tile' ) {
	$thumb_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
	if ( $thumb_id ) {
		$url = wp_get_attachment_image_url( (int) $thumb_id, $size );
		if ( $url ) {
			return $url;
		}
	}
	$external = get_term_meta( $term->term_id, 'tsg_image_url', true );
	if ( $external ) {
		return esc_url_raw( $external );
	}
	return wc_placeholder_img_src( $size );
}

/**
 * Body classes.
 *
 * @param string[] $classes Classes.
 * @return string[]
 */
function tsg_body_classes( $classes ) {
	$classes[] = 'tsg-theme';
	if ( tsg_is_woocommerce() ) {
		$classes[] = 'tsg-woocommerce';
	}
	return $classes;
}
add_filter( 'body_class', 'tsg_body_classes' );
