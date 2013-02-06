<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-sex-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idPersonSexTypes'); ?>
		<?php echo $form->textField($model,'idPersonSexTypes'); ?>
		<?php echo $form->error($model,'idPersonSexTypes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PersonSexTypesName'); ?>
		<?php echo $form->textField($model,'PersonSexTypesName',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'PersonSexTypesName'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->