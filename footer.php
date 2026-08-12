<?php
/**
 * Footer — JennB Scentsy links (handoff site).
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$links = tsg_jennb_footer_links();
?>
<footer class="site-footer">
	<div class="wrap footer-grid">
		<div>
			<div class="footer-brand">
				<?php
				$logo = tsg_get_option( 'logo_white_url' );
				if ( $logo ) :
					?>
					<img src="<?php echo esc_url( $logo ); ?>" alt="Scentsy" width="160" height="41" />
				<?php endif; ?>
				<span class="logo-tag"><?php echo esc_html( tsg_get_option( 'logo_tagline' ) ); ?></span>
			</div>
			<div class="consultant-card">
				<?php
				$photo = tsg_get_option( 'consultant_photo' );
				if ( $photo ) :
					?>
					<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( tsg_get_option( 'consultant_name' ) ); ?>" width="180" height="180" loading="lazy" />
				<?php endif; ?>
				<div>
					<div class="name"><?php echo esc_html( tsg_get_option( 'consultant_name' ) ); ?></div>
					<div class="stars" aria-label="<?php esc_attr_e( '5 stars', 'the-scent-girl' ); ?>">★★★★★</div>
					<div class="title"><?php echo esc_html( tsg_get_option( 'consultant_title' ) ); ?></div>
					<div class="links">
						<?php foreach ( $links['consultant'] as $label => $url ) : ?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-col">
			<h4><?php esc_html_e( 'Scentsy life', 'the-scent-girl' ); ?></h4>
			<?php foreach ( $links['life'] as $label => $url ) : ?>
				<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
			<?php endforeach; ?>
		</div>

		<div class="footer-col">
			<h4><?php esc_html_e( 'Helpful links', 'the-scent-girl' ); ?></h4>
			<?php foreach ( $links['helpful'] as $label => $url ) : ?>
				<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
			<?php endforeach; ?>
		</div>
	</div>
</footer>

<div class="legal-bar">
	<div class="wrap">
		<div>
			<?php foreach ( $links['legal'] as $label => $url ) : ?>
				<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?></a>
			<?php endforeach; ?>
			<span>Copyright <?php echo esc_html( gmdate( 'Y' ) ); ?> Scentsy, Inc</span>
		</div>
	</div>
</div>

<?php
$coupon = tsg_get_option( 'coupon_label' );
if ( $coupon ) :
	?>
	<a class="coupon-chip" href="<?php echo esc_url( tsg_jennb_url( 'shop/c/9811/warmers-and-wax' ) ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $coupon ); ?></a>
	<?php
endif;
?>

<?php wp_footer(); ?>
</body>
</html>
