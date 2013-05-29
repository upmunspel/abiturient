<?php
/* @var $this Educationtypecontroller */
/* @var $model Educationtype */
/* @var $form CActiveForm */
?>

<div class="form well ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'educationtype-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span2">
        <?php echo $form->labelEx($model,'idEducationType'); ?>
        <?php echo $form->textField($model,'idEducationType',array('class'=>'span12')); ?>
        <?php echo $form->error($model,'idEducationType'); ?>
</div>
    <div class ="span10">
        <?php echo $form->labelEx($model,'EducationTypeFullName'); ?>
        <?php echo $form->textField($model,'EducationTypeFullName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'EducationTypeFullName'); ?>
    </div> 
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span12">
        <?php echo $form->labelEx($model,'EducationTypeShortName'); ?>
        <?php echo $form->textField($model,'EducationTypeShortName',array('class'=>'span12','size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'EducationTypeShortName'); ?>
    </div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span12">
        <?php echo $form->labelEx($model,'EducationTypeClassID'); ?>
	<?php echo $form->dropDownList($model,'EducationTypeClassID', Educationclass::DropDown(), array('class'=>'span12')); ?>
        <?php echo $form->error($model,'EducationTypeClassID'); ?>
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