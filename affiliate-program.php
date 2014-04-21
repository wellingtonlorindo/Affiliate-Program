<?php

/**
 * Plugin Name: Affiliate Program
 * Plugin URI: http://lorindo.com
 * Description: A nice wordpress plugin for affiliate program
 * Version: 1.0
 * Author: Wellington Lorindo 
 * Author URI: http://lorindo.com
 * License: GPL2
 */

/**
 * Check if WooCommerce is active
 **/
// if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
//     die("Yout must install and active the WooCommerce");
// }


update_option( 'users_can_register', 1);

register_activation_hook(__FILE__, 'createPage');
function createPage() {
	global $current_user;

	$title = 'Affiliate Registration';
	$content = '[affiliate_registration]';
	$post = array(
		'post_author' => $current_user->ID,
		'post_content' => $content,
		'post_name' =>  "registration-affp",
		'post_status' => 'publish',
		'post_title' => $title,
		'post_type' => 'page',
		'post_parent' => 0,
		'menu_order' => 0,
		'to_ping' =>  '',
		'pinged' => '',
		);
	wp_insert_post($post);	
}

register_deactivation_hook(__FILE__, 'delPage');
function delPage() {
	$page = end(get_posts(array(
			'name'      => 'registration-affp',
			'post_type' => 'page'
			)
		)
	); 
	wp_delete_post($page->ID, true);
}

add_shortcode( 'affiliate_registration', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields($user) { 
	require_once(plugin_dir_path(__FILE__).'/view/add.php');
}

// Update extra fields
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;		
	}
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
}

?>