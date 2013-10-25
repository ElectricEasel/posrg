<?php
/**
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/burak1311/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/burak1311/css/menu.css" type="text/css" />
<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/burak1311/favicon.ico">
<script language="javascript" src="<?php echo $this->baseurl ?>/templates/burak1311/js/jmenu_2.js"></script>

<!--[if lte IE 6]>
<link href="<?php echo $this->
baseurl ?>/templates/<?php echo $this->template ?>/css/ieonly.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php if($this->direction == 'rtl') : ?>
<link href="<?php echo $this->baseurl ?>/templates/burak1311/css/template_rtl.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
</head><body>
<div id="wrapper">
  <div class="wrapper-top"></div>
  <!-- begin wrapper center -->
  <div class="wrapper-center">
    <!--begin styleheader-->
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
    <!--end header -->
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
	<!--begin main container-->
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
          <!--right column-->
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
                <jdoc:include type="component" />
              </div>
            </div>
            <!-- end right column -->
            <!--begin logosupport-->
            <div class="logo-support">
              <div class="logo-support-header"></div>
             <jdoc:include type="modules" name="user8" />
            </div>
            <!--end logosupport-->
          </div>
        </div>
        <div class="main-footer"></div>
      </div>
      <!--end main containter-->
    </div>
    <!-- end wrapper center -->
    <!--begin footer content-->
    <div id="footer">
      <jdoc:include type="modules" name="footer" />
    </div>
  </div>
  <!--end footer content-->
</div>
<jdoc:include type="modules" name="debug" />
</body>
</html>
