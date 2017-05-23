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

	function taxonomy_check( term_id ) {
		// This is what we are sending over the AJAX call
		var data = {
			action: my_ajax_args.ajaxaction,
			tid: term_id,
			nonce: my_ajax_args.nonce,
			pid: my_ajax_args.pid
		};
		
		//event.preventDefault();
		$.ajax({
			url: my_ajax_args.ajaxurl,
			type: 'post',
			data: data,
			success: function( response ) {
				$('#related_posts .inside').html( response );
			}
		});
	}
	
	$( document ).ready( function() {
		// If company is clicked, we fire the AJAX request
		if ( $('#companychecklist input').is(':checked') ) {
			taxonomy_check( $('#companychecklist input').val() );
		} else {
			$('#related_posts .inside').html( 'Please select a company to get a list of related posts' );
		}
		
		$('#companychecklist input').click(function() {
			if ( $(this).is(':checked') ) {
				taxonomy_check( $( this ).val() );
			} else {
				$('#related_posts .inside').html( 'Please select a company to get a list of related posts' );
			}
		});
		
		// Prevent the default behavior for the link
		//event.preventDefault();
	});
})( jQuery );
