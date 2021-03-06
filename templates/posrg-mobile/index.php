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

unset($this->_scripts[JURI::root(true).'/media/system/js/caption.js']);
unset($this->_scripts[JURI::root(true).'/media/system/js/mootools-core.js']);
unset($this->_scripts[JURI::root(true).'/media/system/js/mootools-more.js']);

JFactory::getDocument()
	// add stylesheets
	//->addStyleSheet('//fonts.googleapis.com/css?family=Open+Sans:400,300,600')
	->addStyleSheet('/templates/system/css/system.css')
	->addStyleSheet(CSS_PATH.'general.css')
	->addStyleSheet(CSS_PATH.'slick.css')
	->addStyleSheet(CSS_PATH.'mobile.css')
	// add scripts
	->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js')
	//->addScript(JS_PATH.'jquery.cycle.all.latest.min.js')
	->addScript(JS_PATH.'jquery.touchwipe.min.js')
	->addScript(JS_PATH.'mobile.js')
	->addScript(JS_PATH.'slick.min.js')
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

$bodyClasses[] = $menu->getActive()->alias . '-page';

if ($menu->getActive() == $menu->getDefault()) {
   $bodyClasses = 'home';
   $is_home = true;
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<jdoc:include type="head" />
    <link rel="shortcut icon" href="/favicon.png" type="image/png" />
    <meta name="robots" content="index,follow" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <meta name="msvalidate.01" content="9DEB2B56752FB6326BEC00315BEBD3B9" />
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
<body class="<?php echo implode(' ', $bodyClasses); ?> mobile">
	<div id="container">
		<jdoc:include type="modules" name="mobile-menu-buttons" />
			<div id="menu">
				<jdoc:include type="modules" name="mobile-nav" />
			</div>
			<?php if($this->countModules('mobile-banner')): ?>
				<jdoc:include type="modules" name="mobile-banner" />
			<?php endif; ?>
		<div id="main">
			<div class="wrap">
				<?php if ($is_home) : ?>
					<jdoc:include type="modules" name="mobile-home-modules" />
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
	<script type="text/javascript">
	var cloak = jQuery('.cloak');
	cloak.each(function(){
		var email = jQuery(this).attr('href').replace("_AT_", "@");
		jQuery(this).attr('href',email);
	});
	</script>
	<jdoc:include type="modules" name="debug" style="blank"/>
</body>
</html>