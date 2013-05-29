<?php
/* @var $this Educationtypecontroller */
/* @var $model Educationtype */
/* @var $form CActiveForm */
?>
<div class="well form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span5">
		<?php echo $form->label($model,'idEducationType'); ?>
		<?php echo $form->textField($model,'idEducationType',array('class'=>'span12')); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span5">
		<?php echo $form->label($model,'EducationTypeFullName'); ?>
		<?php echo $form->textField($model,'EducationTypeFullName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span12">
		<?php echo $form->label($model,'EducationTypeShortName'); ?>
		<?php echo $form->textField($model,'EducationTypeShortName',array('class'=>'span12','size'=>50,'maxlength'=>50)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span12">
            <?php echo $form->labelEx($model,'EducationTypeClassID'); ?>
            <?php echo $form->dropDownList($model,'EducationTypeClassID', Educationclass::DropDown(), array('class'=>'span12')); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Пошук',
		)); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- search-form -->