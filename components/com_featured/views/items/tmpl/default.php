<?php defined('_JEXEC') or die; ?>
<div id="resort-container">
	<?php echo $this->loadTemplate('sidebar'); ?>
	<div class="content-container search-page">
		<div class="lightblue-grad">
			<h2>Search RV Resorts &amp; Campgrounds</h2>
			<p>Use the search filters below to start your search.</p>
		</div>
		<?php echo $this->loadTemplate('searchhead'); ?>
		<h3>Featured RV Resorts & Campgrounds:</h3>
		<div id="search-results">
			<ul class="resort-list">
			<?php foreach ($this->items as $item)
			{
				$this->item = $item;
				echo $this->loadTemplate('item');
			} ?>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div>