<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Вітаємо в системі "'.CHtml::encode(Yii::app()->name).'"',
)); ?>

<p>Запорізький національний університет</p>
<br/>
<div class="row">
  <div class="span2"></div>
  <div class="span2">
      <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Абітурієнти',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    )); ?>
  </div>
  <div class="span2">
      <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Довідники',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("directory"),
    )); ?>
  </div>
    <div class="span3" style="">
      <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Статистика вступу',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    )); ?>
    </div>
     <div class="span1"></div>
</div>


<?php $this->endWidget(); ?>
