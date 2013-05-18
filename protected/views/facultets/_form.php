<?php
/* @var $this Facultetscontroller */
/* @var $model Facultets */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facultets-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
<?php echo $form->errorSummary($model); ?>

<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span2">
            <?php echo $form->labelEx($model,'idFacultet'); ?>
            <?php echo $form->textField($model,'idFacultet',array('class'=>'span12')); ?>
            <?php echo $form->error($model,'idFacultet'); ?>
    </div>
    <div class ="span10">
            <?php echo $form->labelEx($model,'FacultetFullName'); ?>
            <?php echo $form->textField($model,'FacultetFullName',array('class'=>'span12','size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'FacultetFullName'); ?>
    </div>
</div>
<div class="row-fluid">
    <div class ="span12">
            <?php echo $form->labelEx($model,'FacultetShortName'); ?>
            <?php echo $form->textField($model,'FacultetShortName',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
            <?php echo $form->error($model,'FacultetShortName'); ?>
    </div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span4">
            <?php echo $form->labelEx($model,'FacultetTypeName'); ?>
            <?php echo $form->textField($model,'FacultetTypeName',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
            <?php echo $form->error($model,'FacultetTypeName'); ?>
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
