jQuery(document).ready(function($){
    
    (function($) {
        "use strict"; 

			/*-----------------------------
			Wishlist
			-----------------------------*/
			var wow_themes = {			
					count: 0,
					wishlist: function(options, selector)
					{
						options.action = '_sh_ajax_callback';
						
						if( $(selector).data('_sh_add_to_wishlist') === true ){
							wow_themes.msg( 'You have already done this job', 'error' );
							return;
						}
						
						$(selector).data('_sh_add_to_wishlist', true );
						wow_themes.loading(true);
						
						$.ajax({
							url: ajaxurl,
							type: 'POST',
							data:options,
							dataType:"json",
							success: function(res){
								try{
									var newjason = res;
									if( newjason.code === 'fail'){
										$(selector).data('_sh_add_to_wishlist', false );
										wow_themes.loading(false);
										wow_themes.msg( newjason.msg, 'error' );
									}else if( newjason.code === 'exists'){
										$(selector).data('_sh_add_to_wishlist', true );
										wow_themes.loading(false);
										wow_themes.msg( newjason.msg, 'error' );
									}else if( newjason.code === 'success' ){
										wow_themes.loading(false);
										$(selector).data('_sh_add_to_wishlist', true );
										wow_themes.msg( newjason.msg, 'success' );
									}else if( newjason.code === 'del' ){
										wow_themes.loading(false);
										$(selector).data('_sh_add_to_wishlist', true );
										$(selector).parents('tbody').remove();
										wow_themes.msg( newjason.msg, 'success' );
									}
									
									
								}
								catch(e){
									wow_themes.loading(false);
									$(selector).data('_sh_add_to_wishlist', false );
									wow_themes.msg( 'There was an error while adding product to whishlist '+e.message, 'error' );
									
								}
							}
						});
					},
					loading: function( show ){
						if( $('.ajax-loading' ).length === 0 ) {
							$('body').append('<div class="ajax-loading" style="display:none;"></div>');
						}
						
						if( show === true ){
							$('.ajax-loading').show('slow');
						}
						if( show === false ){
							$('.ajax-loading').hide('slow');
						}
					},
					
					msg: function( msg, type ){
						if( $('#pop' ).length === 0 ) {
							$('body').append('<div style="display: none;" id="pop"><div class="pop"><div class="alert"><p></p></div></div></div>');
						}
						if( type === 'error' ) {
							type = 'danger';
						}
						var alert_type = 'alert-' + type;
						
						$('#pop > .pop p').html( msg );
						$('#pop > .pop > .alert').addClass(alert_type);
						
						$('#pop').slideDown('slow').delay(5000).fadeOut('slow', function(){
							$('#pop .pop .alert').removeClass(alert_type);
						});
						
						
					},
					
				};
			
			$('#_mail_to_friend').submit(function(e) {

				e.preventDefault();
				var thisform = this;
				//$('input[type=submit]', thisform).attr('disabled', 'disabled');
				var $mailid = $('input[name=friend_email]').val();
				var $message = $('textarea[name=friend_message]').val();
				var $_nonce = $(this).find('input[name="_wpnonce"]').val();
				var opt = {subaction:'mail_to_friend', friend_email:$mailid, friend_message: $message, nonce: $_nonce};
				wow_themes.wishlist( opt, this );
			});
			
			$('.add_to_wishlist, a[rel="product_del_wishlist"]').click(function(e) {
		
				e.preventDefault();
				
				if( $(this).attr('rel') === 'product_del_wishlist' ){
					if( confirm( 'Are you sure! you want to delete it' ) ){
						var opt = {subaction:'wishlist_del', data_id:$(this).attr('data-id')};
						wow_themes.wishlist( opt, this );
					}
				}else{
					var opt = {subaction:'wishlist', data_id:$(this).attr('data-id')};
					wow_themes.wishlist( opt, this );
				}
				
			});/**wishlist end*/
			
			$('.add_to_compare, a[rel="product_del_compare"]').click(function(e) {
		
				e.preventDefault();
				
				if( $(this).attr('rel') === 'product_del_compare' ){
					if( confirm( 'Are you sure! you want to delete it' ) ){
						var opt = {subaction:'compare_del', data_id:$(this).attr('data-id')};
						wow_themes.wishlist( opt, this );
					}
				}else{
					var opt = {subaction:'compare', data_id:$(this).attr('data-id')};
					wow_themes.wishlist( opt, this );
				}
				
			});/**wishlist end*/	
        
    /*------------------------------    
    NiceScroll
    ------------------------------*/
        $("html,.cartTable").niceScroll({
            cursorcolor: "#293133",
            cursorborderradius: "0",
            cursorborder: "0 solid #fff",
            cursorwidth: "10px",
            zindex: "999999",
            scrollspeed: 60
        });
        $('#mainNav').niceScroll({
            cursorcolor: "#293133",
            cursorborderradius: "0",
            cursorborder: "0 solid #fff",
            cursorwidth: "10px",
            zindex: "999999",
            scrollspeed: 60
        });
        
    /*------------------------------    
    Go Top
    ------------------------------*/
        $('a[href="#top"]').on('click', function () {
            $('html, body').animate({ scrollTop: 0 }, 800);
            return false
        });
        
    /*------------------------------    
    Shortcodes
    ------------------------------*/
        $('span[data-toggle="tooltip"]').tooltip();
        $('span[data-toggle="tooltip"][data-placement="top"]').tooltip('show');
        
    /*------------------------------    
    Search Filter
    ------------------------------*/
        $('.searchFilters .dropdown-menu').find('a').click(function(e) {
            e.preventDefault();
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();
            $('.searchFilters span#searchFilterValue').text(concept);
            $('.input-group #search_param').val(param)
        });
        
    /*------------------------------    
    Partner And Testimonial
    ------------------------------*/
        $('.ptTabNavs').on('click','.prevTab', function(){
          $('.ptTab_nav > .active').prev('li').find('a').trigger('click')
        });

        $('.ptTabNavs').on('click','.nextTab', function(){
          $('.ptTab_nav > .active').next('li').find('a').trigger('click')
        });
        
    /*------------------------------    
    Gallery Slider
    ------------------------------*/
        $('.featureCats').owlCarousel({
            loop:true,
            margin:0,
            responsiveClass:true,
            nav: true,
            navText: [ '<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>' ],
            autoplay: false,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:2,
                    nav:true
                },
                1000:{
                    items:4,
                    nav:true
                }
            }
        }); 
    
    /*----------------------------------------------------*/
    /*  Count Up
    /*----------------------------------------------------*/
    $('.counter').counterUp({
        delay: 15,
        time: 1500
    });    
    
    /*----------------------------------------------------*/
    /*  Spinner
    /*----------------------------------------------------*/
    $('.spinner .btn:first-of-type').on('click', function() {
        $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
    });
    $('.spinner .btn:last-of-type').on('click', function() {
        $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
    });
    
    /*----------------------------------------------------*/
    /*  Shipping Address
    /*----------------------------------------------------*/
    $('#shippingAddressEscape').on('click',function() {
        var isChecked = $('#shippingAddressEscape').is(':checked');
        if(isChecked)
            $("#shippingAddress").find(':input').attr('disabled', 'disabled');
        else 
            $("#shippingAddress").find(':input').removeAttr('disabled', 'disabled')
    });
        
    /*------------------------------    
    Team Member Slider
    ------------------------------*/
        $('.ourTeamSlide').owlCarousel({
            loop:true,
            margin:0,
            responsiveClass:true,
            nav: true,
            navText: [ '<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>' ],
            autoplay: true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:1,
                    nav:true
                },
                1000:{
                    items:2,
                    nav:true
                }
            }
        })
        
    })(jQuery)
});

jQuery(window).load(function($) {
    
	var $ = jQuery;
    /*------------------------------    
    Sinlge Prodcut Slider
    ------------------------------*/
    if( $('#productImageSliderNav').length ) {
		$('#productImageSliderNav').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			directionNav: true,
			slideshow: false,
			itemWidth: 130,
			itemMargin: 10,
			asNavFor: '#productImageSlider',
			prevText: '<i class="fa fa-angle-left"></i>',
			nextText: '<i class="fa fa-angle-right"></i>', 
		});
	}
	
	if( $('#productImageSlider').length ) {
		$('#productImageSlider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			directionNav: false,
			slideshow: false,
			sync: "#productImageSliderNav"
		});
	}

    /*------------------------------    
    Main Slider
    ------------------------------*/
	if( $('.sliderCont').length ) {
		$('.sliderCont').flexslider({
			animation: "fade",
			// Primary Controls
			controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
			prevText: '<i class="fa fa-angle-left"></i>',           //String: Set the text for the "previous" directionNav item
			nextText: '<i class="fa fa-angle-right"></i>',               //String: Set the text for the "next" directionNav item
		});
	}
    
	if( $('.sliderCont2').length ) {
		$('.sliderCont2').flexslider({
			animation: "fade",
			// Primary Controls
			controlNav: "thumbnails",       //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
			prevText: '<i class="fa fa-angle-left"></i>',           //String: Set the text for the "previous" directionNav item
			nextText: '<i class="fa fa-angle-right"></i>',               //String: Set the text for the "next" directionNav item
		});
	}
	
	
	$('#_search_terms > li > a').click(function(e) {
		e.preventDefault();
		var data_id = $(this).data('id');
		$('#search_product_cat').val(data_id);
	});
	
});





//-------------------------------------woocommerce quantity buutons-----------------------

jQuery(function($){
// Quantity buttons
	$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

        $( document ).on( 'click', '.plus, .minus', function() {

		// Get values
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event
		$qty.trigger( 'change' );
	});

});

//--------------------------------------woocommerce quantity buttons end.-----------------------------
/* ==========================================================================
   When document is ready, do
   ========================================================================== */
   
	jQuery(document).ready(function($) {			   
		
		$('#contactForm').submit(function(){

			var action = $(this).attr('action');
	
			$("#message").slideUp(750,function() {
			$('#message').hide();
	
			$('button#submit').attr('disabled','disabled');
			$('img.loader').css('visibility', 'visible');
	
			$.post(action, {
				contact_name: $('#contact_name').val(),
				contact_email: $('#contact_email').val(),
				contact_subject: $('#contact_subject').val(),
				contact_message: $('#contact_message').val(),
				verify: $('#verify').val()
			},
				function(data){
					document.getElementById('message').innerHTML = data;
					$('#message').slideDown('slow');
					$('#contactform img.loader').css('visibility', 'hidden' );
					
					$('#submit').removeAttr('disabled');
					if(data.match('success') != null) $('#contactform').slideUp('slow');
	
				}
			);

		});

		return false;

	});
		
	
		/*** dropBox functionality ***/
    
	var $user_controls = $('.searchSec .user-controls-bar > .dropBox');
	$('.cart-contents').on('click', function(e) {
		console.log('test');
		e.preventDefault();
		//$user_controls.removeClass('open');
		$user_controls.toggleClass('open');
	});


	$(document).keyup(function(e) {
        if (e.keyCode == 27) {
            $user_controls.removeClass('open');
        }
    });

	/*$('.dismiss-button').on('click', this, function(e) {
		$user_controls.removeClass('open');
		e.preventDefault();
	});
	
	$('.navbar-header').on('touchstart', 'button.navbar-toggle', function(){
     	$(this).trigger('click');
 	});	*/
});
