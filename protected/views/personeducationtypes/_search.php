<?php
/* @var $this Personeducationtypescontroller */
/* @var $model Personeducationtypes */
/* @var $form CActiveForm */
?>
<div class="well form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php//------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
        <div class ="span3">
        <?php echo $form->label($model,'idPersonEducationTypes'); ?>
        <?php echo $form->textField($model,'idPersonEducationTypes',array('class'=>'span12')); ?>
        </div>
        <div class ="span9">
        <?php echo $form->label($model,'PersonEducationTypesName'); ?>
        <?php echo $form->textField($model,'PersonEducationTypesName',array('class'=>'span12','size'=>20,'maxlength'=>20)); ?>
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