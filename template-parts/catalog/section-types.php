<?php
/**
 * What’s your type — driven by pa_warmer-type attribute + products.
 *
 * @package The_Scent_Girl
 */

$term = $args['term'] ?? null;
if ( ! $term instanceof WP_Term ) {
	return;
}

$heading = tsg_term_meta( $term->term_id, 'tsg_types_heading', __( "What's your type?", 'the-scent-girl' ) );
$sub     = tsg_term_meta( $term->term_id, 'tsg_types_sub', __( 'All warmers melt our signature scented wax — in a variety of ways', 'the-scent-girl' ) );

$types = array(
	array(
		'slug'  => 'standard',
		'jennb' => 'Standard',
		'title' => __( 'Standard Warmers', 'the-scent-girl' ),
		'blurb' => __( 'Standard Warmers melt wax with the heat of a low-watt bulb, enlivening a room with candle-like ambience.', 'the-scent-girl' ),
		'btn'   => __( 'Shop standard Warmers', 'the-scent-girl' ),
	),
	array(
		'slug'  => 'element',
		'jennb' => 'Element',
		'title' => __( 'Element Warmers', 'the-scent-girl' ),
		'blurb' => __( 'Element Warmers feature heating elements to warm wax without a light bulb.', 'the-scent-girl' ),
		'btn'   => __( 'Shop element Warmers', 'the-scent-girl' ),
	),
	array(
		'slug'  => 'mini-warmers',
		'jennb' => 'Mini Warmers',
		'title' => __( 'Mini Warmers', 'the-scent-girl' ),
		'blurb' => __( 'Mini Warmers plug into the wall or sit on a Mini Warmer Tabletop Base so you can enjoy fragrance in smaller spaces.', 'the-scent-girl' ),
		'btn'   => __( 'Shop Mini Warmers', 'the-scent-girl' ),
	),
);

$any = false;
foreach ( $types as $type ) {
	if ( tsg_products_by_warmer_type( $type['slug'], 1 ) ) {
		$any = true;
		break;
	}
}
if ( ! $any && ! taxonomy_exists( 'pa_warmer-type' ) ) {
	return;
}
?>
<section class="section" aria-labelledby="types-title">
	<div class="wrap">
		<div class="types-intro">
			<h2 id="types-title"><?php echo esc_html( $heading ); ?></h2>
			<div class="accent" aria-hidden="true"></div>
			<p><?php echo esc_html( $sub ); ?></p>
		</div>
		<div class="types-grid">
			<?php foreach ( $types as $type ) : ?>
				<?php
				$products = tsg_products_by_warmer_type( $type['slug'], 1 );
				$product  = $products[0] ?? null;
				$img      = '';
				if ( $product ) {
					$img = wp_get_attachment_image_url( $product->get_image_id(), 'tsg-product-card' );
					if ( ! $img ) {
						$img = get_post_meta( $product->get_id(), '_tsg_image_url', true );
					}
				}
				// Prefer the external Warmers category on JennB, filtered by warmer type.
				$warmers  = get_term_by( 'slug', 'warmers', 'product_cat' );
				$external = ( $warmers && ! is_wp_error( $warmers ) ) ? tsg_term_meta( $warmers->term_id, 'tsg_external_url' ) : '';
				if ( $external ) {
					$archive = tsg_handoff_url( add_query_arg( 'Warmer Type', $type['jennb'], esc_url_raw( $external ) ) );
				} else {
					$archive = get_term_link( $type['slug'], 'pa_warmer-type' );
					if ( is_wp_error( $archive ) ) {
						$archive = tsg_get_category_link( ( $warmers && ! is_wp_error( $warmers ) ) ? $warmers : $term );
					}
				}
				?>
				<article class="type-card">
					<?php if ( $img ) : ?>
						<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $type['title'] ); ?>" width="600" height="600" loading="lazy" />
					<?php endif; ?>
					<h3><?php echo esc_html( $type['title'] ); ?></h3>
					<p><?php echo esc_html( $type['blurb'] ); ?></p>
					<a class="btn" href="<?php echo esc_url( $archive ); ?>"><?php echo esc_html( $type['btn'] ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
