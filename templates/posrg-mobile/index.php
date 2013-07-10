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
	->addStyleSheet('//fonts.googleapis.com/css?family=Open+Sans:400,300,60|Droid+Sans:400,700|Arvo:400,700')
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
$menu = JSite::getMenu();
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
				<div id="nav">
					<div class="wrap">
						<ul class="clr">
							<li class="menu-button"><a href="javascript:toggleMenu();">Menu</a></li>
							<li class="menu-button"><a href="javascript:toggleMenu();">Services</a></li>
							<li class="menu-button"><a href="javascript:toggleMenu();">Products</a></li>
							<li class="menu-button"><a href="javascript:toggleMenu();">Buy</a></li>
							<li class="menu-button"><a href="javascript:toggleMenu();">Sell</a></li>
						</ul>
					</div>
					<div id="menu">
						<jdoc:include type="modules" name="mobile-nav" />
				</div>
				</div>		
				<div id="banner">
					<jdoc:include type="modules" name="mobile-header" />
				</div>
			<div id="main">
				<div class="wrap">
					<?php if ($is_home) : ?>
						<ul class="home-buttons">
							<li class="blue-gradient">
								<h3>Search Our Inventory</h3>
								<p>Low cost point-of-sale hardware solutions</p>
							</li>
							<li class="blue-gradient">
								<h3>POS Services</h3>
								<p>Streamlined, organized and precise. That's POSRG.</p>
							</li>
							<li class="blue-gradient">
								<h3>Sell Your Used POS</h3>
								<p>Asset appraisals for used POS and barcode hardware.</p>
							</li>
							<li class="blue-gradient">
								<h3>POS Product Information</h3>
								<p>POSRG partners with major brands for dedicated support.</p>
							</li>
						</ul>
					<?php else: ?>
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<?php endif; ?>
				</div>
			</div>
			<div id="footer">
				<div class="wrap">
				</div>
			</div>
		</div>
	</div>
</body>
</html>