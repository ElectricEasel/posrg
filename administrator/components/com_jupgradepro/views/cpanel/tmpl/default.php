<?php
/**
* jUpgradePro
*
* @version $Id:
* @package jUpgradePro
* @copyright Copyright (C) 2004 - 2013 Matware. All rights reserved.
* @author Matias Aguirre
* @email maguirre@matware.com.ar
* @link http://www.matware.com.ar/
* @license GNU General Public License version 2 or later; see LICENSE
*/
// No direct access.
defined('_JEXEC') or die;

// Get the version
$version = "v{$this->version}";
// get params
$params	= $this->params;
// get document to add scripts
$document	= JFactory::getDocument();
$document->addScript('components/com_jupgradepro/js/dwProgressBar.js');
$document->addScript("components/com_jupgradepro/js/migrate.js");
$document->addScript('components/com_jupgradepro/js/requestmultiple.js');
$document->addStyleSheet("components/com_jupgradepro/css/jupgradepro.css");
?>
<script type="text/javascript">

window.addEvent('domready', function() {

	/* Init jUpgradePro */
	var jUpgradePro = new jUpgradepro({
		method: '<?php echo $params->method ? $params->method : 0; ?>',
		skip_checks: <?php echo $params->skip_checks ? $params->skip_checks : 0; ?>,
    skip_templates: <?php echo $params->skip_templates ? $params->skip_templates : 0; ?>,
    skip_extensions: <?php echo $params->skip_extensions ? $params->skip_extensions : 0; ?>,
    positions: <?php echo $params->positions ? $params->positions : 0; ?>,
    debug: <?php echo $params->debug ? $params->debug : 0; ?>,
	});

});

</script>

<table width="100%">
	<tbody>
		<tr>
			<td width="100%" valign="top" align="center">

				<div id="error" class="error"></div>

				<div id="warning" class="warning">
					<?php echo JText::_('COM_JUPGRADEPRO_WARNING_SLOW'); ?>
				</div>

				<div id="update">
					<br /><img src="components/com_jupgradepro/images/update.png" align="middle" border="0"/><br />
					<h2><?php echo JText::_('START UPGRADE'); ?></h2><br />
				</div>

				<div id="checks">
					<p class="text"><?php echo JText::_('Checking and cleaning...'); ?></p>
					<div id="pb0"></div>
					<div><small><i><span id="checkstatus"><?php echo JText::_('Initialize...'); ?></span></i></small></div>
				</div>

				<div id="migration">
					<p class="text"><?php echo JText::_('Upgrading progress...'); ?></p>
					<div id="pb4"></div>
					<div><small><i><span id="migrate_status"><?php echo JText::_('Initialize...'); ?></span></i></small></div>
					<div id="counter">
						<i><small><b><span id="currItem">0</span></b> items /
						<b><span id="totalItems">0</span></b> items</small></i>
					</div>
				</div>

				<div id="files">
					<p class="text"><?php echo JText::_('Copying images/media files...'); ?></p>
					<div id="pb5"></div>
					<div><small><i><span id="files_status"><?php echo JText::_('Initialize...'); ?></span></i></small></div>
					<div id="files_counter">
						<i><small><b><span id="files_currItem">0</span></b> items /
						<b><span id="files_totalItems">0</span></b> items</small></i>
					</div>
				</div>

				<div id="templates">
					<p class="text"><?php echo JText::_('Copying templates...'); ?></p>
					<div id="pb6"></div>
				</div>

				<div id="extensions">
					<p class="text"><?php echo JText::_('Upgrading 3rd extensions...'); ?></p>
					<div id="pb7"></div>
					<div><small><i><span id="ext_status"><?php echo JText::_('Initialize...'); ?></span></i></small></div>
					<div id="ext_counter">
						<i><small><b><span id="ext_currItem">0</span></b> items /
						<b><span id="ext_totalItems">0</span></b> items</small></i>
					</div>
				</div>

				<div id="done">
					<h2 class="done"><?php echo JText::_('Migration Successful!'); ?></h2>
				</div>

				<div id="info">
					<div id="info_version"><?php echo JText::_('jUpgradePro'); ?> <?php echo JText::_('Version').' <b>'.$this->version.'</b>'; ?></div>
					<div id="info_thanks">
						<p>
							<?php echo JText::_('Developed by'); ?> <i><a href="http://www.matware.com.ar/">Matware &#169;</a></i>  Copyleft 2006-2013<br />
							Licensed as <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html"><i>GNU General Public License v2</i></a><br />
						</p>
						<p>
							<a href="http://redcomponent.com/redcomponent/jupgradepro">Project Site</a> /
							<a href="http://redcomponent.com/forum/jupgradepro-forum">Project Community</a> /
							<a href="http://wiki.redcomponent.com/index.php?title=JUpgradePRO:Table_of_Contents">Wiki</a><br />
						</p>
					</div>
				</div>

				<div>
					<div id="debug"></div>
				</div>

			</td>
		</tr>
	</tbody>
</table>

<form action="index.php?option=com_jupgradepro" method="post" name="adminForm">
	<input type="hidden" name="option" value="com_jupgradepro" />
	<input type="hidden" name="task" value="" />
</form>
