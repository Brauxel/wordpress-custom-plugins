<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Dashcord_Tracking_Links
 * @subpackage Dashcord_Tracking_Links/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
	$pluginAdmin = new Dashcord_Tracking_Links_Admin('dashcord-tracking-links', '1.0.0');
	
	if ( isset($_POST['add-global-slug']) ):
		update_option( 'dashcord_global_url', $_POST['global-slug'], true );
	endif;
	
	if ( isset($_POST['add']) ):
		$pluginAdmin->add_rows($_POST['lead-field'], $_POST['slug'], $_POST['description']); // Function located in admin\class-dashcord-tracking-links-admin
	endif;
	
	if ( isset($_POST['delete']) ):
		$pluginAdmin->delete_rows($_POST['delete']);
	endif;
	
	if ( isset($_POST['edit']) ):
		$pluginAdmin->update_rows($_POST['tracker-id'], $_POST['lead-field'], $_POST['slug'], $_POST['description']);
	endif;
?>
<div class="wrap">

	<form name="dashcord-global-url" method="post" class="dashcord-tracker" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    	<div class="field">
        	<label for="lead-field">Dashcord Global Slug<span class="required">*</span></label>
        	<input type="text" name="global-slug" class="input-text" placeholder="Please enter the global URL to be used" value="<?php echo get_option( 'dashcord_global_url' ); ?>" required>
            <div class="clear"></div>
        <!-- div.field ENDS -->
        </div>
        
        <input type="submit" class="submit-button" value="Add Slug" name="add-global-slug">
        <div class="clear"></div>
    </form>
    
	<?php if ( !isset($_POST['instigate-edit']) ): ?>
	<form name="dashcord-tracker" method="post" id="tracker-add" class="dashcord-tracker" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    	<div class="field">
        	<label for="lead-field">Leading Field<span class="required">*</span></label>
        	<input type="text" name="lead-field" class="input-text" placeholder="Please enter the tracker Name from Dashcord here" required>
            <div class="clear"></div>
        <!-- div.field ENDS -->
        </div>

    	<div class="field">
        	<label for="lead-field">Slug<span class="required">*</span></label>
        	<input type="text" name="slug" class="input-text" placeholder="Please enter the Unique ID from Dashcord here" required>
            <div class="clear"></div>
        <!-- div.field ENDS -->
        </div>

    	<div class="field">
        	<label for="description">Description</label>
            <textarea name="description" placeholder="Please enter a short description here" class="input-textarea"></textarea>
            <div class="clear"></div>
        <!-- div.field ENDS -->
        </div>
        
        <input type="submit" class="submit-button" value="Add Tracker" name="add">
        <div class="clear"></div>
    </form>
    <?php endif; ?>
    
    <?php if ( isset($_POST['instigate-edit']) ): ?>
    <div class="edit-section">
    <?php $rows = $pluginAdmin->pull_rows($_POST['instigate-edit']); ?>
    <?php if ( !empty($rows) ) { ?>
    	<form name="tracker-delete" method="post" id="delete-tracker" class="dashcord-tracker" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        
        	<input type="hidden" name="tracker-id" value="<?php echo $_POST['instigate-edit']; ?>">
        	<div class="field">
	        	<label for="lead-field">Leading Field<span class="required">*</span></label>
	        	<input type="text" name="lead-field" class="input-text" value="<?php echo $rows->name; ?>" placeholder="Please enter the tracker Name from Dashcord here" required>
                <div class="clear"></div>
            </div>

        	<div class="field">
	        	<label for="lead-field">Slug<span class="required">*</span></label>
	        	<input type="text" name="slug" class="input-text" value="<?php echo $rows->slug; ?>" placeholder="Please enter the Unique ID from Dashcord here" required>
                <div class="clear"></div>
            </div>

        	<div class="field">
	        	<label for="description">Description</label>
	            <textarea name="description" placeholder="Please enter a short description here" class="input-textarea"><?php echo $rows->description; ?></textarea>
                <div class="clear"></div>
            </div>
            
            <input type="submit" class="submit-button" value="Save Tracker" name="edit">
            <div class="clear"></div>
        </form>
    <?php } ?>
    <!-- div.delete-section ENDS -->
    </div>
    <?php endif; ?>

    <div class="trackers-listing-container">
    	<p class="title">List of Existing trackers</p>
        <?php
			$rows = $pluginAdmin->pull_rows(0);
			
			if ( isset($rows) ):
		?>
        <table id="trackers-listing" border="1" cellpadding="5" cellspacing="0">
            <col width="20%">
            <col width="20%">
            <col width="40%">
            <col width="10%">
            <col width="10%">
            
            <tr>
            	<th>Title</th>
            	<th>Slug</th>
            	<th>Description</th>
            	<th>Edit</th>
            	<th>Delete</th>
            </tr>
            
	        <?php foreach( $rows as $row ): ?>
            <?php //$editParams = array_merge($_GET, array("edit" => $row->id));
				  //$newEditQuery = http_build_query($editParams);
				  //$deleteParams = array_merge($_GET, array("delete" => $row->id));
				  //$newDeleteQuery = http_build_query($deleteParams);
		    ?>
            <tr>
            	<td><?php echo $row->name; ?></td>
            	<td><?php echo $row->slug; ?></td>
            	<td><?php echo $row->description; ?><br><strong>Tracking URL:</strong> <?php echo 'http://'.get_option( 'dashcord_global_url' ).'/'. $row->slug; ?></td>
                <td>
                	<form name="quick-edit" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	                	<input type="submit" class="edit" value="<?php echo $row->id ?>" name="instigate-edit">
					</form>
                </td>
                <td>
                	<form name="delete-form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	                	<input type="submit" class="delete" value="<?php echo $row->id ?>" name="delete">
					</form>
                </td>
            </tr>
			<?php endforeach; ?>
        <!-- table#trackers-listing ENDS-->
		</table>
        <?php endif; ?>
    <!-- div.trackers-listing-container ENDS -->
    </div>
<!-- div.wrap ENDS -->
</div>
