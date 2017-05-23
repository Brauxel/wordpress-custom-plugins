<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Related_Posts_Plus
 * @subpackage Related_Posts_Plus/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="related-post-wrap">
	<div class="related-posts-listed">
		<ul id="listed-posts">
		<?php 
			foreach( $posts as $post ):
		?>
			<li id="listed-obj"<?php if(in_array(array_keys($posts, $post)[0], array_keys($relations_array))): ?> class="hide"<?php endif; ?>>
				<a href="#" class="<?php echo array_keys($posts, $post)[0]; ?>"><?php echo $post; ?></a>				
			</li>
		<?php endforeach; ?>
		</ul>
	</div>

	<div class="related-posts-selected">
		<ul id="selected-posts">
			<?php foreach( $relations_array as $relation ): ?>
			<li id="post-handler">
				<a href="#" class="<?php echo array_keys($relations_array, $relation)[0]; ?>"><?php echo $relation; ?></a>
				<input type="checkbox" value="<?php echo array_keys($relations, $relation)[0]; ?>" name="related_post[]" checked>
			</li>			
			<?php endforeach; ?>
		</ul>
	</div>
</div>