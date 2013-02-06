<?php
/* @var $this CountryController */
/* @var $model Country */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idCountry'); ?>
		<?php echo $form->textField($model,'idCountry'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CountryName'); ?>
		<?php echo $form->textField($model,'CountryName',array('size'=>60,'maxlength'=>255)); ?>
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