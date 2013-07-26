<?php
/* @var $this CoursedpController */
/* @var $model Coursedp */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'coursedp-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idCourseDP'); ?>
		<?php echo $form->textField($model,'idCourseDP'); ?>
		<?php echo $form->error($model,'idCourseDP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CourseDPName'); ?>
		<?php echo $form->textField($model,'CourseDPName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'CourseDPName'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->