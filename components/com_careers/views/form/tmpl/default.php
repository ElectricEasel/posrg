<?php defined( "_JEXEC" ) or die;

JHtml::_('behavior.formvalidation');

JFactory::getDocument()->addScriptDeclaration('
	// <![CDATA[
    $(function() {
        $("#pdf").change(function(){
        	var name = $(this).val();
        	name = name.replace(/^.*[\\\/]/,"");
			$("#pdf_value").html(name);
        });
    });
	// ]]>
')
?>
<div class="gm-head">
	<h2><?=JText::_("Add Career Listing")?></h2>
</div>
<div id="gm-family-form" class="gm-content">
	<form enctype="multipart/form-data" name="gm_form_family" id="gm_form_family" action="<?=JRoute::_("index.php?option=com_careers&task=save") ?>" method="post"  class="form-validate gm-form">

		<div class="item">
			<div class="label">
				<label for="title"><?=JText::_('TITLE')?> <span class="req" >*</span></label>
			</div>
			<div class="value">
			<?php $title = !is_null($this->item) ? $this->item->title : ""; ?>
				<input name="title" value="<?=$title?>" id="title" class="gm-input required" type="text" maxlength="50" />
			</div>
			<div class="label" style="margin-top:15px;">
				<label for="pdf"><?=JText::_('JOB OVERVIEW (PDF)')?> <span class="req" >*</span></label>
			</div>
			<div class="value" style="margin-top:15px;">
			<?php $pdf = !is_null($this->item) ? $this->item->pdf : ""; ?>
				<input name="pdf" id="pdf" value="<?=$pdf?>" class="gm-input" type="file" />
				<span style="display:inline-block;margin-left:20px" id="pdf_value"><?=$pdf?></span>
			</div>
		</div>

		<div class="action-container">
			<span class="req left"><?=JText::_('* REQUIRED')?></span>

			<button id="cancel" type="button" ><?=JText::_('Cancel')?></button>
			<button type="submit" class="validate" id="save_fm"><?=JText::_('Save')?></button>
		</div>
		<?php $id = !is_null($this->item) ? $this->item->id : ""; ?>
		<input type="hidden" name="id"	value="<?=$id?>" />
		<?=JHtml::_('form.token')?>
	</form>
</div>