<?php
/*
Next Investors Theme Functions
By: Stocks Digital <Aakash Bhatia>
http://stocksdigital.com/
*/

//define('WP_HOME','http://www.nextinvestors.com');
//define('WP_SITEURL','http://www.nextinvestors.com');

 /**
  * Class to access a subscribers resources from the create send API
  * Ref: https://github.com/campaignmonitor/createsend-php/blob/master/csrest_subscribers.php
  * sourced from subscribe-controllers/csrest_subscribers.php
**/
require_once 'subscribe-controllers/csrest_subscribers.php';

require_once 'bin/site-options.php';

 /**
	* Class to customise WordPress to our theme's needs.
	* Sets up styleshhets and scripts
	* Sets up body classes for sub site customisation
	* Allows admin to access menus, thumbnails and custom image sizes
**/
require 'bin/NextInvestors.php';

 /**
	* Class to customise WordPress to our theme's needs.
	* Sets up styleshhets and scripts
	* Sets up body classes for sub site customisation
	* Allows admin to access menus, thumbnails and custom image sizes
**/
include 'bin/Company.php';

include 'bin/GravityFormsCustom.php';

include 'bin/WalkerNextinvestorsMenu.php';

// Custom Global Variables
// This variable is an array consisting of the IDs of the posts that already appear on the page so we can avoid repetitions
$GLOBALS[ 'repAvoider' ] = array();

/* 
	* Instance of NextInvestors
	* @param string:$themeName
	* @param string:$version
*/
$nextinvestors = new NextInvestors( 'next-investors-v3', '3.0.0', get_current_blog_id() );
$nextinvestors->init();
$nextinvestors->register_menus();
$nextinvestors->register_image_sizes();

$company = new Company();
$company->init();

$gform1 = new GravityFormsCustom( '1' );
$gform->init();

// Enable Shortcodes for Category/Taxonomy Description
add_filter( 'term_description', 'shortcode_unautop');
add_filter( 'term_description', 'do_shortcode' );

// Gravity Form Hooks
add_filter( 'gform_field_input', 'custom_heading', 10, 45 );
function custom_heading( $input, $field, $value, $lead_id, $form_id ) {
	if ( $field->cssClass == 'gform_heading' ) {
		$input = '<div class="col-xl-12"><h5>Receive Latest Mining Boom Updates</h5></div>';
	}
}

/* -- COMPANY TAXONOMY START -- */
add_action( 'init', 'register_taxonomy_company' );

function register_taxonomy_company() {

    $labels = array( 
        'name' => _x( 'Company', 'company' ),
        'singular_name' => _x( 'Company', 'company' ),
        'search_items' => _x( 'Search Companies', 'company' ),
        'popular_items' => _x( 'Popular Companies', 'company' ),
        'all_items' => _x( 'All Companies', 'company' ),
        'parent_item' => _x( 'Parent Company', 'company' ),
        'parent_item_colon' => _x( 'Parent Company:', 'company' ),
        'edit_item' => _x( 'Edit Company', 'company' ),
		'view_item' => _x( 'View Company', 'company' ),
        'update_item' => _x( 'Update Company', 'company' ),
        'add_new_item' => _x( 'Add New Company', 'company' ),
        'new_item_name' => _x( 'New Company', 'company' ),
        'separate_items_with_commas' => _x( 'Separate companies with commas', 'company' ),
        'add_or_remove_items' => _x( 'Add or remove companies', 'company' ),
        'choose_from_most_used' => _x( 'Choose from the most used companies', 'company' ),
        'menu_name' => _x( 'Companies', 'company' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,
        'rewrite' => array('slug' => '', 'with_front' => false),
        'query_var' => true
    );

    register_taxonomy( 'company', array('post'), $args );
}
/* -- COMPANY TAXONOMY END -- */

/*-- Truncates a string that is passed via arguments, by default the replacement for the truncated string is '...' however this can be overwritten via the argument ex: truncateString($str, 26, true, " :)") --*/
function truncateString($str, $chars, $to_space, $replacement="...") {
   if($chars > strlen($str)) return $str;

   $str = substr($str, 0, $chars);

   $space_pos = strrpos($str, " ");
   if($to_space && $space_pos >= 0) {
       $str = substr($str, 0, strrpos($str, " "));
   }

   return($str . $replacement);
}
/* -- Truncate Ends -- */

/* -- RECENT POSTS ACROSS MULTISITE START -- */
function recent_posts($count = 3) {
	global $wpdb;
	global $post;
	$postArray = array();
	$currentBlog = get_current_blog_id();
	$blog_list = wp_get_sites();
	
	foreach( $blog_list as $blog ) {
		switch_to_blog( $blog['blog_id'] );
		$posts = $wpdb->get_col(  "SELECT ID, post_date FROM sd_".$blog['blog_id']."_posts WHERE post_status = 'publish' AND post_type = 'post'");
		if ( $blog['blog_id'] == 1 ) {
			$posts = $wpdb->get_col( "SELECT ID, post_date FROM sd_posts WHERE post_status = 'publish' AND post_type = 'post'");
		}

		foreach($posts as $post) {
			$postdetail = get_blog_post($blog['blog_id'],$post);
			setup_postdata($postdetail);
			
			if ( !in_array($postdetail-> ID, $GLOBALS[ 'repAvoider' ] )) {
				$postIndex = array(
					'start_date'  =>  $postdetail->post_date,
					'title'       =>  $postdetail->post_title,
					'link'        =>  get_the_permalink( $postdetail->ID ),
					'id'          =>  $postdetail->ID,
					'image'       =>  get_the_post_thumbnail($postdetail->ID, 'related_thumb')
				);
				array_push($postArray, $postIndex);
			}
		}
	}
	
	asort($postArray);
	$postArray = array_reverse($postArray);
	$postArray = array_slice($postArray, 0, $count);
	
	//echo 'in';
	foreach( $postArray as $post ) {
		// Add the ID to the array to avoid repetitions
		array_push( $GLOBALS[ 'repAvoider' ], $post['id'] );
		$truncatedTitle = truncateString($post['title'], 85, true);
		echo '<article class="col-md-4 mb-5">';
		echo '<a class="image" href="'.$post['link'].'">'.$post['image'].'</a>';
		echo '<h4 class="mt-4 mb-2"><a href="'.$post['link'].'">'.$truncatedTitle.'</a></h4>';
		echo '<div class="clear"></div>';
		$newDate = date("M j, Y", strtotime($post['start_date']));
		echo '<p class="date">'.$newDate.'</p>';
		echo '<a class="btn btn-outline-primary" href="'.$post['link'].'">Read Article</a>';
		echo '</article>';
	}
	
	switch_to_blog($currentBlog);
}
/* -- RECENT POSTS ACROSS MULTISITE END -- */

// Adding Custom Styles to tinyMCE
/*function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');*/

/*
* Callback function to filter the MCE settings
*/
function my_mce_before_init_insert_formats( $init_array ) {  
// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Regular Title',  
			'block' => 'p',  
			'classes' => 'title',
			'wrapper' => false,
		),  
		array(  
			'title' => 'Large Title',
			'block' => 'p',  
			'classes' => 'large-title',
			'wrapper' => false,
		),
		array(  
			'title' => 'Link Style 1',
			'block' => 'a',  
			'classes' => 'link-1',
			'wrapper' => false,
		),
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
} 

// Attach callback to 'tiny_mce_before_init' 
//add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

//gform_confirmation_anchor
add_filter( 'gform_confirmation_anchor', '__return_false' );

//gform_tabindex
add_filter( 'gform_tabindex', '__return_false' );

// filter the Gravity Forms button type
$blog_id = get_current_blog_id();

if($blog_id == 9){
	add_filter( 'gform_submit_button_48', 'om_form_submit_button', 10, 2 );
} else if($blog_id == 10){
	add_filter( 'gform_submit_button_52', 'om_form_submit_button', 10, 2 );
} else if($blog_id == 12){
	add_filter( 'gform_submit_button_31', 'om_form_submit_button', 10, 2 );
} else if($blog_id == 13){
	add_filter( 'gform_submit_button_62', 'om_form_submit_button', 10, 2 );
} else if($blog_id == 15){
	add_filter( 'gform_submit_button_9', 'om_form_submit_button', 10, 2 );
}

function om_form_submit_button( $button, $form ) {
    $dom = new DOMDocument();
    $dom->loadHTML( $button );
    $button = $dom->getElementsByTagName( 'input' )->item(0);
    $new_classes = $button->getAttribute( 'class' ) . " om-trigger-conversion btn btn-outline-primary";
    $button->setAttribute( 'class', $new_classes );
    return $dom->saveHtml( $old_button );
}

add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );

function form_submit_button( $button, $form ) {
	return "<button class='btn btn-outline-primary disabled' id='gform_submit_button_{$form['id']}' disabled>Keep me informed</button>";
}

/*add_filter( 'gform_submit_button_1', 'add_paragraph_below_submit', 10, 2 );
function add_paragraph_below_submit( $button, $form ) {

    return $button .= '<p class="mt-5 disclaimer-rb">Joining Raisebook will give you free access to opportunities not normally available to general retail investors – however you must qualify as a sophisticated investor under Section 708 of the Corporations Act. These opportunities are as diverse as stock placements, seed capital raisings, IPOs, options underwritings. Plus a whole host of other high risk, high reward investment opportunities not available to the general public (careful – this stuff is high risk!).</p>';
}*/

/* -- Get latest posts from each subsite -- */
function populate_latest() {
	// Pull required globals to use DB queries 
	global $wpdb;
	global $post;
	$latest_posts = array();
	$currentBlog = get_current_blog_id();
	
	// Get a list of all site IDs
	$blog_list = wp_get_sites();
	
	// Perform an array_shift on the list to pop the first site i.e. Next Investors.
	array_shift($blog_list);
	
	// We comb through each blog ID and switches over to the blog to perfom a DB query
	foreach( $blog_list as $blog ) {
		switch_to_blog( $blog['blog_id'] );
		array_push($latest_posts, $wpdb->get_results(  "SELECT id, post_title FROM sd_".$blog['blog_id']."_posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC LIMIT 1", ARRAY_A));
		// array_push($latest_posts[0][0], $blog['blog_id']);
	}
	
	//Switch back to current blog
	switch_to_blog( $currentBlog );
	
	// Return the array containing the latest posts across all the sub-sites
	return $latest_posts;
}

// remove default GF entry content function
remove_action( 'gform_print_entry_content', 'gform_default_entry_content', 10 );

// bind our custom entry content function
add_action( 'gform_print_entry_content', 'my_print_entry_content', 10, 3 );

function my_print_entry_content( $form, $entry, $entry_ids ) {
  GFEntryDetail::lead_detail_grid( $form, $entry );
}

//include get_bloginfo('template_url'). '/functions/gravity-forms-custom.php';

//add_filter( 'gform_field_input_49', 'test', 10, 5 );
function test( $input, $field, $value, $lead_id, $form_id ) {
    if ( $field->cssClass == 'email' ) {
        $input = '<input type="hidden" id="hidTracker" name="hidTracker" value="'.$value.'">';
    }
    return $input;
}

// After form submit hooks
add_action("gform_post_submission", "gf_gtm_tracking", 10, 2);
  /**
  * GTM data layer push for gravity forms contact form
  */
 /**
  * Pushes a submission variables to the GTM dataLayer
  * Also pushes the event label for use in GTM tracking
  * @param  Array $form  Form data
  * @return null
  */
function gf_gtm_tracking( $form ) {
	$eventLabel = 'form_'.$form['id'];
?>
		<script type="text/javascript">
			 // var eventLabel = $('#event_label').val();
			 window.dataLayer = window.dataLayer || [];
			 window.dataLayer.push({
			   'event' : 'gravityFormSubmit',
			   'eventCategory' : 'Form',
				'eventAction': 'Submit',
				'eventLabel': '<?= $eventLabel; ?>'
			 });
		</script>	
<?php              
}
?>