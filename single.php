<?php
/**
 * Single post.
 *
 * @package The_Scent_Girl
 */

get_header();
?>
<main class="site-main wrap" style="padding:2.5rem 0;">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class(); ?>>
			<header class="page-intro">
				<h1><?php the_title(); ?></h1>
			</header>
			<div class="entry-content"><?php the_content(); ?></div>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
