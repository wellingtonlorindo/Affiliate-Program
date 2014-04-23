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
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    function my_admin_notice(){
	    echo '<div class="error">
		       <p>Yout must install and active the WooCommerce.</p>
		    </div>';
	}
	add_action('admin_notices', 'my_admin_notice');
	return false;
}

/**
 * Create the page of registration
 */
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

/**
 * Add the registration form
 */
add_shortcode( 'affiliate_registration', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields($user) { 
	$current_user = wp_get_current_user();
	$roles = $current_user->roles;
	if (0 != $current_user->ID) {		
		require_once(plugin_dir_path(__FILE__).'/view/edit.php');	
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
add_action( 'profile_update', 'extraProfileFields' );
add_action( 'user_register', 'extraProfileFields' );
function extraProfileFields($userId) {

	if (!current_user_can('edit_user', $userId) || $_POST['role'] != 'affiliate') {
		return false;		
	}

	foreach ($_POST['meta'] as $key => $value) {
		update_user_meta($userId, $key, $value);
	}
}

/**
 * Send Emails
 */
add_filter ("wp_mail_content_type", "my_awesome_mail_content_type");
function my_awesome_mail_content_type() {
	return "text/html";
}
	
add_filter ("wp_mail_from", "my_awesome_mail_from");
function my_awesome_mail_from() {
	return "hithere@myawesomesite.com";
}
	
add_filter ("wp_mail_from_name", "my_awesome_mail_from_name");
function my_awesome_email_from_name() {
	return "MyAwesomeSite";
}

function wp_new_user_notification($user_id, $plaintext_pass) {
	die('chamou este cara!');
	$user = new WP_User($user_id);

	$user_login = stripslashes($user->user_login);
	$user_email = stripslashes($user->user_email);
	
	$email_subject = "Welcome to MyAwesomeSite ".$user_login."!";
	
	ob_start();
	
?>
	
	<p>A very special welcome to you, <?php echo $user_login ?>. Thank you for joining MyAwesomeSite.com!</p>
	
	<p>
		Your password is <strong style="color:orange"><?php echo $plaintext_pass ?></strong> <br>
		Please keep it secret and keep it safe!
	</p>
	
	<p>
		We hope you enjoy your stay at MyAwesomeSite.com. If you have any problems, questions, opinions, praise, 
		comments, suggestions, please feel free to contact us at any time
	</p>	
	
<?php

	
	$message = ob_get_contents();
	ob_end_clean();

	wp_mail($user_email, $email_subject, $message);
}

?>