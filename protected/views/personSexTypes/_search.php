<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */
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
            <?php echo $form->label($model,'idPersonSexTypes'); ?>
            <?php echo $form->textField($model,'idPersonSexTypes',array('class'=>'span12')); ?>
        </div>
	<div class ="span10">   
            <?php echo $form->label($model,'PersonSexTypesName'); ?>
            <?php echo $form->textField($model,'PersonSexTypesName',array('class'=>'span12','size'=>12,'maxlength'=>12)); ?>
        </div>
</div> <hr>
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