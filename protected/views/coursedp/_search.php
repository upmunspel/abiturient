<?php
/* @var $this CoursedpController */
/* @var $model Coursedp */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idCourseDP'); ?>
		<?php echo $form->textField($model,'idCourseDP'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CourseDPName'); ?>
		<?php echo $form->textField($model,'CourseDPName',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->