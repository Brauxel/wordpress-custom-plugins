<?php
/**
 * Plugin Name: Business Wire Feed
 * Description: Plugin to display the articles from the business wire feed
 * Version: 1.0
 * Author: Aakash Bhatia
 * Author URI: http://stocksdigital.com/
 * Plugin URI: http://stocksdigital.com/
 */



function BWFeed_showFeed(){
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