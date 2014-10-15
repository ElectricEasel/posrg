<?php defined('_JEXEC') or die; ?>
<li>
	<h4><?php echo $this->item->title; ?></h4>
	<div class="card-bottom">
		<a href="<?php echo $this->item->link; ?>"><?php echo EEHtml::asset("resorts/{$this->item->id}/thumbs/199x160_{$this->item->image}"); ?></a>
		<p><?php echo $this->item->city . ', ' . $this->item->state; ?></p>
		<a class="blue-button2" href="<?php echo $this->item->link; ?>">
			Explore &amp; Reserve
		</a>
	</div>
</li>