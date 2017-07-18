<?php
/*
	* Walker Function to add Bootstrap support to WordPress Menu
	* @Reference header.php
*/
class Walker_Nextinvestors_Menu extends Walker {

    // Tell Walker where to inherit it's parent and id values
    var $db_fields = array(
        'parent' => 'menu_item_parent', 
        'id'     => 'db_id' 
    );

    /**
     * At the start of each element, output a <li> and <a> tag structure.
     * 
     * Note: Menu objects include url and title properties, so we will use those.
	 *
	 * 	@ param $output referenced
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$gridClass = 'col-lg-2';
		
		/** 
		 * We need to offset the menu items by one column
		 * We check the position of the menu item via the ['menu_order']<br>
		 * key in the $item object
		**/
		if( $item->menu_order == 1 ) {
			$gridClass .= ' offset-lg-1';
		}
		
        $output .= sprintf( "\n<li class='%s'><a href='%s'%s><span>Next </span>%s</a></li>\n",
			$gridClass,
            $item->url,
            ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
            $item->title
        );
    }
}
?>