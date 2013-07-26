<?php
/* @var $this ContractsController */
/* @var $model Contracts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contracts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'PersonSpecialityID'); ?>
		<?php echo $form->textField($model,'PersonSpecialityID'); ?>
		<?php echo $form->error($model,'PersonSpecialityID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ContractNumber'); ?>
		<?php echo $form->textField($model,'ContractNumber',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ContractNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ContractDate'); ?>
		<?php echo $form->textField($model,'ContractDate'); ?>
		<?php echo $form->error($model,'ContractDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerName'); ?>
		<?php echo $form->textArea($model,'CustomerName',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'CustomerName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerDoc'); ?>
		<?php echo $form->textArea($model,'CustomerDoc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'CustomerDoc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerAddress'); ?>
		<?php echo $form->textArea($model,'CustomerAddress',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'CustomerAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerPaymentDetails'); ?>
		<?php echo $form->textArea($model,'CustomerPaymentDetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'CustomerPaymentDetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PaymentDate'); ?>
		<?php echo $form->textField($model,'PaymentDate'); ?>
		<?php echo $form->error($model,'PaymentDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Comment'); ?>
		<?php echo $form->textArea($model,'Comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Comment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->