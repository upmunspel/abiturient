<?php
/* @var $this Qualificationscontroller */
/* @var $model Qualifications */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'qualifications-form',
	'enableAjaxValidation'=>false,
)); ?>
<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="row-fluid">
   	<div class ="span2">
		<?php echo $form->labelEx($model,'idQualification'); ?>
		<?php echo $form->textField($model,'idQualification',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'idQualification'); ?>
	</div>
   	<div class ="span10">
		<?php echo $form->labelEx($model,'QualificationName'); ?>
		<?php echo $form->textField($model,'QualificationName',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'QualificationName'); ?>
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
<?php $this->endWidget(); ?>
</div>
</div><!-- form -->