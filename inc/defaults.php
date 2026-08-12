<?php
/**
 * Default theme options.
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Defaults used by Customizer and helpers.
 *
 * @return array<string, string>
 */
function tsg_default_options() {
	return array(
		'consultant_name'         => 'Jenn Burton',
		'consultant_title'        => 'SuperStar Director',
		'consultant_photo'        => 'https://imagelive.scentsy.com/cmsimages/Screenshot20260415at4.00.40PM.jpeg',
		'logo_url'                => 'https://jennb.scentsy.us/Content/Images/Rebrand/scentsy-logo-en.svg',
		'logo_white_url'          => 'https://jennb.scentsy.us/Content/Images/Scentsy/scentsy-logo-white-en.svg',
		'logo_tagline'            => 'Fragrance Consultant',
		'primary_category_slug'   => 'warmers-and-wax',
		'coupon_label'            => '$10 off',
		'club_heading'            => 'Save 10% or more on qualifying orders and never run out of your favorite fragrance products',
		'club_button'             => 'Start a subscription',
		'club_url'                => 'https://jennb.scentsy.us/scentsy-club',
		'external_handoff_url'    => 'https://jennb.scentsy.us/shop/c/9811/warmers-and-wax',
	);
}
