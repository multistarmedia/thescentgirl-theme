<?php
/**
 * External product URLs — hand off to JennB Scentsy (no WooCommerce cart).
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Meta keys / ACF names checked for External URL.
 *
 * @return string[]
 */
function tsg_external_url_meta_keys() {
	return array(
		'External URL',
		'external_url',
		'External_URL',
		'external-url',
		'_external_url',
		'product_external_url',
		'_product_url',
	);
}

/**
 * Get a product's External URL for JennB handoff.
 *
 * @param WC_Product|int|null $product Product or ID.
 * @return string Empty if none.
 */
function tsg_get_product_external_url( $product = null ) {
	if ( is_numeric( $product ) ) {
		$product = wc_get_product( $product );
	}
	if ( ! $product && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( get_the_ID() );
	}
	if ( ! $product ) {
		return '';
	}

	$id = $product->get_id();

	// WooCommerce External/Affiliate product type.
	if ( $product->is_type( 'external' ) && method_exists( $product, 'get_product_url' ) ) {
		$url = $product->get_product_url();
		if ( $url ) {
			return esc_url_raw( $url );
		}
	}

	foreach ( tsg_external_url_meta_keys() as $key ) {
		$value = get_post_meta( $id, $key, true );
		if ( is_string( $value ) && $value && filter_var( $value, FILTER_VALIDATE_URL ) ) {
			return esc_url_raw( $value );
		}
	}

	// ACF field by name (if ACF is active).
	if ( function_exists( 'get_field' ) ) {
		foreach ( array( 'External URL', 'external_url' ) as $field ) {
			$value = get_field( $field, $id );
			if ( is_string( $value ) && $value && filter_var( $value, FILTER_VALIDATE_URL ) ) {
				return esc_url_raw( $value );
			}
		}
	}

	return '';
}

/**
 * Default JennB base URL.
 */
function tsg_jennb_base() {
	$handoff = tsg_get_option( 'external_handoff_url', 'https://jennb.scentsy.us/shop/c/9811/warmers-and-wax' );
	$parts   = wp_parse_url( $handoff );
	if ( empty( $parts['scheme'] ) || empty( $parts['host'] ) ) {
		return 'https://jennb.scentsy.us';
	}
	return $parts['scheme'] . '://' . $parts['host'];
}

/**
 * Build a JennB site URL.
 *
 * @param string $path Path on jennb.scentsy.us.
 * @return string
 */
function tsg_jennb_url( $path = '' ) {
	$base = trailingslashit( tsg_jennb_base() );
	$path = ltrim( (string) $path, '/' );
	return $path ? $base . $path : untrailingslashit( $base );
}

/**
 * Official JennB footer links (from jennb.scentsy.us).
 *
 * @return array{life: array<string,string>, helpful: array<string,string>, consultant: array<string,string>, legal: array<string,string>}
 */
function tsg_jennb_footer_links() {
	return array(
		'consultant' => array(
			__( 'Bio', 'the-scent-girl' )     => tsg_jennb_url( 'consultant/bio' ),
			__( 'Contact', 'the-scent-girl' ) => tsg_jennb_url( 'consultant/contact' ),
		),
		'life'       => array(
			__( 'About Scentsy', 'the-scent-girl' )     => tsg_jennb_url( 'about' ),
			__( 'Scentsy Generosity', 'the-scent-girl' ) => tsg_jennb_url( 'generosity' ),
		),
		'helpful'    => array(
			__( 'Scentsy Club', 'the-scent-girl' )                    => tsg_jennb_url( 'scentsy-club' ),
			__( 'Shop popular catalog products', 'the-scent-girl' )   => tsg_jennb_url( 'new-scentsy-catalog-products' ),
			__( 'Download our catalog', 'the-scent-girl' )            => 'https://imagelive.scentsy.com/cmsimages/files/Catalog/2026/2026-R1-USEN-Catalog-4web.pdf',
			__( 'Charitable cause', 'the-scent-girl' )                => tsg_jennb_url( 'charitable-cause' ),
			__( 'Order status', 'the-scent-girl' )                    => tsg_jennb_url( 'account/track-order' ),
			__( 'Shipping, warranties and returns', 'the-scent-girl' ) => tsg_jennb_url( 'shipping-warranty-return-information' ),
			__( 'Account login', 'the-scent-girl' )                   => tsg_jennb_url( 'account/login' ),
			__( 'FAQ', 'the-scent-girl' )                             => tsg_jennb_url( 'frequently-asked-questions-and-fast-facts' ),
		),
		'legal'      => array(
			__( 'Privacy policy', 'the-scent-girl' ) => tsg_jennb_url( 'privacy-policy' ),
			__( 'Terms of use', 'the-scent-girl' )   => tsg_jennb_url( 'form/terms-of-use' ),
		),
	);
}

/**
 * Replace loop Add to Cart with External URL button.
 *
 * @param string     $html    Button HTML.
 * @param WC_Product $product Product.
 * @param array      $args    Args.
 * @return string
 */
function tsg_loop_add_to_cart_external( $html, $product, $args = array() ) {
	$url = tsg_get_product_external_url( $product );
	if ( ! $url ) {
		$url = tsg_jennb_url( 'shop/c/9811/warmers-and-wax' );
	}

	$label = ! empty( $args['cart_text'] ) ? $args['cart_text'] : __( 'Shop now', 'the-scent-girl' );
	// Prefer classic ATC wording when present.
	if ( ! empty( $args['class'] ) && false !== strpos( $html, 'Add to cart' ) ) {
		$label = __( 'Add to cart', 'the-scent-girl' );
	} else {
		$label = __( 'Add to cart', 'the-scent-girl' );
	}

	return sprintf(
		'<a href="%s" class="button product_type_external add_to_cart_button tsg-external-cart" target="_blank" rel="noopener noreferrer" aria-label="%s">%s</a>',
		esc_url( $url ),
		esc_attr( sprintf( /* translators: product name */ __( 'Shop %s on Scentsy', 'the-scent-girl' ), $product->get_name() ) ),
		esc_html( $label )
	);
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'tsg_loop_add_to_cart_external', 20, 3 );

/**
 * Single product: replace add-to-cart form with External URL CTA.
 */
function tsg_replace_single_add_to_cart() {
	if ( ! tsg_is_woocommerce() ) {
		return;
	}

	// Remove all default single add-to-cart outputs.
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

	add_action(
		'woocommerce_single_product_summary',
		function () {
			global $product;
			if ( ! $product ) {
				return;
			}
			$url = tsg_get_product_external_url( $product );
			if ( ! $url ) {
				$url = tsg_jennb_url( 'shop/c/9811/warmers-and-wax' );
			}
			printf(
				'<p class="tsg-external-cart-wrap"><a href="%s" class="single_add_to_cart_button button alt tsg-external-cart" target="_blank" rel="noopener noreferrer">%s</a></p>',
				esc_url( $url ),
				esc_html__( 'Add to cart', 'the-scent-girl' )
			);
		},
		30
	);
}
add_action( 'wp', 'tsg_replace_single_add_to_cart' );

/**
 * Force store chrome (header cart / account) to JennB — not Woo checkout.
 *
 * @param string $which cart|account|shop|wishlist.
 * @return string
 */
function tsg_store_url( $which = 'shop' ) {
	switch ( $which ) {
		case 'cart':
			return tsg_jennb_url( 'checkout/shopping-bag' );
		case 'account':
			return tsg_jennb_url( 'account/login' );
		case 'wishlist':
			return tsg_jennb_url( 'wishlist' );
		case 'shop':
		default:
			return tsg_jennb_url( 'shop/c/9811/warmers-and-wax' );
	}
}
