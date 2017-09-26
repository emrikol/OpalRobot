<?php get_header(); ?>
				<div id="primary" class="container content-area">
					<div class="row">
						<div class="col-12 col-lg-8">
							<div class="flexslider">
								<ul class="slides">
									<li>
										<img src="https://cldup.com/JA0iDx5UJk.png" />
									</li>
									<li>
										<img src="https://cldup.com/JA0iDx5UJk.png" />
									</li>
									<li>
										<img src="https://cldup.com/JA0iDx5UJk.png" />
									</li>
								</ul>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="primary-links">
								<div class="row justify-content-between align-items-center">
									<?php
										wp_nav_menu( array(
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
<?php get_footer();
