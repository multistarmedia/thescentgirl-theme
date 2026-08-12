<?php
/**
 * Fallback primary menu from product categories.
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output a simple category menu when no Primary menu is set.
 */
function tsg_primary_fallback_menu() {
	echo '<ul class="menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'the-scent-girl' ) . '</a></li>';
	if ( tsg_is_woocommerce() ) {
		$primary = tsg_get_primary_category();
		if ( $primary ) {
			echo '<li><a href="' . esc_url( get_term_link( $primary ) ) . '">' . esc_html( $primary->name ) . '</a></li>';
			foreach ( tsg_get_category_children( $primary->term_id ) as $child ) {
				echo '<li><a href="' . esc_url( get_term_link( $child ) ) . '">' . esc_html( $child->name ) . '</a></li>';
			}
		} else {
			echo '<li><a href="' . esc_url( tsg_store_url( 'shop' ) ) . '">' . esc_html__( 'Shop', 'the-scent-girl' ) . '</a></li>';
		}
	}
	echo '</ul>';
}
