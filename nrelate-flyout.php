<?php
/**
Plugin Name: nrelate Flyout
Plugin URI: http://www.nrelate.com
Description: Easily allow related posts to flyout from the sides of your website. Click on <a href="admin.php?page=nrelate-flyout">nrelate &rarr; Flyout</a> to configure your settings.
Author: <a href="http://www.nrelate.com">nrelate</a> and <a href="http://www.slipfire.com">SlipFire</a>
Version: 0.49.3
Author URI: http://nrelate.com/

/*
 * This plugin was inspired by the:
 * upPrev Previous Post Animated Notification plugin
 * @author: Jason Pelker, Grzegorz Krzyminski
 * @author uri: http://item-9.com/
 * @link: http://wordpress.org/extend/plugins/upprev-nytimes-style-next-post-jquery-animated-fly-in-button/
 */


// Copyright (c) 2011 nrelate, All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// This is a plugin for WordPress
// http://wordpress.org/
//
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************


/**
 * Define Plugin constants
 */
define( 'NRELATE_FLYOUT_PLUGIN_VERSION', '0.49.3' );
define( 'NRELATE_FLYOUT_ADMIN_SETTINGS_PAGE', 'nrelate-flyout' );
define( 'NRELATE_FLYOUT_ADMIN_VERSION', '0.03.0' );

define( 'NRELATE_LATEST_ADMIN_VERSION', '0.03.0' );
define( 'NRELATE_CSS_URL', 'http://static.nrelate.com/common_wp/' . NRELATE_FLYOUT_ADMIN_VERSION . '/' );
define( 'NRELATE_BLOG_ROOT', urlencode(str_replace(array('http://','https://'), '', get_bloginfo( 'url' ))));
define( 'NRELATE_JS_DEBUG', isset($_REQUEST['nrelate_debug']) ? true : false );

define( 'NRELATE_ADMIN_COMMON_FILE', plugin_basename( __FILE__ ) );
define( 'NRELATE_ADMIN_DIR_NAME', trim( dirname( NRELATE_ADMIN_COMMON_FILE ), '/' ) );
define( 'NRELATE_ADMIN_DIR', WP_PLUGIN_DIR . '/' . NRELATE_ADMIN_DIR_NAME.'/admin');
define( 'NRELATE_ADMIN_URL', WP_PLUGIN_URL . '/' . NRELATE_ADMIN_DIR_NAME.'/admin');

/**
 * Define Path constants
 */
// Generic: will be assigned to the last nrelate plugin that loads
define( 'NRELATE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'NRELATE_PLUGIN_NAME', trim( dirname( NRELATE_PLUGIN_BASENAME ), '/' ) );
define( 'NRELATE_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . NRELATE_PLUGIN_NAME );

// Plugin specific
define( 'NRELATE_FLYOUT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'NRELATE_FLYOUT_PLUGIN_NAME', trim( dirname( NRELATE_FLYOUT_PLUGIN_BASENAME ), '/' ) );
define( 'NRELATE_FLYOUT_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . NRELATE_FLYOUT_PLUGIN_NAME );
define( 'NRELATE_FLYOUT_PLUGIN_URL', WP_PLUGIN_URL . '/' . NRELATE_FLYOUT_PLUGIN_NAME );
define( 'NRELATE_FLYOUT_SETTINGS_DIR', NRELATE_FLYOUT_PLUGIN_DIR . '/flyout_settings' );
define( 'NRELATE_FLYOUT_SETTINGS_URL', NRELATE_FLYOUT_PLUGIN_URL . '/flyout_settings' );
define( 'NRELATE_FLYOUT_ADMIN_DIR', NRELATE_FLYOUT_PLUGIN_DIR . '/admin' );
define( 'NRELATE_FLYOUT_IMAGE_DIR', NRELATE_FLYOUT_PLUGIN_URL . '/images' );

// Load WP_Http
if( !class_exists( 'WP_Http' ) )
	include_once( ABSPATH . WPINC. '/class-http.php' );
	
// Load Language
load_plugin_textdomain('nrelate-flyout', false, NRELATE_FLYOUT_PLUGIN_DIR . '/language');

/**
 * Get the product status of all nrelate products.
 *
 * @since 0.49.0
 */
if ( ! defined( 'NRELATE_PRODUCT_STATUS' ) ) { require_once ( NRELATE_FLYOUT_ADMIN_DIR . '/product-status.php' ); }

/**
 * Load common styles if another nrelate plugin has not loaded it yet.
 *
 * @since 0.46.0
 */
if (!isset($nrelate_thumbnail_styles)) { require_once ( NRELATE_FLYOUT_ADMIN_DIR . '/styles.php' ); }
require_once ( NRELATE_FLYOUT_SETTINGS_DIR . '/flyout-animation-styles.php' );

/**
 * Check related version to make sure it is compatible with MP
 */
$related_settings = get_option('nrelate_related_options');
$related_version = $related_settings['related_version'];
if($related_version!='' &&version_compare("0.47.4", $related_version)>0){
	$plugin = NRELATE_FLYOUT_PLUGIN_BASENAME;
	$warning = "<p><strong>".__('nrelate Warning(s):', 'nrelate')."</strong></p>";
	$message .= "<li>".sprintf(__('You\'re running Related Content plugin version %1$s. The Flyout plugin requires Related Content version to be 0.47.4 or higher.<br/>Please upgrade to the latest release of Related Content plugin before installing the Flyout plugin.', 'nrelate' ), $related_version ) . "</li>";
	$closing = "<p>".__('The nrelate Flyout plugin has been deactivated.','nrelate')."<br/><br/><a href=\"/wp-admin\">".__('Click here to return to your WordPress dashboard.','nrelate')."</a></p>";
	deactivate_plugins($plugin);
	wp_die( $warning . "<ol>" . $message . "<ol>" . $closing );
	return;
}

/**
 * Initializes the plugin and it's features.
 *
 * @since 0.1
 */
if (is_admin()) {

		//load common admin files if not already loaded from another nrelate plugin
		if ( ! defined( 'NRELATE_COMMON_LOADED' ) ) { require_once ( NRELATE_FLYOUT_ADMIN_DIR . '/common.php' ); }
		
		//load plugin status
		require_once ( NRELATE_FLYOUT_SETTINGS_DIR . '/flyout-plugin-status.php' );
		
		//load flyout menu
		require_once ( NRELATE_FLYOUT_SETTINGS_DIR . '/flyout-menu.php' );
}



/** Load common frontend functions **/
if ( ! defined( 'NRELATE_COMMON_FRONTEND_LOADED' ) ) { require_once ( NRELATE_FLYOUT_ADMIN_DIR . '/common-frontend.php' ); }

/*
 * Load flyout styles
 *
 * since v.44.0
 * updated v46.0
 */
function nrelate_flyout_styles() {
	if ( nrelate_flyout_is_loading() ) {
	
		//Identify style type and stylesheet
		$options = get_option('nrelate_flyout_options');
		$style_options = get_option('nrelate_flyout_options_styles');
			if ($options['flyout_thumbnail']=='Thumbnails') {
				//Thumbnails mode
				if ('none'==$style_options['flyout_thumbnails_style']) return;
				$style_type = $style_options['flyout_thumbnails_style'];
				$stylesheet = 'nrelate-panels-' . $style_type .'.min.css';
				
				// Register ie6 styles
				$nr_css_ie6_url = NRELATE_CSS_URL . "ie6-panels.min.css";
				$nr_ie6_id = 'nrelate-ie6-' . str_replace(".","-",NRELATE_FLYOUT_ADMIN_VERSION);
				wp_register_style($nr_ie6_id, $nr_css_ie6_url, false, null );
				$GLOBALS['wp_styles']->add_data( $nr_ie6_id, 'conditional', 'IE 6' );
			
			} else {
			//Text mode
				if ('none'==$style_options['flyout_text_style']) return;
				$style_type = 'text' . $style_options['flyout_text_style'];
				$stylesheet = 'nrelate-text-'.$style_options['flyout_text_style'].'.min.css';
			}
			
			
		//Identify Animation type and stylesheet
		$options = get_option('nrelate_flyout_options');
		$animstyle_options = get_option('nrelate_flyout_anim_options_styles');
			if ($options['flyout_animation']=='Slideout') {
				//Slideout Animation
				if ('none'==$animstyle_options['flyout_anim_slideout_style']) return;
				$anim_style_type = 'flyout-' . $animstyle_options['flyout_anim_slideout_style'];
				//$anim_style_type = 'slideout-' . $animstyle_options['flyout_anim_slideout_style']; use for two different styles
				$anim_stylesheet = 'nrelate-' . $anim_style_type .'.min.css';		
			} else {
			//Fade Animation
				if ('none'==$animstyle_options['flyout_anim_fade_style']) return;
				$anim_style_type = 'flyout-' . $animstyle_options['flyout_anim_slideout_style'];
				//$anim_style_type = 'fade-' . $animstyle_options['flyout_anim_fade_style'];  use for two different styles
				$anim_stylesheet = 'nrelate-'.$anim_style_type .'.min.css';
			}
		
		$fo_css_url = NRELATE_CSS_URL . $stylesheet;
		// For local development
		//$fo_css_url = NRELATE_FLYOUT_PLUGIN_URL . '/' . $stylesheet;
		
		$fo_anim_css_url = NRELATE_CSS_URL . $anim_stylesheet;
		// For local development
		//$fo_anim_css_url= NRELATE_FLYOUT_PLUGIN_URL . '/' . $anim_stylesheet;
		
		// Load content style
		wp_register_style('nrelate-style-'. $style_type . "-" . str_replace(".","-",NRELATE_FLYOUT_ADMIN_VERSION), $fo_css_url, false, null );
		wp_enqueue_style( 'nrelate-style-'. $style_type . "-" . str_replace(".","-",NRELATE_FLYOUT_ADMIN_VERSION) );
		
		// Load animation style
		wp_register_style('nrelate-style-'. $anim_style_type . "-" . str_replace(".","-",NRELATE_FLYOUT_ADMIN_VERSION), $fo_anim_css_url, false, null );
		wp_enqueue_style( 'nrelate-style-'. $anim_style_type . "-" . str_replace(".","-",NRELATE_FLYOUT_ADMIN_VERSION) );
		
		wp_enqueue_style( 'nrelate-ie6-' . str_replace(".","-",NRELATE_FLYOUT_ADMIN_VERSION) );
	}
}
add_action('wp_print_styles', 'nrelate_flyout_styles');

/*
 * Check if nrelate is loading (frontend only)
 *
 * @since 0.47.0
 */
function nrelate_flyout_is_loading() {
 	// Temporary added YK: flyout will only work for is_single for beta version
 	// Don't care about the where_to_show field, just show on is_single
    // Probably will change in the future
	/*$is_loading = false;
   
    if ( !is_admin() ) {   
        $options = get_option('nrelate_flyout_options');
       
        if ( isset($options['flyout_where_to_show']) ) {
            foreach ( (array)$options['flyout_where_to_show'] as $cond_tag ) {
                if ( function_exists( $cond_tag ) && call_user_func( $cond_tag ) ) {
                    $is_loading = true;
                    break;
                }
            }
        }
    }*/
   if(is_single())
		$is_loading=true;
    return apply_filters( 'nrelate_flyout_is_loading', $is_loading);
}



/**
 * Inject flyout posts into the content
 *
 * Stops injection into themes that use get_the_excerpt in their meta description
 *
 * @since 0.1
 */
function nrelate_flyout_inject($content) {
	global $post;
	
	if ( nrelate_flyout_should_inject() ) {

		$content_bottom = nrelate_flyout(true);

		$original = $content;

		$content  = "<div id='nr_fo_top_of_post'></div>";
		$content .= $original;
		$content .= "<div id='nr_fo_bot_of_post'></div> ".$content_bottom;
	}
	
	return $content;
}
add_filter( 'the_content', 'nrelate_flyout_inject', 10 );
add_filter( 'the_excerpt', 'nrelate_flyout_inject', 10 );


/**
 * Returns true if currently the_content or the_excerpt
 * filter should be injected with nrelate code
 *
 * @since 0.47.3
 */
function nrelate_flyout_should_inject() {
	global $wp_current_filter;
	
	$should_inject = true;
	
	if ( !nrelate_is_main_loop() ) {
		// Don't inject if out of main loop
		$should_inject = false;
	} elseif ( in_array( 'get_the_excerpt', $wp_current_filter ) ) {
		// Don't inject if calling get_the_excerpt
		$should_inject = false;
	} elseif ( is_single() && in_array( 'the_excerpt', $wp_current_filter ) ) {
		// Don't inject the_excerpt on single post pages
		$should_inject = false;
	}
	
	// Third party widgets
	// For php 5.25 support: debug_backtrace(false);
	$call_stack = debug_backtrace();
	foreach ( $call_stack as $call ) {
		if ( $call['function'] == 'widget' ) {
			$should_inject = false;
			break;
		}
	}
	
	return apply_filters( 'nrelate_flyout_should_inject', $should_inject );
}


// FLYOUT: this function will build the js for flyout
require_once ( NRELATE_FLYOUT_SETTINGS_DIR . '/flyout_frontend.php' );

/**
 * Primary function
 *
 * Gets options and passes to nrelate via Javascript
 *
 * @since 0.1
 */
 
$nr_fo_counter = 0;


function nrelate_flyout() {
	global $post, $nr_fo_counter;
	
	$animation_fix = $nr_fo_nonjsbody = $nr_fo_nonjsfix = $nr_fo_js_str = $flyout_js_str= '';
	
	if ( nrelate_flyout_is_loading() )  {	
		$nr_fo_counter++;
		$nrelate_flyout_options = get_option('nrelate_flyout_options');
		
		$fo_style_options = get_option('nrelate_flyout_options_styles');
		$fo_style_code = 'nrelate_' . (($nrelate_flyout_options['flyout_thumbnail']=='Thumbnails') ? $fo_style_options['flyout_thumbnails_style'] : $fo_style_options['flyout_text_style']);
		
		$fo_anim_style_options = get_option('nrelate_flyout_anim_options_styles');
		//$fo_anim_style_code = 'nrelate_animate_style_' . (($nrelate_flyout_options['flyout_animation']=='Slideout') ? $fo_anim_style_options['flyout_anim_slideout_style'] : $fo_anim_style_options['flyout_anim_fade_style']); // use for two styles
		$fo_anim_style_code = 'nrelate_animate_style_' . $fo_anim_style_options['flyout_anim_slideout_style'];
		
		$nr_fo_width_class = 'nr_' . (($nrelate_flyout_options['flyout_thumbnail']=='Thumbnails') ? $nrelate_flyout_options['flyout_thumbnail_size'] : "text");
		$post_title = urlencode(get_the_title($post->ID));
		$post_urlencoded = urlencode(get_permalink($post->ID));
		$nonjs=$nrelate_flyout_options['flyout_nonjs'];
		
		$nr_url = "http://api.nrelate.com/fow_wp/" . NRELATE_FLYOUT_PLUGIN_VERSION . "/?tag=nrelate_flyout";
		$nr_url .= "&keywords=$post_title&domain=" . NRELATE_BLOG_ROOT . "&url=$post_urlencoded&nr_div_number=".$nr_fo_counter;
		$nr_url .= is_home() ? '&source=hp' : '';
		//is loaded only once per page
		if (!defined('NRELATE_FLYOUT_HOME')) {
			define('NRELATE_FLYOUT_HOME', true);
		    
			$animation_fix = '<style type="text/css">.nrelate .nr_sponsored{ left:0px !important; }</style>';
			
			if (!empty($nrelate_flyout_options['flyout_ad_animation'])) {
				$animation_fix = '';
			}
			//FLY OUT ANIMATION FIX
			$frombot = $nrelate_flyout_options['flyout_from_bot'];
			$frombottype = $nrelate_flyout_options['flyout_from_bot_type'];
			$flyout_width = $nrelate_flyout_options['flyout_anim_width'];
			$flyout_width_type = $nrelate_flyout_options['flyout_anim_width_type'];
			$position = $nrelate_flyout_options['flyout_loc'] == "Right" ? "right" : "left";
			$flyout_hide_width = 0;
			if($flyout_width_type=="px"){
				$flyout_hide_width=-($flyout_width+40);
			}else{
				$flyout_hide_width=-($flyout_width+4);
			}
			if ($nrelate_flyout_options['flyout_animation'] == "Fade") {
				$flyout_animation_type = 'fade';
		        $flyout_animation= "<style type='text/css'>.nrelate_flyout {display:block; ".$position.": ".$flyout_hide_width.$flyout_width_type."; bottom: ".$frombot.$frombottype."; width:".$flyout_width.$flyout_width_type.";} #nrelate_flyout_open{display:none; ".$position.":0px; bottom: ".$frombot.$frombottype.";}";
		    } else {
				$flyout_animation_type = 'slideout';
		        $flyout_animation= "<style type='text/css'>.nrelate_flyout {display:block; ".$position.": ".$flyout_hide_width.$flyout_width_type."; bottom: ".$frombot.$frombottype."; width:".$flyout_width.$flyout_width_type.";} #nrelate_flyout_open{display:block; ".$position.": -80px;bottom: ".$frombot.$frombottype.";}";
		    }
		    $flyout_animation.=" #nrelate_flyout_close{background: #fff url(".NRELATE_FLYOUT_PLUGIN_URL."/images/close_window.gif) no-repeat 0 0} </style>";
			$flyout_type_position = strtolower( $flyout_animation_type . '_' . $position );
			
		    //This call makes the js for flyout
			$flyout_js_str=nrelate_flyout_makejs();
		}
		if(!defined('NRELATE_HOME')){
			define('NRELATE_HOME', true);
			$domain = addslashes(NRELATE_BLOG_ROOT);
			
			$script = <<< EOD
				$animation_fix
				<script type="text/javascript">
				//<![CDATA[
					nRelate.domain = "{$domain}";
				//]]>
				</script>
				$flyout_animation
EOD;
			
			echo $script;
		}
		if($nonjs){
			$request = new WP_Http;
		    $args=array("timeout"=>5);
		    $response = $request->request( $nr_url."&nonjs=1",$args);
		    if( !is_wp_error( $response ) ){
			    if($response['response']['code']==200 && $response['response']['message']=='OK'){
				    $nr_fo_nonjsbody=$response['body'];
			   		$nr_fo_nonjsfix='<script type="text/javascript">nRelate.fixHeight("nrelate_flyout_'.$nr_fo_counter.'"); ';
			   		$nr_fo_nonjsfix.='nRelate.adAnimation("nrelate_flyout_'.$nr_fo_counter.'"); ';
					$nr_fo_nonjsfix.='nRelate.tracking("fo"); ';
					$nr_fo_nonjsfix.=$flyout_js_str.'</script>';
			    }else{
			    	$nr_fo_nonjsbody="<!-- nrelate error: nrelate server not 200. -->";
			    }
		    }else{
		    	$nr_fo_nonjsbody="<!-- nrelate error: WP-request to nrelate server failed. -->";
		    }
		}
		else{
			$nr_fo_js_str= <<<EOD
	<script type="text/javascript">
	//<![CDATA[
		$flyout_js_str 
		var entity_decoded_nr_url = jQuery('<div/>').html("$nr_url").text();
		nRelate.getNrelatePosts(entity_decoded_nr_url);
	//]]>
	</script>
EOD;
		}
		$markup = <<<EOD
$animation_fix
<div class="nr_clear"></div>
	<div id="nrelate_flyout_{$nr_fo_counter}" class="nrelate nrelate_flyout nr_$flyout_type_position nr_animate_type_$flyout_animation_type $fo_anim_style_code $fo_style_code $nr_fo_width_class">$nr_fo_nonjsbody</div>
	<!--[if IE 6]>
		<script type="text/javascript">jQuery('.$fo_style_code').removeClass('$fo_style_code');</script>
	<![endif]-->
	$nr_fo_nonjsfix
	$nr_fo_js_str
    <div id='nrelate_flyout_open' class='$fo_anim_style_code nr_$flyout_type_position'></div>
	<div class="nr_clear"></div>
EOD;

echo $markup;

	}
}


//Activation and Deactivation functions
//Since 0.47.4, added uninstall hook
register_activation_hook(__FILE__, 'nr_fo_add_defaults');
register_deactivation_hook(__FILE__, 'nr_fo_deactivate');
register_uninstall_hook(__FILE__, 'nr_fo_uninstall');
?>