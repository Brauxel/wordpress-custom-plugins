import { Modal, Alert } from 'bootstrap';
import ShareButton from './components/js/share-button.js';

var shareButton = new ShareButton();

function validateEmail(isEmail) {
	"use strict";
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	
    if (filter.test(isEmail)) {
        return true;
    }
    else {
        return false;
    }
}

(function($) {
	"use strict";
	
	$('.nav-toggle').click(function() {
		$(this).toggleClass('nav-close');
		$('header').toggleClass('opened');
		$('nav').toggleClass('show');
		$('.main-overlay').toggle();
		$('html').toggleClass('no-scroll');
		$(this).parent().toggleClass('alert-reset');
	});

	$('.res-menu-subscribe').click(function() {
		$('.nav-toggle').toggleClass('nav-close');
		$('nav').toggleClass('show');
		$('.main-overlay').toggle();
		$('html').toggleClass('no-scroll');
	});

	$('.control').click(function(){
		// Lets fetch the font size of the article and convert it to an integer(int)
		var fontSize = parseInt($("article").css("font-size"));

		// We check if the font is to be increased/decreaded via classes
		if($(this).hasClass('plus')) {
			fontSize++;
		} else if($(this).hasClass('minus')) {
			fontSize--;
		}

		// Apply the new fontSize to article
		$("article").css({"font-size": fontSize});

		// Return false to disengage the link action
		return false;
	});

	$('.get-updates .manage').click(function() {
		$(this).parent().parent().find('.options').slideToggle('slow');
		$(this).parent().find('.keep-me-informed').toggleClass('show');
		$(".gform_footer").fadeToggle();

		return false;
	});
	
	$('.show-form').click(function() {
		$(this).parent().find('.gform_wrapper').slideToggle('fast');
		$(this).fadeToggle(0);
		
		return false;
	});
	
	$('.gform_wrapper .close-btn').click(function() {
		$(this).parents('.gform_wrapper').slideToggle(0).parents('.form-holder').find('.show-form').fadeToggle('fast');
	});
	
	//setInterval(fadeHeader, 4000);
	
	setInterval(function(){
		if( !$('header').hasClass('opened') ) {
			$('header .toggler').addClass('hider');
			$('header .logo').addClass('hider');
		}
	}, 4000);

	
	$('.search-form input').focusin(function(){
		$(this).parent().addClass('focused');
	});
	
	$('.search-form input').focusout(function(){
		$(this).parent().removeClass('focused');
	});
	
	$('.gform_body input').on('input' ,function() {
		var name = $(this).parents('.gform_fields').find('.name').find('input').val();
		var email = $(this).parents('.gform_fields').find('.email').find('input').val();
		var isSidebar = 0;
		
		if( $(this).parent().parent().parent().parent().parent().hasClass('sidebar-form') ) {
			isSidebar = 1;
		}
		
		if( name !== '' &&  email !== '' ) {
			if( validateEmail(email) ) {
				if( $('.manage-controls').length ) {
					$(this).parents('.gform_body').find('.manage-controls button').removeAttr("disabled").removeClass('disabled').addClass('active');
				}
				
				$(this).parents('form').find('.gform_footer button').removeAttr("disabled").removeClass('disabled').addClass('active');
				
				if(isSidebar) {
					$(this).parents('.gform_fields').find('.options').slideToggle('fast');
				}
			} else {
				if( $('.manage-controls').length ) {
					$(this).parents('.gform_body').find('.manage-controls button').attr("disabled", true).addClass('disabled').removeClass('active');
				}
				$(this).parents('form').find('.gform_footer button').attr("disabled", true).addClass('disabled').removeClass('active');
				
				if(isSidebar) {
					$(this).parents('.gform_fields').find('.options').slideUp('fast');
				}
			}
		} else {
			if( $('.manage-controls').length ) {
				$(this).parents('.gform_body').find('.manage-controls button').attr("disabled", true).addClass('disabled').removeClass('active');
			}
			$(this).parents('form').find('.gform_footer button').attr("disabled", true).addClass('disabled').removeClass('active');
			
			if(isSidebar) {
				$(this).parents('.gform_fields').find('.options').slideUp('fast');
			}
		}
	});
	
	// Shows the Email a friend popup on clicking the social share button
	$('#general-share li.email a').click(function() {
		$('#email-modal').modal('show');
		
		return false;
	});
	
	$('.close').click(function(){
		$('#email-modal').modal('hide');
	});	
	
	$(function() {
		// Set up an event listener for the contact form.
		$('#email-popup-form').submit(function(event) {
		    // Stop the browser from submitting the form.
		    event.preventDefault();
			// Serialize the form data.
			var formData = $(this).serialize();
			
			// Submit the form using AJAX.
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: formData
			})
			
			.done(function( response ) {
				// Make sure that the formMessages div has the 'success' class.
				dataLayer.push({'event': 'socialInt', 'socialNetwork': 'Email', 'socialAction': 'Share', 'socialTarget': window.location.href});
				$('.modal-title').text('Thank you');
				$('#email-popup-form').hide();
				//$('.form-message').fadeIn('fast');
				
				setTimeout(function() {
					$('#email-modal').modal('hide');
				}, 3000);
			})
			.fail(function( data ) {
				// Set the message text.
				if (data.responseText !== '') {
					$('.form-message .col-sm-12').text(data.responseText);
				} else {
					$('.form-message .col-sm-12').text('Oops! An error occured and your message could not be sent.');
				}
				
				$('#email-popup-form').hide();
				$('.form-message').fadeIn('fast');
				
				setTimeout(function() {
					$('#email-modal').modal('hide');
				}, 3000);
			});
		});
	});
	
	
	// This is a temporary fix as per Jason's feedback, ideally the HTML markup of the <div> will actually have to be re-written. 
	$('.raisebook-block').click(function() {
		window.open("https://raisebook.com/");
	});

	// remove alert classes when preview alert is closed
	$('.alert').on('closed.bs.alert', function () {
	  $('body').removeClass('with-alert');
	  $('body').find('.alert-row').remove();
	});
	
	$(window).scroll(function() {
		var height = $(window).scrollTop();
		var contentHeight = $('main').height();
		var bannerHeight = $('.banner').height();
		var sidebarHeight = $('.sidebar-fixed-container').height();
		var footerHeight = $('footer').height();
		var alertHeight = $('.alert-row').height();
		
		if( height < bannerHeight ) {
			$('.sidebar-fixed-container').removeClass('fixed-pos');
			$('.sidebar-fixed-container').removeClass('fixed-absolute');

		} else if( (height + sidebarHeight) >= (contentHeight) ) {
			$('.sidebar-fixed-container').addClass('fixed-absolute');
			$('.sidebar-fixed-container').removeClass('fixed-pos');
		}
		else {
			$('.sidebar-fixed-container').addClass('fixed-pos');
			$('.sidebar-fixed-container').removeClass('fixed-absolute');
		}

		if(height > 0) {
			$('header .logo').removeClass('hider');
			$('header .toggler').removeClass('hider');
			$('header').addClass('scrolled');

			if(height > bannerHeight) {
				//alert($('.banner').height());
				$('header').addClass('white');
			} else {
				$('header').removeClass('white');
			}
		} else {
			$('header').removeClass('scrolled');
		}
		
		if( (height + sidebarHeight + footerHeight + alertHeight - 150) > contentHeight ) {
			$('.responsive-share-buttons').fadeOut('fast');
		} else {
			$('.responsive-share-buttons').fadeIn('fast');
		}
	});
})( jQuery );