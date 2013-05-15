<?php
/* @var $this PersoneducationformsController */
/* @var $model Personeducationforms */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personeducationforms-form',
	'enableAjaxValidation'=>false,
)); ?>

 <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

	<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="row-fluid">
   	<div class ="span3">
		<?php echo $form->labelEx($model,'idPersonEducationForm'); ?>
		<?php echo $form->textField($model,'idPersonEducationForm',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'idPersonEducationForm'); ?>
	</div>
	<div class ="span9">
		<?php echo $form->labelEx($model,'PersonEducationFormName'); ?>
		<?php echo $form->textField($model,'PersonEducationFormName',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'PersonEducationFormName'); ?>
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