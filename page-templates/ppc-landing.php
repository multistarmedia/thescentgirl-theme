<?php
/**
 * Template Name: PPC Landing
 * Template Post Type: page
 *
 * Paid-traffic landing page: renders the primary catalog category with every
 * link handing off to JennB (Party ID appended). Accepts ?partyId= on the URL.
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Duplicate of the homepage content — keep it out of the index.
add_filter(
	'wp_robots',
	function ( $robots ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
		return $robots;
	}
);

get_header();

$primary = tsg_get_primary_category();

if ( $primary && tsg_is_woocommerce() ) {
	get_template_part( 'template-parts/catalog/category', 'landing', array( 'term' => $primary ) );
} else {
	?>
	<main class="site-main wrap" style="padding:3rem 0;">
		<?php
		while ( have_posts() ) {
			the_post();
			the_title( '<h1>', '</h1>' );
			the_content();
		}
		?>
		<p><a class="btn" href="<?php echo esc_url( tsg_store_url( 'shop' ) ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Shop now', 'the-scent-girl' ); ?></a></p>
	</main>
	<?php
}

get_footer();
