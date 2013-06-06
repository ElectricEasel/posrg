<?php defined( '_JEXEC' ) or die; ?>
<div class='gm-head'>
	<h2><?php echo JText::_('GM_PRODUCT_FORM_HEAD') ?></h2>
</div>
<div id='gm-family-form' class='gm-content'>
	<form name='gm_form_family' id='gm_form_family' action="<?php echo JRoute::_('index.php') ?>" method="post"  class="form-validate gm-form">

		<div class='item'>
			<div class='label'>
				<label for='product_name'><?php echo JText::_('GM_PRODUCT_FORM_NAME') ?> <span class="req" >*</span></label>
			</div>
			<div class='value'>
				<input name='product_name' value='<?php echo $this->data->product_name ?>' id='product_name' class='gm-input required' type="text" maxlength="26" />
			</div>
		</div>
		<div class='item'>
			<div class='label'>
				<label for='product_des'><?php echo JText::_('GM_FAMILY_FORM_DES') ?></label>
			</div>
			<div class='value'>
				<input name='product_des' value='<?php echo $this->data->product_des ?>' id='product_des' class='gm-input' type="text" maxlength="29" />
			</div>
		</div>
		<div class='item'>
			<div class='label'>
				<label  for='image'><?php echo JText::_('GM_PRODUCT_FORM_IMAGE') ?></label>
			</div>
			<div class='value'>
				<div class='gm-image-container size-min jmc-upload' id="gm-special">
					<img src='<?php echo $this->profile_img ?>' class='gm-image-size size-min' alt='Upload'  />
					<input type="hidden" name='image' value='<?php echo $this->data->image  ?>' class='gm-input' />
				</div>
			</div>
		</div>

		<div class='item'>
			<div class='label'>
				<label for='price'><?php echo JText::_('GM_FAMILY_FORM_PRICE') ?> <span class="req" >*</span></label>
			</div>
			<div class='value'>
				<input name='price' value='<?php echo number_format($this->data->price, 2);?>' id='price' class='gm-input required' type="text" /> USD
			</div>
		</div>

		<div class='item'>
			<div class='label'>
				<label><?php echo JText::_('GM_PRODUCT_FORM_FONTEND') ?></label>
			</div>
			<div class='value'>
				<?php echo $this->status ?>
			</div>
		</div>

		<div class='action-container'>
			<span class="req left"><?php echo JText::_('GM_PRODUCT_RQ') ?></span>

			<button id="cancel" type="button" ><?php echo JText::_('Cancel') ?></button>
			<button type="submit" class="validate" id='save_fm'><?php echo JText::_('Save') ?></button>
		</div>

		<input type='hidden' name='task' value='save' />
		<input type='hidden' name='id'	value='<?php echo $this->data->id ?>' />

		<?php echo JHTML::_( 'form.token' ); ?>
		<script language="javascript" type="text/javascript">
		<!--
		jQuery(document).ready(function($){

			$('#cancel').click(function(){
				document.location.href = '<?php echo JRoute::_('index.php?option=com_product&view=manager'); ?>';
			});

			$('.jmc-upload').each(function(A, B){
				var self = B;
				new AjaxUpload($(B), {
					action: "<?php echo JUri::base() ?>index.php?option=com_product&task=upload",
					name:  'file_upload',
					data: {},
					responseType: 'json',
					onComplete: function(file, response) {
						if(response){
							alert(response.message);
							if(response.type=='success'){

								$(self)
									.children('img')
									.addClass('size-min')
									.attr('src', "<?php echo JURI::base() ?>components/com_product/assets/upload/" + response.file);

								$(self)
									.children('input')
									.val(response.file);
							}

						}
					}
				});
			});
		});
		//-->
		</script>
	</form>
</div>
