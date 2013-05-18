<?php
/* @var $this PersoncontacttypesController */
/* @var $model Personcontacttypes */
/* @var $form CActiveForm */
?>
<div class="form well ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personcontacttypes-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
<?php echo $form->errorSummary($model); ?>

<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span4">
            <?php echo $form->labelEx($model,'idPersonContactType'); ?>
            <?php echo $form->textField($model,'idPersonContactType',array('class'=>'span12')); ?>
            <?php echo $form->error($model,'idPersonContactType'); ?>
	</div>
	<div class ="span8">
            <?php echo $form->labelEx($model,'PersonContactTypeName'); ?>
            <?php echo $form->textField($model,'PersonContactTypeName',array('class'=>'span12','size'=>10,'maxlength'=>10)); ?>
            <?php echo $form->error($model,'PersonContactTypeName'); ?>
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