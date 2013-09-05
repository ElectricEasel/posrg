 <?php
 
defined('_JEXEC') or die;

$mydoc =& JFactory::getDocument();
$title = $mydoc->getTitle();

$menu = JFactory::getApplication()->getMenu();
$parentTitle = $menu->getItem($menu->getActive()->parent_id)->title;
$hasParent = ($menu->getItem($menu->getActive()->parent_id));

switch ($title) {
	case "Mobile Contact Us":
		$title = "About Us";
		break;
	case "Mobile Product Info":
		$title = "POS Product Info";
		break;
	case "Mobile Asset Appraisal":
		$title = "Sell Your Used POS";
		break;
	case "POS Services":
		$title = "Point-of-Sale Services";
		break;
}

if ($hasParent == "") {
	$newtitle = $title;
} else {
	$newtitle = $parentTitle;
}

switch ($newtitle) {
	case "POS Services":
		$newtitle = "Point-of-Sale Services";
		break;
}


?>

<h1><?php echo $newtitle; ?></h1>