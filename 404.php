<?php get_header();

$link1_style = get_theme_mod( 'l_image_1_media' ) ? 'background-image: url( ' . esc_url( get_theme_mod( 'l_image_1_media' ) ) . ' );' : '';
$link2_style = get_theme_mod( 'l_image_2_media' ) ? 'background-image: url( ' . esc_url( get_theme_mod( 'l_image_2_media' ) ) . ' );' : '';
?>
				<div id="primary" class="container content-area">
					<div class="row">
						<div class="col-12 col-lg-8">
							<main id="main" class="site-main">

								<section class="error-404 not-found">
									<header class="page-header">
										<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'opalrobot' ); ?></h1>
									</header><!-- .page-header -->

									<div class="page-content">
										<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'opalrobot' ); ?></p>

										<?php
											get_search_form();

											the_widget( 'WP_Widget_Recent_Posts' );
										?>

										<div class="widget widget_categories">
											<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'opalrobot' ); ?></h2>
											<ul>
											<?php
												wp_list_categories( array(
													'orderby'    => 'count',
													'order'      => 'DESC',
													'show_count' => 1,
													'title_li'   => '',
													'number'     => 10,
												) );
											?>
											</ul>
										</div><!-- .widget -->

										<?php

											/* translators: %1$s: smiley */
											$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'opalrobot' ), convert_smilies( ':)' ) ) . '</p>';
											the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

											the_widget( 'WP_Widget_Tag_Cloud' );
										?>

									</div><!-- .page-content -->
								</section><!-- .error-404 -->

							</main><!-- #main -->
						</div>
						<div class="col-12 col-lg-4">
							<div class="primary-links">
								<div class="row justify-content-between align-items-center">
									<?php
										opalrobot_nav_menu( array(
											'container'  => '',
											'theme_location' => 'menu-2',
											'items_wrap' => '%3$s',
											'walker'     => new OpalRobot_Default_Secondary_Walker(),
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
