<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Related_Posts_Plus
 * @subpackage Related_Posts_Plus/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Related_Posts_Plus
 * @subpackage Related_Posts_Plus/admin
 * @author     Aakash Bhatia <aakash@stocksdigital.com>
 */
class Related_Posts_Plus_Admin {

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
	 * The data required for this plugin
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $post_array    The data for the plugin with a structure $posts_array['category_id'] = array(['post_id'] => post_title).
	 */
	protected $post_array;
	
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
	
	public function restrict_admin_with_redirect() {
		if ( ! current_user_can( 'manage_options' ) && ( ! wp_doing_ajax() ) ) {
			wp_redirect( site_url() ); 
			exit;
		}
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
		 * defined in Related_Posts_Plus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Plus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 /**
		  * This function is used to register the stylesheets that will be enqueued in $this->enqueue_styles()
		  * Ref: https://codex.wordpress.org/Function_Reference/wp_register_style/
		  * @param1   string:$handle   Name of the stylesheet. Should be unique
		  * @parma2   string:$src   Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory. In our case we get the URL (with trailing slash) 
		  * for the plugin __FILE__ passed (https://codex.wordpress.org/Function_Reference/plugin_dir_url)
		  * @param3   string:$ver   $this->version   The current version of the plugin set in includes/class-related-posts-plus.php Related_Posts_Plus->version
		 **/
		wp_register_style( $this->plugin_name.'_adminstyles', plugin_dir_url( __FILE__ ) . 'css/related-posts-plus-admin.css', null, $this->version, 'all');

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
		 * defined in Related_Posts_Plus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Plus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * The hooks are defined in $Related_Posts_Plus->define_admin_hooks()	
		 */
		
		 /**
		  * This function is used to enqueue the stylesheets
		  * Ref: https://developer.wordpress.org/reference/functions/wp_enqueue_style/
		  * @param1   string:$handle   Unique Name of the stylesheet
		 **/
		wp_enqueue_style( $this->plugin_name.'_adminstyles' );

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
		 * defined in Related_Posts_Plus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Plus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * The hooks are defined in $Related_Posts_Plus->define_admin_hooks()		 
		 */

		 /**
		  * This function is used to register the scripts that will be enqueued in $this->enqueue_scripts()
		  * Ref: https://developer.wordpress.org/reference/functions/wp_register_script/
		  * @param1   string:$handle   Name of the stylesheet. Should be unique
		  * @parma2   string:$src   Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory. In our case we get the URL (with trailing slash) 
		  * for the plugin __FILE__ passed (https://codex.wordpress.org/Function_Reference/plugin_dir_url)
		  * @param3   array:$deps   ['jquery'] loads jquery-core(/wp-includes/js/jquery/jquery.js) and jquery-migrate-v1.10.2 (/wp-includes/js/jquery/jquery-migrate.js)
		  * @param4   string:$ver   $this->version   The current version of the plugin set in includes/class-related-posts-plus.php Related_Posts_Plus->version
		  * @param5   bool:$in_footer  Loads JS in <footer>
		 **/
		//wp_register_script( 'admincore', plugin_dir_url( __FILE__ ) . 'js/related-posts-plus-admin.js', array( 'jquery' ), $this->version, true);
		//wp_register_script( $this->plugin_name.'_adminajax', plugin_dir_url( __FILE__ ) . 'js/related-posts-plus-admin-ajax.js', array( 'jquery' ), $this->version, true);
		
		wp_register_script( $this->plugin_name.'_core', plugin_dir_url( __FILE__ ) . 'js/related-posts-plus-admin.js', array( 'jquery' ), $this->version, false );

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
		 * defined in Related_Posts_Plus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Plus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * The hooks are defined in $Related_Posts_Plus->define_admin_hooks()		 
		 */
		
		 /**
		  * This function is used to enqueue the scripts
		  * Ref: https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts/
		  * @param1   string:$handle   Unique Name of the scripts
		 **/
		wp_enqueue_script( $this->plugin_name.'_core' );
		wp_enqueue_script( $this->plugin_name.'my-ajax', plugin_dir_url( __FILE__ ) . 'js/related-posts-plus-admin-ajax.js', array( 'jquery' ), $this->version, true );

	}
	
	public function get_data()  {
		/**
		 * This function is used to generate the data for the admin-specific functionality of the plugin on the posts dashboard
		 *
		 * This function should be called in the appropriate place to generate the data before it can be manipulated.
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		// Ref: https://developer.wordpress.org/reference/functions/get_categories/
		$term_ids_array = get_categories();
		
		// We loop through each of the categories
		foreach( $term_ids_array as $term ) {
			// We set a query to get all posts belonging to the individual categories
			$the_query = new WP_Query( array( 'cat' => $term->term_id ) );
			
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					// A transitionary array with the structure $transition['post_id] = post_title;
					$transition[get_the_ID()] = get_the_title();
					
					// Then we push the transition array into our multidimensional posts_array with the structure $post_array['category_id'] = array(['post_id] => post_title)
					// The category is our main filter
					$this->post_array[$term->term_id] = $transition;
				}
			}
		}
	}
		
	/**
	 * This function places the metabox containing all the posts in single post backend
	 *
	 * @since    1.0.0
	 */
	public function posts_meta_box() {
		/**
		 * This function is used to render a meta box for the admin-specific functionality of the plugin on the posts dashboard
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Related_Posts_Plus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Plus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * The hooks are defined in $Related_Posts_Plus->define_admin_hooks()		 
		 */
		
		 /**
		  * This function is used to enqueue the scripts
		  * Ref: https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts/
		  * @param1   string:$handle   Unique Name of the scripts
		 **/
		
		// This function call generates the $post_array, it is called in the meta_box so the rest of the page can finish loading before the meta box is rendered
		$this->get_data();
		
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
		
		// Get the categories of the current post
		$terms = get_the_category();
		
		$params = array(
			'ajaxurl' => admin_url( 'admin-ajax.php', $protocol ), // Get the url to the admin-ajax.php file using admin_url()			
			'ajaxaction' => 'sd_ajax', // Register the PHP function that is responsible for handling the AJAX interactions on the server side
			'pid' => $post->ID, // Pass the post_id as an argument to the JS file that is then passed through to sd_ajax via $_REQUEST
			'tid' => $terms, // Pass the current categories of the post to the JS file and then to sd_ajax via $_REQUEST
			'post_array' => $this->post_array, // Pass the data we constructed earlier
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
	 * Register the AJAX Function for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function sd_ajax( $post ) {
		$terms = $_REQUEST['tid'];
		$post_id = $_REQUEST['pid'];
		$post_array = $_REQUEST['postsdata'];
		
		if( $terms ) {
			foreach( $term as $term ) {
				$posts[] = wp_filter_object_list( $post_array, $term );
			}
		} else {
			foreach( $post_array as $post ) {
				$posts[] = $post;
			}
		}
		
		require_once('partials/related-posts-plus-admin-display.php');

		// Always exit when doing Ajax
		die();

	}
}