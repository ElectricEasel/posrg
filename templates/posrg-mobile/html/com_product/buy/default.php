<?php defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';

// JRequest::setVar('manufacturer', $this->item->mfc);
JRequest::setVar('part_number', $this->item->product_name);
JRequest::setVar('form_name', 'Buy Now: Specials');
?>
<div class="item specials-detail">
		<h2>Current Specials <a href="javascript:history.go(-1)">&laquo; Back</a></h2>
		<img class="specials-img" src="<?php echo $this->image; ?>" alt="<?php echo $this->item->product_name; ?>" />
		<h4 class="spec-name"><?php echo $this->item->product_name; ?></h4>
		<p class="product-desc"><?php echo $this->item->product_des; ?></p>
		<p class="price">Price: <span class="gm-price">$<?php echo  number_format($this->item->price, 2);  ?></span></p>
		<div class="clear"></div>
	</div> <!-- Close the item div -->
</div> <!-- Close the wrap -->

<div id="mobile-form-section">
	<div class="wrap">
		<div class="item">
			<p class="contact-text"><strong>Fill out the form below and one of our representatives will get right back to you. Or call us toll free at <span class="blue">866-462-1005</span></strong></p>
			<?php echo RSFormProHelper::displayForm(3); ?>
		</div>
	</div>
</div>
