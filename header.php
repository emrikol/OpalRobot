<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
		<?php if ( is_front_page() || is_home() ) : ?>
		<script type="text/javascript" charset="utf-8">
			jQuery( window ).load( function() {
				jQuery( '.flexslider' ).flexslider();
			} );
		</script>
		<?php endif; ?>
	</head>

	<body <?php body_class(); ?>>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'opalrobot' ); ?></a>

			<header id="masthead" class="site-header">
				<div class="container">
					<div class="row">

						<?php if ( has_custom_logo() ) : ?>

						<div class="site-branding col has-logo">
							<?php
								$custom_logo_id = get_theme_mod( 'custom_logo' );
								$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
								$custom_logo_desktop_url = get_theme_mod( 'custom_logo_desktop' );
							?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<img class='d-lg-none d-xl-none' src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" />
									<img class='d-none d-lg-block' src="<?php echo esc_url( $custom_logo_desktop_url ); ?>" alt="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" />
								</a>
						</div>

						<?php else : ?>

						<div class="site-branding col col-md-9 no-logo">
							<?php if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
									</a>
								</h1>
							<?php else : ?>
								<p class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
									</a>
								</p>
							<?php
							endif;

							$description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) :
							?>
								<p class="site-description"><?php echo wp_kses_post( $description ); ?></p>
							<?php
							endif;
							?>
						</div>

						<?php endif; ?>

						<div class="col-md-3 d-none d-md-block header-secondary-nav">
						</div>

						<div class="site-navigation col-3 col-md-12">

							<div class="hamburger hamburger--squeeze d-md-none d-lg-none d-xl-none">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>

							<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
							<nav id="site-navigation" class="main-navigation" role="navigation">
								<!--button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
									<?php esc_html_e( 'Primary Menu', 'opalrobot' ); ?>
								</button-->

								<?php
									opalrobot_nav_menu( array(
										'theme_location' => 'menu-1',
										'menu_id' => 'primary-menu',
										'container' => false,
									) );
								?>
							</nav>
							<?php endif; ?>
							<script>
								var hamburger = document.querySelector( '.hamburger' );
								hamburger.addEventListener( 'click', function() {
									hamburger.classList.toggle( 'is-active');
									document.querySelector( '#primary-menu' ).classList.toggle( 'is-active');
									document.querySelector( 'body' ).classList.toggle( 'no-scrolling');
									document.querySelector( 'html' ).classList.toggle( 'no-scrolling');
								} );
							</script>
						</div>

					</div>
				</div>
			</header><!-- #masthead -->

			<div id="content" class="site-content">
