<?php
/* @var $this BenefitController */
/* @var $model Benefit */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'benefit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idBenefit'); ?>
		<?php echo $form->textField($model,'idBenefit'); ?>
		<?php echo $form->error($model,'idBenefit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BenefitName'); ?>
		<?php echo $form->textField($model,'BenefitName',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'BenefitName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BenefitKey'); ?>
		<?php echo $form->textField($model,'BenefitKey',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'BenefitKey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BenefitGroupID'); ?>
		<?php echo $form->textField($model,'BenefitGroupID'); ?>
		<?php echo $form->error($model,'BenefitGroupID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Visible'); ?>
		<div id='togle_Visible'>
                    <?php echo $form->checkBox($model,'Visible'); ?>
                 </div> 
                    <script type='text/javascript'>
                        $('#togle_Visible').toggleButtons({
                        label: {
                            enabled: 'Так',
                            disabled: 'Ні'
                        }
                    });
                 </script>   
		<?php echo $form->error($model,'Visible'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->