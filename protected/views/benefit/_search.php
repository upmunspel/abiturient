<?php
/* @var $this BenefitController */
/* @var $model Benefit */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idBenefit'); ?>
		<?php echo $form->textField($model,'idBenefit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BenefitName'); ?>
		<?php echo $form->textField($model,'BenefitName',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BenefitKey'); ?>
		<?php echo $form->textField($model,'BenefitKey',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BenefitGroupID'); ?>
		<?php echo $form->textField($model,'BenefitGroupID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Visible'); ?>
		
                 <div id='togle_Visible'>
                    <?php echo $form->checkBox($model,'Visible'); ?>
                 </div> 
                 <script type='text/javascript'>
                    $('#togle_Visible').toggleButtons({
                        //width: 100,
                        label: {
                            enabled: 'Так',
                            disabled: 'Ні'
                        }
                    });
                 </script> 
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->