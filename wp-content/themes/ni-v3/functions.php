<?php
/*
Next Investors Theme Functions
By: Stocks Digital <Aakash Bhatia>
http://stocksdigital.com/
*/

//define('WP_HOME','http://www.nextinvestors.com');
//define('WP_SITEURL','http://www.nextinvestors.com');

/**
  * Make site options as global variables, so we can access them
  * in header.php and footer.php rendered via function calls:<br>
  * get_header() and get_footer(), hence are not run in global scope
  @var1 $formID Sets the main Form ID for each subsite
  @var2 $sidebarFormId Sets the secondary Form ID for each subsite
  @var3 $footerFormsTitle Sets the Footer form title for each subsite
  @var4 $logo Sets the logo for each subsite
**/
global $formID;
global $sidebarFormId;
global $footerFormsTitle;
global $logo;

// Enable visibility settings for Gravity Forms' labels. It adds a 'hidden_label' class which can then be styled
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

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
$nextinvestors = new NextInvestors( 'next-investors-v3', '3.0.23', (string)get_current_blog_id() );
$nextinvestors->init();
$nextinvestors->register_menus();
$nextinvestors->register_image_sizes();

/* 
	* Instance of Company
*/
$company = new Company();
$company->init();

$gform1 = new GravityFormsCustom( '1' );
add_filter( 'gform_submit_button', array( $gform1, 'make_button' ), 10, 2 );
$gform1->add_discalimer('Joining Raisebook will give you free access to opportunities not normally available to general retail investors â€“ however you must qualify as a sophisticated investor under Section 708 of the Corporations Act. These opportunities are as diverse as stock placements, seed capital raisings, IPOs, options underwritings. Plus a whole host of other high risk, high reward investment opportunities not available to the general public (careful this stuff is high risk!).');

// Enable Shortcodes for Category/Taxonomy Description
add_filter( 'term_description', 'shortcode_unautop');
add_filter( 'term_description', 'do_shortcode' );

// Register the Company Taxonomy after WordPress has finished loading but before any headers are sen
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

// remove default GF entry content function
remove_action( 'gform_print_entry_content', 'gform_default_entry_content', 10 );

// bind our custom entry content function
add_action( 'gform_print_entry_content', 'my_print_entry_content', 10, 3 );

function my_print_entry_content( $form, $entry, $entry_ids ) {
  GFEntryDetail::lead_detail_grid( $form, $entry );
}
?>