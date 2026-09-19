<?php
/**
 * Demo catalog seeder — recreates Warmers & Wax structure in WooCommerce.
 *
 * Appearance → The Scent Girl Catalog, or Tools → Seed Warmers & Wax Catalog.
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Catalog blueprint matching jennb.scentsy.us/shop/c/9811/warmers-and-wax.
 *
 * @return array<string, mixed>
 */
function tsg_demo_catalog_blueprint() {
	return array(
		'parent'   => array(
			'name'        => 'Warmers & Wax',
			'slug'        => 'warmers-and-wax',
			'external_url' => 'https://jennb.scentsy.us/shop/c/9811/warmers-and-wax',
			'description' => 'Scentsy Warmers are a beautiful and safe way to enjoy amazing fragrance with our premium-quality Scentsy Bars.',
			'image'       => 'https://imagelive.scentsy.com/cmsimages/Categories/1200x1200HOMEWarmerClassicCrestRA2026.jpeg',
			'meta'        => array(
				'tsg_show_marketing'    => 'yes',
				'tsg_decor_heading'     => 'Décor that delights',
				'tsg_decor_sub'         => 'Discover the latest Scentsy Warmer designs',
				'tsg_decor_btn'         => 'See more',
				'tsg_decor_images'      => implode(
					"\n",
					array(
						'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1080x1920-HOME-Warmer-WhiteMarigold-R12MX-2026.jpg',
						'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1600x840-HOME-Warmer-BluebellGingham-R123-2026.jpg',
						'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1600x840-HOME-Warmer-ClassicCrest-RA-2026.jpg',
						'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1200x1200-HOME-Warmer-GossamerHaze-R1MX-2026.jpg',
					)
				),
				'tsg_how_heading'       => 'How it works',
				'tsg_how_steps'         => implode(
					"\n",
					array(
						'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2025/SS25/Warmers%20%26%20Wax/HOME-Warmer-PeriwinklePetals-ISO-RA-SS25-PWS.png|Pick your Warmer',
						'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/SCENT-Bar-ProvenceLavender-ISO-R1-2026-PWS.png|Pick your fragrance',
						'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2025/SS25/Warmers%20%26%20Wax/HOME-Warmer-PeriwinklePetals-ISO-GlowWax-RA-SS25-PWS.png|Add wax and enjoy!',
					)
				),
				'tsg_fragrance_heading' => 'World class fragrance',
				'tsg_fragrance_sub'     => 'Explore high-quality premium scent developed by the best perfumers in the world',
				'tsg_fragrance_image'   => 'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1600x840-SCENT-Wax-Intro-R13-2026.jpg',
				'tsg_fragrance_btn'     => 'Shop Scentsy Bars',
				'tsg_types_heading'     => "What's your type?",
				'tsg_types_sub'         => 'All Scentsy Warmers melt our signature scented wax — in a variety of ways',
			),
		),
		'children' => array(
			array(
				'name'  => 'Wax Bars',
				'slug'  => 'wax-bars',
				'external_url' => 'https://jennb.scentsy.us/shop/c/4410/wax-bars',
				'image' => 'https://imagelive.scentsy.com/cmsimages/Categories/1200x1200InspireLTOCypressCitronR13.jpeg',
			),
			array(
				'name'  => 'Warmers',
				'slug'  => 'warmers',
				'external_url' => 'https://jennb.scentsy.us/shop/c/4436/warmers',
				'image' => 'https://imagelive.scentsy.com/cmsimages/Categories/1200x1200HOMEWarmerClassicCrestRA2026.jpeg',
			),
			array(
				'name'  => 'Bulbs & Accessories',
				'slug'  => 'bulbs-and-accessories',
				'external_url' => 'https://jennb.scentsy.us/shop/c/4439/bulbs-and-accessories',
				'image' => 'https://imagelive.scentsy.com/cmsimages/Categories/1200x1200FW25BulbsRA3af21b91d94f43a3bcbf0ad049e7de96.jpeg',
			),
			array(
				'name'  => 'Warmer Dishes & Lids',
				'slug'  => 'warmer-dishes-and-lids',
				'external_url' => 'https://jennb.scentsy.us/shop/c/7769/warmer-dishes-and-lids',
				'image' => 'https://imagelive.scentsy.com/cmsimages/Categories/HOMEWarmerSandedLineaPACKSHOTDishR12026PWS.jpeg',
			),
		),
		'products' => array(
			array(
				'name'       => 'White Marigold Warmer',
				'slug'       => 'white-marigold-warmer',
				'external_url' => 'https://jennb.scentsy.us/shop/p/106211/white-marigold-warmer',
				'price'      => '55.00',
				'cats'       => array( 'warmers', 'warmers-and-wax' ),
				'type'       => 'standard',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1080x1920-HOME-Warmer-WhiteMarigold-R12MX-2026.jpg',
				'description'=> 'A luminous warmer design that doubles as décor.',
			),
			array(
				'name'       => 'Bluebell Gingham Warmer',
				'slug'       => 'bluebell-gingham-warmer',
				'external_url' => 'https://jennb.scentsy.us/shop/p/106089/bluebell-gingham-warmer',
				'price'      => '55.00',
				'cats'       => array( 'warmers', 'warmers-and-wax' ),
				'type'       => 'standard',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1600x840-HOME-Warmer-BluebellGingham-R123-2026.jpg',
				'description'=> 'Classic gingham charm for mantles and shelves.',
			),
			array(
				'name'       => 'Classic Crest Warmer',
				'slug'       => 'classic-crest-warmer',
				'external_url' => 'https://jennb.scentsy.us/shop/p/106088/classic-crest-warmer',
				'price'      => '60.00',
				'cats'       => array( 'warmers', 'warmers-and-wax' ),
				'type'       => 'standard',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1600x840-HOME-Warmer-ClassicCrest-RA-2026.jpg',
				'description'=> 'Timeless crest detailing with candle-like ambience.',
			),
			array(
				'name'       => 'Gossamer Haze Warmer',
				'slug'       => 'gossamer-haze-warmer',
				'external_url' => 'https://jennb.scentsy.us/shop/p/106202/gossamer-haze-warmer',
				'price'      => '55.00',
				'cats'       => array( 'warmers', 'warmers-and-wax' ),
				'type'       => 'standard',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1200x1200-HOME-Warmer-GossamerHaze-R1MX-2026.jpg',
				'description'=> 'Soft, airy styling for desks and side tables.',
			),
			array(
				'name'       => 'Sanded Linea Warmer',
				'slug'       => 'sanded-linea-warmer',
				'external_url' => 'https://jennb.scentsy.us/shop/p/106213/sanded-linea-warmer',
				'price'      => '50.00',
				'cats'       => array( 'warmers', 'warmers-and-wax' ),
				'type'       => 'standard',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1200x1200-HOME-Warmer-SandedLinea-R1MX-2026.jpg',
				'description'=> 'Standard warmer — low-watt bulb, soft glow.',
			),
			array(
				'name'       => 'Lustra Warmer',
				'slug'       => 'lustra-warmer',
				'external_url' => 'https://jennb.scentsy.us/shop/p/106208/lustra-warmer',
				'price'      => '55.00',
				'cats'       => array( 'warmers', 'warmers-and-wax' ),
				'type'       => 'element',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/1200x1200-HOME-Warmer-Lustra-RA-2026.jpg',
				'description'=> 'Element warmer — heats wax without a light bulb.',
			),
			array(
				'name'       => 'Fancy Filigree Mini Warmer',
				'slug'       => 'fancy-filigree-mini-warmer',
				'external_url' => 'https://jennb.scentsy.us/shop/p/101334/fancy-filigree-mini-warmer',
				'price'      => '25.00',
				'cats'       => array( 'warmers', 'warmers-and-wax' ),
				'type'       => 'mini-warmers',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/HOME-MiniWarmer-FancyFiligree-71-R1-2025.jpg',
				'description'=> 'Mini warmer for smaller spaces — wall or tabletop.',
			),
			array(
				'name'       => 'Provence Lavender Scentsy Bar',
				'slug'       => 'provence-lavender-scentsy-bar',
				'external_url' => 'https://jennb.scentsy.us/shop/p/92961/provence-lavender-scentsy-bar',
				'price'      => '7.00',
				'cats'       => array( 'wax-bars', 'warmers-and-wax' ),
				'type'       => '',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/images/Category-Pages/2026/SCENT-Bar-ProvenceLavender-ISO-R1-2026-PWS.png',
				'description'=> 'Premium wax bar — Provence Lavender.',
			),
			array(
				'name'       => 'Cypress Citron Scentsy Bar',
				'slug'       => 'cypress-citron-scentsy-bar',
				'external_url' => 'https://jennb.scentsy.us/shop/p/106640/cypress-and-citron-scentsy-bar',
				'price'      => '7.00',
				'cats'       => array( 'wax-bars', 'warmers-and-wax' ),
				'type'       => '',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/Categories/1200x1200InspireLTOCypressCitronR13.jpeg',
				'description'=> 'Fresh citrus and cypress wax bar.',
			),
			array(
				'name'       => 'Warmer Replacement Dish',
				'slug'       => 'warmer-replacement-dish',
				'external_url' => 'https://jennb.scentsy.us/shop/c/7769/warmer-dishes-and-lids',
				'price'      => '9.00',
				'cats'       => array( 'warmer-dishes-and-lids', 'warmers-and-wax' ),
				'type'       => '',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/Categories/HOMEWarmerSandedLineaPACKSHOTDishR12026PWS.jpeg',
				'description'=> 'Glass warmer dish replacement.',
			),
			array(
				'name'       => 'Scentsy Warmer Bulbs (2-pack)',
				'slug'       => 'scentsy-warmer-bulbs',
				'external_url' => 'https://jennb.scentsy.us/shop/c/4439/bulbs-and-accessories',
				'price'      => '7.00',
				'cats'       => array( 'bulbs-and-accessories', 'warmers-and-wax' ),
				'type'       => '',
				'image'      => 'https://imagelive.scentsy.com/cmsimages/Categories/1200x1200FW25BulbsRA3af21b91d94f43a3bcbf0ad049e7de96.jpeg',
				'description'=> 'Low-watt replacement bulbs for standard warmers.',
			),
		),
	);
}

/**
 * Admin menu.
 */
function tsg_demo_catalog_menu() {
	$cap = current_user_can( 'manage_woocommerce' ) ? 'manage_woocommerce' : 'manage_options';
	add_theme_page(
		__( 'Seed Warmers & Wax Catalog', 'the-scent-girl' ),
		__( 'Seed Catalog', 'the-scent-girl' ),
		$cap,
		'tsg-seed-catalog',
		'tsg_demo_catalog_page'
	);
}
add_action( 'admin_menu', 'tsg_demo_catalog_menu' );

/**
 * Admin page UI.
 */
function tsg_demo_catalog_page() {
	if ( ! tsg_is_woocommerce() ) {
		echo '<div class="wrap"><h1>' . esc_html__( 'Seed Catalog', 'the-scent-girl' ) . '</h1>';
		echo '<div class="notice notice-error"><p>' . esc_html__( 'Activate WooCommerce first, then run the seeder to recreate the Warmers & Wax catalog.', 'the-scent-girl' ) . '</p></div></div>';
		return;
	}

	$notice = '';
	if ( isset( $_POST['tsg_seed_catalog'] ) && check_admin_referer( 'tsg_seed_catalog' ) ) {
		$result = tsg_seed_demo_catalog();
		$notice = sprintf(
			/* translators: 1: categories created, 2: products created */
			__( 'Catalog seeded. Categories: %1$d · Products: %2$d. Visit the Warmers & Wax category to preview.', 'the-scent-girl' ),
			(int) $result['categories'],
			(int) $result['products']
		);
	}

	$parent = tsg_get_primary_category();
	$url    = $parent ? get_term_link( $parent ) : '';
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Seed Warmers & Wax Catalog', 'the-scent-girl' ); ?></h1>
		<p><?php esc_html_e( 'Creates the WooCommerce product categories, Warmer Type attribute, and sample products that recreate the Scentsy Warmers & Wax category page — driven entirely by the WordPress catalog.', 'the-scent-girl' ); ?></p>
		<?php if ( $notice ) : ?>
			<div class="notice notice-success is-dismissible"><p><?php echo esc_html( $notice ); ?></p>
			<?php if ( $url && ! is_wp_error( $url ) ) : ?>
				<p><a class="button button-primary" href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'View Warmers & Wax', 'the-scent-girl' ); ?></a></p>
			<?php endif; ?>
			</div>
		<?php endif; ?>
		<form method="post">
			<?php wp_nonce_field( 'tsg_seed_catalog' ); ?>
			<p>
				<button type="submit" name="tsg_seed_catalog" class="button button-primary button-hero">
					<?php esc_html_e( 'Seed / refresh catalog', 'the-scent-girl' ); ?>
				</button>
			</p>
		</form>
		<p class="description"><?php esc_html_e( 'Safe to re-run: existing slugs are updated, not duplicated.', 'the-scent-girl' ); ?></p>
	</div>
	<?php
}

/**
 * Ensure Warmer Type product attribute exists.
 *
 * @return int|false Attribute taxonomy id or false.
 */
function tsg_ensure_warmer_type_attribute() {
	if ( ! function_exists( 'wc_create_attribute' ) ) {
		return false;
	}

	$slug = 'warmer-type';
	$tax  = 'pa_' . $slug;
	if ( taxonomy_exists( $tax ) ) {
		foreach ( array( 'standard', 'element', 'mini-warmers' ) as $term_slug ) {
			if ( ! term_exists( $term_slug, $tax ) ) {
				$labels = array(
					'standard'     => 'Standard',
					'element'      => 'Element',
					'mini-warmers' => 'Mini Warmers',
				);
				wp_insert_term( $labels[ $term_slug ], $tax, array( 'slug' => $term_slug ) );
			}
		}
		return true;
	}

	$id = wc_create_attribute(
		array(
			'name'         => 'Warmer Type',
			'slug'         => $slug,
			'type'         => 'select',
			'order_by'     => 'menu_order',
			'has_archives' => true,
		)
	);

	if ( is_wp_error( $id ) ) {
		return false;
	}

	register_taxonomy( $tax, array( 'product' ), array() );
	foreach ( array( 'Standard' => 'standard', 'Element' => 'element', 'Mini Warmers' => 'mini-warmers' ) as $name => $term_slug ) {
		if ( ! term_exists( $term_slug, $tax ) ) {
			wp_insert_term( $name, $tax, array( 'slug' => $term_slug ) );
		}
	}
	return $id;
}

/**
 * Sideload remote image into media library (or reuse by source URL meta).
 *
 * @param string $url Image URL.
 * @param string $title Title.
 * @return int Attachment ID or 0.
 */
function tsg_sideload_image( $url, $title = '' ) {
	if ( ! $url ) {
		return 0;
	}

	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'posts_per_page' => 1,
			'meta_key'       => '_tsg_source_url', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => $url, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'fields'         => 'ids',
		)
	);
	if ( $existing ) {
		return (int) $existing[0];
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$tmp = download_url( $url, 30 );
	if ( is_wp_error( $tmp ) ) {
		return 0;
	}

	$file_array = array(
		'name'     => basename( wp_parse_url( $url, PHP_URL_PATH ) ),
		'tmp_name' => $tmp,
	);
	$file_array['name'] = preg_replace( '/[^a-zA-Z0-9._-]/', '-', rawurldecode( $file_array['name'] ) );

	$id = media_handle_sideload( $file_array, 0, $title );
	if ( is_wp_error( $id ) ) {
		@unlink( $tmp ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
		return 0;
	}
	update_post_meta( $id, '_tsg_source_url', $url );
	return (int) $id;
}

/**
 * Upsert a product category.
 *
 * @param array $data Category data.
 * @param int   $parent Parent term ID.
 * @return int Term ID.
 */
function tsg_upsert_category( $data, $parent = 0 ) {
	$existing = get_term_by( 'slug', $data['slug'], 'product_cat' );
	$args     = array(
		'description' => $data['description'] ?? '',
		'parent'      => $parent,
		'slug'        => $data['slug'],
	);

	if ( $existing && ! is_wp_error( $existing ) ) {
		wp_update_term( $existing->term_id, 'product_cat', array_merge( $args, array( 'name' => $data['name'] ) ) );
		$term_id = (int) $existing->term_id;
	} else {
		$result = wp_insert_term( $data['name'], 'product_cat', $args );
		if ( is_wp_error( $result ) ) {
			return 0;
		}
		$term_id = (int) $result['term_id'];
	}

	if ( ! empty( $data['external_url'] ) ) {
		update_term_meta( $term_id, 'tsg_external_url', esc_url_raw( $data['external_url'] ) );
	}

	if ( ! empty( $data['image'] ) ) {
		update_term_meta( $term_id, 'tsg_image_url', esc_url_raw( $data['image'] ) );
		$att = tsg_sideload_image( $data['image'], $data['name'] );
		if ( $att ) {
			update_term_meta( $term_id, 'thumbnail_id', $att );
		}
	}

	if ( ! empty( $data['meta'] ) && is_array( $data['meta'] ) ) {
		foreach ( $data['meta'] as $key => $value ) {
			update_term_meta( $term_id, $key, $value );
		}
	}

	return $term_id;
}

/**
 * Upsert a simple product.
 *
 * @param array $data Product data.
 * @return int Post ID.
 */
function tsg_upsert_product( $data ) {
	$existing = get_page_by_path( $data['slug'], OBJECT, 'product' );
	$postarr  = array(
		'post_title'   => $data['name'],
		'post_name'    => $data['slug'],
		'post_content' => $data['description'] ?? '',
		'post_status'  => 'publish',
		'post_type'    => 'product',
	);

	if ( $existing ) {
		$postarr['ID'] = $existing->ID;
		$product_id    = wp_update_post( $postarr );
	} else {
		$product_id = wp_insert_post( $postarr );
	}

	if ( ! $product_id || is_wp_error( $product_id ) ) {
		return 0;
	}

	wp_set_object_terms( $product_id, 'simple', 'product_type' );
	update_post_meta( $product_id, '_regular_price', $data['price'] );
	update_post_meta( $product_id, '_price', $data['price'] );
	update_post_meta( $product_id, '_manage_stock', 'no' );
	update_post_meta( $product_id, '_stock_status', 'instock' );
	update_post_meta( $product_id, '_visibility', 'visible' );

	if ( ! empty( $data['cats'] ) ) {
		wp_set_object_terms( $product_id, $data['cats'], 'product_cat' );
	}

	if ( ! empty( $data['type'] ) && taxonomy_exists( 'pa_warmer-type' ) ) {
		wp_set_object_terms( $product_id, $data['type'], 'pa_warmer-type' );
		$product = wc_get_product( $product_id );
		if ( $product ) {
			$attrs = array();
			$attribute = new WC_Product_Attribute();
			$attribute->set_id( wc_attribute_taxonomy_id_by_name( 'pa_warmer-type' ) );
			$attribute->set_name( 'pa_warmer-type' );
			$attribute->set_options( array( $data['type'] ) );
			$attribute->set_visible( true );
			$attribute->set_variation( false );
			$attrs[] = $attribute;
			$product->set_attributes( $attrs );
			$product->save();
		}
	}

	if ( ! empty( $data['image'] ) ) {
		update_post_meta( $product_id, '_tsg_image_url', esc_url_raw( $data['image'] ) );
		$att = tsg_sideload_image( $data['image'], $data['name'] );
		if ( $att ) {
			set_post_thumbnail( $product_id, $att );
		}
	}

	// External URL → JennB product handoff (catalog column).
	// Only write when the blueprint provides a product URL. Never overwrite a
	// product link with a category fallback — that is resolved at render time.
	$external = $data['external_url'] ?? '';
	if ( $external ) {
		update_post_meta( $product_id, 'External URL', esc_url_raw( $external ) );
		update_post_meta( $product_id, 'external_url', esc_url_raw( $external ) );
	}

	return (int) $product_id;
}

/**
 * Run the seeder.
 *
 * @return array{categories:int,products:int}
 */
function tsg_seed_demo_catalog() {
	$blueprint = tsg_demo_catalog_blueprint();
	$counts    = array( 'categories' => 0, 'products' => 0 );

	tsg_ensure_warmer_type_attribute();

	$parent_id = tsg_upsert_category( $blueprint['parent'], 0 );
	if ( $parent_id ) {
		++$counts['categories'];
		set_theme_mod( 'tsg_primary_category_slug', $blueprint['parent']['slug'] );

		// Point fragrance button at wax-bars after children exist.
		$child_ids = array();
		foreach ( $blueprint['children'] as $child ) {
			$cid = tsg_upsert_category( $child, $parent_id );
			if ( $cid ) {
				++$counts['categories'];
				$child_ids[ $child['slug'] ] = $cid;
			}
		}

		// Leave these blank so the sections resolve the child category's external URL at render time.
		delete_term_meta( $parent_id, 'tsg_fragrance_url' );
		delete_term_meta( $parent_id, 'tsg_decor_btn_url' );
	}

	foreach ( $blueprint['products'] as $product ) {
		if ( tsg_upsert_product( $product ) ) {
			++$counts['products'];
		}
	}

	// Flush rewrite rules so category URLs resolve.
	flush_rewrite_rules();

	return $counts;
}

/**
 * Prefer external image URL on products when no attachment (sideload failed).
 *
 * @param string       $image Image HTML.
 * @param WC_Product   $product Product.
 * @return string
 */
function tsg_product_get_image_fallback( $image, $product ) {
	if ( $product->get_image_id() ) {
		return $image;
	}
	$url = get_post_meta( $product->get_id(), '_tsg_image_url', true );
	if ( ! $url ) {
		return $image;
	}
	return sprintf(
		'<img src="%s" alt="%s" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" loading="lazy" />',
		esc_url( $url ),
		esc_attr( $product->get_name() )
	);
}
add_filter( 'woocommerce_product_get_image', 'tsg_product_get_image_fallback', 10, 2 );
