<?php
/**
 * Fragrance banner — from category meta / child Wax Bars link.
 *
 * @package The_Scent_Girl
 */

$term = $args['term'] ?? null;
if ( ! $term instanceof WP_Term ) {
	return;
}

$heading = tsg_term_meta( $term->term_id, 'tsg_fragrance_heading', __( 'World class fragrance', 'the-scent-girl' ) );
$sub     = tsg_term_meta( $term->term_id, 'tsg_fragrance_sub', '' );
$image   = tsg_term_meta( $term->term_id, 'tsg_fragrance_image', '' );
$btn     = tsg_term_meta( $term->term_id, 'tsg_fragrance_btn', __( 'Shop fragrance', 'the-scent-girl' ) );
$btn_url = tsg_term_meta( $term->term_id, 'tsg_fragrance_url', '' );

if ( ! $btn_url ) {
	$wax     = get_term_by( 'slug', 'wax-bars', 'product_cat' );
	$btn_url = tsg_get_category_link( ( $wax && ! is_wp_error( $wax ) ) ? $wax : $term );
} else {
	$btn_url = tsg_handoff_url( $btn_url );
}

if ( ! $image ) {
	return;
}
?>
<section aria-labelledby="fragrance-title">
	<div class="wrap fragrance-head">
		<div class="section-rule-head">
			<h2 id="fragrance-title"><?php echo esc_html( $heading ); ?></h2>
			<span class="rule" aria-hidden="true"></span>
			<?php if ( $sub ) : ?>
				<p class="sub"><?php echo esc_html( $sub ); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<div class="fragrance-banner">
		<img src="<?php echo esc_url( $image ); ?>" alt="" loading="lazy" />
		<a class="btn btn-light" href="<?php echo esc_url( $btn_url ); ?>"><?php echo esc_html( $btn ); ?></a>
	</div>
</section>
