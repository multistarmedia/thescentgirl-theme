<?php
/**
 * Product category marketing meta for Scentsy-style category landings.
 *
 * Stores décor gallery, how-it-works, and type section config on product_cat.
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Marketing meta keys and labels.
 *
 * @return array<string, string>
 */
function tsg_category_meta_fields() {
	return array(
		'tsg_decor_heading'   => __( 'Décor heading', 'the-scent-girl' ),
		'tsg_decor_sub'       => __( 'Décor subcopy', 'the-scent-girl' ),
		'tsg_decor_btn'       => __( 'Décor button label', 'the-scent-girl' ),
		'tsg_decor_btn_url'   => __( 'Décor button URL (blank = first child)', 'the-scent-girl' ),
		'tsg_decor_images'    => __( 'Décor gallery image URLs (one per line)', 'the-scent-girl' ),
		'tsg_how_heading'     => __( 'How it works heading', 'the-scent-girl' ),
		'tsg_how_steps'       => __( 'How it works JSON (image|label per line)', 'the-scent-girl' ),
		'tsg_fragrance_heading' => __( 'Fragrance heading', 'the-scent-girl' ),
		'tsg_fragrance_sub'   => __( 'Fragrance subcopy', 'the-scent-girl' ),
		'tsg_fragrance_image' => __( 'Fragrance banner image URL', 'the-scent-girl' ),
		'tsg_fragrance_btn'   => __( 'Fragrance button label', 'the-scent-girl' ),
		'tsg_fragrance_url'   => __( 'Fragrance button URL', 'the-scent-girl' ),
		'tsg_types_heading'   => __( 'Types heading', 'the-scent-girl' ),
		'tsg_types_sub'       => __( 'Types subcopy', 'the-scent-girl' ),
		'tsg_show_marketing'  => __( 'Show marketing sections (yes/no)', 'the-scent-girl' ),
	);
}

/**
 * Add fields to Add Category screen.
 */
function tsg_product_cat_add_fields() {
	foreach ( tsg_category_meta_fields() as $key => $label ) {
		$type = ( false !== strpos( $key, 'images' ) || false !== strpos( $key, 'steps' ) || false !== strpos( $key, 'sub' ) || false !== strpos( $key, 'heading' ) && false === strpos( $key, 'how' ) ) ? 'textarea' : 'text';
		if ( in_array( $key, array( 'tsg_decor_images', 'tsg_how_steps', 'tsg_decor_sub', 'tsg_fragrance_sub', 'tsg_types_sub', 'tsg_club_heading' ), true ) ) {
			$type = 'textarea';
		}
		?>
		<div class="form-field">
			<label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
			<?php if ( 'textarea' === $type ) : ?>
				<textarea name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" rows="4"></textarea>
			<?php else : ?>
				<input type="text" name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" value="" />
			<?php endif; ?>
		</div>
		<?php
	}
}
add_action( 'product_cat_add_form_fields', 'tsg_product_cat_add_fields' );

/**
 * Edit Category fields.
 *
 * @param WP_Term $term Term.
 */
function tsg_product_cat_edit_fields( $term ) {
	foreach ( tsg_category_meta_fields() as $key => $label ) {
		$value = get_term_meta( $term->term_id, $key, true );
		$is_area = in_array( $key, array( 'tsg_decor_images', 'tsg_how_steps', 'tsg_decor_sub', 'tsg_fragrance_sub', 'tsg_types_sub' ), true );
		?>
		<tr class="form-field">
			<th scope="row"><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label></th>
			<td>
				<?php if ( $is_area ) : ?>
					<textarea name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" rows="4" class="large-text"><?php echo esc_textarea( $value ); ?></textarea>
				<?php else : ?>
					<input type="text" class="large-text" name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" />
				<?php endif; ?>
			</td>
		</tr>
		<?php
	}
}
add_action( 'product_cat_edit_form_fields', 'tsg_product_cat_edit_fields' );

/**
 * Save category meta.
 *
 * @param int $term_id Term ID.
 */
function tsg_save_product_cat_meta( $term_id ) {
	foreach ( array_keys( tsg_category_meta_fields() ) as $key ) {
		if ( ! isset( $_POST[ $key ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			continue;
		}
		$raw = wp_unslash( $_POST[ $key ] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		if ( in_array( $key, array( 'tsg_decor_images', 'tsg_how_steps', 'tsg_decor_sub', 'tsg_fragrance_sub', 'tsg_types_sub' ), true ) ) {
			$value = sanitize_textarea_field( $raw );
		} else {
			$value = sanitize_text_field( $raw );
		}
		update_term_meta( $term_id, $key, $value );
	}

	if ( isset( $_POST['tsg_image_url'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		update_term_meta( $term_id, 'tsg_image_url', esc_url_raw( wp_unslash( $_POST['tsg_image_url'] ) ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
	}
}
add_action( 'created_product_cat', 'tsg_save_product_cat_meta' );
add_action( 'edited_product_cat', 'tsg_save_product_cat_meta' );

/**
 * Get a single category marketing value with fallback.
 *
 * @param int    $term_id Term ID.
 * @param string $key     Meta key.
 * @param string $default Default.
 * @return string
 */
function tsg_term_meta( $term_id, $key, $default = '' ) {
	$value = get_term_meta( $term_id, $key, true );
	return ( '' !== $value && false !== $value ) ? $value : $default;
}

/**
 * Parse décor image URLs from term meta.
 *
 * @param int $term_id Term ID.
 * @return string[]
 */
function tsg_get_decor_images( $term_id ) {
	$raw = tsg_term_meta( $term_id, 'tsg_decor_images' );
	if ( ! $raw ) {
		return array();
	}
	$lines = preg_split( '/\r\n|\r|\n/', $raw );
	$urls  = array();
	foreach ( $lines as $line ) {
		$line = trim( $line );
		if ( $line ) {
			$urls[] = esc_url_raw( $line );
		}
	}
	return $urls;
}

/**
 * Parse how-it-works steps: "image_url|Label".
 *
 * @param int $term_id Term ID.
 * @return array<int, array{image:string,label:string}>
 */
function tsg_get_how_steps( $term_id ) {
	$raw = tsg_term_meta( $term_id, 'tsg_how_steps' );
	if ( ! $raw ) {
		return array();
	}
	$steps = array();
	foreach ( preg_split( '/\r\n|\r|\n/', $raw ) as $line ) {
		$line = trim( $line );
		if ( ! $line ) {
			continue;
		}
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		$steps[] = array(
			'image' => esc_url_raw( $parts[0] ),
			'label' => isset( $parts[1] ) ? $parts[1] : '',
		);
	}
	return $steps;
}
