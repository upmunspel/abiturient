<?php
/* @var $this DocumentsController 
 * @var $form CActiveForm
 */
//$form = new CActiveForm();
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doc-form-modal',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary($model); ?> 
<?php
   
   echo $form->hiddenField($model, "PersonID");
   echo $form->hiddenField($model, "idDocuments");
   
?> 
<div class="row-fluid">
    <div class ="span6">
        <?php echo $form->labelEx($model,'TypeID'); ?>
        <?php echo $form->dropDownList($model, 'TypeID', CHtml::listData(PersonDocumentTypes::model()->findAll(), 'idPersonDocumentTypes', 'PersonDocumentTypesName'),array('class'=>'span12')); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,'Series'); ?>
        <?php echo $form->textField($model,'Series',array('class'=>'span12')); ?>
    </div>   
    <div class ="span4">
        <?php echo $form->labelEx($model,'Numbers'); ?>
        <?php echo $form->textField($model,'Numbers',array('class'=>'span12', )); ?>
    </div>    
</div>
<div class="row-fluid">
    <div class ="span2">
        <?php echo $form->labelEx($model,'DateGet'); ?>
        <?php echo $form->textField($model,'DateGet',array('class'=>'span12 datepicker')); ?>
    </div>
    <div class ="span10">
        <?php echo $form->labelEx($model,'Issued'); ?>
        <?php echo $form->textField($model,'Issued',array('class'=>'span12')); ?>
    </div>
</div>
 <div class="row-fluid">
   <div class ="span2">
        <?php echo $form->labelEx($model,'ZNOPin'); ?>
        <?php echo $form->textField($model,'ZNOPin',array('class'=>'span12','maxlength'=>4)); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,'AtestatValue'); ?>
        <?php echo $form->textField($model,'AtestatValue',array('class'=>'span12',)); ?>
    </div>    
    <div class ="span2">
        <?php echo $form->labelEx($model,'isCopy'); ?>
        <div class="switch" data-on-label="Так" data-off-label="Ні">
        <?php echo $form->checkBox($model,'isCopy'); ?>
        </div>
    </div>  
     <div class ="span2">
        <?php  echo $form->labelEx($model,'isForeinghEntrantDocument'); ?>
        <div class="switch" data-on-label="Так" data-off-label="Ні">
            <?php echo $form->checkBox($model,'isForeinghEntrantDocument'); ?>
        </div>
    </div>
    <div class ="span3">
       <?php  echo $form->labelEx($model,'isNotCheckAttestat'); ?>
        <div class="switch" data-on-label="Так" data-off-label="Ні">
            <?php echo $form->checkBox($model,'isNotCheckAttestat'); ?>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class ="span6">
        <?php echo $form->labelEx($model,'PersonBaseSpecealityID'); ?>
        <?php echo $form->dropDownList($model, 'PersonBaseSpecealityID', Personbasespeciality::DropDown(),array('empty'=>"",'class'=>'span12')); ?>
    </div>   
    <div class="span3">
          <?php echo $form->labelEx($model,'PersonDocumentsAwardsTypesID'); ?>
          <?php echo $form->dropDownList($model,'PersonDocumentsAwardsTypesID', CHtml::listData(Persondocumentsawardstypes::model()->findAll(), 'idPersonDocumentsAwardsTypes', 'PersonDocumentsAwardsTypesName'),array('empty'=>'','class'=>'span12')); ?>
    </div>
</div>

    <script>
        $('#doc-form-modal .datepicker').datepicker({'format':'dd.mm.yyyy'});
        $('.datepicker').css("z-index","9999");
        $("#doc-form-modal .switch").bootstrapSwitch();
    </script>
<?php $this->endWidget(); ?>
</div>