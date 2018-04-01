<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'beka' ); ?></a>

	<?php
	$header_text   = get_theme_mod( 'header_text', esc_html__( 'Welcome to Awesome Blog Design perfect blog', 'beka' ) );
	$social_button = get_theme_mod( 'social_button' );

	if ( $header_text != '' && $social_button != '' ) :
		?>
        <div class="top-header">
            <div class="container clearfix">
				<?php
				if ( $header_text ) : ?>
                    <div class="left-bar">
                        <span><?php echo esc_html( $header_text ); ?></span>
                    </div>
					<?php
				endif;

				if ( $social_button ) : ?>
                    <div class="social-icons">
						<?php
						$facebook = get_theme_mod( 'facebook_url' );
						if ( ! empty( $facebook ) ) : ?>
                            <a href="<?php echo esc_url( $facebook ); ?>"><span class="fa fa-facebook"></span></a>
						<?php endif;

						$twitter = get_theme_mod( 'twitter_url' );
						if ( ! empty( $twitter ) ) : ?>
                            <a href="<?php echo esc_url( $twitter ); ?>"><span class="fa fa-twitter"></span></a>
						<?php endif;

						$google = get_theme_mod( 'gp_url' );
						if ( ! empty( $google ) ) : ?>
                            <a href="<?php echo esc_url( $google ); ?>"><span class="fa fa-google"></span></a>
						<?php endif;

						$instagram = get_theme_mod( 'instagram_url' );
						if ( ! empty( $instagram ) ) : ?>
                            <a href="<?php echo esc_url( $instagram ); ?>"><span class="fa fa-instagram"></span></a>
						<?php endif; ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
	<?php endif; ?>

    <header id="masthead" class="site-header" role="banner">
        <div class="site-branding">
			<?php beka_custom_logo(); ?>
        </div>

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu"
                    aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'beka' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu'
			) ); ?>
        </nav>
    </header>

    <div id="content" class="site-content">
