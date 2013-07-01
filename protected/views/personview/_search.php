<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idPersonSpeciality'); ?>
		<?php echo $form->textField($model,'idPersonSpeciality'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreateDate'); ?>
		<?php echo $form->textField($model,'CreateDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idPerson'); ?>
		<?php echo $form->textField($model,'idPerson'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Birthday'); ?>
		<?php echo $form->textField($model,'Birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FIO'); ?>
		<?php echo $form->textField($model,'FIO',array('size'=>60,'maxlength'=>302)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isContract'); ?>
		<?php echo $form->textField($model,'isContract'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isBudget'); ?>
		<?php echo $form->textField($model,'isBudget'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpecCodeName'); ?>
		<?php echo $form->textField($model,'SpecCodeName',array('size'=>60,'maxlength'=>316)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'QualificationID'); ?>
		<?php echo $form->textField($model,'QualificationID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CourseID'); ?>
		<?php echo $form->textField($model,'CourseID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RequestNumber'); ?>
		<?php echo $form->textField($model,'RequestNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PersonRequestNumber'); ?>
		<?php echo $form->textField($model,'PersonRequestNumber'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->