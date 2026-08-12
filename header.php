<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="header-row">
		<div class="header-left">
			<button class="icon-btn tsg-menu-toggle" type="button" aria-label="<?php esc_attr_e( 'Menu', 'the-scent-girl' ); ?>" aria-expanded="false" aria-controls="tsg-primary-nav">
				<svg width="22" height="16" viewBox="0 0 22 16" fill="none" aria-hidden="true">
					<path d="M0 1h22M0 8h22M0 15h22" stroke="currentColor" stroke-width="1.5"/>
				</svg>
			</button>
			<form class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
				<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'the-scent-girl' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'the-scent-girl' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
				<?php if ( tsg_is_woocommerce() ) : ?>
					<input type="hidden" name="post_type" value="product" />
				<?php endif; ?>
				<button class="icon-btn" type="submit" aria-label="<?php esc_attr_e( 'Submit search', 'the-scent-girl' ); ?>">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
						<circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.6"/>
						<path d="M20 20l-3.5-3.5" stroke="currentColor" stroke-width="1.6"/>
					</svg>
				</button>
			</form>
		</div>

		<a class="logo-block" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php
			$logo = tsg_get_option( 'logo_url' );
			if ( has_custom_logo() ) {
				$logo_id = get_theme_mod( 'custom_logo' );
				echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'custom-logo' ) );
			} elseif ( $logo ) {
				printf(
					'<img src="%s" alt="%s" width="160" height="41" />',
					esc_url( $logo ),
					esc_attr( get_bloginfo( 'name' ) )
				);
			} else {
				echo '<span class="site-title">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
			}
			?>
			<span class="logo-tag"><?php echo esc_html( tsg_get_option( 'logo_tagline' ) ); ?></span>
		</a>

		<div class="header-right">
			<a href="<?php echo esc_url( tsg_store_url( 'account' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Account', 'the-scent-girl' ); ?>">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.5"/><path d="M5 19c1.5-3.2 4-4.8 7-4.8s5.5 1.6 7 4.8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
			</a>
			<a href="<?php echo esc_url( tsg_store_url( 'cart' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'View cart', 'the-scent-girl' ); ?>">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 8h12l-1 11H7L6 8z" stroke="currentColor" stroke-width="1.5"/><path d="M9 8V7a3 3 0 0 1 6 0v1" stroke="currentColor" stroke-width="1.5"/></svg>
			</a>
		</div>
	</div>

	<nav id="tsg-primary-nav" class="tsg-primary-nav" hidden>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => 'tsg_primary_fallback_menu',
			)
		);
		?>
	</nav>

	<div class="consultant-bar">
		<strong><?php echo esc_html( tsg_get_option( 'consultant_name' ) ); ?></strong>
		<span class="stars" aria-label="<?php esc_attr_e( '5 stars', 'the-scent-girl' ); ?>">★★★★★</span>
		<span aria-hidden="true">|</span>
		<a href="<?php echo esc_url( tsg_store_url( 'shop' ) ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Select a party', 'the-scent-girl' ); ?></a>
	</div>
</header>
