/*
 *	Description:    Main script
 *	File:    		script.js
 *	Version:        1.0 - 07/05/2017
 *	Author :        Mucht - claessens.mathieu@gmail.com
*/

jQuery(document).ready(function($) {
	// ******** Global variables declaration ********
	var windowWidth = $( window ).width();

	// ******** Window resize ********
	$( window ).resize( function(){
		windowWidth = $( window ).width();
		responsiveNav(windowWidth);
		displayFilters(windowWidth);
	} );

	// ******** Burger button ********
	$('.burgerButton').click(function(e) {
		e.preventDefault();
		$(this).toggleClass('nav-open');
		$('body').toggleClass('nav-open');
		$(this).next().toggleClass('nav-open');
		$( 'body' ).click( function() {
            $('.nav-open').removeClass('nav-open');
          } );
         e.stopPropagation();
	} );

	// ******** Nav responsive ********
	function responsiveNav(width){
		$('.nav:first').removeClass('desktop').removeClass('mobile');
		$('.burgerButton').removeClass('desktop').removeClass('mobile');
		$('.nav-menu').removeClass('nav-menu-desktop');
		if (width >= 965) {
			$('.nav:first').addClass('desktop');
			$('.nav-menu').addClass('nav-menu-desktop');
		} else {
			$('.nav:first').addClass('mobile');
			$('.burgerButton').addClass('mobile');
		}
	} responsiveNav(windowWidth);

	// ******** Initialize accessibleMegaMenu ********
	$('nav:first').accessibleMegaMenu({
        // prefix for generated unique id attributes, which are required to indicate aria-owns, aria-controls and aria-labelledby
        uuidPrefix: 'accessible-megamenu',
        // css class used to define the megamenu styling
        menuClass: 'nav-menu-desktop',
        // css class for a top-level navigation item in the megamenu
        topNavItemClass: 'nav-item',
        // css class for a megamenu panel
        panelClass: 'sub-nav',
        // css class for a group of items within a megamenu panel
        panelGroupClass: 'sub-nav-group',
        // css class for the hover state
        hoverClass: 'hover',
        // css class for the focus state
        focusClass: 'focus',
        // css class for the open state
        openClass: 'open'
    });

	// ******** Google map ********
	if ($('body').hasClass('page-contact') || $('body').hasClass('page-complexe')) {
		function initialize() {
			$('.gmap').css( "height", "30rem" );
			$('.gmap-link').remove();
	        var myLatlng = new google.maps.LatLng(50.299342,5.098205),
	            centermap = new google.maps.LatLng(50.299942,5.098205),
	            mapOptions = {
	                zoom: 15,
	                center: centermap,
	                mapTypeControl: false,
	                disableDefaultUI: false,
	                scrollwheel : false,
	                streetViewControl : false,
	            },
	            map = new google.maps.Map(document.getElementById('gmap'), mapOptions),
	            marker = new google.maps.Marker({
	                position: myLatlng,
	                map: map,
	                icon: 'http://rbcciney.dev/img/icons/gmap-icon.png'
	            }),
	            infowindow = new google.maps.InfoWindow();

	        google.maps.event.addDomListener(window, 'resize', function() {
	            map.setCenter(centermap);
	        });
	        google.maps.event.addListener(map, 'idle', function(e) {
	            // Prevents card from being added more than once (i.e. when page is resized and google maps re-renders)
	            if ( $( ".place-card" ).length === 0 ) {
	                $(".gm-style").append('<div style="position: absolute; right: 0px; top: 0px;"> <div style="margin: 10px; padding: 1px; -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; border-radius: 2px; background-color: white;"> <div> <div class="place-card place-card-large"> <div class="place-desc-large"> <div class="place-name">RBC Ciney</div><div class="address">Rue Saint-Quentin 10, 5590 Ciney</div></div><div class="navigate"> <div class="navigate"> <a class="navigate-link" href="https://www.google.be/maps/dir//Rue+Saint-Quentin+10,+5590+Ciney/@50.2993422,5.0960162,17z/data=!4m16!1m7!3m6!1s0x47c1b9e9c372d78b:0x81fa797516745527!2sRue+Saint-Quentin+10,+5590+Ciney!3b1!8m2!3d50.2993422!4d5.0982049!4m7!1m0!1m5!1m1!1s0x47c1b9e9c372d78b:0x81fa797516745527!2m2!1d5.0982049!2d50.2993422" target="_blank"> <div class="icon navigate-icon"></div><div class="navigate-text"> Itinéraires </div></a> </div></div><div class="google-maps-link"> <a href="https://www.google.be/maps/place/Rue+Saint-Quentin+10,+5590+Ciney/@50.2993422,5.0960162,17z/data=!3m1!4b1!4m5!3m4!1s0x47c1b9e9c372d78b:0x81fa797516745527!8m2!3d50.2993422!4d5.0982049" target="_blank">Agrandir le plan</a> </div></div><div class="time-to-location-privacy-exp" style="display:none"> <div class="only-visible-to-you-exp"> Visible only to you. </div><a class="learn-more-exp" target="_blank">Learn more</a> </div></div></div></div></div>');
	            }
	        });
	    }
	    if(document.getElementById('gmap')){
	        google.maps.event.addDomListener(window, 'load', initialize);
	    }
	}
	
	// ******** Masonry ********
	if ($('body').hasClass('page-albums')) {
		// Remove default class if JS enable
		$('.album-wrap').removeClass('album-wrap');
		$('.album-photo').removeClass('album-photo');
		// Initiate Masonry
		$('.masonry').masonry({
			// Options
			itemSelector: '.masonry-item',
			percentPosition: true
		});
	}

	// ******** Slick (slider) ********
	if ($('body').hasClass('page-complexe') || $('body').hasClass('page-home')) {
		// Remove default class if JS enable
		$('.sponsor-wrap').removeClass('flex-wrap');
		$('.sponsor-wrap').removeClass('sponsor-wrap');
		$('.sponsor').removeClass('sponsor');
		$('.sponsor-img').removeClass('sponsor-img');
		$('.complexe-album-flex').removeClass('complexe-album-flex');
		// Initiate Slick for sponsors
		$('.sponsor-slider').slick({
			dots: false,
			centerMode: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 3000,
			responsive: [
				{
					breakpoint: 640,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1
					}
				}
			]
		});
		// Initiate Slick for complexe
		$('.complexe-slider').slick({
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 1,
			centerMode: true,
			variableWidth: true
		});
	}

	// ******** Navigation interne ********
	if ($('.page-regles')) {
		function currentNavbarPosition(el){
	        var y = $(window).scrollTop(), // Position of the scroll
		        avp = el.parent().offset().top, // Vertical position of the element container
		        ah = el.parent().height(), // Height of element container
		        navh = el.height(); // Height of navbar container
	        if(y >= avp - 20 ) {
	        	// if scroll position reach the end of the container with the element height as offset
	            if(y > (avp + ah - navh - elTop - 20 )) {
	                el.removeClass('fix-aside');
	                el.addClass('fix-aside-bottom');
	                el.css('top', (ah - navh + 45)+'px');
	            } else {
	                el.addClass('fix-aside');
	                el.removeClass('fix-aside-bottom');
	                el.css('top','');
	            }
	        } else {
	            el.removeClass('fix-aside');
	        };
	    }

	    function navbarScroll(el) {
	        el = $(el);
	        elTop = el.position().top;
	        currentNavbarPosition(el);
	        $(window).resize(function () {
	            currentNavbarPosition(el);
	        });
	        $(window).scroll(function () {
	            currentNavbarPosition(el);
	        });
	    }

	    if(document.querySelector('.inner-nav')){
	        navbarScroll('.inner-nav');

	        var $root = $('html, body'),
	            pageHeight = $( window ).innerHeight(),
	            maxHeightValue = pageHeight - 160,
	            maxHeightString = 'max-height: ' + maxHeightValue + 'px';

	        $( '.inner-nav-list' ).attr( 'style', maxHeightString );

	        $( window ).resize( function(){
	            pageHeight = $( window ).innerHeight(),
	            maxHeightValue = pageHeight - 160,
	            maxHeightString = 'max-height: ' + maxHeightValue + 'px';
	            $( '.inner-nav-list' ).attr( 'style', maxHeightString );
	        } );

	        // Update class active on scroll
	        var aSectionID = [];
	        	// get sections ID
	        $( '.inner-nav-link' ).each( function(){
	            var iSectionID = $( this ).attr( 'href' ).replace( '#', '' );
	            aSectionID.push( iSectionID );
	        } );
	        for (var i = 0; i < aSectionID.length; i++) {
	            var iOffset = 0;
	            	iOffsetDown = 100,
	                iOffsetUp = $( '#' + aSectionID[i] ).outerHeight()*-0.5;
	          	// Update class active on the way down
	            waypoint = new Waypoint({
	                element: document.getElementById( aSectionID[i] ),
	                handler: function( direction ) {
	                	var test =  '.link-' + this.element.id;
                        $('.inner-nav-link-active').removeClass( 'inner-nav-link-active' );
                        $( test ).addClass( 'inner-nav-link-active' );
	                    if (direction == 'down') {
	                        iOffset = iOffsetDown;
	                    } else if (direction == 'up') {
	                        iOffset = iOffsetUp;
	                    }
	                },
	                offset: iOffset
	            });
	        }

	        //Add active class on click
	        $( '.inner-nav-link' ).click( function(){
	            $( '.inner-nav-link' ).removeClass( 'inner-nav-link-active' )
	            $( this ).addClass( 'inner-nav-link-active' );
	        } );

	        // Smooth scroll
	        $('.inner-nav-link').click(function() {
	            var href = $.attr(this, 'href');
	            $root.stop().animate({ scrollTop: $(href).offset().top
	            }, 500, function () {
	                window.location.hash = href;
	            });
	            return false;
	        });
	    }
	}

	// ******** Update "show more" buttons ********
    if ( $( 'body' ).hasClass( 'page-home' ) || $( 'body' ).hasClass( 'page-calendrier' ) || $( 'body' ).hasClass( 'page-equipes' ) ) {
    	$(".gameCard-wrap a[rel='next']").html('Match suivant').addClass('button button-more button-more-next');
    	$(".gameCard-wrap a[rel='prev']").html('Match précédent').addClass('button button-more button-more-prev');
    	$(".resultCard-wrap a[rel='prev']").html('Résultat plus récent').addClass('button button-more button-more-prev');
        $(".resultCard-wrap a[rel='next']").html('Anciens résultats').addClass('button button-more button-more-next');
	}

	// ******** Calendar ********
    $('#mycalendar').monthly({
    	mode: 'picker',
    	weekStart: 'Mon',
    	disablePast: true,
    	stylePast: true
    });

    // ******** filters ********
    function displayFilters(width){
    	if (width >= 965) {
	    	$('.filters').show();
	    	$('.filters-target').css('width', 'calc(100% - 30rem)').css('min-height', '75rem');
	    } else {
	    	$('.filters').hide();
	    }
    } displayFilters(windowWidth);
} );