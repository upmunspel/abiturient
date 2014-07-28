<?php
/* @var $this SpecialityquotesController */
/* @var $model Specialityquotes */
/* @var $form CActiveForm */
?>



<div class="well">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'specialityquotes-form',
	'enableAjaxValidation'=>false,
       
)); 
/* @var $form CActiveForm */
?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
    <div class="span12">
      <?php echo $form->labelEx($model,'SpecialityID'); ?>
      <?php echo $form->dropDownList($model, 'SpecialityID', 
        Specialities::getAllSpecs(), array('class'=>'span12')); ?>
      <?php echo $form->error($model,'SpecialityID'); ?>
    </div>
  </div>
	<div class="row-fluid">
    <div class="span12">
      <?php echo $form->labelEx($model,'QuotaID'); ?>
      <?php echo $form->dropDownList($model, 'QuotaID', 
        Quota::getAllQuota(), array('class'=>'span12')); ?>
      <?php echo $form->error($model,'QuotaID'); ?>
    </div>
  </div>
	<div class="row-fluid">
    <div class="span12">
      <?php echo $form->labelEx($model,'BudgetPlaces'); ?>
      <?php echo $form->textField($model, 'BudgetPlaces'); ?>
      <?php echo $form->error($model,'BudgetPlaces'); ?>
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
