<?php
/* @var $this Countrycontroller */
/* @var $model Country */
/* @var $form CActiveForm */
?>

<div class="form well">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'country-form',
'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
     <div class ="span3">
    <?php echo $form->labelEx($model,'idCountry'); ?>
    <?php echo $form->textField($model,'idCountry',array('class'=>"span12")); ?>
    <?php echo $form->error($model,'idCountry'); ?>
    </div>
    
    <div class ="span3">
    <?php echo $form->labelEx($model,'CountryName'); ?>
    <?php echo $form->textField($model,'CountryName',array('class'=>"span12")); ?>
    <?php echo $form->error($model,'CountryName'); ?>
    </div>
    <div class ="span3">
    <?php  echo $form->labelEx($model,'Visible'); ?>
     <div class="switch" data-on-label="Так" data-off-label="Ні">
        <?php echo $form->checkBox($model,'Visible'); ?>
     </div>
     <?php echo $form->error($model,'Visible'); ?>
    </div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>

<hr>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
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
