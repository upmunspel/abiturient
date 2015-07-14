<?php
/* @var $this ConvertAttestatController */
/* @var $model ConvertAttestat */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'twelve_p'); ?>
		<?php echo $form->textField($model,'twelve_p'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'two_hundred_p'); ?>
		<?php echo $form->textField($model,'two_hundred_p'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->