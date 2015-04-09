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
	<meta name="geo.region" content="US-IL" />
	<meta name="geo.placename" content="Wauconda" />
	<meta name="geo.position" content="42.27240, -88.14476" />
	<meta name="ICBM" content="42.27240, -88.14476" />
	<meta name="DC.publisher" content="POS Remarketing Group" />
	<meta name="DC.title" content="POS Remarketing Group" />
	<meta name="DC.identifier" content="http://www.posrg.com/" />
	<meta name="DC.language" content="en-US" scheme="rfc1766" />
	<meta name="DC.subject" content="Point of Sale Refurbishing" />
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
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
    <?php if ($app->input->get('option') == 'com_wanted' && $app->input->get('view') == 'manager'): ?>
    <script type="text/javascript">
    // <![CDATA[
        $(function() {
            var sortableList = $('#sortable');
            sortableList.sortable({
                cursor:"move",
                handle: 'td:first',
                update: function(event,ui) {
                    // Get the item ID's in an array
                    var cids = Array.prototype.map.call(
                        $('[name="cid"]'),
                        function (item) {
                            return item.value;
                        }
                    );

                    var ordering = Object.keys(cids);

                    $.ajax({
                        type: "POST",
                        url: "/index.php",
                        data: {
                            option: 'com_wanted',
                            task: 'saveOrderAjax',
                            tmpl: 'component',
                            cid: cids,
                            order: ordering
                        },
                        context: this,
                        success: function() {
                            $('#success-message').show().delay(1500).fadeOut(200);
                        }
                    })
                }
            });
            sortableList.disableSelection();
        });
    // ]]>
    </script>
    <?php endif; ?>
	<?php if (getenv('EE_ENV') === 'development') : ?>
	<meta name="robots" content="noindex,nofollow" />
	<?php endif; ?>
	<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?28HMYMeMVn2asz5zlB6L4jpFHKJGCfCN';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
</head>
<body class="<?php echo $body_class ." ". $pageclass; ?>">
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
	<jdoc:include type="modules" name="debug" style="blank"/>
</body>
</html>
