<?php
// Inline Style
if ( ! function_exists( 'maintenance_inline_style' ) ) {
	function maintenance_inline_style() {
		wp_enqueue_style( 'maintenance-custom-style', MAINTENANCE_URL . 'templates/inc/custom-style.css', null, null,
			false );

		// Static Image
		$static_img = cs_get_option( 'maintenance_home_image_background' );
		$stat_img   = wp_get_attachment_image_src( $static_img, 'full' );

		$custom_css    = "
			
			.static-img {
				background: url($stat_img[0]) no-repeat scroll 50% 50%;
				background-size: cover;
				background-color: #a65b06;
			}
	";
		wp_add_inline_style( 'maintenance-custom-style', $custom_css );
	}

	add_action( 'wp_enqueue_scripts', 'maintenance_inline_style' );
}