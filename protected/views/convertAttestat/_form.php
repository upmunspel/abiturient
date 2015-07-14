<?php
/* @var $this ConvertAttestatController */
/* @var $model ConvertAttestat */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'convert-attestat-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'twelve_p'); ?>
		<?php echo $form->textField($model,'twelve_p'); ?>
		<?php echo $form->error($model,'twelve_p'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'two_hundred_p'); ?>
		<?php echo $form->textField($model,'two_hundred_p'); ?>
		<?php echo $form->error($model,'two_hundred_p'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->