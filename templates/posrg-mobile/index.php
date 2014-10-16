<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.beez_20
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

JHtml::_('behavior.framework', true);

define('TEMPLATE_PATH', "/templates/{$this->template}/");
define('CSS_PATH', TEMPLATE_PATH.'css/');
define('IMG_PATH', TEMPLATE_PATH.'images/');
define('JS_PATH', TEMPLATE_PATH.'js/');

JFactory::getDocument()
	// add stylesheets
	//->addStyleSheet('//fonts.googleapis.com/css?family=Open+Sans:400,300,600')
	->addStyleSheet('/templates/system/css/system.css')
	->addStyleSheet(CSS_PATH.'general.css')
	->addStyleSheet(CSS_PATH.'mobile.css')
	// add scripts
	->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js')
	//->addScript(JS_PATH.'jquery.cycle.all.latest.min.js')
	->addScript(JS_PATH.'jquery.touchwipe.min.js')
	->addScript(JS_PATH.'mobile.js')
	->addScriptDeclaration('
	// <![CDATA[
	jQuery.noConflict();
	window.addEventListener("load", function(){
		setTimeout(function(){
			window.scrollTo(0,1);
		}, 0);
	});
	// ]]>
	')
	->setTab("\t");

// set bodyClasses
$bodyClasses = array();
$parts = explode('/', JUri::getInstance()->toString(array('path')));
foreach ($parts as $part) {
	if (empty($part)) continue;
	$bodyClasses[] = strtolower(str_replace(array('-', '_'), '-', $part));
}

$is_home = false;
$app = JFactory::getApplication();
$menu = $app->getMenu();
if ($menu->getActive() == $menu->getDefault()) {
   $bodyClasses[] = 'home';
   $is_home = true;
}

$bodyClasses[] = $menu->getActive()->alias . '-page';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<jdoc:include type="head" />
    <link rel="shortcut icon" href="/favicon.png" type="image/png" />
    <meta name="robots" content="index,follow" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <script type="text/javascript">
    // <![CDATA[
    (function(document,navigator,standalone) {
	    // prevents links from apps from oppening in mobile safari
	    // this javascript must be the first script in your <head>
	    if ((standalone in navigator) && navigator[standalone]) {
	        var curnode, location=document.location, stop=/^(a|html)$/i;
	        document.addEventListener('click', function(e) {
	            curnode=e.target;
	            while (!(stop).test(curnode.nodeName)) {
	                curnode=curnode.parentNode;
	            }
	            // Condidions to do this only on links to your own app
	            // if you want all links, use if('href' in curnode) instead.
	            if('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) ) ) {
	                e.preventDefault();
	                location.href = curnode.href;
	            }
	        },false);
	    }
	})(document,window.navigator,'standalone');
	// ]]>
    </script>
	<!--[if gte IE 9]>
	  <style type="text/css">
	    .gradient {
	       filter: none;
	    }
	  </style>
	<![endif]-->
</head>
<body class="<?php echo implode(' ', $bodyClasses); ?>">
	<div id="container">
				<div id="nav" class="blue-gradient2">
					<div class="wrap">
						<ul class="clr">
							<li class="menu-button active"><a href="javascript:toggleMenu();">Menu</a></li>
							<li class="menu-button"><a href="/services">Services</a></li>
							<li class="menu-button"><a href="">Products</a></li>
							<li class="menu-button"><a href="/inventory/search-our-inventory">Buy</a></li>
							<li class="menu-button"><a href="/online-asset-appraisal">Sell</a></li>
						</ul>
					</div>
				</div>
				<div id="menu">
						<jdoc:include type="modules" name="mobile-nav" />
				</div>
				<div id="banner">
					<div id="banner-contain">
						<img src="/templates/posrg-mobile/images/header.png" alt="POSRG"/>
					</div>
				</div>
				<?php if (!$is_home) : ?>
				<div id="sub-head">
					<div class="wrap">
						<jdoc:include type="modules" name="sub-head" />
					</div>
				</div>
				<?php endif; ?>
			<div id="main">
				<div class="wrap">
					<?php if ($is_home) : ?>
						<ul class="home-buttons">
							<li class="blue-gradient" onclick="location.href='/inventory/search-our-inventory/'">
								<span class="icon search"></span>
								<h3><a href="/inventory/search-our-inventory">Search Our Inventory</a></h3>
								<p>Low cost point-of-sale hardware solutions</p>
							</li>
							<li class="blue-gradient" onclick="location.href='/services'">
								<span class="icon services"></span>
								<h3><a href="/services">POS Services</a></h3>
								<p>Streamlined, organized and precise. That's POSRG.</p>
							</li>
							<li class="blue-gradient" onclick="location.href='/online-asset-appraisal'">
								<span class="icon sell"></span>
								<h3><a href="/online-asset-appraisal">Sell Your Used POS</a></h3>
								<p>Asset appraisals for used POS and barcode hardware.</p>
							</li>
							<li class="blue-gradient" onclick="location.href='/product-info'">
								<span class="icon info"></span>
								<h3><a href="/product-info">POS Product Information</a></h3>
								<p>POSRG partners with major brands for dedicated support.</p>
							</li>
						</ul>
					<?php else: ?>
					<jdoc:include type="message" />
					<jdoc:include type="modules" name="mobile-info-search" />
					<jdoc:include type="component" />
					<?php endif; ?>
				</div>
			</div>
			<div id="footer" class="blue-gradient">
				<div class="wrap">
					<ul id="footer-social">
						<li>
							<a class="fb" href="https://www.facebook.com/posrg"></a>
						</li>
						<li>
							<a class="twitter" href="http://www.twitter.com/posremarket"></a>
						</li>
						<li>
							<a class="email" href="mailto:ktesta@posrg.com"></a>
						</li>
					</ul>
					<a class="footer-phone" href="tel://1-866-462-1005">1-866-462-1005</a>
					<span class="address">POS Remarketing Group, Inc.<br/>
					1059 N. Old Rand Road,<br/>
					Wauconda, IL 60084
					</span>
				</div>
			</div>
			<div id="sub-footer">
				<div class="wrap">
					<span class="copyright">&copy; <?php echo date('Y');?> POS Remarketing Group, Inc.</span>
					<a href="/privacy-policy">Privacy Policy</a>
				</div>
			</div>
		</div>
<div id="preloadImages"></div>
</body>
</html>