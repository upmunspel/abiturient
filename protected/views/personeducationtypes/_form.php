<?php
/* @var $this Personeducationtypescontroller */
/* @var $model Personeducationtypes */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facultets-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="row-fluid">
   	<div class ="span4">
		<?php echo $form->labelEx($model,'idPersonEducationTypes'); ?>
		<?php echo $form->textField($model,'idPersonEducationTypes'); ?>
		<?php echo $form->error($model,'idPersonEducationTypes'); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="row-fluid">
   	<div class ="span4">
		<?php echo $form->labelEx($model,'PersonEducationTypesName'); ?>
		<?php echo $form->textField($model,'PersonEducationTypesName',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'PersonEducationTypesName'); ?>
	</div>
</div>
<div class="form-actions">
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