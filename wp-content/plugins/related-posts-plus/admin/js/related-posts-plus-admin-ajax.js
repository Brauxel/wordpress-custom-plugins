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
	
	var categories = [];

	function taxonomy_check( term_id ) {
		// This is what we are sending over the AJAX call
		//alert(term_id);
		//alert(term_id.toSource());
		
		var data = {
			action: my_ajax_args.ajaxaction,
			pid: my_ajax_args.pid,
			tid: term_id,
			postsdata: my_ajax_args.post_array,
			nonce: my_ajax_args.nonce			
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
	
	function get_terms( terms ) {
		$.map(terms, function(t) {
			categories.push(parseInt(t.term_id));
		});
	}
	
	$( document ).ready( function() {
		if (my_ajax_args.tid !== '') {
			get_terms(my_ajax_args.tid);
			taxonomy_check(categories);
		} else {
			taxonomy_check(0);
		}
		
		$('#categorychecklist li input').click(function() {
			if ( $(this).is(':checked') ) {
				categories.push(parseInt($(this).val()));
				taxonomy_check( categories );
			} else if($( "#categorychecklist li input:checked" ).length > 0) {
				//alert('somthing still checked');
				categories.splice(categories.indexOf(parseInt($(this).val())), 1);
				taxonomy_check( categories );
			} else {
				//alert('all unchecked');
				categories = [];
				taxonomy_check( categories );
			}
		});
		
		// Prevent the default behavior for the link
		//event.preventDefault();
	});
})( jQuery );
