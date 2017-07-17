<?php 
class Company {
	public function init() {
		// Hooks into the edit-tags.php page and removes the parent category
		add_action( 'admin_head-edit-tags.php', array($this, 'remove_parent_company') );
	}
	
	public function remove_parent_company()
	{
		// don't run in the Tags screen
		if ( 'company' != $_GET['taxonomy'] )
			return;

		// Screenshot_1 = New Category
		// http://example.com/wp-admin/edit-tags.php?taxonomy=category
		$parent = 'parent()';

		// Screenshot_2 = Edit Category
		// http://example.com/wp-admin/edit-tags.php?action=edit&taxonomy=category&tag_ID=17&post_type=post
		if ( isset( $_GET['action'] ) )
			$parent = 'parent().parent()';

		?>
			<script type="text/javascript">
				jQuery(document).ready(function($)
				{     
					$('label[for=parent]').<?= $parent; ?>.remove();
				});
			</script>
		<?php
	}
}
?>