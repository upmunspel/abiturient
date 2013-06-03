<?php
/* @var $this Languagescontroller */
/* @var $model Languages */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'languages-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

	<?php echo $form->errorSummary($model); ?>

<div class="row-fluid">   	
       <div class ="span4">
		<?php echo $form->labelEx($model,'idLanguages'); ?>
		<?php echo $form->textField($model,'idLanguages',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'idLanguages'); ?>
	</div>

	<div class ="span4">
		<?php echo $form->labelEx($model,'LanguagesCode'); ?>
		<?php echo $form->textField($model,'LanguagesCode',array('class'=>'span12','size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'LanguagesCode'); ?>
	</div>

	<div class ="span4">
		<?php echo $form->labelEx($model,'LanguagesName'); ?>
		<?php echo $form->textField($model,'LanguagesName',array('class'=>'span12','size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'LanguagesName'); ?>
	</div>
</div>

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