<?php
/**
 * Main index fallback.
 *
 * @package The_Scent_Girl
 */

get_header();
?>
<main class="site-main wrap" style="padding:2.5rem 0;">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article <?php post_class(); ?> style="margin-bottom:2rem;">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			</article>
		<?php endwhile; ?>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No content found.', 'the-scent-girl' ); ?></p>
	<?php endif; ?>
</main>
<?php
get_footer();
