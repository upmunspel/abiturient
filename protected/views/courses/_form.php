<?php
/* @var $this Coursescontroller */
/* @var $model Courses */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
	'enableAjaxValidation'=>false,
));
?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
   	<div class ="span2">
		<?php echo $form->labelEx($model,'idCourse'); ?>
		<?php echo $form->textField($model,'idCourse',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'idCourse'); ?>
   	</div>
        <div class ="span10">
		<?php echo $form->labelEx($model,'CourseName'); ?>
		<?php echo $form->textField($model,'CourseName',array('class'=>'span12','size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CourseName'); ?>
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
</div>
<!-- form -->