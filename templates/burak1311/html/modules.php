<?php
/*
 * Module chrome that allows for rounded corners by wrapping in nested div tags
 */
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
function modChrome_menu_rounded($module, &$params, &$attribs)
{ ?>
		<div class="module<?php echo $params->get('moduleclass_sfx'); ?>">
			<div>
				<div>
					<div class="ja-container2">
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
?>