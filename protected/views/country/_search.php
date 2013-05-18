<?php
/* @var $this Countrycontroller */
/* @var $model Country */
/* @var $form CActiveForm */
?>

<div class="well form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span2">
		<?php echo $form->label($model,'idCountry'); ?>
		<?php echo $form->textField($model,'idCountry',array('class'=>'span12')); ?>
	</div>
    <div class ="span10">
		<?php echo $form->label($model,'CountryName'); ?>
		<?php echo $form->textField($model,'CountryName',array('class'=>'span12','size'=>60,'maxlength'=>255)); ?>
	</div>
</div>
<div class="row-fluid">
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="row-fluid">
		<?php echo $form->label($model,'Visible'); ?>	
                  <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model,'Visible');?>
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
</div>
    <hr>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                //'type'=>'info',
                'label'=>'Пошук',
        )); ?>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
