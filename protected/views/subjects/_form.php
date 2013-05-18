<?php
/* @var $this Subjectscontroller */
/* @var $model Subjects */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subjects-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
   	<div class ="span2">
		<?php echo $form->labelEx($model,'idSubjects'); ?>
		<?php echo $form->textField($model,'idSubjects',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'idSubjects'); ?>
	</div>
   	<div class ="span2">
		<?php echo $form->labelEx($model,'idZNOSubject'); ?>
		<?php echo $form->textField($model,'idZNOSubject',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'idZNOSubject'); ?>
	</div>
   	<div class ="span8">
		<?php echo $form->labelEx($model,'SubjectName'); ?>
		<?php echo $form->textField($model,'SubjectName',array('class'=>'span12','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'SubjectName'); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="row-fluid">
   	<div class ="span6">
		<?php echo $form->labelEx($model,'ParentSubject'); ?>
		<?php echo $form->textField($model,'ParentSubject',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'ParentSubject'); ?>
	</div>
   	<div class ="span6">
		<?php echo $form->labelEx($model,'SubjectKey'); ?>
		<?php echo $form->textField($model,'SubjectKey',array('class'=>'span12','size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'SubjectKey'); ?>
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