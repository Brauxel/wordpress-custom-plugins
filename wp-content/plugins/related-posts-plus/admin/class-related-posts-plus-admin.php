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
	//private $postID;
	
	//public $post_array;
	public $post_array;
	private $term_ids_array;
	private $term_taxonomy_ids_array;
	private $related_posts;
	private $params;

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
		
	public function initial_data() {
		$this->get_data();
		
		//die(print_r($this->post_array));
		//die(print_r($this->term_ids_array));
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
		wp_register_script( $this->plugin_name.'_ajax', plugin_dir_url( __FILE__ ) . 'js/related-posts-plus-admin-ajax.js', array( 'jquery' ), $this->version, false );

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
		wp_enqueue_script( $this->plugin_name.'_ajax' );

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
		
		$screens = array('post');   //limit meta box only to posts
		
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
		$relations = $this->build_relations( $post->ID );
				
		// Get the protocol of the current page
		$protocol = isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
		
		// Create a nonce for this action
		$nonce = wp_create_nonce( 'sd_ajax-' . $post->ID );
		
		$terms = get_the_category();
		//die(print_r($relations));
		
		$this->params = array(
			// Get the url to the admin-ajax.php file using admin_url()
			'ajaxurl' => admin_url( 'admin-ajax.php', $protocol ),
			'ajaxaction' => 'sd_ajax',
			'pid' => $post->ID,
			'tid' => $terms,
			'relations' => $relations,
			'nonce' => $nonce
		);

		// Print the script to our page
		wp_localize_script( $this->plugin_name.'my-ajax', 'my_ajax_args', $this->params );
		
	}
	
	/**
	 * Register the AJAX Function for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function sd_ajax( $post ) {
		global $wpdb;
		$terms = $_REQUEST['tid'];
		$post_id = $_REQUEST['pid'];
		$relations_array = $_REQUEST['relations'];
		$terms_tax = array();
		$posts_id = array();
		$posts = array();
		
		if( $terms ) {
						
			foreach( $this->term_taxonomy_ids_array as $key => $value ) {
				foreach ($terms_tax as $term_tax) {
					if($value['term_taxonomy_id'] == $term_tax) {
						array_push($posts_id, $value['object_id']);
					}
				}
			}
			
			foreach( $this->post_array as $key => $value ) {
				foreach ($posts_id as $post_id) {
					if($value['ID'] == $post_id) {
						$posts[$value['ID']] = $value['post_title'];
					}
				}
			}
			
		} else {
			foreach( $this->post_array as $key => $value ) {
				$posts[$value['ID']] = $value['post_title']; 
			}
			
			
		}
		
		require_once('partials/related-posts-plus-admin-display.php');

		// Always exit when doing Ajax
		die();

	}
	
	private function build_relations( $post_id ) {
		$this->related_posts = get_post_meta( $post_id, 'related_post');
		
		if( !empty($this->related_posts[0]) ) {			
			foreach( $this->related_posts[0] as $related_post ) {
				$relations[$related_post] = get_the_title($related_post);
			}
			return $relations;
		} else {
			return NULL;
		}
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
		
		$this->term_taxonomy_ids_array = get_posts();
		
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
	
	public function save( $post ) {
		/**
		 * This function is used to save the relaed posts by hooking into save_post hook.
		 * Ref: https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
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
		
		if ( isset( $_POST['related_post'] ) ) {
		 /**
		  * This function is used to update metadata of a post with the related_posts' ids as an array
		  * it is stored in the wp_postsmeta table in your database
		  * Ref: https://codex.wordpress.org/Function_Reference/update_post_meta
		  * @param1   int:$post_id   Id of the current post
		  * @param2:  string:$table_col_name   The name of the column in the table
		  * @param3 array:$related_posts   Post IDs
		 **/
			update_post_meta( $_POST['post_ID'], 'related_post', $_POST['related_post'] );
		}		
	}
}