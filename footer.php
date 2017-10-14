<?php
$link_style    = array();
$link_style[1] = get_theme_mod( 't_link_1_media' ) ? 'background-image: url( ' . esc_url( get_theme_mod( 't_link_1_media' ) ) . ' );' : '';
$link_style[2] = get_theme_mod( 't_link_2_media' ) ? 'background-image: url( ' . esc_url( get_theme_mod( 't_link_2_media' ) ) . ' );' : '';
$link_style[3] = get_theme_mod( 't_link_3_media' ) ? 'background-image: url( ' . esc_url( get_theme_mod( 't_link_3_media' ) ) . ' );' : '';
$link_style[4] = get_theme_mod( 't_link_4_media' ) ? 'background-image: url( ' . esc_url( get_theme_mod( 't_link_4_media' ) ) . ' );' : '';
?>
				</div>
			</div>
			<footer id="colophon" class="site-footer">
				<div class="container site-info">
					<div class="row footer-navigation xhidden-md-up"><?php for ( $i = 1; $i <= 4; $i++ ) : ?>
						<div class="col-3 col-md-6 col-lg-3 align-self-center"><a style="<?php echo esc_attr( $link_style[ $i ] ); ?>" class="text-hide" href="<?php echo esc_url( get_theme_mod( sprintf( 't_link_%d_url', (int) $i ), '/' ) ); ?>"><?php echo esc_html( get_theme_mod( sprintf( 't_link_%d_text', (int) $i ), sprintf( 'Link %d', (int) $i ) ) ); ?></a></div>
					<?php endfor; ?></div>
				</div>
				<p><?php echo esc_html( date( 'Y' ) ); ?> &copy; <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
			</footer>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
