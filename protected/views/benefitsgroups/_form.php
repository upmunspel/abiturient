<?php
/* @var $this BenefitsgroupsController */
/* @var $model Benefitsgroups */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'benefitsgroups-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'BenefitsGroupsName'); ?>
		<?php echo $form->textField($model,'BenefitsGroupsName',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'BenefitsGroupsName'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->