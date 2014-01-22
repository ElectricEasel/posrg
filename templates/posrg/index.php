<?php defined( '_JEXEC' ) or die;

$app  = JFactory::getApplication();
$menu = $app->getMenu();
$tpath = $this->baseurl . '/templates/' . $this->template;

if ($app->input->get('option') !== 'com_product')
{
	$this->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
}

// $this JDocument
$this
	->addScript($tpath . '/js/chosen/chosen.jquery.min.js')
	->addScript($tpath . '/js/site.js')
	->addScriptDeclaration('
		// <![CDATA[
			jQuery(document).ready(function($){$(".chzn-select, #mfc").chosen({allow_single_deselect:true});});
		// ]]>
')
	->addStyleSheet($tpath . '/js/chosen/chosen.css')
	->addStyleSheet($tpath . '/css/style.css')
	->setTab("\t")
	->setBase(null)
	->setGenerator('Electric Easel, Inc.');

$body_class = 'page-' . $menu->getActive()->alias;
$is_home = false;
if ($menu->getActive() == $menu->getDefault())
{
	$body_class = "home";
	$is_home = true;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" >
<head>
<jdoc:include type="head" />
	<meta name="google-site-verification" content="sF65DH0a4wU2jqT9Vh3DIAWd88iaLg2-z8N4VqqYuHg" />
	<meta name="geo.region" content="US-IL" />
	<meta name="geo.placename" content="Wauconda" />
	<meta name="geo.position" content="42.27240, -88.14476" />
	<meta name="ICBM" content="42.27240, -88.14476" />
	<meta name="DC.publisher" content="POS Remarketing Group" />
	<meta name="DC.title" content="POS Remarketing Group" />
	<meta name="DC.identifier" content="http://www.posrg.com/" />
	<meta name="DC.language" content="en-US" scheme="rfc1766" />
	<meta name="DC.subject" content="Point of Sale Refurbishing" />
	<script type="text/javascript">
	// <![CDATA[
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-15339057-1']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	// ]]>
	</script>
	<?php if (getenv('EE_ENV') === 'development') : ?>
	<meta name="robots" content="noindex,nofollow" />
	<?php endif; ?>
</head>
<body class="<?php echo $body_class; ?>">
	<div id="header">
		<div class="wrap">
			<a href="/" id="logo"></a>
			<div class="header-right">
				<div class="header-contact">
					<span class="phone-number">
						<a class="recycle-button" href="http://www.turbongroup.com/posrg/" target="_blank">Recycle Toner Here</a>
						<span id="call"><b>Call Us Toll Free:</b></span>
						<span id="tel"><b>866-462-1005</b></span>
					</span>
				</div>
				<div id="top-nav">
					<jdoc:include type="modules" name="top-nav" />
				</div>
				<div id="secondary-nav">
					<jdoc:include type="modules" name="secondary-nav" />
				</div>
			</div>
			<div class="clear"></div>
			<div id="nav">
				<jdoc:include type="modules" name="nav" />
			</div>
		</div>
	</div>
	<div id="banner">
		<div class="dropshadow">
			<div class="wrap">
				<?php if($this->countModules('banner_index')): ?>
					<jdoc:include type="modules" name="banner_index"/>
				<?php endif; ?>
				<?php if($this->countModules('banner_page')): ?>
					<jdoc:include type="modules" name="banner_page"/>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="content">
		<div class="dropshadow">
			<div class="wrap">
				<div id="breadcrumbs">
					<jdoc:include type="modules" name="breadcrumb"/>
				</div>
          		<div id="message"><jdoc:include type="message" /></div>
				<jdoc:include type="modules" name="content-top" />
				<?php if($is_home): ?>
				<div class="search-wrap">
				<div class="home-inv-search">
					<jdoc:include type="modules" name="home-search" style="blank" />
					</div>
				</div>
				<div class="widget-area">
					<jdoc:include type="modules" name="home-content" style="home" />
				</div>
				<?php else: ?>
				<div id="main">
				<jdoc:include type="modules" name="interior-slider" style="blank" />
					<jdoc:include type="component" />

				</div>
				<div id="sidebar">
					<jdoc:include type="modules" name="left" style="widget" />
				</div>
				<?php endif; ?>
				<div id="bottom-widget">
					<jdoc:include type="modules" name="content-bottom" style="blank" />
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="wrap">
			<div class="col">
				<jdoc:include type="modules" name="footer-1" style="widget" />
			</div>
			<div class="col">
				<jdoc:include type="modules" name="footer-2" style="widget" />
			</div>
			<div class="col last">
				<jdoc:include type="modules" name="footer-4" style="widget" />
			</div>
			<div class="clear"></div>
		</div>
		<div class="bottom-nav">
			<div class="wrap">
				<a href="/privacy-policy">Privacy Policy</a> |
				&copy; <?php echo date('Y'); ?> POS Remarketing Group, Inc.
				<a class="ee" href="http://www.electriceasel.com" target="_blank">website design by electric easel</a>
			</div>
		</div>
	</div>
</body>
</html>
