<?php
/* @var $this Personeducationpaymenttypescontroller */
/* @var $model Personeducationpaymenttypes */
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
		<?php echo $form->label($model,'idEducationPaymentTypes'); ?>
		<?php echo $form->textField($model,'idEducationPaymentTypes',array('class'=>'span12')); ?>
	</div>

	<div class ="span9">
		<?php echo $form->label($model,'EducationPaymentTypesName'); ?>
		<?php echo $form->textField($model,'EducationPaymentTypesName',array('class'=>'span12','size'=>15,'maxlength'=>15)); ?>
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