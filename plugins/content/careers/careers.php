<?php
/**
 * @package		Joomla.Plugin
 * @subpackage	Content.loadmodule
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class plgContentCareers extends JPlugin
{
	/**
	 * Plugin that loads module positions within content
	 *
	 * @param	string	The context of the content being passed to the plugin.
	 * @param	object	The article object.  Note $article->text is also available
	 * @param	object	The article params
	 * @param	int		The 'page' number
	 */
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer') {
			return true;
		}

		// simple performance check to determine whether bot should process further
		if (strpos($article->text, '{careers}') === false) {
			return true;
		}

		// career list
		$careers = $this->getCareerItems();
		$pdf_path = "/media/com_careers/pdf/";

		// expression to search for (positions)
		$spots_regex = '/{careers}/';

		// $matches[0] is full pattern match, $matches[1] is the position
		preg_match_all($spots_regex, $article->text, $matches, PREG_SET_ORDER);
		// No matches, skip this
		if ($matches)
		{	
			jimport('joomla.application.component.helper');

			foreach ($matches as $match)
			{
				$replaceHtml = "<h4>Current Opportunities</h4><ul>";
				foreach ($careers as $career)
				{
					$replaceHtml .= "<li><a href='".$pdf_path.$career->pdf."' target='_blank'>".$career->title."</a></li>";
				}
				$replaceHtml .= "</ul>";

				$output = "{$replaceHtml}";
				$article->text = preg_replace("|$match[0]|", addcslashes($output, '\\$'), $article->text);
				
				// Only run once.
				break;
			}
		}
	}

	private function getCareerItems()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*')
			  ->from($db->quoteName('#__careers'))
			  ->order('ordering ASC');
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}