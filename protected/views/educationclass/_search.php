<?php
/* @var $this Educationclasscontroller */
/* @var $model Educationclass */
/* @var $form CActiveForm */
?>
<div class="well form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    )); 
    ?>

<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span3">
		<?php echo $form->label($model,'idEducationClass'); ?>
		<?php echo $form->textField($model,'idEducationClass',array('class'=>'span12')); ?>
	</div>
	<div class ="span9">
		<?php echo $form->label($model,'EducationClassName'); ?>
		<?php echo $form->textField($model,'EducationClassName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
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
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<?php $this->endWidget(); ?>
</div><!-- search-form -->