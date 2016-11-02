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
		$formId = $args['formId'];

		$table = new CrmTable;

		if ($table->load(array('form_id' => $formId)) && $table->published == 1)
		{
			$dt = new DateTime("now", new DateTimeZone('America/Chicago'));
			$dt->setTimestamp(time());
			$time = $dt->format('Y-m-d H:i:s');

			$field_ignore_list = array(
				'cd_domain',
				'cd_visitorkey',
				'formId',
				'submit',
				'cd_accountkey',
				'name',
				'cover_letter',
				'resume',
				'antispam',
				'antispam_check',
				'fname',
				'lname',
				'telephone',
				'from_mobile',
				'date_available_plus',
				'user_agent'
			);

			$query = $this->db->getQuery(true);
			$query->select('DISTINCT(FieldName) as field')
				  ->from('#__rsform_submission_values');
			$this->db->setQuery($query);
			$fields = $this->db->loadRowList();
			$csv_headers = array();

			for ($i = 0; $i < count($fields); $i++) {
				if (!in_array($fields[$i][0], $field_ignore_list)) {
					$csv_headers[] = $fields[$i][0];
				}
			}

			$csv_items = array();
			foreach ($csv_headers as $item) {
				if (isset($args['post'][$item])) {
					$csv_items[] = $args['post'][$item];
				}
				else {
					$csv_items[] = '';
				}
			}

			array_unshift($csv_headers,'timestamp');
			array_unshift($csv_items,$time);

			$fp = fopen(JPATH_ROOT.'/leads/test.csv', 'w');
			fputcsv($fp, $csv_headers);
			fputcsv($fp, $csv_items);
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