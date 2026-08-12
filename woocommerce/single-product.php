<?php
/**
 * Single product.
 *
 * @package The_Scent_Girl
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>
<main id="primary" class="site-main tsg-single-product">
	<div class="wrap" style="padding:2rem 0 3rem;">
		<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'the-scent-girl' ); ?>">
			<?php woocommerce_breadcrumb( array( 'delimiter' => '&nbsp;/&nbsp;' ) ); ?>
		</nav>
		<?php
		while ( have_posts() ) {
			the_post();
			wc_get_template_part( 'content', 'single-product' );
		}
		?>
	</div>
</main>
<?php
get_footer( 'shop' );
