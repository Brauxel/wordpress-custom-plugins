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
	if ( isset( $_POST['term_order'] ) ) {
		update_option( 'pos_collection',$_POST['term_order'], false );
	}
?>

<?php
$args = array(
  'public'   => true,
  '_builtin' => false 
);
$ts = get_taxonomies( $args ); 
?>
<div class="wrap">
	<a href="<?php bloginfo( 'url' ); ?>#current-stocks" class="btn" target="_blank">Click here to view the Companies</a>

    <form method="post" action="#" name="update_order">
        <ul class="four-columns" id="company-order">
        <?php
		$pos_collection = get_option( 'pos_collection' );
		$pos_collection = array_filter($pos_collection);
			
		if (  $pos_collection != NULL  ):
			$terms = get_terms( array( 'taxonomy' => 'company', 'hide_empty' => false, 'fields' => 'ids' ) );
			$terms_merge = array_merge($terms, $pos_collection);
			$terms_merge = array_unique($terms_merge);
			foreach ( $terms_merge as $t ) {
				array_push($pos_collection, $t);
			}
			$pos_collection = array_unique($pos_collection);

			foreach( $pos_collection as $pos ):
				$term = get_term_by( 'id', $pos, 'company');
				$src = get_option( 'z_taxonomy_image'.$term->term_taxonomy_id );
		?>
            <li class="column">
                <img src="<?php echo $src; ?>" title="<?php echo $term->name; ?>" alt="<?php echo $term->name; ?>" />
                <p><?php echo $term->name; ?></p>
                <input type="hidden" value="<?php echo $term->term_taxonomy_id; ?>" name="term_order[]">
            </li>
		<?php endforeach; ?>
		<?php
		else:
			$terms = get_terms( array( 'taxonomy' => 'company', 'hide_empty' => false ) );
			foreach( $terms as $term ):
				$src = get_option( 'z_taxonomy_image'.$term->term_taxonomy_id );
		?>
            <li class="column">
                <img src="<?php echo $src; ?>" title="<?php echo $term->name; ?>" alt="<?php echo $term->name; ?>" />
                <p><?php echo $term->name; ?></p>
                <input type="hidden" value="<?php echo $term->term_taxonomy_id; ?>" name="term_order[]">
            </li>        
        <?php endforeach; endif; ?>
        </ul>
	    <button type="submit" class="btn">Submit</button>
	</form>    
<!-- div.wrap ENDS -->
</div>