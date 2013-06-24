jQuery(document).ready(function($){
	var catlist_uls = '#catlist .level1';
	if($('#catlist .level2').length > 1)
	{
		var catlist_uls = '#catlist';
	}
	$(catlist_uls).find('ul').each(function(index, e){
		$(e).children('ul li').has('ul').not('#catlist > .level1 > li').prepend('<span class="toggle closed"></span>').children('ul').hide();
	});
	
	var loc = location.pathname;
	if(!loc.match(/category/))
	{
		var loc = $('.pos-meta .element-itemcategory a').attr('href');
	}
	
	$('#catlist a[href="' + loc + '"]').each(function(){
		if($(this).siblings('.toggle').length > 0 )
		{
			$(this).siblings('.toggle').removeClass('closed').addClass('open');
			$(this).siblings('ul').slideDown(300);
		}
		else
		{
			$(this).parents('ul').siblings('.toggle').removeClass('closed').addClass('open');
			$(this).parents('ul').slideDown(300);
		}
	});
	
	$('#catlist .toggle').click(function(){
		if($(this).hasClass('closed'))
		{
			$(this).removeClass('closed').addClass('open');
			$(this).siblings('ul').slideDown(300);
		}
		else
		{
			$(this).removeClass('open').addClass('closed');
			$(this).siblings('ul').slideUp(300);
		}
	});
});