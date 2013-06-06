<?php defined('_JEXEC') or die;

jimport('joomla.application.component.helper');
jimport('joomla.application.component.controller');
jimport('joomla.application.component.modelitem');
jimport('joomla.application.component.modellist');
jimport('joomla.application.component.view');
jimport('joomla.filesystem.file');
jimport('joomla.html.pagination');

JHtml::script('mootools.js');
JFactory::getDocument()
	->addScript('components/com_product/assets/js/jquery.js')
	->addScript('components/com_product/assets/js/slide.js')
	->addScript('components/com_product/assets/js/time.js')
	->addScript('components/com_product/assets/js/ajaxupload.js')
	->addScript('components/com_product/assets/js/validate.js')
	->addScript('includes/js/joomla.javascript.js')
	->addStyleSheet('components/com_product/assets/css/template.css')
	->addStyleSheet('components/com_product/assets/css/svwp_style.css')
	->addScript('components/com_product/assets/js/jquery.lightbox.js')
	->addStyleSheet('components/com_product/assets/css/jquery.lightbox.css');

require_once 'lib/Gd2.php';

JLoader::registerPrefix('Product', dirname(__FILE__));

$app = JFactory::getApplication();

$controller = new ProductController;
$controller->execute($app->input->get('task'));
$controller->redirect();
