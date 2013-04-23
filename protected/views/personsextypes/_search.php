<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */
/* @var $form CActiveForm */
?>

<div class="">
    
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    
    'type'=>'horizontal',
    'htmlOptions'=>array('class'=>'well'),
));
//$form = new TbActiveForm();
?>


    <?php echo $form->textFieldRow($model,'idPersonSexTypes'); ?>
    <?php echo $form->textFieldRow($model,'PersonSexTypesName',array('size'=>12,'maxlength'=>12)); ?>
    <div class ="row-fluid">
        <?php  $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Пошук')); ?>
    </div>
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->