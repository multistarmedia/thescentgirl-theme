<?php
/**
 * 404.
 *
 * @package The_Scent_Girl
 */

get_header();
?>
<main class="site-main wrap" style="padding:3rem 0;text-align:center;">
	<h1><?php esc_html_e( 'Page not found', 'the-scent-girl' ); ?></h1>
	<p><a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back home', 'the-scent-girl' ); ?></a></p>
</main>
<?php
get_footer();
