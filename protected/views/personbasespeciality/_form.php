<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personbasespeciality-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'PersonBaseSpecialityName'); ?>
		<?php echo $form->textField($model,'PersonBaseSpecialityName',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'PersonBaseSpecialityName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PersonBaseSpecialityClasifierCode'); ?>
		<?php echo $form->textField($model,'PersonBaseSpecialityClasifierCode',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'PersonBaseSpecialityClasifierCode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->