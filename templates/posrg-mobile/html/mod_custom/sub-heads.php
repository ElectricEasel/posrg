 <?php
 
defined('_JEXEC') or die;

$mydoc =& JFactory::getDocument();
$title = $mydoc->getTitle();

$menu = JFactory::getApplication()->getMenu();
$parentTitle = $menu->getItem($menu->getActive()->parent_id)->title;
$hasParent = ($menu->getItem($menu->getActive()->parent_id));


if ($hasParent == "") {
	$newtitle = $title;
} else {
	$newtitle = $parentTitle;
}


?>

<h1><?php echo $newtitle; ?></h1>