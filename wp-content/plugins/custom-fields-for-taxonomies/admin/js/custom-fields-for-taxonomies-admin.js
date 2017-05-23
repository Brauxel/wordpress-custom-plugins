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
	 
	$( document ).ready(function() {
		// Makes the list sortable that is drag & drop
		$( '.related-posts' ).sortable();
		
		$('#company-order').sortable();
		
		// This jQuery functionality feeds into replacing the background image for the checkboxes
		$( '.related-posts .checkbox-styler' ).click(function() {
			if ( !$( this ).find('.checkbox' ).attr('checked') ) {
				if( $( '.related-posts .checkbox-styler .checkbox:checked' ).length < 3) {
					$(this).find('.checkbox' ).prop('checked', true);
					$(this).addClass('checked');
				} else {
					alert("We apologise but you are only allowed to select 3 related articles");
					$(this).find('.checkbox' ).prop('checked', false);
					$(this).removeClass('checked');
				}
			} else {
				if( $( '.related-posts .checkbox-styler .checkbox:checked' ).length <= 1) {
					alert('Sorry! A minimum of one post has to selected.');
				} else {
					$(this).find('.checkbox' ).prop('checked', false);
					$(this).removeClass('checked');
				}
			}
		});
	});
})( jQuery );