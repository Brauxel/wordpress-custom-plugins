<?php
/**
 * Plugin Name: Business Wire Feed
 * Description: Plugin to display the articles from the business wire feed
 * Version: 1.0
 * Author: Chris Adkins
 * Author URI: http://stocksdigital.com/
 * Plugin URI: http://stocksdigital.com/
 */



function BWFeed_showFeed(){
	/* ERROR REPORTING */
	//@ini_set( 'log_errors', 'Off' );
	//@ini_set( 'display_errors', 'On' );
	//define( 'WP_DEBUG', true );
	//define( 'WP_DEBUG_LOG', false );
	//define( 'WP_DEBUG_DISPLAY', true );

	/*$feedUrl = "http://feed.businesswire.com/rss/finfeed/?rss=G1QFDERJXkJdFV1TWQ==";
	$content = file_get_contents($feedUrl);
	$x = new SimpleXmlElement($content);
	$i = 0;
	$items = array();
	$items = $x;
	$html = NULL;
	$cwd = dirname(__FILE__);

	file_put_contents($cwd.'/items.json', json_encode($items));*/
	
	$cwd = dirname(__FILE__);
	$feed = file_get_contents($cwd . '/items.json');
	$items = json_decode($feed);

	foreach($items as $item) {
		for($i=0; $i<10; $i++) {
			if($item->item[$i]->title != '') {
				$html .= '<li class="businesswire-item"><a target="_blank" href="'.$item->item[$i]->link.'">'.$item->item[$i]->title.'</a></li>';
			}
		}
		
	}

	return $html;
}

include('settings_menu.php');

include('cron.php');
?>