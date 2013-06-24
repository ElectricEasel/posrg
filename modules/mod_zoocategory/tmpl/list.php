<?php
/**
* @package   ZOO Category
* @file      list.php
* @version   2.4.0
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/



if(!function_exists('get_parent_cat'))
{
	function get_parent_cat($cat_id)
	{
		$db = JFactory::getDbo();
		
		do {
			$query = 'SELECT parent'
				.' FROM '.ZOO_TABLE_CATEGORY
				.' WHERE id='.(int) $cat_id;
			
			$db->setQuery($query);
			$cat_parent = $db->loadResult();
			if($cat_parent != 0)
			{
				$cat_id = $cat_parent;
			}
			
		} while ($cat_parent != 0);
		
		return $cat_id;
	}
}


// no direct access
defined('_JEXEC') or die('Restricted access');

// include css
$zoo->document->addStylesheet('modules:mod_zoocategory/tmpl/list/style.css');
// include js
$zoo->document->addScript('modules:mod_zoocategory/tmpl/list/list.js');

$count = count($categories);

$uri = explode('/', $_SERVER['REQUEST_URI']);

$active_cat_id = NULL;
$zoo = App::getInstance('zoo');

if($uri[1] == 'product-info')
{
	switch($uri[2])
	{
		case 'category':
			$active_cat_id = $zoo->request->getInt('category_id', 0);
			break;
		case 'item':
			if(($active_cat_id = $zoo->request->getInt('category_id', 0)) == 0)
			{
				$item_id = $zoo->request->getInt('item_id', 0);
				$cats = $zoo->category->getItemsRelatedCategoryIds($item_id);
				$active_cat_id = $cats[0];
			}
			break;
		default:
			break;
	}
	
	$current_cat_parent = get_parent_cat($active_cat_id);
}

?>

<div class="zoo-category list<?php echo ($active_cat_id == NULL) ? ' catalog_frontpage' : ''; ?>" id="catlist">

	<?php if ($count) : ?>

		<ul class="level1">
			<?php
			
			foreach ($categories as $category) {
				if(is_null($active_cat_id))
				{
					echo $zoo->categorymodule->render($category, $params, 2);
				}
				else
				{
					if($category->id == $current_cat_parent)
					{
						echo $zoo->categorymodule->render($category, $params, 2);
						break;
					}
				}
			}
			
			?>
		</ul>
		
	<?php else : ?>
		<?php echo JText::_('COM_ZOO_NO_CATEGORIES_FOUND'); ?>
	<?php endif; ?>
		
</div>