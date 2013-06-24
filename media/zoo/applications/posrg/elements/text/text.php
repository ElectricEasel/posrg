<?php
/**
* @package   ZOO Component
* @file      text.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// register ElementRepeatable class
App::getInstance('zoo')->loader->register('ElementRepeatable', 'elements:repeatable/repeatable.php');

/*
   Class: ElementText
       The text element class
*/
class ElementText extends ElementRepeatable implements iRepeatSubmittable {

	/*
		Function: _getSearchData
			Get repeatable elements search data.
					
		Returns:
			String - Search data
	*/	
	protected function _getSearchData() {
		return $this->_data->get('value');
	}

	/*
	   Function: _edit
	       Renders the repeatable edit form field.

	   Returns:
	       String - html
	*/		
	protected function _edit() {

		// init vars
		$default = $this->_config->get('default');		
		
		// set default, if item is new
		if ($default != '' && $this->_item != null && $this->_item->id == 0) {
			$this->_data->set('value', $default);
		}

		return $this->app->html->_('control.text', 'elements[' . $this->identifier . '][' . $this->index() . '][value]', $this->_data->get('value'), 'size="60" maxlength="255"');		
		
	}
	
	
	/*
		Function: _renderSubmission
			Renders the element in submission.

	   Parameters:
            $params - submission parameters

		Returns:
			String - html
	*/
	public function _renderSubmission($params = array()) {
        return $this->_edit();
	}
	

	/*
		Function: render
			Renders the element.

	   Parameters:
            $params - render parameter

		Returns:
			String - html
	*/
	public function render($params = array()) {
		
		$result = array();
		foreach ($this as $self) {
			$result[] = $this->_render($params);
		}
		
		
		$params = $this->app->data->create($params);
		if ($params->get('link_to_item', false)) {
			$url = $this->app->route->item($this->_item);
			foreach($this as $self)
			{
				return '<a href="' . JRoute::_($url) . '">' . $this->_data->get('value') . '</a>';
			}
			
		}
		
		return $this->app->element->applySeparators($params['separated_by'], $result);
	}
}