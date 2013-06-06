<?php
/*
 * Module chrome that allows for rounded corners by wrapping in nested div tags
 */

function modChrome_widget($module, &$params, &$attribs)
{
	$title = $module->title;
	if($title == 'Main Sidebar Menu')
	{
		$app  = JFactory::getApplication();
		$list  =  $app->getPathway()->getPathWay();
		$count =  count($list);

		if ($count !== 0)
		{
			$title = $list[0]->name;
		}
	}

	if($module->content):
	?>
					<div class="widget <?php echo $params->get('moduleclass_sfx'); ?>">
						<?php if($module->showtitle): ?>
						<h4><?php echo $title; ?></h4>
						<?php endif; ?>
						<div class="widget_content">
							<?php echo $module->content; ?>
						</div>
					</div>
	<?php endif;
}

function modChrome_blank($module, &$params, &$attribs)
{
	echo $module->content;
}

function modChrome_home($module, &$params, &$attribs)
{
	?>
	<div class="homepage-widget">
		<?php if ($module->showtitle != 0) : ?>
		<h3><?php echo $module->title; ?></h3>
		<?php endif; ?>
		<div class="widget-content">
			<?php echo $module->content; ?>
		</div>
	</div>
	<?php
}

function modChrome_rounded_grey($module, &$params, &$attribs)
{ ?>
		<div class="module_grey<?php echo $params->get('moduleclass_sfx'); ?>">
			<div>
				<div>
					<div>
						<?php if ($module->showtitle != 0) : ?>
							<h3><?php echo $module->title; ?></h3>
						<?php endif; ?>
					<?php echo $module->content; ?>
					</div>
				</div>
			</div>
		</div>
	<?php
}