<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>

	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
			/* translators: 1. Site name 2. Current Year 3. WordPress Link 4. FancyThemes Link */
			echo apply_filters( 'beka_footer_credit', sprintf(
				__( '&copy; %1$s %2$s. Powered by %3$s &amp; %4$s', 'beka' ),
				get_bloginfo( 'name' ),
				date_i18n( esc_html__( 'Y', 'beka' ) ),
				sprintf(
					'<a href="%1$s" title="%2$s">%3$s</a>',
					'https://wordpress.org/',
					esc_attr__( 'WordPress', 'beka' ),
					esc_html__( 'WordPress', 'beka' )
				),
				sprintf(
					'<a href="%1$s" title="%2$s">%3$s</a>',
					'https://fancythemes.com/',
					esc_attr__( 'FancyThemes', 'beka' ),
					esc_html__( 'FancyThemes', 'beka' )
				)
			) ); ?>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
