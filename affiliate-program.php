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
 * 
 **/
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    function affpAdminNotice(){
	    echo '<div class="error">
		       <p>Yout must install and to activate the <strong>WooCommerce</strong> also.</p>
		    </div>';
	}
	add_action('admin_notices', 'affpAdminNotice');
}

/**
 * Create the page of registration
 * 
 */
register_activation_hook(__FILE__, 'affpCreatePage');
function affpCreatePage() {
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

register_deactivation_hook(__FILE__, 'affpDelPage');
function affpDelPage() {
	$page = end(get_posts(array(
			'name'      => 'registration-affp',
			'post_type' => 'page'
			)
		)
	); 
	wp_delete_post($page->ID, true);
}

/**
 * Add the registration form
 *
 */
add_shortcode( 'affiliate_registration', 'affpProfileFields' );
function affpProfileFields($user) { 
	$current_user = wp_get_current_user();
	$roles = $current_user->roles;
	if (0 != $current_user->ID) {	
		if (in_array('affiliate', $roles)) {
			require_once(plugin_dir_path(__FILE__).'/view/edit.php');	
		} else {
			require_once(plugin_dir_path(__FILE__).'/view/add.php');	
		}
	} else {
		require_once(plugin_dir_path(__FILE__).'/view/add.php');		
	}

	// Load Scripts
	wp_enqueue_style( 'bootstrap', plugins_url('/css/bootstrap.min.css', __FILE__ ));
	wp_enqueue_style( 'affp-style', plugins_url('/css/style.css', __FILE__ ));
	wp_enqueue_script("jquery");
	wp_enqueue_script( 'main', plugins_url('/js/main.js', __FILE__ ));
}

// Update extra fields
add_action('profile_update', 'affpUpdateProfileFields');
add_action('user_register', 'affpUpdateProfileFields');
function affpUpdateProfileFields($userId) {

	if (!current_user_can('edit_user', $userId) || $_POST['role'] != 'affiliate') {
		return false;		
	}

	foreach ($_POST['meta'] as $key => $value) {
		update_user_meta($userId, $key, $value);
	}
}

/**
 * Send Emails
 * 
 */
add_filter ("wp_mail_content_type", "affpMailContentType");
function affpMailContentType() {
	return "text/html";
}
	
add_filter ("wp_mail_from", "affpMailFrom");
function affpMailFrom() {
	return "contact@affiliateprogram.com";
}
	
add_filter ("wp_mail_from_name", "affpMailFromName");
function affpMailFromName() {
	return "Affiliate Program";
}

add_action('user_register', 'newUserNotification');
function newUserNotification($userId) {
	$user = new WP_User($userId);
	$user_login = stripslashes($user->user_login);
	$user_email = stripslashes($user->user_email);
	
	$email_subject = "Welcome to Affiliate Program ".$user_login."!";
	
	ob_start();
	
?>	
	<p>A very special welcome to you, <?php echo $user_login ?>. Thank you for joining Affiliate Program!</p>
	
	<p>
		Click on the link below to confirm your registration. <?php bloginfo('url').'/wp-login.php';?>
	</p>

	<p>
		Your password is <strong style="color:blue"><?php echo $_POST['user_pass']; ?></strong> <br>
		Please keep it secret and keep it safe!
	</p>
	
	<p>
		We hope you enjoy your stay at affiliateprogram.com. If you have any problems, questions, opinions, praise, 
		comments, suggestions, please feel free to contact us at any time.
	</p>	
	
<?php
	
	$message = ob_get_contents();
	ob_end_clean();
	wp_mail($user_email, $email_subject, $message);
}

?>