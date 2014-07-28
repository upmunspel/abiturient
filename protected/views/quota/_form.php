<?php
/* @var $this QuotaController */
/* @var $model Quota */
/* @var $form CActiveForm */
?>



<div class="well">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quota-form',
	'enableAjaxValidation'=>false,
       
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
    <div class="span12">
      <?php echo $form->labelEx($model,'QuotaName'); ?>
      <?php echo $form->textField($model,'QuotaName',
        array('size'=>60,'maxlength'=>250, "class"=>"span12")); ?>
      <?php echo $form->error($model,'QuotaName'); ?>
    </div>
  </div>


<?php //--------------------------------------// ?>
  <div class="row-fluid">
  <?php 
  $this->widget("bootstrap.widgets.TbButton", array(
    'buttonType'=>'submit',
    'type'=>'primary',
    "size"=>"null",
    'label'=>$model->isNewRecord ? 'Створити' : 'Зберегти',
  )); ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
