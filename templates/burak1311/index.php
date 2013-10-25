<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$this->_generator = 'Electric Easel, Inc.';
$headerstuff =& $this->getHeadData();
unset($headerstuff['scripts']['/media/system/js/caption.js']);
$this->setHeadData($headerstuff);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="/templates/burak1311/css/combined.css" type="text/css" />
<meta name="google-site-verification" content="pYFdCRTjLsLPQm2w_f89yPTZ4Dna1t7HrS1ypsVf_5c" />
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
</head>
<body>
	<?php if($this->countModules('absolute')) : ?>
	<div id="absolute">
		<jdoc:include type="modules" name="absolute" />
	</div>
	<?php endif; ?>
<div id="wrapper">
  <div class="wrapper-top"></div>
  <div class="wrapper-center">
	<div id="header">
	  <div class="logo">
	  	<jdoc:include type="modules" name="logo"/>
	  </div>
      <div class="header-right">
        <div class="contact-phone">
          <jdoc:include type="modules" name="user5" />
        </div>
		<div id="top-menu">
			<div class="top-menu-left"></div>
			<div id="menu" class="top-menu-center">
				<div id="horiz-menu" class="nav">
					<jdoc:include type="modules" name="user3" />
				</div>
			</div>
			<div class="top-menu-right"></div>
		</div>
      </div>
    </div>
	<?php if($this->countModules('banner_index')){?>
	<div class="welcome-module">
		<jdoc:include type="modules" name="banner_index"/>
	</div>
	<?php }?>
	<?php if($this->countModules('banner_page')){?>
	<div class="welcome-module2">
		<jdoc:include type="modules" name="banner_page"/>
	</div>
	<?php }?>
    <div id="main">
      <?php if( JRequest::getVar('view') == 'frontpage') {?>
	  <div class="main-top"></div>
	  <?php }else{?>
	  <div class="main-top2"></div>
	  <?php }?>
      <div id="main-center">
        <div class="main-container">
          <?php if($this->countModules('left')): ?>
          <div id="left_column">
            <jdoc:include type="modules" name="topleft" style="rounded_grey"/>
            <jdoc:include type="modules" name="left" style="menu_rounded"/>
          </div>
          <div id="main-right">
            <?php else: ?>
            <div id="main-right-full">
              <?php endif; ?>
			  <?php if($this->countModules('breadcrumb')){ ?>
              <div id="breadcrumb">
			  	<jdoc:include type="modules" name="breadcrumb"/>
			  </div>
			  <?php }?>
			  <div id="user1">
                <jdoc:include type="modules" name="user1" style="xhtml" />
              </div>
              <div id="component">
              	<div id="message"><jdoc:include type="message" /></div>
                <jdoc:include type="component" />
              </div>
            </div>
            <div class="logo-support">
              <div class="logo-support-header"></div>
             <jdoc:include type="modules" name="user8" />
            </div>
          </div>
        </div>
        <div class="main-footer"></div>
      </div>
    </div>
    <div id="footer">
     	<jdoc:include type="modules" name="footer" style="xhtml" />
    </div>
  </div>
<jdoc:include type="modules" name="debug" />
<div id="chat_tracking" style="display:none"></div>
<script type="text/javascript">
// <![CDATA[
var script = document.createElement("script");
script.type="text/javascript";
var src = "http://chat.posrg.com/server.php?request=track&output=jcrpt&nse="+Math.random();setTimeout("script.src=src;document.getElementById('chat_tracking').appendChild(script)",1);
// ]]>
</script>
</body>
</html>