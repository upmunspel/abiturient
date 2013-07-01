<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-speciality-view-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idPersonSpeciality'); ?>
		<?php echo $form->textField($model,'idPersonSpeciality'); ?>
		<?php echo $form->error($model,'idPersonSpeciality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreateDate'); ?>
		<?php echo $form->textField($model,'CreateDate'); ?>
		<?php echo $form->error($model,'CreateDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idPerson'); ?>
		<?php echo $form->textField($model,'idPerson'); ?>
		<?php echo $form->error($model,'idPerson'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Birthday'); ?>
		<?php echo $form->textField($model,'Birthday'); ?>
		<?php echo $form->error($model,'Birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FIO'); ?>
		<?php echo $form->textField($model,'FIO',array('size'=>60,'maxlength'=>302)); ?>
		<?php echo $form->error($model,'FIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isContract'); ?>
		<?php echo $form->textField($model,'isContract'); ?>
		<?php echo $form->error($model,'isContract'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isBudget'); ?>
		<?php echo $form->textField($model,'isBudget'); ?>
		<?php echo $form->error($model,'isBudget'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpecCodeName'); ?>
		<?php echo $form->textField($model,'SpecCodeName',array('size'=>60,'maxlength'=>316)); ?>
		<?php echo $form->error($model,'SpecCodeName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'QualificationID'); ?>
		<?php echo $form->textField($model,'QualificationID'); ?>
		<?php echo $form->error($model,'QualificationID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CourseID'); ?>
		<?php echo $form->textField($model,'CourseID'); ?>
		<?php echo $form->error($model,'CourseID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RequestNumber'); ?>
		<?php echo $form->textField($model,'RequestNumber'); ?>
		<?php echo $form->error($model,'RequestNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PersonRequestNumber'); ?>
		<?php echo $form->textField($model,'PersonRequestNumber'); ?>
		<?php echo $form->error($model,'PersonRequestNumber'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->