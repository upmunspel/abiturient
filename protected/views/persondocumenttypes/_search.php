<?php
/* @var $this Persondocumenttypescontroller */
/* @var $model PersonDocumentTypes */
/* @var $form CActiveForm */
?>

<div class="well form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span3">
        <?php echo $form->label($model,'idPersonDocumentTypes'); ?>
        <?php echo $form->textField($model,'idPersonDocumentTypes',array('class'=>'span12')); ?>
    </div>

    <div class ="span9">
        <?php echo $form->label($model,'PersonDocumentTypesName'); ?>
        <?php echo $form->textField($model,'PersonDocumentTypesName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
    </div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span3">
        <?php echo $form->labelEx($model,'IsEntrantDocument'); ?>
        <?php echo $form->dropDownList($model,'IsEntrantDocument',PersonDocumentTypes::DropDown2(),array('class'=>'span12')); ?>
    </div>
</div>
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