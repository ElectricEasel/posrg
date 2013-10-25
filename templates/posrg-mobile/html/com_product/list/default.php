<?php defined( '_JEXEC' ) or die;

$count	= count($this->items);
$i		= 0;
?>
<div class="item">
	<h2 class="componentheading"><?php echo JText::_('GM_PRODUCT_PRODUCT_LIST') ?></h2>
	<ul id="specials-list">
	<?php
	$i=0;
	if ($count) :
		foreach ($this->items as $item) :
			$detailUrl	= JRoute::_('index.php?option=com_product&view=detail&id='.$item->id);
			$buyUrl		= JRoute::_('index.php?option=com_product&view=buy&id='.$item->id);
			$img		= $this->getThumb("components/com_product/assets/upload/default.gif", 100, 125);
			$lightbox	= JUri::base()."components/com_product/assets/upload/default.gif";

			if (JFile::exists(JPATH_COMPONENT.'/assets/upload/'.$item->image))
			{
				$img =  $this->getThumb("components/com_product/assets/upload/" . $item->image, 100, 125);
				$lightbox = JUri::base()."components/com_product/assets/upload/" . $item->image;
			}

			$action	= JUri::base() . 'templates/family/images/btn_view_profile.png';
			?>
		<li>
			<div class="img-contain">
				<img src="<?php echo $img ?>" alt="<?php echo $item->product_name ?>" />
			</div>
			<h4><?php echo $item->product_name ?></h4>
			<div class="price">Price: <span>$<?php echo number_format($item->price, 2) ?></span></div>
			<a class="button-buy" href="<?php echo $buyUrl; ?>"><?php echo JText::_('Buy Now') ?></a>
		</li>	
			
	<?php
		$i++;
		if($i%3 == 0) echo '<div class="clear"></div>';
		endforeach;
	else :
		echo '<div style="text-align: center">'.JText::_('GM_PRODUCT_LIST_NO_ITEM').'</div>';
	endif; ?>
	</ul>

</div>
<script type="text/javascript">
// <![CDATA[
jQuery(document).ready(function($){
	$(".lightbox").lightbox();
});
// ]]>
</script>