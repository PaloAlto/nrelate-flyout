<?php
/**
 * nrelate Admin Messages
 *
 * Does system checks and sets messages for admin settings
 *
 * @package nrelate
 * @subpackage Functions
 */

 
 
 /**
 * nrelate Dashboard Messages
 *
 * Do some checks and load some messages that will help user
 */
function nr_admin_message_set(){
	
	// Let's write some messages
	// Simple create div with id adverify for nrelate to populate the content
	$msg = '<li id="adverify"></li>';
		
	 // Get admin options
	$admin_options = get_option('nrelate_admin_options');
	
	// get admin email address
	$admin_email = @$admin_options['admin_email_address'];
	
	// Communication
	if ($admin_email == null) {
		$msg = $msg . '<li><div class="red">It\'s a good idea to provide nrelate with your email address. Check the box under the <a href="#admin_email_address">Communication</a> area below.</div></li>';
		}
	// AJAX call to nrelate server to bring back ad code status
	$msg.='<script type="text/javascript"> checkad(\''.NRELATE_BLOG_ROOT.'\',\''.NRELATE_LATEST_ADMIN_VERSION.'\',\''.get_option('nrelate_key').'\'); </script>';
	echo $msg;
};
add_action ('nrelate_admin_messages','nr_admin_message_set');


 /**
 * nrelate theme compatibility
 *
 * Check active theme and provide messages to user that might be helpful.
 */
function nr_theme_compat() {
	
	// Theme Capability for either Related OR Popular
	if (defined('NRELATE_RELATED_ACTIVE') || defined('NRELATE_POPULAR_ACTIVE')) {
		$theme_data = current_theme_info();	
		
		// Woothemes
		if (strlen(strstr($theme_data->author,'woothemes'))>0) { $msg = $msg . '<li><div class="warning">' . sprintf('<strong>Woothemes</strong> are supported, but may require %sconfiguration%s.', '<a href="http://nrelate.com/theblog/theme-capatibility/woothemes/" target="_blank">', '</a>') . '</div></li>'; }
	}

echo $msg;
	
}
add_action ('nrelate_admin_messages','nr_theme_compat');




 /**
 * nrelate plugin compatibility
 *
 * Check active plugins to see if they are compatable with nrelate
 * If these plugins are active, provide messages to user that might be helpful.
 */
function nr_plugin_compat() {

	// Plugin Capability for either Related OR Popular
	if (defined('NRELATE_RELATED_ACTIVE') || defined('NRELATE_POPULAR_ACTIVE')) {

		//W3 Total Cache
		if (is_plugin_active('w3-total-cache/w3-total-cache.php')) { $msg = $msg . '<li><div class="warning">' . sprintf('<strong>W3 Total Cache</strong> is supported, but may require %sconfiguration%s.', '<a href="http://nrelate.com/theblog/plugin-compatibility/w3-total-cache/" target="_blank">', '</a>') . '</div></li>'; }

		//CDN Tools
		if (is_plugin_active('cdn-tools/cdntools.php')) { $msg = $msg . '<li><div class="warning">' . sprintf('<strong>CDN Tools</strong> option "Google ajax CDN" is not supported. You can learn more %shere%s.', '<a href="http://nrelate.com/theblog/plugin-compatibility/cdn-tools/" target="_blank">', '</a>') . '</div></li>'; }

		//WP Minify
		if (is_plugin_active('wp-minify/wp-minify.php')) { $msg = $msg . '<li><div class="warning">' . sprintf('<strong>WP Minify</strong> is supported, but may require %sconfiguration%s.', '<a href="http://nrelate.com/theblog/plugin-compatibility/wp-minify/" target="_blank">', '</a>') . '</div></li>'; }
		
		
	}
	
echo isset($msg) ? $msg : '';
	
}
add_action ('nrelate_admin_messages','nr_plugin_compat');
	


		
?>