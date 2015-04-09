jQuery.noConflict();
jQuery(document).ready(function($){

	// SearchForm (sf) functions
	if(1==0)
	{
		var sf			= jQuery('form.search');
		var sf_btn		= sf.find('.button');
		var sf_text		= sf.find('[name=searchword]');
		var sf_width	= 15;
		var sf_oldwidth	= sf.width();
		var sf_defval	= 'Search';

		sf.width(sf_width);
		sf_btn.click(function(e){
			if(sf.width() == sf_width)
			{
				e.preventDefault();
				sf.animate({width: sf_oldwidth});
				sf_text.select();
			}
		});
		sf_text.blur(function(){
			if(sf_text.val() == '' || sf_text.val() == sf_defval)
			{
				sf.animate({width: sf_width});
			}
		});
	}

	$('.fancybox').fancybox();

	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});

	$('.default-value').each(function() {
	    var default_value = this.value;
	    $(this).focus(function() {
	        if(this.value == default_value) {
	            this.value = '';
	        }
	    });
	    $(this).blur(function() {
	        if(this.value == '') {
	            this.value = default_value;
	        }
	    });
	});
	$('[data-accordion]').accordion();

});




