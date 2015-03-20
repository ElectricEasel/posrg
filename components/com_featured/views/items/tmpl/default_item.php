<?php defined('_JEXEC') or die; ?>
<li>
    <?php if ($this->item->image) : ?>
    <div class="frame">
        <?=JHtml::image($this->item->image, $this->item->title);?>
    </div>
    <?php endif; ?>
    <div class="featuredcontent">
        <h5><?=$this->item->title?></h5>
        <p>New Price: <span>MSRP $<?=$this->item->msrp?></span></p>
        <p><strong>POSRG Price: <span>Qty 1-10 $<?=$this->item->price?></span></strong></p>
        <p class="indent"><strong><span>Qty 10+ contact your rep.</span></strong></p>
        <table>
            <thead>
            <tr>
                <th>Technology</th>
                <th>Interface</th>
                <th>Surface Treatment</th>
                <th>Monitor Color</th>
                <th>Part# (RoHS Compliant)</th>
                <th>Availability</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?=$this->item->technology?></td>
                <td><?=$this->item->interface?></td>
                <td><?=$this->item->surface_treatment?></td>
                <td><?=$this->item->monitor_color?></td>
                <td><?=$this->item->part_number?></td>
                <td><?=$this->item->availability?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <p><?=$this->item->description?></p>
    <h6>We offer unbeatable trade-in value for used POS equipment when you purchase new hardware from POSRG.</h6>
    <a class="button button-blue" href="#">Buy Now &raquo;</a>
    <a class="button button-gray" href="#">Trade Up &raquo;</a>
</li>
