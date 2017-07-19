<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Related_Posts_Sd
 * @subpackage Related_Posts_Sd/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Related_Posts_Sd
 * @subpackage Related_Posts_Sd/admin
 * @author     Aakash Bhatia <akash.bhatia1184@gmail.com>
 */
class Related_Posts_Sd_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
	}
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function register_styles() {

		/**
		 * This function is used to register the stylesheets for the admin-specific functionality of the plugin.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Related_Posts_Sd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Sd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 /**
		  * This function is used to register the stylesheets that will be enqueued in $this->enqueue_styles()
		  * Ref: https://codex.wordpress.org/Function_Reference/wp_register_style/
		  * @param1   string:$handle   Name of the stylesheet. Should be unique
		  * @parma2   string:$src   Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory. In our case we get the URL (with trailing slash) 
		  * for the plugin __FILE__ passed (https://codex.wordpress.org/Function_Reference/plugin_dir_url)
		  * @param3   string:$ver   $this->version   The current version of the plugin set in includes/class-related-posts-Sd.php Related_Posts_Sd->version
		 **/
		wp_register_style( $this->plugin_name.'_adminstyles', plugin_dir_url( __FILE__ ) . 'css/related-posts-sd-admin.css', null, $this->version, 'all');

	}
	
	/**
	 * Register the scripts for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function register_scripts() {

		/**
		 * This function is used to register the scripts for the admin-specific functionality of the plugin.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Related_Posts_Sd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Sd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * The hooks are defined in $Related_Posts_Sd->define_admin_hooks()		 
		 */

		 /**
		  * This function is used to register the scripts that will be enqueued in $this->enqueue_scripts()
		  * Ref: https://developer.wordpress.org/reference/functions/wp_register_script/
		  * @param1   string:$handle   Name of the stylesheet. Should be unique
		  * @parma2   string:$src   Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory. In our case we get the URL (with trailing slash) 
		  * for the plugin __FILE__ passed (https://codex.wordpress.org/Function_Reference/plugin_dir_url)
		  * @param3   array:$deps   ['jquery'] loads jquery-core(/wp-includes/js/jquery/jquery.js) and jquery-migrate-v1.10.2 (/wp-includes/js/jquery/jquery-migrate.js)
		  * @param4   string:$ver   $this->version   The current version of the plugin set in includes/class-related-posts-Sd.php Related_Posts_Sd->version
		  * @param5   bool:$in_footer  Loads JS in <footer>
		 **/
		wp_register_script( $this->plugin_name.'_core', plugin_dir_url( __FILE__ ) . 'js/related-posts-sd-admin.js', array( 'jquery' ), $this->version, false );
		wp_register_script( $this->plugin_name.'_jquery-ui', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is used to enqueue the stylesheets for the admin-specific functionality of the plugin.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Related_Posts_Sd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Sd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * The hooks are defined in $Related_Posts_Sd->define_admin_hooks()	
		 */
		
		 /**
		  * This function is used to enqueue the stylesheets
		  * Ref: https://developer.wordpress.org/reference/functions/wp_enqueue_style/
		  * @param1   string:$handle   Unique Name of the stylesheet
		 **/

		wp_enqueue_style( $this->plugin_name.'_adminstyles' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is used to enqueue the scripts for the admin-specific functionality of the plugin.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Related_Posts_Sd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Sd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * The hooks are defined in $Related_Posts_Sd->define_admin_hooks()		 
		 */
		
		 /**
		  * This function is used to enqueue the scripts
		  * Ref: https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts/
		  * @param1   string:$handle   Unique Name of the scripts
		 **/

		wp_enqueue_script( $this->plugin_name.'_jquery-ui' );
		wp_enqueue_script( $this->plugin_name.'_core' );
		wp_enqueue_script( $this->plugin_name.'my-ajax', plugin_dir_url( __FILE__ ) . 'js/related-posts-sd-admin-ajax.js', array( 'jquery' ), $this->version, true );

	}
	
	/**
	 * This function places the custom fields on posts
	 *
	 * @since    1.0.0
	 */
	public function add_meta_box( $post_type ) {
		/**
		 * This function is used to render a meta box for the admin-specific functionality of the plugin on the posts dashboard
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Related_Posts_Sd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Sd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * The hooks are defined in $Related_Posts_Sd->define_admin_hooks()		 
		 */
		
		 /**
		  * This function is used to enqueue the scripts
		  * Ref: https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts/
		  * @param1   string:$handle   Unique Name of the scripts
		 **/
		
		// If admin then continue with the plugin else exit the function			
		if ( !is_admin() ):
			exit();
		endif;
		
		// Limit meta box only to posts
		$screens = array('post');
		
		// We loop through the screens and display the meta box on them
		foreach( $screens as $screen ) {
			add_meta_box(
				'related_posts', // Name of the metabox
				__( 'Related Posts' ), // Title of the metabox
				array($this, 'render_posts_meta_box_content'),
				$screen,
				'advanced',
				'high'
			);
		}
	}
	
	public function render_posts_meta_box_content( $post ) {
		// Get the protocol of the current page
		$protocol = isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
		
		// Create a nonce for this action
		$nonce = wp_create_nonce( 'sd_ajax-' . $post->ID );

		// Set the ajaxurl Parameter which will be output right before
		// our ajax-delete-posts.js file so we can use ajaxurl
		$params = array(
			'ajaxurl' => admin_url( 'admin-ajax.php', $protocol ), // Get the url to the admin-ajax.php file using admin_url()
			'ajaxaction' => 'sd_ajax', // Register the PHP function that is responsible for handling the AJAX interactions on the server side
			'pid' => $post->ID, // Pass the post_id as an argument to the JS file that is then passed through to sd_ajax via $_REQUEST
			'nonce' => $nonce // Pass the nonce that is to be checked in the JS file
		);

		/**
		* We must use wp_localize_script() to pass values into JavaScript object properties, since PHP cannot directly echo values into our JavaScript file
		*
		* Ref: https://codex.wordpress.org/Function_Reference/wp_localize_script
		* @param1 string:The registered script handle you are attaching the data for.
		* @param1 string:The name of the variable which will contain the data
		* @param1 array:The data itself.
		**/
		wp_localize_script( $this->plugin_name.'my-ajax', 'my_ajax_args', $params );		
		
	}	
	
	/**
	 * This function renders the content for the custom field
	 *
	 * @since    1.0.0
	 */
	public function render_meta_box_content( $post ) {
		//$term_id = $post;
		
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'related_posts_inner_custom_box_nonce', 'related_posts_inner_custom_box_nonce' );
		
		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_my_related_posts', true );
		
		if ( empty($value) ) {
			$value = array(NULL);
		}
		
		include('partials/related-posts-sd-admin-display.php');
	}
	
	/**
	 * Register the AJAX Function for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function sd_ajax( $post_id ) {
		$term_id = $_REQUEST['tid'];
		$post_id = $_REQUEST['pid'];
		
		require_once('partials/related-posts-sd-admin-display.php');

		echo $html;

		// Always exit when doing Ajax
		die();
	}
	
	/**
	 * This function is fired when a post is saved/updated, it primarily saves the related fields in a metabox
	 *
	 * @since    1.0.0
	 */
	public function save( $post ) {
		/* OK, its safe for us to save the data now. */
		
		/* if ( sizeof( $_POST['tax_input']['company'] ) == 2 ) {
		} else {
		} */
		
		if ( isset( $_POST['related_post'] ) ) {
			// Update the meta field.
			update_post_meta( $_POST['post_ID'], '_my_related_posts', $_POST['related_post'] );

			// This injects the current post into the meta field '_my_related_posts' of all the older posts that have been related to it
			// To put it simply, it auto injects the current post ID into the related posts of all the older posts that are related to the current post
			// Let's begin by filtering through the IDs of the related posts
			foreach( $_POST['related_post'] as $related_posts ) {
				// Fetch the related_posts metadata of the isolated ID
				$currentRelatedPosts = get_post_meta( $related_posts, '_my_related_posts');
				
				// If we the islated post has related posts, we push current post ID onto the array
				if (  !is_null($currentRelatedPosts) ) {
					foreach( $currentRelatedPosts as $currentRelatedPost ) {
						// We should only auto inject if it doesn't already exsit in the array
						if( in_array($_POST['post_ID'], $currentRelatedPost) ){
							continue;
						} else {
							array_push( $currentRelatedPost, $_POST['post_ID'] );
						}
					}
					
					// We updat the posts meta data
					update_post_meta( $related_posts, '_my_related_posts', $currentRelatedPost );
				} else {
					// Else we create new related posts metadata for the isolated ID
					$currentRelatedPost = array( get_the_ID() );
					update_post_meta( $related_posts, '_my_related_posts', $currentRelatedPost );
				}
			}
		}
	}
	
    public function tax_error_notice( $post ) {
		// We notify the user that they must select a company
		// It doesn't halt the process, its more a warnging than an error
		$screen = get_current_screen();
		if ( $screen->parent_base == 'edit' ) {
			echo '<div id="error-no-select" class="error">Please select atleast and only one company to proceed</div>';
		}
	}
}