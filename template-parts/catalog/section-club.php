<?php
/**
 * Club / subscription strip.
 *
 * @package The_Scent_Girl
 */

$heading = tsg_get_option( 'club_heading' );
$btn     = tsg_get_option( 'club_button' );
$url     = tsg_get_option( 'club_url' );
if ( ! $url ) {
	$url = tsg_store_url( 'shop' );
}
?>
<section class="club" aria-label="<?php esc_attr_e( 'Club', 'the-scent-girl' ); ?>">
	<div class="wrap club-inner">
		<strong class="club-mark" style="font-family:HVAuckland,serif;font-size:1.35rem;color:var(--heading);">
			<?php bloginfo( 'name' ); ?> Club
		</strong>
		<span class="rule" aria-hidden="true"></span>
		<p><?php echo esc_html( $heading ); ?></p>
		<a class="btn" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $btn ); ?></a>
	</div>
</section>
