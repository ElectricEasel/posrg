<?php defined( '_JEXEC' ) or die;

JHtml::_('behavior.framework');

$count = count($this->items);
$i     = 0;
?>
<form action="<?=JRoute::_('index.php?option=com_careers&view=manager')?>" method="post" name='adminForm' id='adminForm' class='gm-form'>
	<?=JHtml::_('form.token')?>
	<input type="hidden" name="filter_order" value="<?=$this->lists['order']?>" />
	<input type="hidden" name="filter_order_Dir" value="<?=$this->lists['order_Dir']?>" />
	<input type='hidden' name='task' value='' id='task' />

	<div class='gm-head'>
		<h2 class='left'><?=JText::_('Career Listings Manager')?></h2>
		<div class='right'>
			<a  href="<?=JRoute::_('index.php?option=com_careers&view=form')?>"><span><?=JText::_('Add Item')?></span></a>
		</div>
	</div>
    <p id="success-message" style="display:none">Ordering Saved</p>
	<div id='gm-family-list' class='gm-content'>
		<table class="careers">
			<thead>
				<tr>
					<th><?=JText::_('Reorder')?></th>
					<th><?=JText::_('Title')?></th>
					<th><?=JText::_('PDF')?></th>
					<th>
						&nbsp;
					</th>
				</tr>
			</thead>
			<tbody id="sortable">
		<?php
		if ($count) :
			$k = 0;
			$cb = 0;
			foreach ($this->items as $item) :
				$checked = JHtml::_('grid.id', $i, $item->id);
				?>
				<tr class="row<?=$k?>">
                    <td align="center"  class="handle">
                        <input type="hidden" value="<?=$item->id?>" name="cid" />
						&bull;
					</td>
                    <td>
                        <a href="<?=JRoute::_('index.php?option=com_careers&view=form&id=' . $item->id)?>"><?=$item->title?></a>
                    </td>
                    <td>
                        <a href="<?=JRoute::_($item->pdf)?>"><?=$item->pdf?></a>
                    </td>
					<td>
						<a href="<?=JRoute::_('index.php?option=com_careers&view=form&id=' . $item->id )?>"><span>Edit</span></a>
						<a href="<?php echo JRoute::_('index.php?option=com_careers&task=delete&id=' . $item->id . '&' . JSession::getFormToken() . '=1' ) ?>"><span>Delete</span></a>
					</td>
				</tr>
				<?php $k = 1 - $k;
			endforeach;
		else :
			echo "<td style='text-align: center' colspan='5'>" . JText::_('No Items') . "</td>";
		endif;
		?>
			</tbody>
		</table>
		<div class="gm-family-toolbar careers-pagination">
			<?=$this->pagination->getPagesLinks()?>
		</div>
	</div>
</form>