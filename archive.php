<?php get_header();

$link1_style = get_theme_mod( 'l_image_1_media' ) ? 'background-image: url( ' . esc_url( get_theme_mod( 'l_image_1_media' ) ) . ' );' : '';
$link2_style = get_theme_mod( 'l_image_2_media' ) ? 'background-image: url( ' . esc_url( get_theme_mod( 'l_image_2_media' ) ) . ' );' : '';
?>
				<div id="primary" class="container content-area">
					<div class="row">
						<div class="col-12 col-lg-8">
							<main id="main" class="site-main">

									<?php
									if ( have_posts() ) :
									?>

										<header class="page-header">
											<?php
												the_archive_title( '<h1 class="page-title">', '</h1>' );
												the_archive_description( '<div class="archive-description">', '</div>' );
											?>
										</header><!-- .page-header -->

										<?php
										/* Start the Loop */
										while ( have_posts() ) :
											the_post();

											/*
											 * Include the Post-Format-specific template for the content.
											 * If you want to override this in a child theme, then include a file
											 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
											 */
											get_template_part( 'template-parts/content', get_post_format() );

										endwhile;

										the_posts_navigation();

									else :

										get_template_part( 'template-parts/content', 'none' );

									endif;
									?>

									</main><!-- #main -->
						</div>
						<div class="col-12 col-lg-4">
							<div class="primary-links">
								<div class="row justify-content-between align-items-center">
									<?php
										opalrobot_nav_menu( array(
											'container' => '',
											'theme_location' => 'menu-2',
											'items_wrap' => '%3$s',
											'walker'  => new OpalRobot_Default_Secondary_Walker(),
										) );
									?>
								</div>
							</div>
							<div class="secondary-links d-lg-none d-xl-none">
								<div class="row justify-content-center align-items-center">
									<div class="col-6"><a style="<?php echo esc_attr( $link1_style ); ?>" href="<?php echo esc_url( get_theme_mod( 'l_image_1_url', '/' ) ); ?>"><?php echo esc_html( get_theme_mod( 'l_image_1_text', 'Link 1' ) ); ?></a></div>
									<div class="col-6"><a style="<?php echo esc_attr( $link2_style ); ?>" href="<?php echo esc_url( get_theme_mod( 'l_image_2_url', '/' ) ); ?>"><?php echo esc_html( get_theme_mod( 'l_image_2_text', 'Link 2' ) ); ?></a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="d-none d-lg-block lg-tertiary">
						<div class="tertiary-links">
							<a class="image" style="<?php echo esc_attr( $link1_style ); ?>" href="<?php echo esc_url( get_theme_mod( 'l_image_1_url', '/' ) ); ?>"><?php echo esc_html( get_theme_mod( 'l_image_1_text', 'Link 1' ) ); ?></a>
							<a class="image" style="<?php echo esc_attr( $link2_style ); ?>" href="<?php echo esc_url( get_theme_mod( 'l_image_2_url', '/' ) ); ?>"><?php echo esc_html( get_theme_mod( 'l_image_2_text', 'Link 2' ) ); ?></a>
							<div class="contact-information"><?php echo wp_kses_post( get_theme_mod( 'l_textarea', 'Text Area 1' ) ); ?></div>
						</div>
					</div>
				</div>
<?php
get_footer();
