<?php
/* Plugin Name: Soc Share Plugin
Description: Used for easy placement of social sharing
Version: 1.0
Author: Baljinder Singh
Author URI: http://stdiocorps.com/
License: GPLv2 or later
Text Domain: soc-share
 */
define( 'SOCSHAREHOME', dirname( __FILE__ ) . '/' );
$basenames=explode("/", plugin_basename( __FILE__ ) );
define( 'SOCSHAREDOMAIN', $basenames[0] );
define('SOCSHAREURL', plugin_dir_url( __FILE__ ) );
 
// Includes
include(SOCSHAREHOME.'admin/post_meta.php');
include(SOCSHAREHOME.'wp/render.php');

// Include Admin Page for settings
add_action( 'admin_menu', 'settings_page' );
function settings_page() {
	add_menu_page(
		__( 'Soc Share', 'soc-share' ),
        'Soc Share',
        'manage_options',
        SOCSHAREHOME.'admin/settings.php',
        '',
        plugins_url( SOCSHAREDOMAIN.'/assets/settings-icon.png' ),
        11
    );
}

// Add metabox to relevant post types by checking options
$optns = unserialize( get_option('soc-share-set') );
foreach($optns['display_on'] as $pst) add_action( 'add_meta_boxes_' . $pst, 'post_meta_box_soc_share' );
add_action('wp_insert_post', 'add_metas_soc_share');

//Enqueue Admin and frontend side styles and scripts
function enq_script_style($hook) {
    if(is_admin()){
		if ( ( 'post.php' != $hook ) && ( 'soc-share/admin/settings.php' != $hook ) ) {
			return;
		}
		
		wp_register_style( 'soc_share_css', SOCSHAREURL . 'admin/req/soc-share-admin.css', false, '1.0.0' );
		wp_enqueue_style( 'soc_share_css' );
		wp_enqueue_script( 'soc-share', SOCSHAREURL . 'admin/req/soc-share-admin.js', array( 'jquery' ) );
		wp_enqueue_script( 'soc-share-color-js', SOCSHAREURL . 'admin/req/js-color.js', array( 'jquery' ) );
	}
	else{
		wp_register_style( 'soc_share_css_wp', SOCSHAREURL . 'wp/req/style.css', false, '1.0.0' );
		wp_enqueue_style( 'soc_share_css_wp' );
		wp_register_style( 'fontAwesome', SOCSHAREURL . 'wp/req/font-awesome.css', false, '1.0.0' );
		wp_enqueue_style( 'fontAwesome' );
		wp_enqueue_script( 'soc-share', SOCSHAREURL . 'wp/req/script.js', array( 'jquery' ) );
	}
}
add_action( 'admin_enqueue_scripts', 'enq_script_style' );
add_action( 'wp_enqueue_scripts', 'enq_script_style' );

//shortcode for easy use
function soc_share_show( $att ){
	global $post;
	
	return render_soc_share_html( @$att['networks'], @$att['size'], 'default', $post->ID );
}
add_shortcode('soc_share_show', 'soc_share_show');

//Handling Global or post specific HTML Rendering
include(SOCSHAREHOME.'wp/handeler.php');
?>