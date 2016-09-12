<?php defined('_JEXEC') or die;

class CareersViewForm extends JView
{

	public function display($tpl = null)
	{
		$this->item = $this->get('Item');

		$arr = array(
			(object) array(
				'value' => 0,
				'text'  => JText::_('GM_PRODUCT_FORM_STATUS_N')
			),
			(object) array(
				'value'	=> '1',
				'text'  => JText::_('GM_PRODUCT_FORM_STATUS_Y')
			)
		);

		$this->prepareDocument();

		parent::display($tpl);
	}

	protected function prepareDocument()
	{
		JFactory::getDocument()
			->addScript('components/com_careers/assets/js/ajaxupload.js')
			->addScriptDeclaration('
			// <![CDATA[
			jQuery(document).ready(function($){

				$("#cancel").click(function(){
					document.location.href = "' . JRoute::_('index.php?option=com_careers&view=manager') . '";
				});

				$(".jmc-upload").each(function(A, B){
					var self = B;
					new AjaxUpload($(B), {
						action: "<?php echo JUri::base() ?>index.php?option=com_careers&task=upload",
						name:  "file_upload",
						data: {},
						responseType: "json",
						onComplete: function(file, response) {
							if(response){
								alert(response.message);
								if(response.type == "success"){

									$(self)
										.children("img")
										.addClass("size-min")
										.attr("src", "' . JUri::base() . 'components/com_careers/assets/upload/" + response.file);

									$(self)
										.children("input")
										.val(response.file);
								}

							}
						}
					});
				});
			});
			// ]]>
			');
	}
}