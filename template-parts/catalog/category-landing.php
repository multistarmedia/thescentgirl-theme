<?php
/**
 * Catalog-driven category landing (Scentsy Warmers & Wax layout).
 *
 * Expects $args['term'] as WP_Term (product_cat).
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$term = $args['term'] ?? get_queried_object();
if ( ! $term instanceof WP_Term ) {
	return;
}

$children = tsg_get_category_children( $term->term_id );
$has_mkt  = tsg_category_has_marketing( $term );
?>

<main id="primary" class="site-main tsg-category-landing">
	<div class="wrap">
		<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'the-scent-girl' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'the-scent-girl' ); ?></a>
			&nbsp;/&nbsp;
			<span><?php echo esc_html( $term->name ); ?></span>
		</nav>

		<header class="page-intro">
			<h1><?php echo esc_html( $term->name ); ?></h1>
			<?php if ( $term->description ) : ?>
				<p><?php echo wp_kses_post( term_description( $term ) ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( $children ) : ?>
			<ul class="category-type-list">
				<?php foreach ( $children as $child ) : ?>
					<li>
						<a href="<?php echo esc_url( tsg_get_category_link( $child ) ); ?>">
							<img
								src="<?php echo esc_url( tsg_get_term_image_url( $child ) ); ?>"
								alt=""
								width="600"
								height="600"
								loading="lazy"
							/>
							<span><?php echo esc_html( $child->name ); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>

	<?php if ( $has_mkt ) : ?>
		<?php get_template_part( 'template-parts/catalog/section', 'decor', array( 'term' => $term ) ); ?>
		<?php get_template_part( 'template-parts/catalog/section', 'how', array( 'term' => $term ) ); ?>
		<?php get_template_part( 'template-parts/catalog/section', 'fragrance', array( 'term' => $term ) ); ?>
		<?php get_template_part( 'template-parts/catalog/section', 'club' ); ?>
		<?php get_template_part( 'template-parts/catalog/section', 'types', array( 'term' => $term ) ); ?>
	<?php endif; ?>

	<section class="section tsg-category-products" aria-label="<?php esc_attr_e( 'Products', 'the-scent-girl' ); ?>">
		<div class="wrap">
			<div class="section-rule-head">
				<h2><?php echo esc_html( sprintf( /* translators: category name */ __( 'Shop %s', 'the-scent-girl' ), $term->name ) ); ?></h2>
				<span class="rule" aria-hidden="true"></span>
				<p class="sub"><?php esc_html_e( 'Browse products from this catalog category.', 'the-scent-girl' ); ?></p>
			</div>

			<?php
			$q = new WP_Query(
				array(
					'post_type'      => 'product',
					'posts_per_page' => 24,
					'post_status'    => 'publish',
					'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
						array(
							'taxonomy'         => 'product_cat',
							'field'            => 'term_id',
							'terms'            => $term->term_id,
							'include_children' => true,
						),
					),
				)
			);

			if ( $q->have_posts() ) :
				woocommerce_product_loop_start();
				while ( $q->have_posts() ) {
					$q->the_post();
					wc_get_template_part( 'content', 'product' );
				}
				woocommerce_product_loop_end();
				wp_reset_postdata();
			else :
				echo '<p>' . esc_html__( 'No products in this category yet. Run Appearance → Seed Catalog.', 'the-scent-girl' ) . '</p>';
			endif;
			?>
		</div>
	</section>

	<section class="shop-strip">
		<div class="wrap">
			<p><?php echo esc_html( sprintf( /* translators: category name */ __( 'Ready to shop %s?', 'the-scent-girl' ), $term->name ) ); ?></p>
			<a class="btn" href="<?php echo esc_url( tsg_get_category_link( $term ) ); ?>"><?php echo esc_html( sprintf( /* translators: category name */ __( 'Shop all %s', 'the-scent-girl' ), $term->name ) ); ?></a>
		</div>
	</section>
</main>
