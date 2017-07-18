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
		*/
		add_image_size( 'related_thumb', 260, 146, false );
	}
		
	/**
	 * This function is used to truncate strings to fit our design needs
	 *
	 * This function should be called in the front end templates
	 *
	 * It's called in single.php and taxonomy-company.php
	 *
	 * @param1 string:$str, the string passed to the function for truncation
	 * @param2 int:$chars, the number of character that the string is limited to.
	 * @param3: bool:$to_space a boolean value, if true the string is truncated to the final space before the count else it sticks to the number of characters
	 * @param4 string:$replacement optional argument that defines the characters that are meant to replace the truncated string
	*/
	public function truncateString($str, $chars, $to_space, $replacement="...") {
		if( $chars > strlen($str) ) return $str;

		$str = substr($str, 0, $chars);

		$space_pos = strrpos($str, " ");
		
		if($to_space && $space_pos >= 0) {
		   $str = substr($str, 0, strrpos($str, " "));
		}

		return($str . $replacement);
	}
	
	/**
	 * This function is used to latest posts based on dates across all the multisite system
	 *
	 * This function should be called in the front end templates
	 *
	 * It's called in 404.php and taxonomy-company.php
	 *
	 * @param1 int:$count, optional argument that sets the number of latest posts to fetch, defaults to 3
	*/
	public function recent_posts($count = 3) {
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
				$postdetail = get_blog_post($blog['blog_id'], $post);
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

		foreach( $postArray as $post ) {
			// Add the ID to the array to avoid repetitions
			array_push( $GLOBALS[ 'repAvoider' ], $post['id'] );
			$truncatedTitle = $this->truncateString($post['title'], 85, true);
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
	
	/**
	 * This function is used to latest post on each site
	 *
	 * This function should be called in the front end templates
	 *
	 * It's called in landing.php
	 *
	*/
	public function populate_latest() {
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
}
?>