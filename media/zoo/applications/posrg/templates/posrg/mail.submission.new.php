<?php
/**
* @package   ZOO Component
* @file      mail.submission.new.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// author
$user_name = JText::_('Guest');
if ($author = $item->created_by_alias) {
	$user_name = $author;
} else if (($user = $item->app->user->get($item->created_by)) && $user->name) {
	$user_name = $user->name;
}

?>

<html>
	<body>
		<p>Hi,</p>

		<p>You are receiving this email because you are administaring the submissions at <?php echo $website_name; ?>. There has been a new submission by <?php echo $user_name; ?> - <?php echo $item->name; ?>.</p>

		<p>If you want to edit the new submission, click the following link: <a href="<?php echo $item_link; ?>"><?php echo $item_link; ?></a></p>
	</body>
</html>