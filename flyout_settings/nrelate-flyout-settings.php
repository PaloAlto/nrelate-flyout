<?php
/**
 * nrelate Flyout Settings
 *
 * @package nrelate
 * @subpackage Functions
 */


function options_init_nr_fo(){
	register_setting('nrelate_flyout_options', 'nrelate_flyout_options', 'flyout_options_validate' );
	
	$options = get_option('nrelate_flyout_options');
	// Display preview image
	if($options['flyout_thumbnail']=="Thumbnails"){
		$divstyle = 'style="display:block;"';
	}
	else{
		$divstyle = 'style="display:none;"';
	}
	if($options['flyout_offset']==4){
		$offset_divstyle = 'style="display:block;"';
	}
	else{
		$offset_divstyle = 'style="display:none;"';
	}
	
	// Main Section
	add_settings_section('main_section', __('Main Settings','nrelate'), 'section_text_nr_fo', __FILE__);
	add_settings_field('flyout_save_preview_top','', 'flyout_save_preview', __FILE__, 'main_section');
	add_settings_field('flyout_thumbnail', __('Would you like to display thumbnails with text, or text only','nrelate'), 'setting_flyout_thumbnail',__FILE__,'main_section');
	add_settings_field('flyout_thumbnail_size', __('<div id="imagesizepreview_header" '.$divstyle.'>Please choose a thumbnail size','nrelate') . nrelate_thickbox_youtube('9Y09dHk8nO0','flyout_thumbnailsize_video') . '</div>', 'setting_flyout_thumbnail_size',__FILE__,'main_section');
	add_settings_field('flyout_default_image', __('<div id="imagepreview_header" '.$divstyle.'>Please provide a link to your default image: (This will show up when a flyout post does not have a picture in it)<br/><i>For best results image should be as large (or larger) than the thumbnail size you chose above.</i>' . nrelate_thickbox_youtube('OzTtXJUgW3c','flyout_default_image') . '</div>','nrelate'), 'setting_flyout_default_image',__FILE__,'main_section');
	add_settings_field('flyout_custom_field', __('<div id="imagecustomfield_header" '.$divstyle.'>If you use <b>Custom Fields</b> for your images, nrelate can show them.</div>','nrelate'), 'setting_flyout_custom_field',__FILE__,'main_section');
	add_settings_field('flyout_title', __('Please enter a title for the flyout box','nrelate') . nrelate_thickbox_youtube('cWEpWJ7Ftsw','flyout_title_video'), 'setting_string_nr_fo', __FILE__, 'main_section');
	add_settings_field('flyout_number_of_posts', __('<b>Maximum</b> number of flyout posts to display from this site','nrelate'), 'setting_flyout_number_of_posts', __FILE__, 'main_section');
	add_settings_field('flyout_bar', __('How relevant do you want the results to be?<br/><i>Based on the amount/type of content on your website, higher relevancy settings may return little or no posts.</i>','nrelate'), 'setting_flyout_bar_nr_fo', __FILE__, 'main_section');
	add_settings_field('flyout_max_age', __('How deep into your archive would you like to go for flyout posts?','nrelate'), 'setting_flyout_max_age', __FILE__, 'main_section');
	add_settings_field('flyout_exclude_cats', __('Exclude Categories from your flyout content.','nrelate'), 'setting_flyout_exclude_cats',__FILE__,'main_section');
	add_settings_field('flyout_show_post_title', '<a name="nrelate_show_post_title"></a>'.__('Show Post Title?','nrelate'), 'setting_flyout_show_post_title', __FILE__, 'main_section');
	add_settings_field('flyout_max_chars_per_line', __('Maximum number of characters for title?','nrelate'), 'setting_flyout_max_chars_per_line', __FILE__, 'main_section');
	add_settings_field('flyout_show_post_excerpt', '<a name="nrelate_show_post_excerpt"></a>'.__('Show Post Excerpt?','nrelate'), 'setting_flyout_show_post_excerpt', __FILE__, 'main_section');
	add_settings_field('flyout_max_chars_post_excerpt', __('Maximum number of words for post excerpt?','nrelate'), 'setting_flyout_max_chars_post_excerpt', __FILE__, 'main_section');
	add_settings_field('flyout_save_preview','', 'flyout_save_preview', __FILE__, 'main_section');
	

	// Layout Section
	add_settings_section('layout_section',__('Layout Settings','nrelate'), 'section_text_nr_fo_layout', __FILE__);
	//add_settings_field('flyout_where_to_show',__('Which pages should display flyout content?','nrelate'), 'setting_flyout_where_to_show', __FILE__, 'layout_section');
	add_settings_field('flyout_loc',__('Which side of the page should the box appear from?','nrelate'), 'setting_flyout_loc', __FILE__, 'layout_section');
	add_settings_field('flyout_animation',__('Choose an Animation type,','nrelate') . '<br><a href="admin.php?page=nrelate-flyout&tab=anim-styles">' . __('then an animation style','nrelate') . '</a>'	, 'setting_flyout_animation', __FILE__, 'layout_section');
	add_settings_field('flyout_offset',__('When should the Flyout appear?','nrelate'), 'setting_flyout_offset', __FILE__, 'layout_section');	
	add_settings_field('flyout_offset_element','<div id="flyout_offset_div_header" '.$offset_divstyle.'>'.__('Before which HTML element should the box appear? (i.e. #comments, .entry-content)','nrelate').'</div>', 'setting_flyout_offset_element', __FILE__, 'layout_section');
	add_settings_field('flyout_width',__('Width of Flyout box:','nrelate'), 'setting_flyout_width', __FILE__, 'layout_section');
	add_settings_field('flyout_from_bot',__('How far from the bottom of the screen do you want the box to appear?','nrelate'), 'setting_flyout_from_bot', __FILE__, 'layout_section');
	add_settings_field('flyout_css_link',__('Change the Style','nrelate','nrelate'), 'setting_flyout_css_link', __FILE__, 'layout_section');
	add_settings_field('flyout_display_logo',__('Would you like to support nrelate by displaying our logo?','nrelate'), 'setting_flyout_display_logo', __FILE__, 'layout_section');
	add_settings_field('flyout_save_preview','', 'flyout_save_preview', __FILE__, 'layout_section');

	// Ad Section
	add_settings_section('ad_section',__('Advertising Settings','nrelate'), 'section_text_nr_fo_ad', __FILE__);
	add_settings_field('flyout_display_ad',__('Would you like to display ads?','nrelate'), 'setting_flyout_display_ad', __FILE__, 'ad_section');
	add_settings_field('flyout_ad_number',__('How many ad spaces do you wish to show?','nrelate'), 'setting_flyout_ad_number', __FILE__, 'ad_section');
	add_settings_field('flyout_ad_placement',__('Where would you like to place the ads?','nrelate'), 'setting_flyout_ad_placement', __FILE__, 'ad_section');
	add_settings_field('flyout_ad_animation',__('Would you like to show animated "sponsored" text in ads?','nrelate'), 'setting_flyout_ad_animation', __FILE__, 'ad_section');
	add_settings_field('flyout_save_preview','', 'flyout_save_preview', __FILE__, 'ad_section');

	// Labs Section
	add_settings_section('labs_section',__('nrelate Labs','nrelate'), 'section_text_nr_fo_labs', __FILE__);
	add_settings_field('flyout_nonjs', __('Which nrelate version would you like to use?','nrelate'), 'setting_flyout_nonjs', __FILE__, 'labs_section');
	
	// Reset Setting
	add_settings_section('reset_section',__('Reset Settings to Default','nrelate'), 'section_text_nr_fo_reset', __FILE__);
	add_settings_field('flyout_reset',__('Would you like to restore to defaults upon reactivation?','nrelate'), 'setting_reset_nr_fo', __FILE__, 'reset_section');
	add_settings_field('flyout_save_preview','', 'flyout_save_preview', __FILE__, 'reset_section');
	
}
add_action('admin_init', 'options_init_nr_fo' );


/****************************************************************
 ************************** Admin Sections ********************** 
*****************************************************************/

///////////////////////////
//   Main Settings
//////////////////////////
 
// Section HTML, displayed before the first option
function section_text_nr_fo() {
	_e('<p class="section-desc">Main controls for your flyout content.</p>','nrelate');
}



// DROP-DOWN-BOX - Name: nrelate_flyout_options[flyout_number_of_posts]
function setting_flyout_number_of_posts() {
	$options = get_option('nrelate_flyout_options');
	$items = array("0","1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
	echo "<select id='flyout_number_of_posts' name='nrelate_flyout_options[flyout_number_of_posts]'>";
	foreach($items as $item) {
		$selected = ($options['flyout_number_of_posts']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
}

// DROP-DOWN-BOX - Name: nrelate_flyout_options[flyout_bar]
function  setting_flyout_bar_nr_fo() {
	$options = get_option('nrelate_flyout_options');
	$items = array ("Low", "Medium", "High");
	$itemval = array ("Low" => __("Low: least relevant",'nrelate'), "Medium" => __("Med: more relevant",'nrelate'), "High" => __("High: most relevant",'nrelate'));
	echo "<select id='flyout_bar' name='nrelate_flyout_options[flyout_bar]'>";
	foreach($items as $item) {
		$selected = ($options['flyout_bar']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$itemval[$item]</option>";
	}
	echo "</select>";
}

// TEXTBOX - Name: nrelate_flyout_options[flyout_title]
function setting_string_nr_fo() {
	$options = get_option('nrelate_flyout_options');
	$r_title = stripslashes(stripslashes($options['flyout_title']));
	$r_title = htmlspecialchars($r_title);
	echo '<input id="flyout_title" name="nrelate_flyout_options[flyout_title]" size="40" type="text" value="'.$r_title.'" />';
}


// TEXTBOX / DROPDOWN - Name: nrelate_flyout_options[flyout_max_age]
function setting_flyout_max_age() {
	$options_num = get_option('nrelate_flyout_options');
	$options_frame = get_option('nrelate_flyout_options');
	$items = array(
		"Hour(s)" => __("Hour(s)","nrelate"),
		"Day(s)" => __("Day(s)","nrelate"),
		"Week(s)" => __("Week(s)","nrelate"),
		"Month(s)" => __("Month(s)","nrelate"),
		"Year(s)" => __("Year(s)","nrelate")
	);
	echo "<input id='flyout_max_age_num' name='nrelate_flyout_options[flyout_max_age_num]' size='4' type='text' value='{$options_num['flyout_max_age_num']}' />";
	
	echo "<select id='flyout_max_age_frame' name='nrelate_flyout_options[flyout_max_age_frame]'>";
	foreach($items as $type => $item) {
		$selected = ($options_frame['flyout_max_age_frame']==$item) ? 'selected="selected"' : '';
		echo "<option value='$type' $selected>$item</option>";
	}
		echo "</select>";
}

// CHECKBOX - Show Post Title
function setting_flyout_show_post_title(){
	$options = get_option('nrelate_flyout_options');
	$checked = @$options['flyout_show_post_title']=='on' ? ' checked="checked" ' : '';
	echo "<input ".$checked." id='flyout_show_post_title' name='nrelate_flyout_options[flyout_show_post_title]' type='checkbox'/>";
}

// TEXTBOX - Characters for Post Title
function setting_flyout_max_chars_per_line() {
	$options = get_option('nrelate_flyout_options');
	echo "<input id='flyout_max_chars_per_line' name='nrelate_flyout_options[flyout_max_chars_per_line]' size='4' type='text' value='{$options['flyout_max_chars_per_line']}' />";
}

// CHECKBOX - Show Post Excerpt
function setting_flyout_show_post_excerpt(){
	$options = get_option('nrelate_flyout_options');
	$checked = @$options['flyout_show_post_excerpt']=='on' ? ' checked="checked" ' : '';
	echo "<input ".$checked." id='flyout_show_post_excerpt' name='nrelate_flyout_options[flyout_show_post_excerpt]' type='checkbox'/>";
}

// TEXTBOX - Characters for Post Excerpt
function setting_flyout_max_chars_post_excerpt() {
	$options = get_option('nrelate_flyout_options');
	echo "<input id='flyout_max_chars_post_excerpt' name='nrelate_flyout_options[flyout_max_chars_post_excerpt]' size='4' type='text' value='{$options['flyout_max_chars_post_excerpt']}' />";
}


// CHECKBOX - Name: nrelate_flyout_options[flyout_reset]
function setting_reset_nr_fo() {
	$options = get_option('nrelate_flyout_options');
	$checked = @$options['flyout_reset'] == 'on' ? ' checked="checked" ' : '';
	echo "<input ".$checked." id='plugin_flyout_reset' name='nrelate_flyout_options[flyout_reset]' type='checkbox' />";
}

///////////////////////////
//   Layout Settings
//////////////////////////

// Section HTML, displayed before the first option
function section_text_nr_fo_layout(){
	echo '<div class="section-desc">How do you want your content to display?</div>';
}
/*
// CHECKBOX LIST - Where to show flyout content
function setting_flyout_where_to_show(){
	$options = get_option('nrelate_flyout_options');
	// Define conditional tags tree	
	$cond_tags = array(
		(object) array(
			"term_id" => 1,
			"check_val" => "is_front_page",
            "name" => "Front Page", 
            "parent" => 0
		),
		(object) array(
			"term_id" => 2,
			"check_val" => "is_single",
            "name" => "Single Posts", 
            "parent" => 0
		),
		(object) array(
			"term_id" => 3,
			"check_val" => "is_page",
            "name" => "Pages", 
            "parent" => 0
		),
		(object) array(
			"term_id" => 4,
			"check_val" => "is_archive",
            "name" => "All Archives", 
            "parent" => 0
		),
				(object) array(
					"term_id" => 6,
					"check_val" => "is_category",
					"name" => "Category Archives", 
					"parent" => 4
				),
				(object) array(
					"term_id" => 7,
					"check_val" => "is_tag",
					"name" => "Tag Archives", 
					"parent" => 4
				),
				(object) array(
					"term_id" => 8,
					"check_val" => "is_author",
					"name" => "Author Archives", 
					"parent" => 4
				),
				(object) array(
					"term_id" => 9,
					"check_val" => "is_date",
					"name" => "Date Archives", 
					"parent" => 4
				),
		(object) array(
			"term_id" => 5,
			"check_val" => "is_search",
            "name" => "Search Results", 
            "parent" => 0
		),
		(object) array(
			"term_id" => 11,
			"check_val" => "is_attachment",
            "name" => "Attachment Pages", 
            "parent" => 0
		)
	);
	
	$args = array('taxonomy' => 'category', 'value_field' => 'check_val');
	$args['selected_cats'] = is_array(@$options['flyout_where_to_show']) ? $options['flyout_where_to_show'] : array();
	$args['name'] = 'nrelate_flyout_options[flyout_where_to_show]';
	
	echo '<div id="nrelate-where-to-show" class="categorydiv"><ul id="categorychecklist" class="list:category categorychecklist form-no-clear">';
	$walker = new nrelate_Walker_Category_Checklist();
	echo call_user_func_array(array(&$walker, 'walk'), array($cond_tags, 0, $args));
	
	echo '</ul></div>';
	
	$javascript = <<< JAVA_SCRIPT
jQuery(document).ready(function(){
	var nrelate_where_to_show_check = jQuery('#nrelate-where-to-show :checkbox');
	
	nrelate_where_to_show_check.change(function(){
		var me = jQuery(this);
		
		if ( !me.is(':checked') && me.val() == 'is_single' ) {
			if ( !confirm("Are you sure you do not want to show flyout content on single posts?") ) {
				me.attr('checked', true );
			}
		}
		
		if ( nrelate_where_to_show_check.filter(':checked').size() == 0 ) {
			if ( !confirm("Flyout content will not be shown anywhere. Please confirm.") ) {
				me.attr('checked', true );
			}
		}
		
		// Check children
		me.parent().siblings('.children').find(':checkbox').attr('checked', me.is(':checked'));
		
		// If a child, check/uncheck parent according to group
		var siblings = me.closest('.children').find(':checkbox');
		if ( siblings.size() ) {
			if ( siblings.size() == siblings.filter(':checked').size() ) {
				me.closest('.parent-category').children('.selectit').find(':checkbox').attr('checked', true);	
			} else {
				me.closest('.parent-category').children('.selectit').find(':checkbox').attr('checked', false);
			}
		}
		
	});								
});
JAVA_SCRIPT;

	echo "<script type='text/javascript'>{$javascript}</script>";
}
*/
// RADIO - Name: nrelate_flyout_options[flyout_loc]
function setting_flyout_loc(){
	$options = get_option('nrelate_flyout_options');
	$directions = array("Right","Left");
	
	foreach($directions as $direction){ 
			$checked = ($options['flyout_loc']==$direction) ? ' checked="checked" ' : '';
			echo "<label for='flyout_loc_".$direction."'><input ".$checked." id='flyout_loc_".$direction."' value='$direction' name='nrelate_flyout_options[flyout_loc]' type='radio' />$direction</label><br/>";
	}
}

// RADIO - Name: nrelate_flyout_options[flyout_animation]
function setting_flyout_animation(){
	$options = get_option('nrelate_flyout_options');
	$methods = array("Slideout","Fade");
	
	foreach($methods as $method){ 
			$checked = ($options['flyout_animation']==$method) ? ' checked="checked" ' : '';
			echo "<label for='flyout_animation_".$method."'><input ".$checked." id='flyout_animation_".$method."' value='$method' name='nrelate_flyout_options[flyout_animation]' type='radio' />$method</label><br/>";
	}
}

// TEXTBOX - Flyout offset in the page
function setting_flyout_offset() {
	$options = get_option('nrelate_flyout_options');
	$methods = array(1=>"Middle of Article",2=>"End of Article",3=>"Bottom of Page",4=>"Custom");
	foreach($methods as $key=>$value){
			$checked = ($options['flyout_offset']==$key) ? ' checked="checked" ' : '';
			echo "<label for='flyout_offset_".$key."'><input ".$checked." id='flyout_offset_".$key."' value='$key' name='nrelate_flyout_options[flyout_offset]' type='radio' onClick='show_custom_element(this);' />$value</label><br/>";
	}
	$javascript = <<< JAVA_SCRIPT
	function show_custom_element(current){
		if(current.value==4){
			jQuery('#flyout_offset_div_header').show('slow');
			jQuery('#flyout_offset_div').show('slow');
		}else{
			jQuery('#flyout_offset_div_header').hide('slow');
			jQuery('#flyout_offset_div').hide('slow');
		}
	}
JAVA_SCRIPT;
	echo "<script type='text/javascript'>{$javascript}</script>";
}

// TEXTBOX - Flyout element detection
function setting_flyout_offset_element() {
	$options = get_option('nrelate_flyout_options');
	if($options['flyout_offset']==4){
		$offset_divstyle = 'style="display:block;"';
	}
	else{
		$offset_divstyle = 'style="display:none;"';
	}
	echo "<div id='flyout_offset_div' ".$offset_divstyle."><input id='flyout_offset_element' name='nrelate_flyout_options[flyout_offset_element]' size='20' type='text' value='{$options['flyout_offset_element']}' /></div>";
}


// TEXTBOX / DROPDOWN - Name: nrelate_flyout_options[flyout_width]
function setting_flyout_width() {
	$options = get_option('nrelate_flyout_options');
	$items = array(
		"px" => __("px","nrelate"),
		"%" => __("%","nrelate"),
	);
	echo "<input id='flyout_anim_width' name='nrelate_flyout_options[flyout_anim_width]' size='4' type='text' value='{$options['flyout_anim_width']}' />";
	
	echo "<select id='flyout_anim_width_type' name='nrelate_flyout_options[flyout_anim_width_type]'>";
	foreach($items as $type => $item) {
		$selected = ($options['flyout_anim_width_type']==$item) ? 'selected="selected"' : '';
		echo "<option value='$type' $selected>$item</option>";
	}
		echo "</select>";
}

// TEXTBOX - Flyout element detection
function setting_flyout_from_bot() {
	$options = get_option('nrelate_flyout_options');
	$items = array(
		"px" => __("px","nrelate"),
		"%" => __("%","nrelate"),
	);
	echo "<input id='flyout_from_bot' name='nrelate_flyout_options[flyout_from_bot]' size='4' type='text' value='{$options['flyout_from_bot']}' />";
	
	echo "<select id='flyout_from_bot_type' name='nrelate_flyout_options[flyout_from_bot_type]'>";
	foreach($items as $type => $item) {
		$selected = ($options['flyout_from_bot_type']==$item) ? 'selected="selected"' : '';
		echo "<option value='$type' $selected>$item</option>";
	}
		echo "</select>";
		echo "<br>* If using the Meebo toolbar, then set this to at least 40px";
}



// TEXT ONLY - no options
function setting_flyout_css_link(){
	echo '<a href="admin.php?page=nrelate-flyout&tab=styles">';	
	_e("Choose a style from our Style Gallery","nrelate");
	echo '</a>';
}

// CHECKBOX - Show nrelate logo
function setting_flyout_display_logo(){
	$options = get_option('nrelate_flyout_options');
	$checked = @$options['flyout_display_logo']=='on' ? ' checked="checked" ' : '';
	echo "<input ".$checked." id='show_logo' name='nrelate_flyout_options[flyout_display_logo]' type='checkbox' />";
}

// DROPDOWN - Name: nrelate_flyout_options[flyout_thumbnail]
function setting_flyout_thumbnail() {
	$options = get_option('nrelate_flyout_options');
	$items = array('Thumbnails'=>__("Thumbnails","nrelate"), 'Text'=>__("Text","nrelate"));
	echo "<select id='flyout_thumbnail' name='nrelate_flyout_options[flyout_thumbnail]' onChange='nrelate_showhide_thumbnail(\"flyout_thumbnail\");'>";
	foreach($items as $type=>$item) {
		$selected = ($options['flyout_thumbnail']==$type) ? 'selected="selected"' : '';
		echo "<option value='".$type."' ".$selected.">".$item."</option>";
	}
	echo "</select>";
}

// RADIO - Name: nrelate_flyout_options[flyout_thumbnail_size]
function setting_flyout_thumbnail_size(){
	$options = get_option('nrelate_flyout_options');
	
	if($options['flyout_thumbnail']=="Thumbnails"){
		$divstyle = "style='display:block;'";
	}
	else{
		$divstyle = "style='display:none;'";
	}
	
	echo "<div id='imagesizepreview' ".$divstyle.">";
	$sizes = array(80,90,100,110,120,130,140,150);
	
	foreach($sizes as $size){ ?>
		<div class="nrelate-layout-thumbnails-1">
			<?php $checked = ($options['flyout_thumbnail_size']==$size) ? ' checked="checked" ' : '';
			echo "<label for='flyout_imagesize_".$size."'><input ".$checked." id='flyout_imagesize_".$size."' value='$size' name='nrelate_flyout_options[flyout_thumbnail_size]' type='radio' class='nrelate-thumb-size' /><br/>$size<br /><img src='" . NRELATE_ADMIN_IMAGES . "/thumbnails/preview_cloud_" . $size.".jpeg' /></label>";?>
		</div>
	<?php
	}
}

// TEXTBOX - Name: nrelate_flyout_options[flyout_thumbnail]
//show picture and give ability to change picture
function setting_flyout_default_image(){
	
	$options = get_option('nrelate_flyout_options');
	// Display preview image
	if($options['flyout_thumbnail']=="Thumbnails"){
		$divstyle = "style='display:block;'";
	}
	else{
		$divstyle = "style='display:none;'";
	}
	echo "<div id='imagepreview' ".$divstyle.">";
	$imageurl = stripslashes(stripslashes($options['flyout_default_image']));
	$imageurl = htmlspecialchars($imageurl);
	
	// Check if $imageurl is an empty string
	if($imageurl==""){
		_e("No default image chosen, until you provide your default image, nrelate will use <a class=\"thickbox\" href='http://img.nrelate.com/fow_wp/".NRELATE_FLYOUT_PLUGIN_VERSION."/defaultImages.html?KeepThis=true&TB_iframe=true&height=400&width=600' target='_blank'>these images</a>.<BR>","nrelate");
	}
	else{
		// Send image url and returns a thumbed version of the image

		$body=array(
			'link'=>$imageurl,
			'domain'=>NRELATE_BLOG_ROOT
		);
		$url = 'http://api.nrelate.com/common_wp/'.NRELATE_FLYOUT_ADMIN_VERSION.'/thumbimagecheck.php';
		
		$request=new WP_Http;
		$result=$request->request($url,array('method'=>'POST','body'=>$body));
		$imageurl_cached=!is_wp_error($result) ? $result['body'] : null;
		if ($imageurl_cached) {
			echo "Current default image: &nbsp &nbsp";
			//$imageurl = htmlspecialchars(stripslashes($imageurl));
			$imagecall = '<img id="imgupload" style="outline: 1px solid #DDDDDD; width:'.$options['flyout_thumbnail_size'].'px; height:'.$options['flyout_thumbnail_size'].'px;" src="'.$imageurl_cached.'" alt="No default image chosen" /><br><br>';
			echo $imagecall;
	 	}
	}
	// User can input an image url
	_e("Enter the link to your default image (include http://): <br>");
	echo '<input type="text" size="60" id="flyout_default_image" name="nrelate_flyout_options[flyout_default_image]" value="'.$imageurl.'"></div>';
}


// TEXTBOX - Name: nrelate_flyout_options[flyout_custom_field]
function setting_flyout_custom_field() {
	$options = get_option('nrelate_flyout_options');
	// Display preview image
	if($options['flyout_thumbnail']=="Thumbnails"){
		$divstyle = "style='display:block;'";
	}
	else{
		$divstyle = "style='display:none;'";
	}
		_e('<div id="imagecustomfield" '.$divstyle.'><a href="admin.php?page=nrelate-main#admin_custom_field">Click Here, to enter your custom field on the nrelate dashboard, under CUSTOM FIELD FOR IMAGES settings. ></a></div>','nrelate');
		echo "<script type='text/javascript'> nrelate_showhide_thumbnail('flyout_thumbnail');</script>";
}


// TEXTBOX - Name: nrelate_flyout_options[flyout_exclude_cats]
function setting_flyout_exclude_cats() {
	_e('<a href="admin.php?page=nrelate-main#exclude-cats">Click Here, to select categories to exclude under the EXCLUDE CATEGORIES settings. ></a></div>','nrelate');
}

///////////////////////////
//   Advertising Settings
//////////////////////////

// Section HTML, displayed before the first option
function section_text_nr_fo_ad() {
		_e('<p class="section-desc">nrelate can display ads under your flyout posts and you can earn money. Make sure you have signed up for an <a href="' . NRELATE_WEBSITE_AD_SIGNUP . '" target="_blank">Advertising ID</a>, and entered it on the <a href="admin.php?page=nrelate-main">nrelate Dashboard page</a>.</p>','nrelate');
		$admin_options = get_option('nrelate_admin_options');
		
		if (empty($admin_options['admin_validate_ad'])) {
			echo '<div id="ads_warning" class="nr_error" style="margin-right:15px; display:none;"><p>';
			echo (__('Before you can display ads, you must sign up for an "Advertising ID". Please' ,'nrelate') . ' <a href="' . NRELATE_WEBSITE_AD_SIGNUP . '">' . __('click here','nrelate') . '</a>' . __(' to sign up.','nrelate') . '</p></div>');
		}
}

// CHECKBOX - Display ads
function setting_flyout_display_ad() {
	$options = get_option('nrelate_flyout_options');
	$checked = @$options['flyout_display_ad']=='on' ? ' checked="checked" ' : '';
	echo "<input ".$checked." id='show_ad' name='nrelate_flyout_options[flyout_display_ad]' type='checkbox' />";
}

function setting_flyout_ad_number(){
	$options = get_option('nrelate_flyout_options');
	$items = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
	echo "<div id='adnumber'><select id='flyout_number_of_ads' name='nrelate_flyout_options[flyout_number_of_ads]'>";
	foreach($items as $item) {
		$selected = ($options['flyout_number_of_ads']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select></div>";
}

// DROPDOWN - ad placement
function setting_flyout_ad_placement(){	
	$options = get_option('nrelate_flyout_options');
	$items = array("Mixed","First","Last");
	echo "<div id='adplacement'><select id='flyout_ad_placement' name='nrelate_flyout_options[flyout_ad_placement]'>";
	foreach($items as $item) {
		$selected = ($options['flyout_ad_placement']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select></div>";
}

// CHECKBOX - Animated "sponsored" text in ads
function setting_flyout_ad_animation(){
	$options = get_option('nrelate_flyout_options');
	$checked = !empty($options['flyout_ad_animation']) ? ' checked="checked" ' : '';
	echo "<input ".$checked." id='ad_animation' name='nrelate_flyout_options[flyout_ad_animation]' type='checkbox' />";
}

///////////////////////////
//   nrelate Labs
//////////////////////////

// Section HTML, displayed before the first option
function section_text_nr_fo_labs() {
	_e('<p class="section-desc">Try out some new nrelate features, by selecting the BETA VERSION.</p>','nrelate');
}

// Radio - Use Non js: nonjs=1, js=0
function setting_flyout_nonjs(){
	$options = get_option('nrelate_flyout_options');
	$values=array("js","nonjs");
	$valuedescription = array ("js" => __("<strong>Javascript:</strong> Stable and fast",'nrelate'), "nonjs" => __("<strong>No Javascript:</strong> BETA VERSION: Allows search engines to index our plugin and may help your SEO.",'nrelate')); 
	$i=0;
	foreach($values as $value){
		$checked = @$options['flyout_nonjs']==$i ? ' checked="checked" ' : '';
		echo "<label for='flyout_nonjs_".$i."'><input ".$checked." id='flyout_nonjs_".$i."' name='nrelate_flyout_options[flyout_nonjs]' value='$i' type='radio'/>  ".$valuedescription[$value]."</label><br/>";
		$i+=1;
	}
}

///////////////////////////
//   Reset
//////////////////////////

// Section HTML, displayed before the first option
function section_text_nr_fo_reset() {
	_e('<p class="section-desc">To reset the plugin to defaults, check the box below, deactivate the plugin, and then reactivate it.</p>','nrelate');
}


/****************************************************************
 ******************** Build the Admin Page ********************** 
*****************************************************************/

function nrelate_flyout_do_page() {

//Convert some visual option parameters for preview purposes
	$option = get_option('nrelate_flyout_options');
	$r_title = urlencode($option['flyout_title']);
	$r_show_post_title = @$option['flyout_show_post_title'];
	$r_max_char_per_line = $option['flyout_max_chars_per_line'];
	$r_show_post_excerpt = @$option['flyout_show_post_excerpt'];
	$r_max_char_post_excerpt = $option['flyout_max_chars_post_excerpt'];
	$r_display_ad = empty($option['flyout_display_ad']) ? false : true;
	$r_display_logo = empty($option['flyout_display_logo']) ? false : true;
	$flyout_thumbnail = $option['flyout_thumbnail'];
	
	
	// Convert ad parameter
	switch ($r_display_ad){
	case true:
		$ad = 1;
		break;
	default:
		$ad = 0;
	}
	
	// Convert display post title parameter
	switch ($r_show_post_title)
	{
	case 'on':
	  $r_show_post_title = 1;
	  break;
	default:
	 $r_show_post_title = 0;
	}
	
	// Convert display post excerpt parameter
	switch ($r_show_post_excerpt)
	{
	case 'on':
	  $r_show_post_excerpt = 1;
	  break;
	default:
	 $r_show_post_excerpt = 0;
	}
		
	
	// Convert logo parameter
	switch ($r_display_logo){
	case true:
	  $logo = 1;
	  break;
	default:
	 $logo = 0;
	}
	
	// Convert thumbnail parameter
	switch ($flyout_thumbnail)
	{
	case 'Thumbnails':
	  $thumb = 1;
	  break;
	default:
	 $thumb = 0;
	}
	$tag = '?NUM='.$number.'&TITLE='.$r_title.'&SHOWPOSTTITLE='.$r_show_post_title.'&MAXCHAR='.$r_max_char_per_line.'&SHOWEXCERPT='.$r_show_post_excerpt.'&MAXCHAREXCERPT='.$r_max_char_post_excerpt.'&AD='.$ad.'&LOGO='.$logo.'&THUMB='.$thumb;
	//echo $tag;
?>
	
	<?php nrelate_flyout_settings_header(); ?>
    <script type="text/javascript">
		//<![CDATA[
		var nr_fo_plugin_settings_url = '<?php echo NRELATE_FLYOUT_SETTINGS_URL; ?>';
		var nr_plugin_domain = '<?php echo NRELATE_BLOG_ROOT ?>';
		var nr_fo_plugin_version = '<?php echo NRELATE_FLYOUT_PLUGIN_VERSION ?>';
		//]]>
    </script>
		<form name="settings" action="options.php" method="post" enctype="multipart/form-action">
    	<?php
			$style_options = get_option('nrelate_flyout_options_styles');
      ?>
      <input type="hidden" id="flyout_imagestyle" value="<?php echo $style_options['flyout_thumbnails_style']; ?>" />
      <input type="hidden" id="flyout_textstyle" value="<?php echo $style_options['flyout_text_style']; ?>" />
			<?php settings_fields('nrelate_flyout_options'); ?>
			<?php do_settings_sections(__FILE__);?>
		</form>
    <script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready(function($){
			$('.nrelate_fo_preview_button').click(function(event){
				event.preventDefault();
				$(this).parents('form:first').find('.nrelate_disabled_preview span').hide();
				
				if ($('#flyout_thumbnail').val()=='Thumbnails') {
					if ($('#flyout_imagestyle').val()=='none') { $(this).parents('td:first').find('.thumbnails_message:first').show(); return; }
				} else {
					if ($('#flyout_textstyle').val()=='none') { $(this).parents('td:first').find('.text_message:first').show(); return; }
				}
				
				if ($('#flyout_thumbnail').val()=='Text') {
					if (!$('#flyout_show_post_title').is(':checked') && !$('#flyout_show_post_excerpt').is(':checked')) {
						$(this).parents('td:first').find('.text-warning-message:first').show();
						setTimeout('tb_remove()', 50);
						return;
					}
				}
			});
			
			$('#flyout_thumbnail').change(function(){
				$(this).parents('form:first').find('.nrelate_disabled_preview span').hide();
			});
			
			$('input.button-primary[name="Submit"]').click(function(event){
				$(this).parents('form:first').find('.nrelate_disabled_preview span').hide();
				
				if ($('#flyout_thumbnail').val()=='Thumbnails') return;
				if ($('#flyout_show_post_title').is(':checked')) return;
				if ($('#flyout_show_post_excerpt').is(':checked')) return;
				event.preventDefault();
				event.stopPropagation();
				$(this).parents('td:first').find('.text-warning-message:first').show();
			});
		});
		//]]>
    </script>
    </div>
<?php
	
	update_nrelate_flyout_data();
}

// Loads all of the nrelate_flyout_options from wp database
// Makes necessary conversion for some parameters.
// Sends nrelate_flyout_options entries, rss feed mode, and wordpress home url to the nrelate server
// Returns Success if connection status is "200". Returns error if not "200"
function update_nrelate_flyout_data(){
	
	// Get nrelate_flyout options from wordpress database
	$option = get_option('nrelate_flyout_options');
	$r_bar = $option['flyout_bar'];
	$r_title = urlencode($option['flyout_title']);
	$r_max_age = $option['flyout_max_age_num'];
	$r_max_frame = $option['flyout_max_age_frame'];
	$r_box_width = $option['flyout_anim_width'];
	$r_box_width_type = $option['flyout_anim_width_type'];
	$r_show_post_title = empty($option['flyout_show_post_title']) ? false : true;
	$r_max_char_per_line = $option['flyout_max_chars_per_line'];
	$r_show_post_excerpt = empty($option['flyout_show_post_excerpt']) ? false : true;
	$r_max_char_post_excerpt = $option['flyout_max_chars_post_excerpt'];
	$r_display_ad = empty($option['flyout_display_ad']) ? false : true;
	$r_display_logo = empty($option['flyout_display_logo']) ? false : true;
	//$r_flyout_reset = $option['flyout_reset'];
	$flyout_thumbnail = $option['flyout_thumbnail'];
	$backfill = $option['flyout_default_image'];
	$flyout_thumbnail_size = $option['flyout_thumbnail_size'];
	$flyout_loc = @$option['flyout_loc'];
	$flyout_animation = $option['flyout_animation'];
	$noflyoutposts=$option['flyout_number_of_posts'];
	$flyout_offset = $option['flyout_offset'];
	$flyout_offset_element= $option['flyout_offset_element'];
	$flyout_ad_num = $option['flyout_number_of_ads'];
	$flyout_ad_place = $option['flyout_ad_placement'];
	$flyout_nonjs = $option['flyout_nonjs'];
	$flyout_from_bot = $option['flyout_from_bot'];
	$flyout_from_bot_type = $option['flyout_from_bot_type'];
	
	// Convert max age time frame to minutes
	switch ($r_max_frame){
	case 'Hour(s)':
		$maxageposts = $r_max_age * 60;
		break;
	case 'Day(s)':
		$maxageposts = $r_max_age * 1440;
		break;
	case 'Week(s)':
		$maxageposts = $r_max_age * 10080;
		break;
	case 'Month(s)':
		$maxageposts = $r_max_age * 44640;
		break;
	case 'Year(s)':
		$maxageposts = $r_max_age * 525600;
		break;
	}
	
	// Convert show post title parameter
	switch ($r_show_post_title){
	case true:
		$r_show_post_title = 1;
		break;
	default:
		$r_show_post_title = 0;
	}

	// Convert show post excerpt parametet
	switch ($r_show_post_excerpt){
	case true:
		$r_show_post_excerpt = 1;
		break;
	default:
		$r_show_post_excerpt = 0;
	}


	// Convert ad parameter
	switch ($r_display_ad){
	case true:
		$ad = 1;
		break;
	default:
		$ad = 0;
	}

	// Convert logo parameter
	switch ($r_display_logo){
	case true:
		$logo = 1;
		break;
	default:
		$logo = 0;
	}
	
	// Convert thumbnail option parameter
	switch ($flyout_thumbnail){
	case 'Thumbnails':
		$thumb = 1;
	  break;
	default:
		$thumb = 0;
	}
	// Write the parameters to be sent
	
	$body=array(
		'DOMAIN'=>NRELATE_BLOG_ROOT,
		'NUM'=>$noflyoutposts,
		'R_BAR'=>$r_bar,
		'HDR'=>$r_title,
		'MAXPOST'=>$maxageposts,
		'SHOWPOSTTITLE'=>$r_show_post_title,
		'MAXCHAR'=>$r_max_char_per_line,
		'SHOWEXCERPT'=>$r_show_post_excerpt,
		'MAXCHAREXCERPT'=>$r_max_char_post_excerpt,
		'ADOPT'=>$ad,
		'THUMB'=>$thumb,
		'LOGO'=>$logo,
		'IMAGEURL'=>$backfill,
		'THUMBSIZE'=>$flyout_thumbnail_size,
		'LAYOUT'=>$flyout_layout,
		'ADNUM'=>$flyout_ad_num,
		'ADPLACE'=>$flyout_ad_place,
		'OFFSET'=>$flyout_offset,
		'ELEMENT'=>$flyout_offset_element,
		'ANIMATION'=>$flyout_animation,
		'LOCATION'=>$flyout_loc,
		'ADNUM'=>$flyout_ad_num,
		'OFFSET'=>$flyout_offset,
		'ELEMENT'=>$flyout_offset_element,
		'ADLOC'=>$flyout_ad_place,
		'NONJS'=>$flyout_nonjs,
		'FROMBOT'=>$flyout_from_bot,
		'FROMBOTTYPE'=>urlencode($flyout_from_bot_type),
		'WIDTH'=>$r_box_width,
		'WIDTHTYPE'=>urlencode($r_box_width_type)
	);
	$url = 'http://api.nrelate.com/fow_wp/'.NRELATE_FLYOUT_PLUGIN_VERSION.'/processWPflyout.php';
	
	$request=new WP_Http;
	$result=$request->request($url,array('method'=>'POST','body'=>$body,'blocking'=>false));
}

// Validate user data for some/all of our input fields
function flyout_options_validate($input) {
	// Check our textbox option field contains no HTML tags - if so strip them out
	$input['flyout_title'] =  wp_filter_nohtml_kses($input['flyout_title']);
	if(!is_numeric($input['flyout_max_chars_per_line'])){
		$input['flyout_max_chars_per_line']=100;
	}
	if(!is_numeric($input['flyout_max_age_num'])){
		$input['flyout_max_age_num']=2;
	}
	if(!is_numeric($input['flyout_width'])){
		$input['flyout_width']=360;
	}
	
	// Like escape all text fields
	$input['flyout_default_image'] = like_escape($input['flyout_default_image']);
	$input['flyout_title'] = like_escape($input['flyout_title']);
	// Add slashes to all text fields
	$input['flyout_default_image'] = esc_sql($input['flyout_default_image']);
	$input['flyout_title'] = esc_sql($input['flyout_title']);
	
	$input['flyout_version'] = NRELATE_FLYOUT_PLUGIN_VERSION;
	
	// Make sure that unchecked checkboxes are stored as empty strings
	global $nr_fo_std_options;
	$options = array_keys($nr_fo_std_options);
	$values = array_fill(0, count($options), '');
	$empty_settings_array = array_combine($options, $values);
	
	$input = wp_parse_args( $input, $empty_settings_array );
	
	return $input; // return validated input
}
?>