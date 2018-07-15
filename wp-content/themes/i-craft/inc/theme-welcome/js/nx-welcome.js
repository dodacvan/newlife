jQuery(document).ready(function ($) {
    //$('body').on('click', ' .tx-install-plugin ', function () {
	$('.install-now').on('click', function (e) {	

        var installButton = $(this);
        e.preventDefault();
		
		if ($(installButton).length) {		
			
			var url = $(installButton).attr('href');
			var slug = $(this).attr('data-slug');
			var lebel = $(this).data('active-lebel');			
			
			if (typeof url !== 'undefined') {
                //Request plugin istallation.
                $.ajax({
                    beforeSend: function () {
                        $(installButton).replaceWith('<a class="button updating-message">' + lebel + '</a>');
                    },
                    async: true,
                    type: 'GET',
                    url: url,
                    success: function () {
                        //Reload the page.
                        location.reload();
                    }
                });
            }
		}
        return false;
    });

    $('.activate-now').on('click', function (e) {
		
        var activateButton = $(this);
        e.preventDefault();
        
		if ($(activateButton).length) {
			
            var url = $(activateButton).attr('href');
			var lebel = $(this).data('active-lebel');			
            
			if (typeof url !== 'undefined') {
                //Request plugin activation.
                $.ajax({
                    beforeSend: function () {
                        $(activateButton).replaceWith('<a class="button updating-message">' + lebel + '</a>');
                    },
                    async: true,
                    type: 'GET',
                    url: url,
                    success: function () {
                        //Reload the page.
                        location.reload();
                    }
                });
            }
        }
    });
});


/* insert variable after logo in customizer 
jQuery(document).ready(function($) {
	$( "#customize-info" ).after( recomended_not );
});
*/