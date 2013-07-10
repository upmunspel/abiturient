<?php
/* @var $this PersoncontactsviewController */
/* @var $model PersonContactsView */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-contacts-view-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'FIO'); ?>
		<?php echo $form->textField($model,'FIO',array('size'=>60,'maxlength'=>302)); ?>
		<?php echo $form->error($model,'FIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SepcialityID'); ?>
		<?php echo $form->textField($model,'SepcialityID'); ?>
		<?php echo $form->error($model,'SepcialityID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EducationFormID'); ?>
		<?php echo $form->textField($model,'EducationFormID'); ?>
		<?php echo $form->error($model,'EducationFormID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isBudget'); ?>
		<?php echo $form->textField($model,'isBudget'); ?>
		<?php echo $form->error($model,'isBudget'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isContract'); ?>
		<?php echo $form->textField($model,'isContract'); ?>
		<?php echo $form->error($model,'isContract'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpecName'); ?>
		<?php echo $form->textField($model,'SpecName',array('size'=>60,'maxlength'=>315)); ?>
		<?php echo $form->error($model,'SpecName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Contacts'); ?>
		<?php echo $form->textField($model,'Contacts',array('size'=>60,'maxlength'=>341)); ?>
		<?php echo $form->error($model,'Contacts'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->