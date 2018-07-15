/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title and description changes.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' == to ) {
				if ( 'remove-header' == _wpCustomizeSettings.values.header_image )
					$( '.home-link' ).css( 'min-height', '0' );
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.home-link' ).css( 'min-height', '230px' );
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
} )( jQuery );


jQuery(document).ready(function($) {
		
	var editslides = $('.ibanner').data('edit-slides');

	if( $('.ibanner').length > 0 ) 	{
		$( '.ibanner .da-slider' ).after( '<div class="tx-slider-shortcut">'+editslides+'</div>' );	
	}
});


(function(wp,$,api){ 
	
	api.bind( 'preview-ready', function() {
		
		// Parallax 1 Customizer Edits
		$( '.titlebar' ).on( "click", ".editslider", function() {
			wp.customize.preview.send( 'expand-slider-options-panel' );			
		});											
						
		$( '.titlebar' ).on( "click", ".editeheader", function() {
			wp.customize.preview.send( 'expand-header-media-options-panel' );			
		});	
						
		$( '.headerinnerwrap' ).on( "click", ".nx-normal-logo", function() {
			wp.customize.preview.send( 'expand-title-tagline-options-panel' );			
		});	
						
		$( '.headerinnerwrap' ).on( "click", ".nx-trans-logo", function() {
			wp.customize.preview.send( 'expand-basic-options-panel' );			
		});							
						
		$( '.ibanner' ).on( "click", ".tx-slider-shortcut", function() {
			wp.customize.preview.send( 'expand-slides-options-panel' );			
		});			
			
	});



})(window.wp, jQuery, wp.customize);


