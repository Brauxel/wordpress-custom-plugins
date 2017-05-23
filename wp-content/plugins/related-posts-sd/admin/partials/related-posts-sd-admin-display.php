<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Related_Posts_Sd
 * @subpackage Related_Posts_Sd/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
	if ( $term_id != null ) {
		// Setup the custom WP_Query pertaining to a taxonomy term
		$args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'post__not_in' => array( $post_id ), 'orderby' => 'date', 'order' => 'DESC', 'tax_query' => array( array( 'taxonomy' => 'company', 'field' => 'id', 'terms' => $term_id ) ) );
	} else {
		// Setup the custom WP_Query for all posts
		$args = array('post_type' => 'post', 'orderby' => 'date', 'post__not_in' => array( $post_id ), 'order' => 'DESC', 'post_status' => 'publish', 'posts_per_page' => -1 );
	}
	
	$the_query = new WP_Query( $args );

	// Pull the required related posts
	$myRelatedPosts = get_post_meta( $post_id, '_my_related_posts', false );

	if ( $the_query->have_posts() ) {
		$html .= '<ul class="related-posts-admin">';

		while( $the_query->have_posts() ) {
			$the_query->the_post();
			// Construct the HTML that is to be echoed via the sd_ajax() function in class-admin
			$html .= '<li><input checked type="checkbox" name="related_post[]" value="'.get_the_ID().'">';
			$html .= '<label for="related_post[]">'.get_the_title().'</label></li>';
		}

		$html .= '</ul>';
	} else {
		$html = '<p>No Posts to display for this company</p>';
	}
?>