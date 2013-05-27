<?php
/* @var $this Persondocumenttypescontroller */
/* @var $model PersonDocumentTypes */
/* @var $form CActiveForm */
?>

<div class="form well ">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'person-document-types-form',
'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

<?php echo $form->errorSummary($model); ?>

<div class="row-fluid">
    <div class ="span3">
        <?php echo $form->labelEx($model,'idPersonDocumentTypes'); ?>
        <?php echo $form->textField($model,'idPersonDocumentTypes',array('class'=>'span12')); ?>
        <?php echo $form->error($model,'idPersonDocumentTypes'); ?>
    </div>

    <div class ="span9">
            <?php echo $form->labelEx($model,'PersonDocumentTypesName'); ?>
            <?php echo $form->textField($model,'PersonDocumentTypesName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'PersonDocumentTypesName'); ?>
    </div>
</div>
<div class="row-fluid">
    <div class ="span12">
            <?php echo $form->labelEx($model,'IsEntrantDocument'); ?>
            <?php echo $form->textField($model,'IsEntrantDocument',array('class'=>'span12')); ?>
            <?php echo $form->error($model,'IsEntrantDocument'); ?>
    </div>
</div>
<div class="row-fluid">
<?php $this->widget("bootstrap.widgets.TbButton", array(
                    'buttonType'=>'submit',
                    'type'=>'primary',
                      "size"=>"null",
                    'label'=>$model->isNewRecord ? 'Створити' : 'Зберегти',
                    )); 
?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->