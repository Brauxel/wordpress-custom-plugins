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
		
		//add_action( 'save_post', array( $this, 'save' ) );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Related_Posts_Sd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Sd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/related-posts-sd-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Related_Posts_Sd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Sd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		global $post;
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jquery-ui.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'my-custom-css', plugin_dir_url( __FILE__ ) . 'js/related-posts-sd-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'my-ajax', plugin_dir_url( __FILE__ ) . 'js/related-posts-sd-admin-ajax.js', array( 'jquery' ), $this->version, true );

		// Get the protocol of the current page
		$protocol = isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
		
		// Create a nonce for this action
		$nonce = wp_create_nonce( 'sd_ajax-' . $post->ID );

		// Set the ajaxurl Parameter which will be output right before
		// our ajax-delete-posts.js file so we can use ajaxurl
		$params = array(
			// Get the url to the admin-ajax.php file using admin_url()
			'ajaxurl' => admin_url( 'admin-ajax.php', $protocol ),
			'ajaxaction' => 'sd_ajax',
			'pid' => $post->ID,
			'nonce' => $nonce
		);

		// Print the script to our page
		wp_localize_script( $this->plugin_name.'my-ajax', 'my_ajax_args', $params );

	}
	
	/**
	 * This function places the custom fields on posts
	 *
	 * @since    1.0.0
	 */
	public function add_meta_box( $post_type ) {

		// If admin then continue with the plugin else exit the function			
		if ( !is_admin() ):
			exit();
		endif;
		
		$post_types = array('post');   //limit meta box only to posts
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'related_posts'
				,__( 'Related Posts', 'tracker_textdomain' )
				,array( $this, 'render_meta_box_content' )
				,$post_type
				,'advanced'
				,'high'
			);
		}
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
		
		die('in');

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
			foreach( $_POST['related_post'] as $related_posts ) {
				$currentRelatedPosts = get_post_meta( $related_posts, '_my_related_posts');
				
				if (  $currentRelatedPosts != NULL ) {
					//die('in'.print_r($currentRelatedPosts));
					
					foreach( $currentRelatedPosts as $currentRelatedPost ) {
						// We should only auto inject if it doesn't already exsit in the array
						if( in_array($_POST['post_ID'], $currentRelatedPost) ){
							continue;
						} else {
							array_push( $currentRelatedPost, $_POST['post_ID'] );
						}
					}
					
					//die('in'.print_r($currentRelatedPost));
					
					update_post_meta( $related_posts, '_my_related_posts', $currentRelatedPost );
				} else {
					//die('out'.get_the_ID());
					$currentRelatedPost = array( get_the_ID() );
					//die('out'.print_r($currentRelatedPost));
					update_post_meta( $related_posts, '_my_related_posts', $currentRelatedPost );
				}
			}
		}
	}
	
    public function tax_error_notice( $post ) {
		$screen = get_current_screen();
		if ( $screen->parent_base == 'edit' ) {
			echo '<div id="error-no-select" class="error">Please select atleast and only one company to proceed</div>';
		}
	}
}