<?php
/**
 * The design and technical requirements for Next Investors V3
 *
 * @link       http://stocksdigital.com/
 * @since      3.0.0
 *
 * @package    next-investors-v3
 * @subpackage bin/NextInvestors
 *
 * Sets up styleshhets and scripts
 * Sets up body classes for sub site customisation
 * Allows admin to access menus, thumbnails and custom image sizes
*/

class NextInvestors {
	public $themeName;
	public $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $themeName, $version, $siteID ) {
		/**
		 * This function is used to register the stylesheets and scripts specific to the Next Investors V3 theme
		 *
		 * The registerd stylesheets and scripts have to enqueued in the init() function
		 @
		 */
		
		// Sets theme name passed via instance in functions.php
		$this->themeName = $themeName;
		
		// Sets version passed via instance in functions.php. Useful for forcing cache to rebuild styles and scripts
		$this->version = $version;
		
		// Passes the current site ID to set the site options in init() via set_site_options(), can be accessed for further customisation
		$this->siteID = $siteID;
		
		 /**
		  * This function is used to register the stylesheets that will be enqueued in $this->enqueue_styles()
		  * Ref: https://codex.wordpress.org/Function_Reference/wp_register_style/
		  * @param1   string:$handle   Name of the stylesheet. Should be unique
		  * @parma2   string:$src   Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory. In our case we get the URL (with trailing slash) 
		  * for the plugin __FILE__ passed (https://codex.wordpress.org/Function_Reference/plugin_dir_url)
		  * @param4   array:$dependencies   null
		  * @param4   string:$ver   $this->version   The current version of the theme
		 **/		
		wp_register_style( $this->themeName.'_next-investors-styles', get_bloginfo( 'template_url' ) . '/assets/next-investors.css', null, $this->version, 'all');
		wp_register_style( 'stylesheet', get_bloginfo( 'template_url' ) . '/style.css', null, $this->version, 'all');
		
		wp_register_script( $this->themeName.'_tether', get_bloginfo( 'template_url' ) . '/assets/tether.min.js', '1.4.0' );
		wp_register_script( $this->themeName.'_core', get_bloginfo( 'template_url' ) . '/assets/core.js', array( 'jquery' ), $this->version, true );
	}
	
	public function init() {
		// Use wp_enqueue_scripts hook to add the assets defined in enqueue_assets to the frontend
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_assets') );
		
		$this->set_site_options();
		
		// Allows the 'featured image' functionality on posts and pages
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails' );
		}
		
		// Add blog-id as a class to style CSS
		add_filter( 'body_class', array($this, 'my_class_names') );
	}
	
	public function set_site_options() {
		if( $this->siteID == 1 ) {
			$formID =  '1';
			$sidebarFormId = 49;
			$logo = get_bloginfo('template_url').'/assets/images/ni.svg';
			$footerFormsTitle = 'Follow Next Investors';
		}

		if( $this->siteID == 9 ) {
			$formID =  45;
			$sidebarFormId = 49;
			$logo = get_bloginfo('template_url').'/assets/images/nmb.svg';
			$footerFormsTitle = 'Follow Next Mining Boom';
		} 

		//Set options for Next Oil Rush
		if( $this->siteID == 10 ) {
			$formID = 50;
			$sidebarFormId = 53;
			$logo = get_bloginfo('template_url').'/assets/images/nor.svg';
			$footerFormsTitle = 'Follow Next Oil Rush';
		}

		//Set options for Next Tech Stock
		if( $this->siteID == 12 ) {
			$formID =  23;
			$sidebarFormId = 32;
			$logo = get_bloginfo('template_url').'/assets/images/nts.svg';
			$footerFormsTitle = 'Follow Next Tech Stock';
		}

		//Set options for Next Small Cap
		if( $this->siteID == 13 ) {
			$formID =  58;
			$sidebarFormId = 63;
			$logo = get_bloginfo('template_url').'/assets/images/nsc.svg';
			$footerFormsTitle = 'Follow Next Small Cap';
		}

		//Set options for Next Biotech
		if( $this->siteID == 15 ) {
			$this->formID =  7;
			$this->sidebarFormId = 10;
			$this->logo = get_bloginfo('template_url').'/assets/images/nbt.svg';
			$this->footerFormsTitle = 'Follow Next Biotech';
		}
	}
	
	public function my_class_names( $classes ) {
		// Add 'class-name' to the $classes array
		$classes[] = 'blog-'.get_current_blog_id();
		$classes[] = 'with-alert';
		// return the $classes array
		return $classes;
	}
	
	
	public function enqueue_assets() {
		/**
		 * This function is used to enqueue the stylesheets and scripts required for the Next Investors V3 theme
		 *
		 * This function should be hooked into WordPress' wp_enqueue_scripts in the init() of the current class
		 *
		 * The scripts are enqueued only if the current page is public facing, hence not made available in the admin side
		 @
		*/
		if ( !is_admin() ) {
		   /**
		   * This function is used to enqueue the stylesheets/scripts
		   * Ref: https://developer.wordpress.org/reference/functions/wp_enqueue_style/
		   * @param1   string:$handle   Unique Name of the stylesheet
		   **/			
			wp_enqueue_style( $this->themeName.'_next-investors-styles' );
			wp_enqueue_style( 'stylesheet' );
			wp_enqueue_script( $this->themeName.'_tether' );
			wp_enqueue_script( $this->themeName.'_core' );
		}
	}
	
	public function register_menus() {
		/**
		 * This function is used to register the required menus for use by the admin
		 *
		 * This function should be called in the functions.php
		 *
		 * Ref: https://developer.wordpress.org/reference/functions/register_nav_menus/
		 @
		*/
		register_nav_menus( array(
			'main' => 'Main Menu',
			'footer' => 'Footer Menu'
		));
	}
	
	public function register_image_sizes() {
		/**
		 * This function is used to add custom image sizes
		 *
		 * This function should be called in the functions.php
		 *
		 * Ref: https://developer.wordpress.org/reference/functions/add_image_size/
		 @
		*/
		add_image_size( 'related_thumb', 260, 146, false );
	}	
}
?>