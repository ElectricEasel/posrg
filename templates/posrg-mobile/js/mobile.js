jQuery.noConflict();
jQuery(document).ready(function ($){	 
    // Menu behaviour
    $("#menu .menu li a").click(function () {
        var p = $(this).parent();
        if ($(p).hasClass('active')) {
            $("#menu li").removeClass('active');
        } else {
            $("#menu li").removeClass('active');
            $(p).addClass('active');
        }
    });
    
	$(".slidingDiv").hide();
	$(".show_hide").show().addClass("block");
	
	$('.show_hide').toggle(function(){
	   $(".slidingDiv").slideDown(
	     function(){
	       $("#plus").html("Show Less <span>&#8593;</span>")
	     }
	   );
	},function(){
	   $(".slidingDiv").slideUp(
	   function(){
	       $("#plus").html("Show More <span>&#8595;</span>")
	   }
	   );
	});
    $('body.category #yoo-zoo .items').before('<p class="table-msg">&#8592; Scroll to see all &#8594;</p>');
    
    
    $(".service-box dt").click(function() {
	if ( jQuery(this).hasClass("minus") ) {
		jQuery(this).removeClass("minus");
   		jQuery(this).parent().children("dd").removeClass("show").addClass("hide");
	}
	else{
		jQuery(this).addClass("minus");
   		jQuery(this).parent().children("dd").removeClass("hide").addClass("show");
	}
	});
	var slide_container = $('#slides');
	if(slide_container.length > 0)
	{
		slide_container.cycle({
			timeout: 4000,
			pager: '#slidenav'
		});
	}
	var community_slide = $(".community-right #gallery_images");
	if (community_slide.length > 0)
	{
		community_slide.cycle({
			timeout: 4000
		});
	}
	var from_mobile = $("#from_mobile");
	if (from_mobile.length > 0)
	{
		from_mobile.val("true");
	}
	var rvpage = $('body.findanrvresort #main .item-page');
	if (rvpage.length > 0)
	{
		var rvtitle = document.createElement('h2');
		rvtitle.innerHTML = "Find an RV Resort";
		rvpage.prepend(rvtitle);
	}
	$('.menu-toggle').click(function(){
		var menu = jQuery("#menu-blog-categories");
		if ($(this).hasClass('toggled-on'))
		{
			menu.slideUp(300);
		}
		else
		{
			menu.slideDown(300);
		}
	});
});
var toggleMenu = function()
{
    var menu = jQuery("#menu ul.menu");
    if (menu.is(':visible'))
    {
    	menu.slideUp(300);
    }
    else
    {
    	menu.slideDown(300);
    }
}