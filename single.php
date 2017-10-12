<?php get_header(); ?>
				<div id="primary" class="container content-area">
					<div class="row">
						<div class="col-12 col-lg-8">
							<main id="main" class="site-main">

							<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content', get_post_type() );

								the_post_navigation();

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
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
