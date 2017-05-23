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
		
	public function initial_data( $current_screen ) {
		if ( $current_screen->post_type == 'post'  && 'post' == $current_screen->base ) {
			//$this->get_data();
		}
		
		//die(print_r($this->post_array));
		//die(print_r($this->term_ids_array));
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
		 * defined in Related_Posts_Plus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Plus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/related-posts-plus-admin.css', array(), $this->version, 'all' );

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
		 * defined in Related_Posts_Plus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Related_Posts_Plus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		global $post;	

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/related-posts-plus-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'my-ajax', plugin_dir_url( __FILE__ ) . 'js/related-posts-plus-admin-ajax.js', array( 'jquery' ), $this->version, true );

	}
		
	/**
	 * This function places the metabox containing all the posts in single post backend
	 *
	 * @since    1.0.0
	 */
	public function posts_meta_box() {
		global $post;
		
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
		//$p = $this->post_array;
		//$this->get_data();
		
				
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
		
		//print_r($this->post_array);
		
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
		//$terms = array(1,2,3);
		$terms_tax = array();
		$posts_id = array();
		$posts = array();
		//die(print_r($terms));
		
		if(isset($this->post_array)) {
			//$this->get_data();
		} else {
			$this->get_data();
		}
		
		if( $terms ) {
			foreach( $this->term_ids_array as $key => $value ) {
				foreach( $terms as $term ) {
					if( $value['term_id'] == $term ) {
						array_push($terms_tax, $value['term_taxonomy_id']);
					}
				}
			}
						
			foreach( $this->term_taxonomy_ids_array as $key => $value ) {
				foreach ($terms_tax as $term_tax) {
					//die(print_r($value));
					if($value['term_taxonomy_id'] == $term_tax) {
						array_push($posts_id, $value['object_id']);
					}
				}
			}
			
			foreach( $this->post_array as $key => $value ) {
				//die(print_r($value));
				foreach ($posts_id as $post_id) {
					if($value['ID'] == $post_id) {
						$posts[$value['ID']] = $value['post_title'];
					}
				}
			}
			
			//die(print_r($posts));
		} else {
			//die(print_r($this->post_array));
			foreach( $this->post_array as $key => $value ) {
				$posts[$value['ID']] = $value['post_title']; 
			}
			
			
		}
		
		//die(print_r($posts));
		
		require_once('partials/related-posts-plus-admin-display.php');

		//echo $html;

		// Always exit when doing Ajax
		die();

	}
	
	private function build_relations( $post_id ) {
		$this->related_posts = get_post_meta( $post_id, 'related_post');
		
		if( isset($this->related_posts) ) {			
			foreach( $this->related_posts[0] as $related_post ) {
				$relations[$related_post] = get_the_title($related_post);
			}
			return $relations;
		} else {
			return NULL;
		}
	}
	
	public function get_data()  {
		global $wpdb;
		$this->post_array = $wpdb->get_results( 'SELECT ID, post_title FROM wp_posts WHERE post_type = "post" AND post_status = "publish"', ARRAY_A );
		$this->term_taxonomy_ids_array = $wpdb->get_results( "SELECT term_taxonomy_id, object_id FROM {$wpdb->prefix}term_relationships", ARRAY_A );
		$this->term_ids_array = $wpdb->get_results( "SELECT term_taxonomy_id, term_id FROM {$wpdb->prefix}term_taxonomy", ARRAY_A );
	}
	
	public function save( $post ) {
		//die(print_r($_POST['related_post']));
		if ( isset( $_POST['related_post'] ) ) {
			//die(print_r($_POST['related_posts']));
			update_post_meta( $_POST['post_ID'], 'related_post', $_POST['related_post'] );
		}		
		//echo "<script>console.log('save fired');</script>";
	}
}