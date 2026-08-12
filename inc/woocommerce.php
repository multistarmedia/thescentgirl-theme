<?php
/**
 * WooCommerce integration — catalog-driven layout.
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Declare WooCommerce support extras and loop columns.
 */
function tsg_woocommerce_setup() {
	if ( ! tsg_is_woocommerce() ) {
		return;
	}

	// Match Scentsy-style dense catalog grids.
	add_filter( 'loop_shop_columns', function () {
		return 4;
	} );
	add_filter( 'loop_shop_per_page', function () {
		return 24;
	}, 20 );

	// Remove default Woo wrappers; theme provides chrome.
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	// Category page: custom intro instead of default title block when marketing layout.
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}
add_action( 'after_setup_theme', 'tsg_woocommerce_setup', 20 );

/**
 * Theme content wrappers.
 */
function tsg_wc_wrapper_start() {
	echo '<main id="primary" class="site-main tsg-shop">';
}
function tsg_wc_wrapper_end() {
	echo '</main>';
}
add_action( 'woocommerce_before_main_content', 'tsg_wc_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'tsg_wc_wrapper_end', 10 );

/**
 * Use Scentsy-style product card markup.
 */
function tsg_product_card_open() {
	echo '<div class="tsg-product-card-inner">';
}
function tsg_product_card_close() {
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item', 'tsg_product_card_open', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'tsg_product_card_close', 50 );

/**
 * Products that match a Warmer Type attribute (Standard / Element / Mini).
 *
 * @param string $type Attribute term slug or name.
 * @param int    $limit Max products.
 * @return WC_Product[]
 */
function tsg_products_by_warmer_type( $type, $limit = 1 ) {
	if ( ! tsg_is_woocommerce() ) {
		return array();
	}
	$query = new WP_Query(
		array(
			'post_type'      => 'product',
			'posts_per_page' => $limit,
			'post_status'    => 'publish',
			'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				array(
					'taxonomy' => 'pa_warmer-type',
					'field'    => 'slug',
					'terms'    => sanitize_title( $type ),
				),
			),
		)
	);
	$products = array();
	foreach ( $query->posts as $post ) {
		$product = wc_get_product( $post );
		if ( $product ) {
			$products[] = $product;
		}
	}
	wp_reset_postdata();
	return $products;
}

/**
 * Whether current product_cat should use the Scentsy marketing landing.
 *
 * @param WP_Term|null $term Term.
 * @return bool
 */
function tsg_category_has_marketing( $term = null ) {
	if ( ! $term ) {
		$term = get_queried_object();
	}
	if ( ! $term instanceof WP_Term || 'product_cat' !== $term->taxonomy ) {
		return false;
	}
	$flag = tsg_term_meta( $term->term_id, 'tsg_show_marketing', '' );
	if ( 'no' === strtolower( $flag ) ) {
		return false;
	}
	// Auto-enable for primary category or any category with décor images / children.
	if ( 'yes' === strtolower( $flag ) ) {
		return true;
	}
	$primary = tsg_get_primary_category();
	if ( $primary && (int) $primary->term_id === (int) $term->term_id ) {
		return true;
	}
	$children = tsg_get_category_children( $term->term_id );
	return count( $children ) > 0 || (bool) tsg_term_meta( $term->term_id, 'tsg_decor_images' );
}

// tsg_store_url() lives in inc/external-cart.php (always points to JennB).
