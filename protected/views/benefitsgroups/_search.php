<?php
/* @var $this BenefitsgroupsController */
/* @var $model Benefitsgroups */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idBenefitsGroups'); ?>
		<?php echo $form->textField($model,'idBenefitsGroups'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BenefitsGroupsName'); ?>
		<?php echo $form->textField($model,'BenefitsGroupsName',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->