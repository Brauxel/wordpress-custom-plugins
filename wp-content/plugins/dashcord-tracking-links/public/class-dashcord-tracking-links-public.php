<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Dashcord_Tracking_Links
 * @subpackage Dashcord_Tracking_Links/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dashcord_Tracking_Links
 * @subpackage Dashcord_Tracking_Links/public
 * @author     Stocks Digital <Aakash Bhatia> <akash.bhatia1184@gmail.com>
 */
class Dashcord_Tracking_Links_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		// Hooks for the plots
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'custom_queues' ) );
		add_action( 'wp_footer', array( $this, 'injection' ) );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */

	public function custom_queues($hook) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dashcord_Tracking_Links_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dashcord_Tracking_Links_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( $hook == 'post.php' || $hook == 'post-new.php'):
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dashcord-tracking-links-posts.css', array(), $this->version, 'all' );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dashcord-tracking-links-posts.js', array( 'jquery' ), $this->version, false );
		endif;

	}

	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dashcord_Tracking_Links_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dashcord_Tracking_Links_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dashcord-tracking-links-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dashcord_Tracking_Links_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dashcord_Tracking_Links_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dashcord-tracking-links-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function add_meta_box( $post_type ) {

		// If admin then continue with the plugin else exit the function			
		if ( !is_admin() ):
			exit();
		endif;
		
		$post_types = array('post', 'page');   //limit meta box to certain post types
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'post_tracker'
				,__( 'Select your trackers', 'tracker_textdomain' )
				,array( $this, 'render_meta_box_content' )
				,$post_type
				,'advanced'
				,'high'
			);
		}
	}
	
	public function render_meta_box_content( $post ) {
		
			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'dashcord_trackers_inner_custom_box_nonce', 'dashcord_trackers_inner_custom_box_nonce' );
	
			// Use get_post_meta to retrieve an existing value from the database.
			$value = get_post_meta( $post->ID, '_my_dashcord_trackers', true );
			
			if ( empty($value) ) {
				$value = array(NULL);
			}
	
			global $wpdb;
			$rows = $wpdb->get_results( 'SELECT * FROM wp_trackers' );
			
			if ( !empty($rows) ):
				foreach( $rows as $row ):
					echo '<div class="tracker">';
					if ( in_array($row->id, $value) ):
						echo '<input checked type="checkbox" class="tracker-checkbox" name="post_tracker[]" value="'.$row->id.'">';
					else:
						echo '<input type="checkbox" class="tracker-checkbox" name="post_tracker[]" value="'.$row->id.'">';
					endif;
					echo '<label for="post_tracker[]">'.$row->name.'</label>';
					echo '</div>';
				endforeach;
			endif;
	}
	
	public function save( $post_id ) {
		//die('we are in');
		
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		*/
		
		// Check if our nonce is set.
		if ( ! isset( $_POST['dashcord_trackers_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['dashcord_trackers_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'dashcord_trackers_inner_custom_box_nonce' ) )
			return $post_id;
			
		// If this is an autosave, our form has not been submitted,
		// so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */			
		
		// Update the meta field.
		update_post_meta( $post_id, '_my_dashcord_trackers', $_POST['post_tracker'] );
	}
	
	// This function auto injects the tracking codes at the end of content
	public function injection($post_id) {
		global $post;
		global $wpdb;
		$trackers = get_post_meta( $post->ID, '_my_dashcord_trackers', true );

		if (!empty ($trackers)):
			foreach( $trackers as $t ):
				$slug = $wpdb->get_var( $wpdb->prepare("SELECT slug FROM wp_trackers WHERE id = %s", $t) );
				echo '<img width="1" height="1" style="display:none;" src="http://'.get_option( 'dashcord_global_url' ).'/t/'.$slug.'/">';
			endforeach;
		endif;		
	}
}
