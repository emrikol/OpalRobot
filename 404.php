<?php get_header(); ?>
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
									<div class="col-6"><a href="#">What to Expect</a></div>
									<div class="col-6"><a href="#">Map/Directions</a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="d-none d-lg-block lg-tertiary">
						<div class="tertiary-links">
							<a class="image" href="#">What to Expect</a>
							<a class="image" href="#">Map/Directions</a>
							<div class="contact-information">
								<p>
									LINTON FIRST CHRISTIAN CHURCH<br/>
									9878 West State Road 54<br/>
									Linton, Indiana 47441<br/>
									<a href="tel:+18128479535">812.847.9535</a><br/>
								</p>
								<ul class="leaders">
									<li><span>1st Service</span><span>8:15 am</span></li>
									<li><span>Classes</span><span>9:50 am</span></li>
									<li><span>2nd Service</span><span>11:00 am</span></li>
									<li><span>Prayer Meeting</span><span>Wed. 6:00 pm</span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
<?php
get_footer();
