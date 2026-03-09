<?php
/**
 * YCONA Backend Customization
 *
 * Customizations for the WordPress login page:
 * admin bar, footer, body class. Styles in backend.long.css.
 * Template: wp-login.php
 *
 * @package WordPress
 * @subpackage Ycona
 */

defined( 'ABSPATH' ) || exit;


/* Body class for CSS scoping */
add_filter( 'admin_body_class', 'wt_backend_body_class' );

function wt_backend_body_class( $classes ) {
	return $classes . ' wt-backend-styled ';
}


/* Admin bar: logo → frontend, WPML, user without Willkommen */
add_action( 'wp_before_admin_bar_render', 'wt_backend_admin_bar_customize', 999 );

function wt_backend_admin_bar_customize() {
    // When using wp_before_admin_bar_render, we must call the global variable
    global $wp_admin_bar;

    $theme_uri = get_stylesheet_directory_uri();
    $logo_url  = $theme_uri . '/assets/img/Yacona.png';
    $home_url  = home_url( '/' );

    /* 1. Remove default WP bar nodes */
    $remove_ids = array(
        'wp-logo',
        'dashboard',
        'my-sites',
        'new-content',
        'comments',
        'edit',
        'appearance',
        'updates',
    );

    foreach ( $remove_ids as $id ) {
        $wp_admin_bar->remove_node( $id );
    }

    /* 2. Site-name = YCONA logo, link to frontend */
    $site_name = $wp_admin_bar->get_node( 'site-name' );
    if ( $site_name ) {
        $logo_img = '<img src="' . esc_url( $logo_url ) . '" alt="YCONA Logo" class="wt-adminbar-logo-img" />';
        $wp_admin_bar->add_node( array(
            'id'    => 'site-name',
            'title' => $logo_img,
            'href'  => $home_url,
            'meta'  => array(
                'title' => get_bloginfo( 'name' ),
            ),
        ) );
    }

    /* 3. My-account: avatar + name only (Guaranteed to remove Willkommen) */
    $user_id = get_current_user_id();
    $user    = $user_id ? get_userdata( $user_id ) : null;

    if ( $user ) {
        $avatar = get_avatar( $user_id, 26, '', $user->display_name, array( 'class' => 'wt-adminbar-avatar' ) );

        // I swapped this to match the standard WP layout: Name first, then Avatar
        $title  = '<span class="display-name">' . esc_html( $user->display_name ) . '</span>' . $avatar;

        $wp_admin_bar->add_node( array(
            'id'    => 'my-account',
            'title' => $title,
        ) );
    }
}


/* Admin footer text */
add_filter( 'admin_footer_text', 'wt_backend_footer_text' );

function wt_backend_footer_text( $text ) {
	return 'YCONA &bull; ' . esc_html__( 'Powered by WordPress', 'webthinkershop' );
}
