<?php
/**
 * Product card in loops.
 *
 * @package The_Scent_Girl
 */

defined( 'ABSPATH' ) || exit;

global $product;
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'tsg-product', $product ); ?>>
	<?php
	$external = tsg_get_product_external_url( $product );
	$link     = $external ? $external : $product->get_permalink();
	$target   = $external ? ' target="_blank" rel="noopener noreferrer"' : '';
	?>
	<a href="<?php echo esc_url( $link ); ?>" class="woocommerce-LoopProduct-link"<?php echo $target; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php echo $product->get_image( 'tsg-product-card' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<h2 class="woocommerce-loop-product__title"><?php echo esc_html( $product->get_name() ); ?></h2>
		<span class="price"><?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	</a>
	<?php
	// Always render external handoff button (filter maps to External URL).
	echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		'woocommerce_loop_add_to_cart_link',
		'',
		$product,
		array( 'cart_text' => __( 'Add to cart', 'the-scent-girl' ) )
	);
	?>
</li>
