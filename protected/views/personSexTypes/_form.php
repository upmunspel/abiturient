<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */
/* @var $form CActiveForm */
?>

<div class="form well">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'person-sex-types-form',
'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span2">
        <?php echo $form->labelEx($model,'idPersonSexTypes'); ?>
        <?php echo $form->textField($model,'idPersonSexTypes',array('class'=>'span12')); ?>
        <?php echo $form->error($model,'idPersonSexTypes'); ?>

</div>
    <div class ="span10">
        <?php echo $form->labelEx($model,'PersonSexTypesName'); ?>
        <?php echo $form->textField($model,'PersonSexTypesName',array('class'=>'span12','size'=>12,'maxlength'=>12)); ?>
        <?php echo $form->error($model,'PersonSexTypesName'); ?>
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