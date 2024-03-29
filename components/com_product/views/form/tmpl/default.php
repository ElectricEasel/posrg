<?php defined( "_JEXEC" ) or die;

JHtml::_('behavior.formvalidation');
?>
<div class="gm-head">
	<h2><?php echo JText::_("GM_PRODUCT_FORM_HEAD") ?></h2>
</div>
<div id="gm-family-form" class="gm-content">
	<form name="gm_form_family" id="gm_form_family" action="<?php echo JRoute::_("index.php?option=com_product&task=save") ?>" method="post"  class="form-validate gm-form">

		<div class="item">
			<div class="label">
				<label for="product_name"><?php echo JText::_('GM_PRODUCT_FORM_NAME') ?> <span class="req" >*</span></label>
			</div>
			<div class="value">
			<?php $product_name = isset($this->item->product_name) ? $this->item->product_name : ''; ?>
				<input name="product_name" value="<?php echo $product_name ?>" id="product_name" class="gm-input required" type="text" maxlength="26" />
			</div>
		</div>
		<div class="item">
			<div class="label">
				<label for="product_des"><?php echo JText::_('GM_FAMILY_FORM_DES') ?></label>
			</div>
			<div class="value">
			<?php $product_des = isset($this->item->product_des) ? $this->item->product_des : ''; ?>
				<input name="product_des" value="<?php echo $product_des ?>" id="product_des" class="gm-input" type="text" maxlength="29" />
			</div>
		</div>
		<div class="item">
			<div class="label">
				<label  for="image"><?php echo JText::_('GM_PRODUCT_FORM_IMAGE') ?></label>
			</div>
			<div class="value">
			<?php
			$product_image = isset($this->item->product_image) ? $this->item->product_image : '';
			$this->profile_img = isset($this->profile_img) ? $this->profile_img : '';
			?>
				<div class="gm-image-container size-min jmc-upload" id="gm-special">
					<img src="<?php echo $this->profile_img ?>" class="gm-image-size size-min" alt="Upload"  />
					<input type="hidden" name="image" value="<?php echo $product_image  ?>" class="gm-input" />
				</div>
			</div>
		</div>

		<div class="item">
			<div class="label">
				<label for="inventory">Quantity <span class="req" >*</span></label>
			</div>
			<div class="value">
			<?php $product_inventory = isset($this->item->product_inventory) ? $this->item->product_inventory : ''; ?>
				<input name="inventory" value="<?php echo $product_inventory; ?>" id="inventory" class="gm-input required" type="text" />
			</div>
		</div>

		<div class="item">
			<div class="label">
				<label><?php echo JText::_('GM_PRODUCT_FORM_FONTEND') ?></label>
			</div>
			<div class="value">
				<?php echo $this->status ?>
			</div>
		</div>

		<div class="action-container">
			<span class="req left"><?php echo JText::_('GM_PRODUCT_RQ') ?></span>

			<button id="cancel" type="button" onclick="history.go(-1);"><?php echo JText::_('Cancel') ?></button>
			<button type="submit" class="validate" id="save_fm"><?php echo JText::_('Save') ?></button>
		</div>
		<input type="hidden" name="id"	value="<?php echo $this->item->id ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
