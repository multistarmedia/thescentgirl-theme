<?php
/**
 * Décor gallery section from category meta.
 *
 * @package The_Scent_Girl
 */

$term   = $args['term'] ?? null;
if ( ! $term instanceof WP_Term ) {
	return;
}

$images  = tsg_get_decor_images( $term->term_id );
$heading = tsg_term_meta( $term->term_id, 'tsg_decor_heading', __( 'Décor that delights', 'the-scent-girl' ) );
$sub     = tsg_term_meta( $term->term_id, 'tsg_decor_sub', __( 'Discover the latest designs', 'the-scent-girl' ) );
$btn     = tsg_term_meta( $term->term_id, 'tsg_decor_btn', __( 'See more', 'the-scent-girl' ) );
$btn_url = tsg_term_meta( $term->term_id, 'tsg_decor_btn_url', '' );

if ( ! $btn_url ) {
	$children = tsg_get_category_children( $term->term_id );
	$btn_url  = $children ? get_term_link( $children[0] ) : get_term_link( $term );
}

if ( ! $images ) {
	return;
}
?>
<section class="section" aria-labelledby="decor-title">
	<div class="wrap">
		<div class="section-rule-head">
			<h2 id="decor-title"><?php echo esc_html( $heading ); ?></h2>
			<span class="rule" aria-hidden="true"></span>
			<p class="sub"><?php echo esc_html( $sub ); ?></p>
			<div class="actions">
				<a class="btn" href="<?php echo esc_url( $btn_url ); ?>"><?php echo esc_html( $btn ); ?></a>
			</div>
		</div>
		<div class="decor-grid">
			<?php foreach ( $images as $src ) : ?>
				<figure>
					<img src="<?php echo esc_url( $src ); ?>" alt="" loading="lazy" />
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
