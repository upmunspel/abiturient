<?php
/* @var $this Educationclasscontroller */
/* @var $model Educationclass */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
	'enableAjaxValidation'=>false,
));?>
<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
	<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
   	<div class ="span3">
		<?php echo $form->labelEx($model,'idEducationClass'); ?>
		<?php echo $form->textField($model,'idEducationClass',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'idEducationClass'); ?>
	</div>
   	<div class ="span9">
		<?php echo $form->labelEx($model,'EducationClassName'); ?>
		<?php echo $form->textField($model,'EducationClassName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'EducationClassName'); ?>
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