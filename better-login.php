<?php

/**
 * Plugin Name: Better Login
 * Plugin URI: http://www.julianneragland.com
 * Description: Replaces WordPress's link, logo and name on the login page with your site's link, logo and name.
 * Version: 1.0
 * Author: Julianne Ragland
 * Author URI: http://www.julianneragland.com
 */

function bl_get_custom_logo_url() {
    if ( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $custom_logo_url = wp_get_attachment_url( $custom_logo_id );
        return $custom_logo_url;
    } else {
        return false;
    }
}

// Fix login logo
add_action( 'login_enqueue_scripts', 'bl_customize_login_logo' );
function bl_customize_login_logo() {
	$logo_url = bl_get_custom_logo_url();
	if ( $logo_url ) {
?>
        <style type="text/css">
            #login h1 a {
                background-image: url('<?php echo $logo_url; ?>');
                background-size: contain;
            }
        </style>
<?php
    }
}

// Fix login header URL
add_filter( 'login_headerurl', 'bl_customize_login_url' );
function bl_customize_login_url( $url ) {
    return get_home_url();
}

// Fix login header text
add_filter( 'login_headertext', 'bl_customize_login_headertext' );
function bl_customize_login_headertext( $headertext ) {
	$headertext = get_bloginfo( 'name' );
	return $headertext;
}