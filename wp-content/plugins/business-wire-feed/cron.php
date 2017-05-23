<?php 


function injest_bwfeed_now(){
	/* ERROR REPORTING */
	@ini_set( 'log_errors', 'Off' );
	@ini_set( 'display_errors', 'On' );
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', false );
	define( 'WP_DEBUG_DISPLAY', true );

	$feedUrl = "http://feed.businesswire.com/rss/finfeed/?rss=G1QFDERJXkJdFV1TWQ==";
	$content = file_get_contents($feedUrl);
	$x = new SimpleXmlElement($content);
	$i = 0;
	$items = array();
	$items = $x;
	$html = NULL;
	$cwd = dirname(__FILE__);

	file_put_contents($cwd.'/items.json', json_encode($items));
}


add_action( 'injest_bwfeed', 'injest_bwfeed_now' );
// Add function to register event to WordPress init
add_action( 'init', 'register_hourly_injest');

// Function which will register the event
function register_hourly_injest() {
	// Make sure this event hasn't been scheduled
	if( !wp_next_scheduled( 'injest_bwfeed_now' ) ) {
		// Schedule the event
		wp_schedule_event( time(), 'ten_minutes', 'injest_bwfeed_now' );
	}
}

// Add custom cron interval
add_filter( 'cron_schedules', 'add_custom_cron_intervals', 10, 1 );

function add_custom_cron_intervals( $schedules ) {
	// $schedules stores all recurrence schedules within WordPress
	$schedules['ten_minutes'] = array(
		'interval'	=> 100,	// Number of seconds, 600 in 10 minutes
		'display'	=> 'Once Every 10 Minutes'
	);

	// Return our newly added schedule to be merged into the others
	return (array)$schedules; 
}

?>