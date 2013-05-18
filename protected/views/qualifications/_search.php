<?php
/* @var $this Qualificationscontroller */
/* @var $model Qualifications */
/* @var $form CActiveForm */
?>
<div class="well form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php//------------------------------------------------------------------------------------------------------------------------------------//?>  
<div class="row-fluid">
    <div class ="span4">
		<?php echo $form->label($model,'idQualification'); ?>
		<?php echo $form->textField($model,'idQualification',array('class'=>'span12')); ?>
	</div>
<?php//------------------------------------------------------------------------------------------------------------------------------------//?>  
    <div class ="span4">
		<?php echo $form->label($model,'QualificationName'); ?>
		<?php echo $form->textField($model,'QualificationName',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<hr>
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