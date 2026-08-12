<?php
/**
 * WordPress Settings — JennB handoff (Party ID).
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register settings.
 */
function tsg_register_settings() {
	register_setting(
		'tsg_jennb_handoff',
		'tsg_party_id',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'tsg_sanitize_party_id',
			'default'           => '',
		)
	);
}
add_action( 'admin_init', 'tsg_register_settings' );

/**
 * Sanitize Party ID — digits only.
 *
 * @param string $value Raw value.
 * @return string
 */
function tsg_sanitize_party_id( $value ) {
	return preg_replace( '/\D/', '', (string) $value );
}

/**
 * Settings page under Settings menu.
 */
function tsg_settings_menu() {
	add_options_page(
		__( 'JennB Handoff', 'the-scent-girl' ),
		__( 'JennB Handoff', 'the-scent-girl' ),
		'manage_options',
		'tsg-jennb-handoff',
		'tsg_settings_page_render'
	);
}
add_action( 'admin_menu', 'tsg_settings_menu' );

/**
 * Settings page markup.
 */
function tsg_settings_page_render() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$party_id = tsg_get_party_id();
	$example  = 'https://jennb.scentsy.us/shop/p/114245/pumpkin-oak-scentsy-pod-twin-pack?partyId=19607365';
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'JennB Handoff', 'the-scent-girl' ); ?></h1>
		<p><?php esc_html_e( 'All outbound links to jennb.scentsy.us automatically include your Party ID so orders credit the correct party.', 'the-scent-girl' ); ?></p>
		<form method="post" action="options.php">
			<?php settings_fields( 'tsg_jennb_handoff' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row">
						<label for="tsg_party_id"><?php esc_html_e( 'Party ID', 'the-scent-girl' ); ?></label>
					</th>
					<td>
						<input
							type="text"
							id="tsg_party_id"
							name="tsg_party_id"
							value="<?php echo esc_attr( $party_id ); ?>"
							class="regular-text"
							inputmode="numeric"
							pattern="[0-9]*"
							placeholder="19607365"
						/>
						<p class="description">
							<?php esc_html_e( 'Example: entering 19607365 appends ?partyId=19607365 to every JennB link.', 'the-scent-girl' ); ?>
						</p>
						<?php if ( $party_id ) : ?>
							<p class="description">
								<strong><?php esc_html_e( 'Preview:', 'the-scent-girl' ); ?></strong>
								<code><?php echo esc_html( tsg_handoff_url( 'https://jennb.scentsy.us/shop/p/114245/pumpkin-oak-scentsy-pod-twin-pack' ) ); ?></code>
							</p>
						<?php else : ?>
							<p class="description">
								<code><?php echo esc_html( $example ); ?></code>
							</p>
						<?php endif; ?>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Current Party ID (empty string if unset).
 *
 * @return string
 */
function tsg_get_party_id() {
	return tsg_sanitize_party_id( get_option( 'tsg_party_id', '' ) );
}

/**
 * Whether a URL points at the JennB consultant site.
 *
 * @param string $url URL.
 * @return bool
 */
function tsg_is_jennb_url( $url ) {
	if ( ! is_string( $url ) || '' === $url ) {
		return false;
	}
	$host = wp_parse_url( $url, PHP_URL_HOST );
	if ( ! $host ) {
		return false;
	}
	$host = strtolower( $host );
	return 'jennb.scentsy.us' === $host || str_ends_with( $host, '.scentsy.us' );
}

/**
 * Append partyId to JennB URLs (no-op for other hosts).
 *
 * @param string $url Original URL.
 * @return string
 */
function tsg_handoff_url( $url ) {
	if ( ! $url || ! tsg_is_jennb_url( $url ) ) {
		return $url;
	}

	$party_id = tsg_get_party_id();
	if ( '' === $party_id ) {
		return $url;
	}

	// Replace existing partyId if present.
	$url = remove_query_arg( 'partyId', $url );

	return add_query_arg( 'partyId', $party_id, $url );
}

/**
 * Product handoff URL: External URL meta + Party ID.
 *
 * @param WC_Product|int|null $product Product.
 * @param string              $fallback_path JennB path if no external URL.
 * @return string
 */
function tsg_get_product_handoff_url( $product = null, $fallback_path = 'shop/c/9811/warmers-and-wax' ) {
	$url = tsg_get_product_external_url( $product );
	if ( ! $url ) {
		$url = tsg_jennb_url( $fallback_path );
	}
	return tsg_handoff_url( $url );
}
