<?php
/**
 * @version 1.3.0
 * @package RSform!Pro Twilio Notifications
 * @copyright (C) 2014 www.electriceasel.com
 * @license GPL, http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Twilio SMS Notifications Plugin for RSForm! Pro
 */
class plgSystemRsfpcrm extends JPlugin
{
	/**
	 * @var JApplication
	 */
	protected $app;

	/**
	 * @var JDatabase
	 */
	protected $db;

	/**
	 * Constructor
	 *
	 * @access	protected
	 * @param	object	$subject The object to observe
	 * @param 	array   $config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);
		$this->app = JFactory::getApplication();
		$this->db = JFactory::getDbo();

		require __DIR__ . '/src/table.php';
	}

	public function rsfp_bk_onAfterShowConfigurationTabs($tabs)
	{
		$tabs->addTitle('CRM Integration', 'form-crm');
		$tabs->addContent($this->crmConfigurationScreen());
	}

	/**
	 * Do the SMS Notification
	 *
	 * @param $args
	 */
	public function rsfp_f_onBeforeStoreSubmissions($args)
	{
		$submissionId = $args['SubmissionId'];
		$formId = $args['formId'];

		$table = new CrmTable;

		if ($table->load(array('form_id' => $formId)) && $table->published == 1)
		{
			$dt = new DateTime("now", new DateTimeZone('America/Chicago'));
			$dt->setTimestamp(time());
			$time = $dt->format('m/d/Y H:i');

			$csv_headers = array(
				'timestamp',
				'email',
				'last_name',
				'first_name',
				'form_name',
				'pos_services',
				'online_quote',
				'pos_asset_appraisal',
				'recycling_asset_recovery_quote',
				'emv_compliance',
				'trade_in_up',
				'preferred_oems',
				'notes',
				'phone',
				'company',
				'manufacturer',
				'part_number',
				'quantity',
				'city',
				'state',
				'zip',
				'condition',
				'date_available',
				'equipment_location',
				'inventory_type',
				'info',
				'additional_information',
				'question',
				'id',
				'repair_quote',
				'vertical_landing',
				'lead_source',
			);

			$csv_items = array();
			foreach ($csv_headers as $header) {
				if ($header == 'id') {
					$csv_items[] = $submissionId;
				}
				elseif ($header == 'timestamp') {
					$csv_items[] = $time;
				}
				else if (isset($args['post'][$header])) {
					$csv_items[] = $args['post'][$header];
				}
				else {
					$csv_items[] = '';
				}
			}

			$file_path = JPATH_ROOT.'/leads/WebsiteLeadsCombined.csv';
			if (file_exists($file_path)) {
				$fp = fopen($file_path, 'a');
				fputcsv($fp, $csv_items);
			}
			else {
				$fp = fopen($file_path, 'w');
				fputcsv($fp, $csv_headers);
				fputcsv($fp, $csv_items);
			}
			fclose($fp);
		}
	}

	public function rsfp_onFormSave($form)
	{
		$data = array(
			'form_id' => $this->app->input->getInt('formId', null),
			'published' => $this->app->input->getInt('crm_published', null),
		);

		$table = new CrmTable;

		if ($data['form_id'] !== null)
		{
			$table->load(array('form_id' => $data['form_id']));
		}

		if (! $table->save($data))
		{
			JError::raiseWarning(500, $table->getError());
			return false;
		}

		return true;
	}

	public function rsfp_bk_onAfterShowFormEditTabsTab()
	{
		echo '<li><a href="javascript: void(0);" id="crm"><span>CRM Integration</span></a></li>';
	}

	public function rsfp_bk_onAfterShowFormEditTabs()
	{
		$formId = $this->app->input->getInt('formId', null);
		$table = new CrmTable;
		$table->load(array('form_id' => $formId));
		$published = RSFormProHelper::renderHTML('select.booleanlist', 'crm_published', 'class="inputbox"', $table->published);

		$html = array();
		$html[] = '<div id="crmdiv">';
		$html[] = '<table class="admintable">';
		$html[] = '<tr>';
		$html[] = '<td valign="top" align="left" width="30%">';
		$html[] = '<table>';
		$html[] = '<tr>';
		$html[] = '<td colspan="2"><div class="rsform_error">CRM Integration</div></td>';
		$html[] = '</tr>';
		$html[] = '<tr>';
		$html[] = '<td width="80" align="right" nowrap="nowrap" class="key">Submit to CRM</td>';
		$html[] = '<td>' . $published . '</td>';
		$html[] = '</tr>';
		$html[] = '</table>';
		$html[] = '</div>';

		echo implode("\n", $html);
	}

	protected function canRun()
	{
		if (class_exists('RSFormProHelper')) return true;

		$helper = JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';

		if (file_exists($helper))
		{
			require_once $helper;
			RSFormProHelper::readConfig();
			return true;
		}

		return false;
	}

	protected function crmConfigurationScreen()
	{
		ob_start();
		?>
		<div id="page-crm">
			<table class="admintable">
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="public">FTP URL</label></td>
					<td><input type="text" name="rsformConfig[crm.url]" value="<?php echo RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('crm.url')); ?>" size="100" maxlength="100"></td>
				</tr>
			</table>
		</div>
		<?php

		return ob_get_clean();
	}
}