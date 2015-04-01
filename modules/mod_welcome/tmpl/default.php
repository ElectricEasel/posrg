<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$template_path = '/templates/posrg';
?>
<div id="slider">
	<script type="text/javascript" src="<?php echo $template_path; ?>/js/jquery.cycle.js"></script>
	<script type="text/javascript">
	// <![CDATA[
		jQuery(document).ready(function($){
			$('#slider .slides').cycle({
				timeout:	5000,
				pager:		'#slider .slidenav',
				pause: 1,
				pagerAnchorBuilder:	function()
				{
					return '<span></span>';
				}
			});
		});
	// ]]>
	</script>
	<div class="slides">
		<a href="/preferred-oems"><img src="<?php echo $template_path; ?>/images/banner-new-hardware.jpg" alt="New Hardware" /></a>
		<a href="/about-us/posrg-news"><img src="<?php echo $template_path; ?>/images/banner-news1.jpg" alt="POSRG News" /></a>
		<a href="/inventory/search-our-inventory"><img src="<?php echo $template_path; ?>/images/banner-posrg.jpg" alt="Streamlined, organized and precise. That's POSRG." /></a>
		<a href="/product-info"><img src="<?php echo $template_path; ?>/images/banner-brands.jpg" alt="All major brands - no major headaches." /></a>
		<a href="/our-process/green-program"><img src="<?php echo $template_path; ?>/images/banner-green.jpg" alt="POSRG - Where &ldquo;green&rdquo; is a lifestyle." /></a>
		<a href="/our-process/quality-assurance"><img src="<?php echo $template_path; ?>/images/banner-advantage3.jpg" alt="Yes: real people actually pick up the phone." /></a>
	</div>
	<div class="slidenav"></div>
</div>