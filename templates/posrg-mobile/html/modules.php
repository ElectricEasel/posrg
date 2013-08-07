 <?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.beez_20
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

function modChrome_noStyle($module, &$params, &$attribs)
{
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
	if (!empty ($module->content))
	{
		if ($module->showtitle)
		{
			echo '<h'.$headerLevel.'>'.$module->title.'</h'.$headerLevel.'>';
		}
		echo '<div class="moduletable'.htmlspecialchars($params->get('moduleclass_sfx')).'">'.$module->content.'</div>';
	}
}

function modChrome_justcontent($module, &$params, &$attribs)
{
	echo $module->content;
}

function modChrome_blank($module, &$params, &$attribs)
{
	if($module->showtitle) : ?>
		<h4><?php echo $module->title; ?></h4>
	<?php endif; ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
			<?php echo $module->content; ?>
		</div>
	<?php
}