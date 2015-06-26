<?php
/* @var $this DocumentsController 
 * @var $form CActiveForm
 */
//$form = new CActiveForm();
Yii::app()->clientScript->registerPackage('select2');
$formtype_url = Yii::app()->createUrl("documents/create", array("personid"=>$model->PersonID, "type"=>1)); 
?>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'doc-form-modal',
        'enableAjaxValidation' => false,
    ));
    echo $form->errorSummary($model);
    ?> 
    <?php
    echo $form->hiddenField($model, "PersonID");
    echo $form->hiddenField($model, "idDocuments");
    echo $form->hiddenField($model, "TypeID");
    ?> 
    <div class="row-fluid">
        <div class ="span12">
            <?php echo $form->labelEx($model, 'TypeID'); ?>
            <?php echo $form->dropDownList($model, 'TypeID', CHtml::listData(PersonDocumentTypes::model()->findAll(), 'idPersonDocumentTypes', 'PersonDocumentTypesName'), array(
                'onchange' => "PSN.changeDocType(this, '$formtype_url')", "disabled" => $model->isNewRecord ? "" : "disabled", 'class' => 'span12'));
            ?>
        </div> 
    </div>
    <div class="row-fluid">

        <div class ="span6">
            <?php echo $form->labelEx($model, 'CountryID'); ?>
<?php echo $form->dropDownList($model, 'CountryID', CHtml::listData(Country::model()->findAll(), 'idCountry', 'CountryName'), array("empty" => "", 'class' => 'span12')); ?>
        </div> 
    </div>    
    <div class="row-fluid">    
        <div class ="span4">
            <?php echo $form->labelEx($model, 'Series'); ?>
<?php echo $form->textField($model, 'Series', array('class' => 'span12')); ?>
        </div>   
        <div class ="span4">
            <?php echo $form->labelEx($model, 'Numbers'); ?>
<?php echo $form->textField($model, 'Numbers', array('class' => 'span12',)); ?>
        </div>    
        <div class ="span4">
            <?php echo $form->labelEx($model, 'DateGet'); ?>
<?php echo $form->textField($model, 'DateGet', array('class' => 'span12 datepicker')); ?>
        </div>

    </div>
    <div class="row-fluid">
        <div class ="span12">
            <?php echo $form->labelEx($model, 'Issued'); ?>
<?php echo $form->textArea($model, 'Issued', array('class' => 'span12')); ?>
        </div>
    </div>
    <script>
        $('#doc-form-modal .datepicker').datepicker({'format': 'dd.mm.yyyy'});
        $('.datepicker').css("z-index", "9999");
        $("#doc-form-modal .switch").bootstrapSwitch();
        $('#<?php echo CHtml::activeId($model, "PersonBaseSpecealityID"); ?>').select2({placeholder: "Обрати спеціальності", allowClear: true});
    </script>
<?php $this->endWidget(); ?>
</div>