<?php
/* @var $this PersoneducationformsController */
/* @var $model Personeducationforms */
/* @var $form CActiveForm */
?>
<div class="well form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
  <div class="row-fluid">
		<div class ="span3">
		<?php echo $form->label($model,'idPersonEducationForm'); ?>
		<?php echo $form->textField($model,'idPersonEducationForm',array('class'=>'span12')); ?>
	</div>
		<div class ="span9">
		<?php echo $form->label($model,'PersonEducationFormName'); ?>
		<?php echo $form->textField($model,'PersonEducationFormName',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<hr>
<div class="row-fluid">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Пошук',
		)); ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- search-form -->