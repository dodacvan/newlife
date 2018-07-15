// JavaScript Document

(function($,api){ 
	
	wp.customize.bind('ready', function() {		
		
		//===========================================================================
		// Open slider panel 
		wp.customize.previewer.bind( 'expand-slider-options-panel', function(){
			wp.customize.section("blogpage").expand({ allowMultiple: false });
		});
		
		//===========================================================================
		// Open Header Media panel 
		wp.customize.previewer.bind( 'expand-header-media-options-panel', function(){
			wp.customize.section("header_image").expand({ allowMultiple: false });
		});	
		
		//===========================================================================
		// Open Header Media panel 
		wp.customize.previewer.bind( 'expand-title-tagline-options-panel', function(){
			wp.customize.control("custom_logo").focus();
		});	
		
		//===========================================================================
		// Open Header Media panel 
		wp.customize.previewer.bind( 'expand-basic-options-panel', function(){
			wp.customize.control("logo-trans").focus();
		});																																		
		
		//===========================================================================
		// Open Header Media panel 
		wp.customize.previewer.bind( 'expand-slides-options-panel', function(){
			wp.customize.panel("slider").expand({ allowMultiple: false });
		});	
		
				
	});		
	
})(jQuery, wp.customize);
