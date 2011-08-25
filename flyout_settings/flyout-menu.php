<?php
/**
 * Plugin Admin File
 *
 * Settings for this plugin
 *
 * @package nrelate
 * @subpackage Functions
 */

function nrelate_flyout_load_admin_scripts() {
	wp_enqueue_script('nrelate_flyout_js', NRELATE_FLYOUT_SETTINGS_URL.'/nrelate_flyout_admin'. ( NRELATE_JS_DEBUG ? '' : '.min') .'.js');
}
add_action('nrelate_admin_page','nrelate_flyout_load_admin_scripts');


// Check dashboard messages if on dashboard page in admin
require_once NRELATE_FLYOUT_SETTINGS_DIR . '/flyout-messages.php';
 
/**
 * Add sub menu
 */
function nrelate_flyout_setup_admin() {

    // Add our submenu to the custom top-level menu:
	require_once NRELATE_FLYOUT_SETTINGS_DIR . '/nrelate-flyout-settings.php';
	require_once NRELATE_FLYOUT_SETTINGS_DIR . '/nrelate-flyout-styles-settings.php';
	require_once NRELATE_FLYOUT_SETTINGS_DIR . '/nrelate-flyout-animation-styles-settings.php';
    $flyoutmenu = add_submenu_page('nrelate-main', __('Flyout','nrelate'), __('Flyout','nrelate'), 'manage_options', NRELATE_FLYOUT_ADMIN_SETTINGS_PAGE, 'nrelate_flyout_settings_page');
};
add_action('admin_menu', 'nrelate_flyout_setup_admin');

/**
 * Save / Preview button
 *
 * Includes error messages
 * since v0.46.0
 */
function flyout_save_preview() { ?>
	<span class="nrelate_disabled_preview">
		<span class="nrelate-hidden thumbnails_message nr_error"><p><?php echo __('No CSS Stylesheet is selected for Thumbnails mode. Please change this setting <a href="?page=nrelate-flyout&tab=styles&mode=Thumbnails">here</a>.', 'nrelate'); ?></p></span>
		<span class="nrelate-hidden text_message nr_error"><p><?php echo __('No CSS Stylesheet is selected for Text mode. Please change this setting <a href="?page=nrelate-flyout&tab=styles&mode=Text">here</a>.', 'nrelate'); ?></p></span>
		<span class="nrelate-hidden text-warning-message nr_error"><p><?php echo __('When selecting TEXT mode you must show either <a href="#nrelate_show_post_title">Post Title</a> or <a href="#nrelate_show_post_excerpt">Post Excerpt</a>.'); ?></p></span>
	</span>
	<span class="nrelate-submit-preview">
		<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes','nrelate'); ?>" />
		<button type="button" class="nrelate_fo_preview_button button-primary"> <?php _e('Preview','nrelate'); ?> </button>
	</span>
<?php
}


/**
 * Main Flyout Settings
 *
 * Generates all settings pages
 * since v0.46.0
 */
function nrelate_flyout_settings_page() {
	global $pagenow;
	
	if ( $pagenow == 'admin.php' && $_GET['page'] == 'nrelate-flyout' ) : 
    if ( isset ( $_GET['tab'] ) ) : 
        $tab = $_GET['tab']; 
    else: 
        $tab = 'general'; 
    endif; 
    switch ( $tab ) : 
        case 'general' : 
            nrelate_flyout_do_page(); 
            break; 
        case 'styles' : 
            nrelate_flyout_styles_do_page(); 
            break; 
        case 'anim-styles' : 
            nrelate_flyout_anim_styles_do_page(); 
            break; 
    endswitch; 
	endif;
}

/**
 * Tabs for flyout settings
 *
 * since v0.46.0
 */
function nrelate_flyout_tabs($current = 0) { 

	$options = get_option('nrelate_flyout_options');
	$anitype = $options['flyout_animation'];
	
	$options = get_option('nrelate_flyout_options');
	$flytype = $options['flyout_thumbnail'];

    $tabs = array( 'general' => 'General', 'styles' => $flytype . __(' Gallery','nrelate'), 'anim-styles' => __('Animation Styles','nrelate') ); 
    $links = array();
	
		if ( $current == 0 ) {
		if ( isset( $_GET[ 'tab' ] ) ) {
			$current = $_GET[ 'tab' ];
		} else {
			$current = 'general';
		}
	}
		
    foreach( $tabs as $tab => $name ) : 
        if ( $tab == $current ) : 
            $links[] = "<a class='nav-tab nav-tab-active' href='?page=nrelate-flyout&tab=$tab'>$name</a>"; 
        else : 
            $links[] = "<a class='nav-tab' href='?page=nrelate-flyout&tab=$tab'>$name</a>"; 
        endif; 
    endforeach; 
    echo '<h2>'; 
    foreach ( $links as $link ) 
        echo $link; 
    echo '</h2>'; 
}
	

/**
 * Header for flyout settings
 *
 * Common for all settings pages
 * since v0.46.0
 */
function nrelate_flyout_settings_header() { ?>
	
	<script type="text/javascript">
		//<![CDATA[
		/*
		* User warning if switching tabs without saving
		*/
		jQuery(document).ready(function($) {
			$('form')
				// Store initial status
				.each(function(){
					var $this = $(this);
					$this.data( 'init_status', $this.serialize() );
					$this.data( 'is_dirty', false );
				})
				// Disable dirty check when submitting
				.submit(function(){
					$(window).unbind('beforeunload');
				});
			
			// Kepp track of changes on form's inputs
			$(':input').live('change keyup', function(){
				$form = $(this).closest('form');
				if ( $form.serialize() != $form.data('init_status') ) {
					$form.data( 'is_dirty', true );
				} else {
					$form.data( 'is_dirty', false );
				}
			});
			
			function is_page_dirty() {
				var is_dirty = false;
				// Iterate through forms checking if there's any dirty
				$('form').each(function(){
					if ( $(this).data( 'is_dirty' ) ) {
						is_dirty = true;
						// If found one dirty, stop iterating returning false
						return false;
					}
				});
				return is_dirty;
			}
			
			$(window).bind('beforeunload', function(){
				if ( is_page_dirty() ) {
					return "You haven't saved your changes. Do you really want to leave?";
				}
			});
		});
		//]]>
    </script>
	<div class="wrap nrelate-settings nrelate-page" style="margin: 10px 0 0 0;">
		<?php echo '<img src='. NRELATE_ADMIN_IMAGES .'/nrelate-logo.png alt="nrelate Logo" style="float:left; margin: 0 20px 0 0"; />';
		
		echo '<h2 class="nrelate-title">';
		_e('Flyout','nrelate' );
		nrelate_tos( NRELATE_FLYOUT_PLUGIN_DIR );
		echo '</h2>';
		
		_e('The Flyout plugin allows you to display related posts on your website, in a cool Flyout.
		Click <a href="'.NRELATE_WEBSITE_FORUM_URL.'" target="_blank">here</a> to read about each setting.','nrelate'); ?>
		<br><br>
		
<?php	nrelate_index_check();
		nrelate_flyout_tabs();
}


/**
 * Tells the dashboard that we're active
 * Shows icon and link to settings page
 */
function nr_fo_plugin_active(){ ?>
	<li class="active-plugins">
		<?php echo '<img src="'. NRELATE_FLYOUT_IMAGE_DIR .'/flyout.png" style="float:left;" alt="" />'?>
		<a href="admin.php?page=<?php echo NRELATE_FLYOUT_ADMIN_SETTINGS_PAGE ?>">
		<?php _e('Flyout')?> &raquo;</a>
	</li>
<?php
};
add_action ('nrelate_active_plugin_notice','nr_fo_plugin_active');



/**
 * Add settings link on plugin page
 *
 * @since 0.40.3
 */
function nrelate_flyout_add_plugin_links( $links, $file) {
	if( $file == NRELATE_FLYOUT_PLUGIN_BASENAME ){
		return array_merge( array(
			'<a href="admin.php?page='.NRELATE_FLYOUT_ADMIN_SETTINGS_PAGE.'">'.__('Settings', 'nrelate').'</a>',
			'<a href="admin.php?page=nrelate-main">'.__('Dashboard', 'nrelate').'</a>'
		),$links );
	}
	return $links;
}
add_filter('plugin_action_links', 'nrelate_flyout_add_plugin_links', 10, 2);

/**
 * Add plugin row meta on plugin page
 *
 * @since 0.40.3
 */

function nrelate_flyout_set_plugin_meta($links, $file) {
	// create link
	if ($file == NRELATE_FLYOUT_PLUGIN_BASENAME) {
		return array_merge( $links, array(
			'<a href="admin.php?page='.NRELATE_FLYOUT_ADMIN_SETTINGS_PAGE.'">'.__('Settings', 'nrelate').'</a>',
			'<a href="admin.php?page=nrelate-main">'.__('Dashboard', 'nrelate').'</a>',
			'<a href="'.NRELATE_WEBSITE_FORUM_URL.'">' . __('Support Forum', 'nrelate') . '</a>'
		));
	}
	return $links;
}
add_filter('plugin_row_meta', 'nrelate_flyout_set_plugin_meta', 10, 2 );

?>