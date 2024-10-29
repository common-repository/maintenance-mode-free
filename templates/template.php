<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="ShapedPlugin">


	<title><?php echo cs_get_option( 'maintenance_site_title' ) ?></title>

	<!-- favicon icon -->
	<?php
	$fav_id  = cs_get_option( 'maintenance_favicon' );
	$fav_img = wp_get_attachment_image_src( $fav_id, 'full' );
	if ( $fav_img[0] != '' ) {
		echo '<link rel="icon" type="image/png" href="' . $fav_img[0] . '">';
	} ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class( array( 'static-img', 'maintenance' ) ); ?>>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<div class="content">
					<div class="main-content">
						<div class="main-logo">
							<a href="<?php echo esc_url( get_home_url()); ?>">
								<img src="<?php
								$logo_id         = cs_get_option( 'maintenance_logo' );
								$logo_attachment = wp_get_attachment_image_src( $logo_id, 'full' );
								echo $logo_attachment[0];
								?>" alt="" width="<?php echo cs_get_option( 'maintenance_logo_width' ); ?>"
								     height="<?php echo
								     cs_get_option( 'maintenance_logo_height' ); ?>"/>
							</a>
						</div>
						<h1 class="text-uppercase"><?php echo cs_get_option( 'maintenance_template_title' ); ?></h1>

						<p><?php echo cs_get_option( 'maintenance_template_content' ) ?></p>

						<!-- COUNTDOWN-->
						<div id="counter" class="countdown" data-countdown="<?php echo cs_get_option
						( 'maintenance_countdown_date' );
						echo ' '; ?><?php echo cs_get_option
						( 'maintenance_countdown_time' ); ?>"></div>
					</div>
					<!--// Main Content-->
					<div class="footer text-center">
						<?php echo cs_get_option( 'maintenance_footer_text' ); ?>
					</div>
				</div>
				<!--/Content-->
			</div>
		</div>
	</div>
	<!--/Container-->
</section>

<?php wp_footer(); ?>
</body>
</html>