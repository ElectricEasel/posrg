<?php defined('_JEXEC') or die('Restricted access'); ?>

<ul id="search_results" class="contentpaneopen<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php
		$i=1;
		if(count($this->results))
		foreach( $this->results as $result ) :
		
		$odd_even = ($i&1) ? 'odd' : 'even';
		
		?>
			<li class="<?=$odd_even?>">
				<div>
					<span class="small<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>" style="font-weight:bold">
						<?php echo $this->pagination->limitstart + $result->count.'. ';?>
					</span>
					<?php if ( $result->href ) :
						if ($result->browsernav == 1 ) : ?>
							<a href="<?php echo JRoute::_($result->href); ?>" target="_blank">
						<?php else : ?>
							<a href="<?php echo JRoute::_($result->href); ?>">
						<?php endif;

						echo $this->escape($result->title);

						if ( $result->href ) : ?>
							</a>
						<?php endif;
						if ( $result->section ) : ?>
							<br />
							<span class="small<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
								(<?php echo $this->escape($result->section); ?>)
							</span>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<?php if($result->text): ?>
				<div>
					<?php echo $result->text; ?>
				</div>
				<?php endif; ?>
				<?php
					if ( $this->params->get( 'show_date' )) : ?>
				<div class="small<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
					<?php echo $result->created; ?>
				</div>
				<?php endif; ?>
			</li>
		<?php $i++; endforeach; ?>
</ul>
<div class="search_pagination">
	<?php echo $this->pagination->getPagesLinks( ); ?>
</div>