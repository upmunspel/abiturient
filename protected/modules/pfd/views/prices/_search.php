<?php
/* @var $this PricesController */
/* @var $model Prices */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idPrice'); ?>
		<?php echo $form->textField($model,'idPrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpecialityID'); ?>
		<?php echo $form->textField($model,'SpecialityID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PriceYearInNumbers'); ?>
		<?php echo $form->textField($model,'PriceYearInNumbers'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PriceSemesterInNumbers'); ?>
		<?php echo $form->textField($model,'PriceSemesterInNumbers'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PriceYearInWords'); ?>
		<?php echo $form->textField($model,'PriceYearInWords',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->