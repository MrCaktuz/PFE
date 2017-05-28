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

		// ******** Functions called on resize ********
		dropDownOnClick();
	} )

	// ******** Burger button ********
	$( '.mainNav__burgerButton' ).click( function( e ) {
		e.preventDefault();
		$(this).toggleClass('open');
		$(this).next().toggleClass('open');
	} );

	// ******** Dropdown management ********
	function dropDownOnClick() {
		if ( windowWidth < 980 ) {
			$( '.mainNav__dropdownButton' ).click( function( e ) {
				e.preventDefault();
				$(this).toggleClass('open');
				$(this).next().toggleClass('open');
			} );
		}
	}

	// ******** Functions called ********
	dropDownOnClick();
} );