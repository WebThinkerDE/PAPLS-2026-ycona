<?php
/**
 * Login Page Customization
 *
 * Customizations for the WordPress login page:
 * Logo, Styles and Optional reCAPTCHA v3
 * Template: wp-login.php
 *
 * @package WordPress
 * @subpackage Ycona
 */
/*login-logo*/
function wt_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'wt_login_logo_url' );

function wt_login_logo_title() {
    return get_option( 'blogname' );
}
add_filter( 'login_headertext', 'wt_login_logo_title' );

/*login-assets*/
function wt_login_enqueue_styles() {
    $theme_uri = get_template_directory_uri();

    // Load backend.long.css so :root color variables are available.
    wp_enqueue_style(
        'wt-backend-login', $theme_uri . '/assets/css/backend.long.css', [], defined( '_S_VERSION' ) ? _S_VERSION : '1.0'
    );

    // Load the dedicated login styles on top.
    wp_enqueue_style(
        'wt-login', $theme_uri . '/assets/css/wt-login.long.css', [ 'wt-backend-login' ], defined( '_S_VERSION' ) ? _S_VERSION : '1.0'
    );
}
add_action( 'login_enqueue_scripts', 'wt_login_enqueue_styles' );

/*wt-login-misc*/
// Hide the default core login language dropdown (we use WPML's switcher instead).
add_filter( 'login_display_language_dropdown', '__return_false' );

/*login-recaptcha*/
/*
 * Hidden reCAPTCHA v3 – commented out.
 * Enable: uncomment block below and in wp-config.php add:
 *   define( 'WT_RECAPTCHA_V3_SITE_KEY', 'your_site_key' );
 *   define( 'WT_RECAPTCHA_V3_SECRET_KEY', 'your_secret_key' );
 *   define( 'WT_RECAPTCHA_V3_THRESHOLD', 0.5 ); // optional, default 0.5
 *
if ( defined( 'WT_RECAPTCHA_V3_SITE_KEY' ) && defined( 'WT_RECAPTCHA_V3_SECRET_KEY' ) ) {

    function wt_login_recaptcha_field() {
        echo '<input type="hidden" name="wt_recaptcha_token" id="wt_recaptcha_token" value="" autocomplete="off">';
    }
    add_action( 'login_form', 'wt_login_recaptcha_field' );

    function wt_login_recaptcha_scripts() {
        wp_enqueue_script(
            'google-recaptcha-v3',
            'https://www.google.com/recaptcha/api.js?render=' . esc_attr( WT_RECAPTCHA_V3_SITE_KEY ),
            [],
            null,
            true
        );
        $inline = "document.addEventListener('DOMContentLoaded',function(){var form=document.getElementById('loginform');if(!form)return;form.addEventListener('submit',function(e){e.preventDefault();var f=form;if(typeof grecaptcha==='undefined'){f.submit();return;}grecaptcha.ready(function(){grecaptcha.execute('" . esc_js( WT_RECAPTCHA_V3_SITE_KEY ) . "',{action:'login'}).then(function(token){document.getElementById('wt_recaptcha_token').value=token;f.submit();});});});});";
        wp_add_inline_script( 'google-recaptcha-v3', $inline, 'after' );
    }
    add_action( 'login_enqueue_scripts', 'wt_login_recaptcha_scripts', 5 );

    function wt_login_verify_recaptcha( $user, $username, $password ) {
        if ( empty( $_POST['wt_recaptcha_token'] ) ) {
            return new WP_Error( 'recaptcha_missing', __( '<strong>Error:</strong> Security check failed. Please try again.', 'webthinkershop' ) );
        }
        $response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', [
            'body' => [
                'secret'   => WT_RECAPTCHA_V3_SECRET_KEY,
                'response' => sanitize_text_field( $_POST['wt_recaptcha_token'] ),
                'remoteip' => isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : '',
            ],
        ] );
        if ( is_wp_error( $response ) ) {
            return new WP_Error( 'recaptcha_error', __( '<strong>Error:</strong> Security check could not be completed. Please try again.', 'webthinkershop' ) );
        }
        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        if ( empty( $body['success'] ) ) {
            return new WP_Error( 'recaptcha_fail', __( '<strong>Error:</strong> Security check failed. Please try again.', 'webthinkershop' ) );
        }
        $score = isset( $body['score'] ) ? (float) $body['score'] : 0;
        $threshold = defined( 'WT_RECAPTCHA_V3_THRESHOLD' ) ? (float) WT_RECAPTCHA_V3_THRESHOLD : 0.5;
        if ( $score < $threshold ) {
            return new WP_Error( 'recaptcha_low_score', __( '<strong>Error:</strong> Security check did not pass. Please try again.', 'webthinkershop' ) );
        }
        return $user;
    }
    add_filter( 'authenticate', 'wt_login_verify_recaptcha', 30, 3 );
}
*/
