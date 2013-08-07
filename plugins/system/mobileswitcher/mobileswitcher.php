<?php
/**
 * Mobile Template Switcher and Home Page Selector
 *
 * @author      $Author: dongilbert $
 * @copyright   Don Gilbert - 2014
 * @package     Joomla.System
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     $Id: shmobile.php 2050 2011-06-30 13:52:38Z silianacom-svn $
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');
jimport('joomla.environment.uri');
jimport('joomla.environment.browser');

/**
 * sh404SEF system plugin
 *
 * @author
 */
class plgSystemMobileSwitcher extends JPlugin
{
	public $app;
	public $browser;
	public $template;
	public $homepage;
	public $doMobile;
	public $defaultRecords	= array(
		array( 'start' => 0, 'stop' => 0, 'string' =>
			'/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile|o2|opera m(ob|in)i|palm( os)?|p(ixi|re)\/|plucker|pocket|psp|smartphone|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce; (iemobile|ppc)|xiino/i'),
		array( 'start' => 0, 'stop' => 4, 'string' =>
			'/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i')
	);
	
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);
		
		$this->app      = JFactory::getApplication();
		$this->browser  = JBrowser::getInstance();
		$this->template = $this->params->get('mobile_template', false);
		$this->homepage = $this->params->get('mobile_homepage', false);
		
		if (JRequest::getVar('noMobile') === 'true')
		{
			JFactory::getSession()->set('noMobile', true);
			JApplication::redirect(JUri::root());
		}
		
		if ($this->params->get('mobile_switch_enabled', false) !== false && $this->checkIp() === true && $this->checkSession() === false)
		{
			$isMobileRequest = $this->browser->get('_mobile');

			if ($isMobileRequest !== true)
			{
				$userAgent	= $this->browser->get('_lowerAgent');

				foreach ($this->defaultRecords as $record)
				{
					$isMobileRequest =
						$isMobileRequest ||
						(bool) (empty($record['stop']) ?
							preg_match($record['string'], substr($userAgent, $record['start'])) :
							preg_match($record['string'], substr($userAgent, $record['start'], $record['stop'])));
				}
			}
		}
		
		$host = JUri::getInstance()->toString(array('host'));
		
		if (strpos($host, 'mobile.eebeta'))
		{
			$isMobileRequest = true;
		}
		
		$isMobileRequest = true;
		
		$this->doMobile = (bool) ($isMobileRequest === true && $this->app->isAdmin() === false);
		
		if ($this->doMobile)
		{
			$this->browser->set('_mobile', true);
		}
	}

	private function checkSession()
	{
		return JFactory::getSession()->get('noMobile', false);
	}

	private function checkIp()
	{
		return true;

		$host = JUri::getInstance()->toString(array('host'));

		return (isset($_SERVER['REMOTE_ADDR']) && in_array($_SERVER['REMOTE_ADDR'], explode("\n", $this->params->get('ips', false))));
	}

	public function onAfterInitialise()
	{
		if ($this->doMobile === true && $this->homepage !== false)
		{
			$this->app->getMenu()->setDefault($this->homepage, '*');
		}
	}

	public function onAfterRoute()
	{
		if ($this->doMobile === true && $this->template !== false)
		{
			$this->app->setTemplate($this->template);
		}
	}
}
