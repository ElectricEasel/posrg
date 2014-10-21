<?php defined('_JEXEC') or die;

/** @var $this RvViewResort */
echo $this->loadTemplate('overview'); ?>

<div id="resort-wrap" class="clear">
	<?php echo $this->loadTemplate('sidebar'); ?>
	<div id="resort-content">
		<?php $renderer = JFactory::getDocument()->loadRenderer ( 'message' );
			echo $renderer->render('message'); ?>
		<h2><?php echo $this->item->sub_title; ?></h2>
		<div id="resort-description" class="resort-module">
			<?php if ($this->item->iskoa) : ?>
			<img src="/images/koa_logo.png" style="float:right;padding: 0 0 20px 20px" />
			<?php endif; ?>
			<?php echo EEHelper::nl2p($this->item->description); ?>
		</div>
		<?php if ($this->item->newsposts) : ?>
		<div id="resort-news">
			<h3>Resort News <small><a href="<?php echo $this->item->links->newsposts; ?>">view all</a></small></h3>
			<?php
			// Change the layout to newsposts for now
			$this->setLayout('newsposts');

			$this->post = $this->item->newsposts[0];
			echo $this->loadTemplate('single');

			// Reset to the default layouer
			$this->setLayout('default');
			?>
		</div>
		<?php endif; ?>
		<?php if (count($this->item->amenities)) : ?>
		<div id="resort-amenities" class="resort-module">
			<h2>Amenities</h2>
			<ul class="clear">
				<?php foreach ($this->item->amenities as $a) : ?>
				<li class="amenity" style="background-image:url(/<?php echo $a->icon; ?>)"><?php echo $a->title; ?></li>
				<?php endforeach; ?>
			</ul>
			<?php if (count($this->item->amenities) > 12) : ?>
			<span id="expand-list">+ view more</span>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<div id="resort-map"<?php echo ($this->item->links->video) ? '' : ' class="full"'; ?>>
			<h3>Regional Map <a href="<?php echo $this->item->links->directions; ?>">Get Directions &raquo;</a></h3>
			<div id="map-canvas"></div>
		</div>
		<?php if ($this->item->links->video) : ?>
		<div id="resort-video">
			<h3>Video Tour</h3>
			<a class="fancybox" data-fancybox-type="<?php echo $this->item->video_type; ?>" href="<?php echo $this->item->links->video; ?>"<?php echo $this->item->video_title; ?>>
				<img src="/templates/rvotg/images/dummy-video.jpg" alt=""/>
			</a>
		</div>
		<?php endif; ?>
	</div>	
</div>
