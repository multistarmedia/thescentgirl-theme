<?php
/**
 * Social share meta (Open Graph + Twitter cards).
 *
 * Skipped automatically when a known SEO plugin is active so tags are not duplicated.
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether an SEO plugin already outputs social meta.
 *
 * @return bool
 */
function tsg_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' )            // Yoast.
		|| class_exists( 'RankMath' )             // Rank Math.
		|| defined( 'AIOSEO_VERSION' )            // All in One SEO.
		|| defined( 'SEOPRESS_VERSION' )          // SEOPress.
		|| defined( 'THE_SEO_FRAMEWORK_VERSION' ); // The SEO Framework.
}

/**
 * Share image for the current request.
 *
 * Order: featured image → product/category image → Customizer share image → site icon.
 *
 * @return string
 */
function tsg_share_image() {
	$size   = 'large';
	$custom = tsg_get_option( 'share_image', '' );

	// On the homepage / PPC landing a purpose-made share image beats the category tile.
	if ( $custom && ( is_front_page() || is_page_template( 'page-templates/ppc-landing.php' ) ) ) {
		return $custom;
	}

	if ( is_singular() && has_post_thumbnail() ) {
		$url = get_the_post_thumbnail_url( null, $size );
		if ( $url ) {
			return $url;
		}
	}

	if ( is_singular( 'product' ) && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( get_queried_object_id() );
		if ( $product ) {
			$url = wp_get_attachment_image_url( $product->get_image_id(), $size );
			if ( ! $url ) {
				$url = get_post_meta( $product->get_id(), '_tsg_image_url', true );
			}
			if ( $url ) {
				return $url;
			}
		}
	}

	$term = null;
	if ( is_tax( 'product_cat' ) ) {
		$term = get_queried_object();
	} elseif ( is_front_page() || is_page_template( 'page-templates/ppc-landing.php' ) ) {
		$term = tsg_get_primary_category();
	}
	if ( $term instanceof WP_Term && function_exists( 'wc_placeholder_img_src' ) ) {
		$url = tsg_get_term_image_url( $term, $size );
		if ( $url && $url !== wc_placeholder_img_src( $size ) ) {
			return $url;
		}
	}

	if ( $custom ) {
		return $custom;
	}

	$icon = get_site_icon_url( 512 );
	return $icon ? $icon : '';
}

/**
 * Share description for the current request.
 *
 * @return string
 */
function tsg_share_description() {
	$text = '';

	if ( is_singular() ) {
		$text = get_the_excerpt();
	} elseif ( is_tax( 'product_cat' ) ) {
		$text = term_description();
	} elseif ( is_front_page() ) {
		$term = tsg_get_primary_category();
		$text = $term ? $term->description : '';
	}

	if ( ! $text ) {
		$text = get_bloginfo( 'description', 'display' );
	}

	return wp_trim_words( wp_strip_all_tags( $text ), 40, '…' );
}

/**
 * Canonical URL for the current request.
 *
 * @return string
 */
function tsg_share_url() {
	if ( is_singular() ) {
		return get_permalink();
	}
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_tax() || is_category() || is_tag() ) {
		$link = get_term_link( get_queried_object() );
		return is_wp_error( $link ) ? home_url( '/' ) : $link;
	}
	global $wp;
	return home_url( add_query_arg( array(), $wp->request ) );
}

/**
 * Output the tags.
 */
function tsg_output_social_meta() {
	if ( tsg_seo_plugin_active() || is_admin() || is_404() ) {
		return;
	}

	$title = wp_get_document_title();
	$desc  = tsg_share_description();
	$url   = tsg_share_url();
	$image = tsg_share_image();
	$type  = is_singular() && ! is_front_page() ? 'article' : 'website';

	$tags = array(
		'og:site_name'    => get_bloginfo( 'name', 'display' ),
		'og:type'         => $type,
		'og:title'        => $title,
		'og:description'  => $desc,
		'og:url'          => $url,
		'og:locale'       => get_locale(),
		'twitter:card'    => $image ? 'summary_large_image' : 'summary',
		'twitter:title'   => $title,
		'twitter:description' => $desc,
	);

	if ( $image ) {
		$tags['og:image']      = $image;
		$tags['twitter:image'] = $image;
		if ( 0 === strpos( $image, 'https://' ) ) {
			$tags['og:image:secure_url'] = $image;
		}
	}

	echo "\n<!-- The Scent Girl social meta -->\n";
	if ( $desc ) {
		printf( '<meta name="description" content="%s" />' . "\n", esc_attr( $desc ) );
	}
	foreach ( $tags as $key => $value ) {
		if ( '' === $value ) {
			continue;
		}
		$attr = 0 === strpos( $key, 'twitter:' ) ? 'name' : 'property';
		printf( '<meta %s="%s" content="%s" />' . "\n", $attr, esc_attr( $key ), esc_attr( $value ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'tsg_output_social_meta', 5 );
