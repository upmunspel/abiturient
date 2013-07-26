<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idPersonBaseSpeciality'); ?>
		<?php echo $form->textField($model,'idPersonBaseSpeciality'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PersonBaseSpecialityName'); ?>
		<?php echo $form->textField($model,'PersonBaseSpecialityName',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PersonBaseSpecialityClasifierCode'); ?>
		<?php echo $form->textField($model,'PersonBaseSpecialityClasifierCode',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->