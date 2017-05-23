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
	  
	$( document ).ready( function() {
		// Move to selected posts list on click and disable button
		$('#listed-posts li').on('click', 'a', function() {
			var moveContent = '<li id="post-handler">' + $(this).parent().html() + '</li>';
			//alert(moveContent);
			$('#selected-posts').append(moveContent);
			$(this).parent().addClass('hide');
			return false;
		});
		
		/*$('#selected-posts li').on('click', 'a', function() {
			alert('in');
			return false;
		});*/
	});
	
	$(document).on('click', '#listed-obj', function() {
		if($( "#selected-posts li" ).length < 4) {
			var moveContent = '<li id="post-handler">' + $(this).html() + '<input type="checkbox" value="'+ $(this).find('a').attr('class') +'" name="related_post[]" checked></li>';
			$('#selected-posts').append(moveContent);
			$(this).addClass('hide');
		} else {
			alert('only 4 please');
		}
		return false;
	});
	
	$(document).on('click', '#post-handler', function() {
		//alert($(this).text());
		var id = $(this).find('a').attr('class');
		//alert(id);

		$('#listed-posts li a.' + id).parent().removeClass('hide');
		$(this).remove();

		return false;
	});

	})( jQuery );