<?php
/* @var $this Personeducationpaymenttypescontroller */
/* @var $model Personeducationpaymenttypes */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personeducationpaymenttypes-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
	<?php echo $form->errorSummary($model); ?>

<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="row-fluid">
   	<div class ="span3">
		<?php echo $form->labelEx($model,'idEducationPaymentTypes'); ?>
		<?php echo $form->textField($model,'idEducationPaymentTypes',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'idEducationPaymentTypes'); ?>
	</div>

   	<div class ="span9">
		<?php echo $form->labelEx($model,'EducationPaymentTypesName'); ?>
		<?php echo $form->textField($model,'EducationPaymentTypesName',array('class'=>'span12','size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'EducationPaymentTypesName'); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<hr>    
<div class="row-fluid">
<?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        "size"=>"null",
			'label'=>$model->isNewRecord ? 'Створити' : 'Зберегти',
                        )); 
                ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->