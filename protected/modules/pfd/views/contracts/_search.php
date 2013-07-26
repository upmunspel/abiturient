<?php
/* @var $this ContractsController */
/* @var $model Contracts */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idContract'); ?>
		<?php echo $form->textField($model,'idContract'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PersonSpecialityID'); ?>
		<?php echo $form->textField($model,'PersonSpecialityID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ContractNumber'); ?>
		<?php echo $form->textField($model,'ContractNumber',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ContractDate'); ?>
		<?php echo $form->textField($model,'ContractDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CustomerName'); ?>
		<?php echo $form->textArea($model,'CustomerName',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CustomerDoc'); ?>
		<?php echo $form->textArea($model,'CustomerDoc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CustomerAddress'); ?>
		<?php echo $form->textArea($model,'CustomerAddress',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CustomerPaymentDetails'); ?>
		<?php echo $form->textArea($model,'CustomerPaymentDetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PaymentDate'); ?>
		<?php echo $form->textField($model,'PaymentDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Comment'); ?>
		<?php echo $form->textArea($model,'Comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->