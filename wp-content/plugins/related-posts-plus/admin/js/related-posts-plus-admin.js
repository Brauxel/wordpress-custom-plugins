(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	
	$( document ).on('click', '#listed-posts .post', function() {
		$(this).parent().addClass('hide');
		var moveContent = '<div class="field-group"><input id="' + $(this).parent().attr('id') + '" type="checkbox" value="'+ $(this).parent().attr('id') +'" name="related_post[]" placeholder="' + $(this).html() + '" checked><label for="' + $(this).parent().attr('id') + '">' + $(this).html() + '</label></div>';		
		
		$('#selected-posts').append(moveContent);
		
		console.log(moveContent);
		
		return false;
	});
	
	$( document ).on('click', '#selected-posts .field-group', function() {
		var identifier = '#' + $(this).find('input').attr('id');
		console.log(identifier);
		
		$(this).remove();
		
		$('#listed-posts').find(identifier).removeClass('hide');
	});

})( jQuery );