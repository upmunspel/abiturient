<?php
/* @var $this CountryController */
/* @var $model Country */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'country-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'CountryName'); ?>
		<?php echo $form->textField($model,'CountryName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'CountryName'); ?>
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