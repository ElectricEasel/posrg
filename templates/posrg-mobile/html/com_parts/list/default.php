<?php defined( '_JEXEC' ) or die;

$count = count($this->data);
$i     = 0;
$resetUrl = JRoute::_('index.php?option=com_parts&view=list');

?>
<div class="item">
	<div class="search-inventory-box">
		<h2><?php echo JText::_('PART LIST') ?></h2>
		<form name="adminform" id="adminform" action="<?php echo JRoute::_('index.php?option=com_parts&view=list'); ?>" method="get">
			<?php echo $this->mfcSelectList ?>
			<input type="text" placeholder="Keywords" class="" name="keyword" id="keyword" value="<?php echo $this->state->get('filter.keyword'); ?>" />
			<input type="submit" value="Search" class="blue-gradient" />	
		</form>
	
	</div>




	<?php if ($count) : ?>
	<div class="product-pagination">
			<?php echo str_replace('y?limitstart=0', 'y', $this->pagination->getPagesLinks()); ?>
		</div>
	<ul class="results">
		<?php
		$j = 0;
		foreach ($this->data as $item)
		{
			foreach($item as $key => $value)
			{
				$item->$key = JFilterOutput::ampReplace($value);
			}
		
			$j++;
			$item->url = JRoute::_('index.php?option=com_parts&view=form&id=' . $item->id);
			?>
	
			<li class="product">
				<ul>
					<li>
						<span><?php echo JText::_('BRAND') ?></span>
						<span class="right"><?php echo $item->mfc; ?></span>
					</li>
					<li>
						<span><?php echo JText::_('PART #') ?></span>
						<span class="right"><?php echo $item->part_number; ?></span>
					</li>
					<li>
						<span><?php echo JText::_('COND') ?></span>
						<span class="right"><?php echo $item->new; ?></span>
					</li>
					<li>
						<span><?php echo JText::_('QTY') ?></span>
						<span class="right"><?php echo $item->physical_count; ?></span>
					</li>
					<li class="full">
						<span>Description:</span>
						<span><?php echo $item->des; ?></span>
					</li>
				</ul>
				<a class="button-gray" href="<?php echo $item->url ?>">Quick Quote</a>
			</li>
		<?php }	?>
	</ul>
<?php
		else :
			echo '<div class="no-results">' . JText::_('NO ITEM') . '</div>';
		endif; ?>
		<div class="product-pagination">
			<?php echo str_replace('y?limitstart=0', 'y', $this->pagination->getPagesLinks()); ?>
		</div>

</div>






