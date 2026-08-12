<?php
/**
 * WooCommerce fallback template.
 *
 * @package The_Scent_Girl
 */
get_header( 'shop' );
?>
<main id="primary" class="site-main tsg-shop">
	<div class="wrap" style="padding:2rem 0 3rem;">
		<?php woocommerce_content(); ?>
	</div>
</main>
<?php
get_footer( 'shop' );
