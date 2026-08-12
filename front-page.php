<?php
/**
 * Front page — redirects to primary Warmers & Wax catalog category.
 *
 * @package The_Scent_Girl
 */

get_header();

$primary = tsg_get_primary_category();

if ( $primary && tsg_is_woocommerce() ) {
	get_template_part( 'template-parts/catalog/category', 'landing', array( 'term' => $primary ) );
} elseif ( tsg_is_woocommerce() ) {
	?>
	<main class="site-main wrap" style="padding:3rem 0;">
		<h1><?php esc_html_e( 'Set up your catalog', 'the-scent-girl' ); ?></h1>
		<p><?php esc_html_e( 'Install WooCommerce, then go to Appearance → Seed Catalog to create the Warmers & Wax category structure.', 'the-scent-girl' ); ?></p>
		<p><a class="btn" href="<?php echo esc_url( tsg_store_url( 'shop' ) ); ?>"><?php esc_html_e( 'Go to shop', 'the-scent-girl' ); ?></a></p>
	</main>
	<?php
} else {
	?>
	<main class="site-main wrap" style="padding:3rem 0;">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				the_title( '<h1>', '</h1>' );
				the_content();
			}
		}
		?>
	</main>
	<?php
}

get_footer();
