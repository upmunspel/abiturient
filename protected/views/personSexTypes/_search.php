<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idPersonSexTypes'); ?>
		<?php echo $form->textField($model,'idPersonSexTypes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PersonSexTypesName'); ?>
		<?php echo $form->textField($model,'PersonSexTypesName',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->