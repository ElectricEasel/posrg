<?php
/**
* @package   com_zoo
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// include assets css/js
$this->app->document->addStylesheet($this->template->resource.'assets/css/style.css');

$css_class = $this->application->getGroup().'-'.$this->template->name;

?>

<div id="system" class="yoo-zoo <?php echo $css_class; ?> <?php echo $css_class.'-tag'; ?>">

	<?php if ($this->params->get('template.show_title')) : ?>
	<h3 class="page-title"><?php echo JText::_('Articles tagged with').': '.$this->tag; ?></h3>
	<?php endif; ?>

	<?php

		// render items
		if (count($this->items)) {
			echo $this->partial('items');
		}
		
	?>

</div>