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

	// Slick Carousel
	var lgMin = 1200;
	var medMin = 992;
	var smallMin = 768;
	var mobileMin = 650;
	$('.logo-slider').slick({
		prevArrow: '<i class="logos-arrow logos-prev"></i>',
		nextArrow: '<i class="logos-arrow logos-next"></i>',
		lazyLoad: 'progressive',
		autoplay: true,
		autoplaySpeed: 3000,
		slidesToShow: 6,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: mobileMin,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			}
		]
	});

	// Add smooth scrolling to all links
	$(".marketing-pos-hero .btn-blue").on('click', function(event) {

	// Make sure this.hash has a value before overriding default behavior
	if (this.hash !== "") {
	  // Prevent default anchor click behavior
	  event.preventDefault();

	  // Store hash
	  var hash = this.hash;

	  // Using jQuery's animate() method to add smooth page scroll
	  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
	  $('html, body').animate({
	    scrollTop: $(hash).offset().top
	  }, 800, function(){

	    // Add hash (#) to URL when done scrolling (default click behavior)
	    window.location.hash = hash;
	  });
	} // End if
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




