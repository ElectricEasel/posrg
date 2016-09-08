<?php defined( "_JEXEC" ) or die;

JHtml::_('behavior.formvalidation');
?>
<div class="gm-head">
	<h2><?=JText::_("Add Career Listing")?></h2>
</div>
<div id="gm-family-form" class="gm-content">
	<form name="gm_form_family" id="gm_form_family" action="<?=JRoute::_("index.php?option=com_careers&task=save") ?>" method="post"  class="form-validate gm-form">

		<div class="item">
			<div class="label">
				<label for="careers_title"><?=JText::_('TITLE')?> <span class="req" >*</span></label>
			</div>
			<div class="value">
			<?php $value = !is_null($this->item) ? $this->item->title : ""; ?>
				<input name="title" value="<?=$value?>" id="careers_title" class="gm-input required" type="text" maxlength="50" />
			</div>
		</div>

		<div class="action-container">
			<span class="req left"><?=JText::_('* REQUIRED')?></span>

			<button id="cancel" type="button" ><?=JText::_('Cancel')?></button>
			<button type="submit" class="validate" id="save_fm"><?=JText::_('Save')?></button>
		</div>
		<input type="hidden" name="id"	value="<?=$this->item->id ?>" />
		<?=JHtml::_('form.token')?>
	</form>
</div>