<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Related_Posts_Plus
 * @subpackage Related_Posts_Plus/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Related_Posts_Plus
 * @subpackage Related_Posts_Plus/includes
 * @author     Aakash Bhatia <aakash@stocksdigital.com>
 */
class Related_Posts_Plus {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Related_Posts_Plus_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'related-posts-plus';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Related_Posts_Plus_Loader. Orchestrates the hooks of the plugin.
	 * - Related_Posts_Plus_i18n. Defines internationalization functionality.
	 * - Related_Posts_Plus_Admin. Defines all hooks for the admin area.
	 * - Related_Posts_Plus_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-related-posts-plus-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-related-posts-plus-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-related-posts-plus-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-related-posts-plus-public.php';

		$this->loader = new Related_Posts_Plus_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Related_Posts_Plus_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Related_Posts_Plus_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Related_Posts_Plus_Admin( $this->get_plugin_name(), $this->get_version() );				
		
		/**
		  * admin_init is triggered before any other hook when a user accesses the admin area
		  * @callback1 from admin/class-related-posts-plus-admin.php Related_Posts_Plus_Admin->register_admin_with_redirect()
		  * @callback2 from admin/class-related-posts-plus-admin.php Related_Posts_Plus_Admin->enqueue_styles()
		  * @callback3 from admin/class-related-posts-plus-admin.php Related_Posts_Plus_Admin->enqueue_scripts()
		**/
		$this->loader->add_action( 'admin_init', $plugin_admin, 'restrict_admin_with_redirect' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_styles' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_scripts' );
		
		/**
		  * admin_enqueue_scripts is the first action hooked into the admin scripts actions
		  * @callback1 from admin/class-related-posts-plus-admin.php $Related_Posts_Plus_Admin->enqueue_styles()
		  * @callback2 from admin/class-related-posts-plus-admin.php $Related_Posts_Plus_Admin->enqueue_scripts()
		**/
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		
		//$this->loader->add_action( 'wp', $plugin_admin, 'get_data' );
		//$this->loader->add_action( 'current_screen', $plugin_admin, 'initial_data' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'posts_meta_box' );
		
		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_ajax_sd_ajax', $plugin_admin, 'sd_ajax' );
		$this->loader->add_action( 'wp_ajax_nopriv_sd_ajax', $plugin_admin, 'sd_ajax' );
		//$this->loader->add_action( 'wp', $plugin_admin, 'post_params' );		
		//$this->loader->add_action( 'private_to_public', $plugin_admin, 'save' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Related_Posts_Plus_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Related_Posts_Plus_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
