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
		<a href="/services/data-destruction"><img src="<?php echo $template_path; ?>/images/banner-naid.jpg" alt="POSRG NAID AAA Certified for Data Destruction" /></a>
		<a href="/pos-repair-services" style="display: none;"><img src="<?=$template_path?>/images/banner-repair.jpg" alt="POS Repair Services Quote" /></a>
		<a href="/about-us/posrg-news/168-posrg-r2-certified-for-responsible-electronics-recycling" style="display: none;"><img src="<?php echo $template_path; ?>/images/banner-responsible-recycling.jpg" alt="POSRG Certified for Responsible Electronics Recycling. Certification positions POSRG as leader in point of sale solutions industry." /></a>
		<a href="/preferred-oems" style="display: none;"><img src="<?php echo $template_path; ?>/images/banner-new-hardware.jpg" alt="New Hardware" /></a>
		<a href="/product-info" style="display: none;"><img src="<?php echo $template_path; ?>/images/banner-brands.jpg" alt="All major brands - no major headaches." /></a>
	</div>
	<div class="slidenav"></div>
</div>