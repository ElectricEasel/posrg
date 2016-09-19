<?php defined( '_JEXEC' ) or die; ?>
<div id="careers">
	<div class="top">
		
	</div>
	<div class="mid">
		<h2>POS Remarketing Group wants to buy the following POS related careers:</h2>
	    <div id="careers-list">
	        <ul>
	        <?php foreach ($this->items as $item)
	        {
	            echo '<li>' . $item->title . '</li>';
	        }
	        ?>
	        </ul>
	    </div>
	</div>
	<div class="bot">
	    <?php echo $this->pagination->getPagesLinks(); ?>
	    <h3>If you have any of the above equipment in stock and are motivated to sell it at wholesale pricing please</h3>
	    <a class="careers-chat" href="javascript:void($zopim.livechat.window.show())">&nbsp;</a>
	</div>
</div>