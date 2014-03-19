<?php defined( '_JEXEC' ) or die;

$count = count($this->items);
$half = ceil($count / 2);
?>
<div id="wanted">
    <h2>POS Remarketing Group wants to buy the following POS related hardware:</h2>
    <div id="wanted-list">
    <?php
    foreach (array_chunk($this->items, $half) as $i => $items)
    {
        echo '<ul class="iteration-' . $i . '">';
        foreach ($items as $item)
        {
            echo '<li>' . $item->title . '</li>';
        }
        echo '</ul>';
    }
    ?>
    </div>
    <?php echo $this->pagination->getPagesLinks(); ?>
    <h3>If you have any of the above equipment in stock and are motivated to sell it at wholesale pricing please</h3>
</div>