<?php
/* @var $this PersonDocumentTypesController */
/* @var $model PersonDocumentTypes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-document-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idPersonDocumentTypes'); ?>
		<?php echo $form->textField($model,'idPersonDocumentTypes'); ?>
		<?php echo $form->error($model,'idPersonDocumentTypes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PersonDocumentTypesName'); ?>
		<?php echo $form->textField($model,'PersonDocumentTypesName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'PersonDocumentTypesName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IsEntrantDocument'); ?>
		<?php echo $form->textField($model,'IsEntrantDocument'); ?>
		<?php echo $form->error($model,'IsEntrantDocument'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->