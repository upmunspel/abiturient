<?php
/* @var $this PersonDocumentTypesController */
/* @var $model PersonDocumentTypes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idPersonDocumentTypes'); ?>
		<?php echo $form->textField($model,'idPersonDocumentTypes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PersonDocumentTypesName'); ?>
		<?php echo $form->textField($model,'PersonDocumentTypesName',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IsEntrantDocument'); ?>
		<?php echo $form->textField($model,'IsEntrantDocument'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->