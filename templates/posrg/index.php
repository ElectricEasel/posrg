<?php defined( '_JEXEC' ) or die;

$app  = JFactory::getApplication();
$menu = $app->getMenu();
$tpath = $this->baseurl . '/templates/' . $this->template;

// $this JDocument
$this
	->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js')
	->addScript($tpath . '/js/jquery.fancybox.min.js')
	->addScript($tpath . '/js/jquery.fancybox-media.js')
	->addScript($tpath . '/js/chosen/chosen.jquery.min.js')
	->addScript($tpath . '/js/jquery.accordion.js')
	->addScript($tpath . '/js/site.js')
    ->addStyleSheet('http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css')
	->addScriptDeclaration('
		// <![CDATA[
			jQuery(document).ready(function($){$(".chzn-select, #mfc").chosen({allow_single_deselect:true});});
		// ]]>
')
	->addStyleSheet($tpath . '/js/chosen/chosen.css')
	->addStyleSheet($tpath . '/css/jquery.fancybox.css')
	->addStyleSheet($tpath . '/css/style.css')
	->setTab("\t")
	->setBase(null)
	->setGenerator('Electric Easel, Inc.');

$is_wordpress = $menu->getActive()->component;
$body_class = 'page-' . $menu->getActive()->alias;
$is_home = false;
if ($menu->getActive() == $menu->getDefault())
{
	$body_class = "home";
	$is_home = true;
}


$menu_active = $app->getMenu()->getActive();
$pageclass = '';

if (is_object($menu_active))
$pageclass = $menu_active->params->get('pageclass_sfx');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" >
<head>
<jdoc:include type="head" />
	<meta name="google-site-verification" content="sF65DH0a4wU2jqT9Vh3DIAWd88iaLg2-z8N4VqqYuHg" />
	<meta name="msvalidate.01" content="9DEB2B56752FB6326BEC00315BEBD3B9" />
	<meta name="geo.region" content="US-IL" />
	<meta name="geo.placename" content="Wauconda" />
	<meta name="geo.position" content="42.27240, -88.14476" />
	<meta name="ICBM" content="42.27240, -88.14476" />
	<meta name="DC.publisher" content="POS Remarketing Group" />
	<meta name="DC.title" content="POS Remarketing Group" />
	<meta name="DC.identifier" content="http://www.posrg.com/" />
	<meta name="DC.language" content="en-US" scheme="rfc1766" />
	<meta name="DC.subject" content="Point of Sale Refurbishing" />
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />
    <link href="https://plus.google.com/u/0/115660277677228108714" rel="publisher" />
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
<body class="<?php echo $body_class ." ". $pageclass; ?>">
	<div id="header">
		<div class="wrap">
			<a href="/" id="logo"></a>
			<div class="sell-pos-header">
				<a class="sell-pos-button" href="sell-used-pos-systems">Sell Your Used POS &raquo;<img src="/templates/posrg/images/dollar-sign.png"></a>
				<img src="/templates/posrg/images/sell-home-header.png" class="sell-home-header">
			</div>
			<div class="header-right">
				<div class="header-contact">
					<span class="phone-number">
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
				<?php if (!$is_wordpress): ?>
				<div id="sidebar">
					<jdoc:include type="modules" name="left" style="widget" />
				</div>
				<?php endif; ?>
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
	<jdoc:include type="modules" name="debug" style="blank"/>
	<script type="text/javascript">
	var cloak = jQuery('.cloak');
	cloak.each(function(){
		var email = jQuery(this).attr('href').replace("_AT_", "@");
		jQuery(this).attr('href',email);
	});
	</script>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58331dfb2bd2e0ea"></script> 
		<!-- begin olark code -->
	<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
	f[z]=function(){
	(a.s=a.s||[]).push(arguments)};var a=f[z]._={
	},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
	f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
	0:+new Date};a.P=function(u){
	a.p[u]=new Date-a.p[0]};function s(){
	a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
	hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
	return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
	b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
	b.contentWindow[g].open()}catch(w){
	c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
	var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
	b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
	loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('9700-951-10-2803');/*]]>*/</script><noscript><a href="https://www.olark.com/site/9700-951-10-2803/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
	<!-- end olark code -->
</body>
</html>