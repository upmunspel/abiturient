<?php
$this->pageTitle=Yii::app()->name." - Довідники";
?>
<h3>Довідники</h3>
<hr>
<div class="row">
    <div class="span3">
        <div>
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>true, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Home', 'url'=>'#', 'active'=>true),
        array('label'=>'Profile', 'url'=>'#'),
        array('label'=>'Messages', 'url'=>'#'),
    ),
)); ?>
        </div>
    </div>
    <div class="span9">
        <div class="well">
        <a href="#">Навчальні заклади</a>
        <a href="#">Структурні підрозділи</a>
        </div>
        
    </div>
</div>
