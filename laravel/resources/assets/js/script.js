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
		if (width >= 980) {
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
	
	// ******** Masonry ********
		// Remove default class if JS enable
	$('.album-wrap').removeClass('album-wrap');
	$('.album-photo').removeClass('album-photo');
		// Initiate Masonry
	$('.masonry').masonry({
		// Options
		itemSelector: '.masonry-item',
		percentPosition: true
	});
} );