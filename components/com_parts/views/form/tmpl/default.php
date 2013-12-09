<?php defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';

JRequest::setVar('manufacturer', $this->item->mfc);
JRequest::setVar('part_number', $this->item->part_number);
JRequest::setVar('form_name', 'Quick Quote: Inventory');
JRequest::setVar('inventory_type', $this->item->inventory_type);

?>
<h1><span style="color: #0066cc; font-size: 18px; font-weight: bold;">Quick Quote:</span></h1>
<br />
<div class="form_item">
	<div style="width:100%;border-bottom:2px solid #000;margin-bottom:10px;" class="form_element cf_heading">
		<img src="/images/quickquote.png" style="float:right;padding:0 10px 10px 20px;position:relative;top:-20px" />
		<p style="font-size:14px;font-weight:normal;margin:0">POSRG prides itself on customer service. Please fill out the form below and a POSRG customer services representative will be in touch with you right away.</p>
		<br />
		<p style="font-size:14px;font-weight:bold">Fill out the form below and we'll get right back with you.</p>
		<br />
	</div>
</div>
<br />
<div class="form_item">
	<div class="form_element cf_heading">
		<p style="font-size:13px;color:#000;">Current Time: <?php echo date("g:ia - m/d/y") ?></p>
		<br />
		<p><span style="color:red">*</span> required fields</p>
		<br />
	</div>
</div>
<br />
<div class="quote-form-wrap">
	<?php echo RSFormProHelper::displayForm(3); ?>
</div>
