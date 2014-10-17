<?php defined('_JEXEC') or die; ?>
<div id="page">
    <h2 class="contentheading">POSRG Featured Products</h2>
    <ul id="featuredlist">
        <?php foreach ($this->items as $item)
        {
            $this->item = $item;
            echo $this->loadTemplate('item');
        } ?>
    </ul>
</div>
