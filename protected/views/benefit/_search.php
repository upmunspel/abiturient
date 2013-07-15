<?php
/* @var $this Benefitcontroller */
/* @var $model Benefit */
/* @var $form CActiveForm */
?>

<div class="well form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
	<div class ="span2">
		<?php echo $form->label($model,'idBenefit'); ?>
		<?php echo $form->textField($model,'idBenefit',array('class'=>'span12')); ?>
	</div>
	<div class ="span10">
		<?php echo $form->label($model,'BenefitName'); ?>
		<?php echo $form->textField($model,'BenefitName',array('class'=>'span12','size'=>60,'maxlength'=>250)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
	<div class ="span6">
		<?php echo $form->label($model,'BenefitKey'); ?>
		<?php echo $form->textField($model,'BenefitKey',array('class'=>'span12','size'=>30,'maxlength'=>30)); ?>
	</div>
	<div class ="span6">
		<?php echo $form->label($model,'BenefitGroupID'); ?>
		<?php echo $form->textField($model,'BenefitGroupID',array('class'=>'span12')); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
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
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>      
 <hr>
<div class="row-fluid">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                //'type'=>'info',
                'label'=>'Пошук',
        )); ?>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<?php $this->endWidget(); ?>
</div><!-- search-form -->
