<?php defined('_JEXEC') or die('Restricted access'); ?>

<form id="searchForm" action="<?php echo JRoute::_( 'index.php?option=com_search' );?>" method="post" name="searchForm">
	<table class="contentpaneopen<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<tbody>
			<tr>
				<td nowrap="nowrap">
					<label for="search_searchword">
						<?php echo JText::_( 'Search Keyword' ); ?>:&nbsp;
					</label>
				</td>
				<td nowrap="nowrap">
					<input type="text" name="searchword" id="search_searchword" size="30" maxlength="30" value="<?php echo $this->escape($this->searchword); ?>" class="inputbox" />
				</td>
				<td width="100%" nowrap="nowrap">
					<button name="Search" onclick="this.form.submit()" class="button"><?php echo JText::_( 'Search' );?></button>
				</td>
			</tr>
		</tbody>
	</table>
<?php if($this->total > 0) : ?>
	<div>
		<div style="float: right;">
			<label for="limit">
				<?php echo JText::_( 'Display Num' ); ?>
			</label>
			<?php echo $this->pagination->getLimitBox( ); ?>
		</div>
		<div style="float:left">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</div>
		<div class="clear"></div>
	</div>
<?php endif; ?>
	<input type="hidden" name="task"   value="search" />
</form>