<?php
/* @var $this Sitecontroller */
$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
'heading'=>'Вітаємо в системі "'.CHtml::encode(Yii::app()->name).'"',
)); ?>

<p>Запорізький національний університет</p>
<br/>

<div class="span2">
<?php $this->widget('bootstrap.widgets.TbButton', array(
'label'=>'Авторизуватися',
'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
'size'=>'large', // null, 'large', 'small' or 'mini'
'url'=>Yii::app()->createUrl("site/login"),
)); ?>
</div>

<div class="span3" style="">
<?php $this->widget('bootstrap.widgets.TbButton', array(
'label'=>'Статистика вступу',
'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
'size'=>'large', // null, 'large', 'small' or 'mini'
'url'=>Yii::app()->createUrl("statistic/public"),
)); ?>
</div>
<div class="row-fluid"></div>
<?php $this->endWidget(); ?>
