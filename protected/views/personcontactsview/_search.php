<?php
/* @var $this PersoncontactsviewController */
/* @var $model PersonContactsView */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FIO'); ?>
		<?php echo $form->textField($model,'FIO',array('size'=>60,'maxlength'=>302)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SepcialityID'); ?>
		<?php echo $form->textField($model,'SepcialityID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EducationFormID'); ?>
		<?php echo $form->textField($model,'EducationFormID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isBudget'); ?>
		<?php echo $form->textField($model,'isBudget'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isContract'); ?>
		<?php echo $form->textField($model,'isContract'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpecName'); ?>
		<?php echo $form->textField($model,'SpecName',array('size'=>60,'maxlength'=>315)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Contacts'); ?>
		<?php echo $form->textField($model,'Contacts',array('size'=>60,'maxlength'=>341)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->