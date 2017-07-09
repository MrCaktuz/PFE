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
	$("nav:first").accessibleMegaMenu({
        /* prefix for generated unique id attributes, which are required to indicate aria-owns, aria-controls and aria-labelledby */
        uuidPrefix: "accessible-megamenu",
        /* css class used to define the megamenu styling */
        menuClass: "nav-menu-desktop",
        /* css class for a top-level navigation item in the megamenu */
        topNavItemClass: "nav-item",
        /* css class for a megamenu panel */
        panelClass: "sub-nav",
        /* css class for a group of items within a megamenu panel */
        panelGroupClass: "sub-nav-group",
        /* css class for the hover state */
        hoverClass: "hover",
        /* css class for the focus state */
        focusClass: "focus",
        /* css class for the open state */
        openClass: "open"
    });

} );