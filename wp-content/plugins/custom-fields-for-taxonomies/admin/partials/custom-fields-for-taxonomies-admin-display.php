<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Custom_Fields_For_Taxonomies
 * @subpackage Custom_Fields_For_Taxonomies/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
	$url = explode("&", $_SERVER["QUERY_STRING"]);
	$t_id = substr($url[1], 7, 3);
?>
<tr class="form-field">
    <th scope="row" valign="top">
        <label for="presenter_id"><?php _e('Related Posts (Except the latest post)'); ?></label>
    </th>
    <?php
		$myRelatedPosts = get_term_meta($t_id, 'ba_related_posts', true);
		
		if ( is_array( $myRelatedPosts ) ) {

			// First we pull all the posts that are related
			$args = array(
					'post_type' => 'post',
					'orderby' => 'date',
					'offset' => 1,
					'order' => 'DESC',
					'tax_query' => array(
					array(
							'taxonomy' => 'company',
							'field' => 'id',
							'terms' => $t_id
							)
						)
					);
			$the_query = new WP_Query( $args );
			
			if ( $the_query->have_posts() ):
	?>
    <td>
    	<ul class="related-posts">
	<?php
				while( $the_query->have_posts() ):
					$the_query->the_post();
	?>
    		<li>
            	<?php if(in_array(get_the_ID(), $myRelatedPosts)): ?>
	                <div class="checkbox-styler checked"><input type="checkbox" name="related_posts[]" value="<?php echo get_the_ID(); ?>" class="checkbox" checked></div>
                <?php else: ?>
	                <div class="checkbox-styler"><input type="checkbox" name="related_posts[]" value="<?php echo get_the_ID(); ?>" class="checkbox"></div>
			<?php endif; ?>
                <label for="related_posts[]"><?php the_title(); ?></label>
            </li>
    <?php
				endwhile;
				wp_reset_query();
	?>
        </ul>
    </td>
    <?php
			endif;
		} else {
			$args = array(
					'post_type' => 'post',
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC',
					'tax_query' => array(
					array(
							'taxonomy' => 'company',
							'field' => 'id',
							'terms' => $t_id
							)
						)
					);
			$the_query = new WP_Query( $args );
			
			if ( $the_query->have_posts() ):
	?>
    <td>
    	<ul class="related-posts">
	<?php
				while( $the_query->have_posts() ):
					$the_query->the_post();
	?>
    		<li>
                <div class="checkbox-styler"><input type="checkbox" name="related_posts[]" value="<?php echo get_the_ID(); ?>" class="checkbox"></div>
                <label for="related_posts[]"><?php the_title(); ?></label>
            </li>
	<?php
				endwhile;
				wp_reset_query();
	?>
        </ul>
    </td>
    <?php
			endif;
		} 
	?>
</tr>