<?php
/**
 * How it works — from category meta.
 *
 * @package The_Scent_Girl
 */

$term = $args['term'] ?? null;
if ( ! $term instanceof WP_Term ) {
	return;
}

$steps   = tsg_get_how_steps( $term->term_id );
$heading = tsg_term_meta( $term->term_id, 'tsg_how_heading', __( 'How it works', 'the-scent-girl' ) );

if ( ! $steps ) {
	return;
}
?>
<section class="how" aria-labelledby="how-title">
	<div class="wrap">
		<h2 id="how-title"><?php echo esc_html( $heading ); ?></h2>
		<div class="accent" aria-hidden="true"></div>
		<div class="steps">
			<?php foreach ( $steps as $i => $step ) : ?>
				<article class="step">
					<img src="<?php echo esc_url( $step['image'] ); ?>" alt="" width="600" height="600" loading="lazy" />
					<div class="step-num"><?php echo esc_html( (string) ( $i + 1 ) ); ?></div>
					<p><?php echo esc_html( $step['label'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
