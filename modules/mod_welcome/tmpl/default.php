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
		<a href="/pos-repair-services"><img src="<?=$template_path?>/images/banner-repair.jpg" alt="POS Repair Services Quote" /></a>
		<a href="/about-us/posrg-news/174-2017-trade-show-schedule"><img src="<?php echo $template_path; ?>/images/nacs_show.jpg" alt="NACS Show" /></a>
		<a href="/about-us/posrg-news/168-posrg-r2-certified-for-responsible-electronics-recycling" style="display: none;"><img src="<?php echo $template_path; ?>/images/banner-responsible-recycling.jpg" alt="POSRG Certified for Responsible Electronics Recycling. Certification positions POSRG as leader in point of sale solutions industry." /></a>
		<a href="/about-us/posrg-news/166-posrg-naid-aaa-certified-for-data-destruction" style="display: none;"><img src="<?php echo $template_path; ?>/images/banner-naid.jpg" alt="POSRG NAID AAA Certified for Data Destruction" /></a>
		<a href="/preferred-oems" style="display: none;"><img src="<?php echo $template_path; ?>/images/banner-new-hardware.jpg" alt="New Hardware" /></a>
<!-- 		<a href="/inventory/search-our-inventory"><img src="<?php echo $template_path; ?>/images/banner-posrg.jpg" alt="Streamlined, organized and precise. That's POSRG." /></a> -->
		<a href="/product-info" style="display: none;"><img src="<?php echo $template_path; ?>/images/banner-brands.jpg" alt="All major brands - no major headaches." /></a>
<!-- 		<a href="/our-process/green-program"><img src="<?php echo $template_path; ?>/images/banner-green.jpg" alt="POSRG - Where &ldquo;green&rdquo; is a lifestyle." /></a>
		<a href="/our-process/quality-assurance"><img src="<?php echo $template_path; ?>/images/banner-advantage3.jpg" alt="Yes: real people actually pick up the phone." /></a> -->
	</div>
	<div class="slidenav"></div>
</div>