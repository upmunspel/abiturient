<?php
/* @var $this StatementsController */
/* @var $model Statements */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idStatement'); ?>
		<?php echo $form->textField($model,'idStatement'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpecialityID'); ?>
		<?php echo $form->textField($model,'SpecialityID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Subjects1ID'); ?>
		<?php echo $form->textField($model,'Subjects1ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Subjects2ID'); ?>
		<?php echo $form->textField($model,'Subjects2ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Subjects3ID'); ?>
		<?php echo $form->textField($model,'Subjects3ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubjectsDate1'); ?>
		<?php echo $form->textField($model,'SubjectsDate1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubjectsDate2'); ?>
		<?php echo $form->textField($model,'SubjectsDate2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SubjectsDate3'); ?>
		<?php echo $form->textField($model,'SubjectsDate3'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->