<?php
/**
 * WooCommerce archive — product categories use Scentsy landing; others use grid.
 *
 * @package The_Scent_Girl
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

if ( is_product_taxonomy() ) {
	$term = get_queried_object();
	if ( $term instanceof WP_Term && 'product_cat' === $term->taxonomy && tsg_category_has_marketing( $term ) ) {
		get_template_part( 'template-parts/catalog/category', 'landing', array( 'term' => $term ) );
		get_footer( 'shop' );
		return;
	}
}

/**
 * Standard shop / attribute / child category grid.
 */
?>
<main id="primary" class="site-main tsg-shop">
	<div class="wrap" style="padding-top:1.5rem;padding-bottom:3rem;">
		<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'the-scent-girl' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'the-scent-girl' ); ?></a>
			&nbsp;/&nbsp;
			<span><?php woocommerce_page_title(); ?></span>
		</nav>

		<header class="page-intro">
			<h1><?php woocommerce_page_title(); ?></h1>
			<?php do_action( 'woocommerce_archive_description' ); ?>
		</header>

		<?php if ( woocommerce_product_loop() ) : ?>
			<?php do_action( 'woocommerce_before_shop_loop' ); ?>
			<?php woocommerce_product_loop_start(); ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php endwhile; ?>
			<?php woocommerce_product_loop_end(); ?>
			<?php do_action( 'woocommerce_after_shop_loop' ); ?>
		<?php else : ?>
			<?php do_action( 'woocommerce_no_products_found' ); ?>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer( 'shop' );
