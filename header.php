<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
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
								$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
							?>
								<a href="<?php home_url( '/' ); ?>">
									<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" />
								</a>
						</div>

						<?php else : ?>

						<div class="site-branding col no-logo">
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
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo wp_kses_post( $description ); ?></p>
							<?php
							endif; ?>
						</div>


						<?php endif; ?>
						<div class="site-navigation col-3">
							<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
							<nav id="site-navigation" class="main-navigation" role="navigation">
								<div id="menuToggle">
									<!--button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
										<?php esc_html_e( 'Primary Menu', 'opalrobot' ); ?>
									</button-->

									<!-- A fake / hidden checkbox is used as click reciever, so you can use the :checked selector on it. -->
									<input type="checkbox" />

									<div class='hamburger-bun'>
										<!-- Some spans to act as a hamburger. -->
										<span></span>
										<span></span>
										<span></span>
									</div>

									<?php
										wp_nav_menu( array(
											'theme_location' => 'menu-1',
											'menu_id' => 'primary-menu',
											'container' => false,
										) );
									?>
								</div>
							</nav>
							<?php endif; ?>
						</div>

					</div>
				</div>
			</header><!-- #masthead -->

			<div id="content" class="site-content">
