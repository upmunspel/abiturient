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
            <?php echo $form->dropDownList($model, 'TypeID', CHtml::listData(PersonDocumentTypes::model()->findAll("display = 1"), 'idPersonDocumentTypes', 'PersonDocumentTypesName'), array(
                'onchange' => "PSN.changeDocType(this, '$formtype_url')", "disabled" => $model->isNewRecord ? "" : "disabled", 'class' => 'span12'));
            ?>
        </div> 
    </div>
    <div class="row-fluid">
        <div class ="span6">
            <?php echo $form->labelEx($model, 'CopyType'); ?>
<?php echo $form->dropDownList($model, 'CopyType', array("" => "", "Фотокомп'ютерні" => "Фотокомп'ютерні", "Поліграфічні" => "Поліграфічні"), array('class' => 'span12')); ?>
        </div> 
        <div class ="span6">
            <?php echo $form->labelEx($model, 'CountryID'); ?>
<?php echo $form->dropDownList($model, 'CountryID', CHtml::listData(Country::model()->findAll(), 'idCountry', 'CountryName'), array("empty" => "", 'class' => 'span12')); ?>
        </div> 
    </div>    
    <div class="row-fluid">    
        <div class ="span3">
            <?php echo $form->labelEx($model, 'Series'); ?>
<?php echo $form->textField($model, 'Series', array('class' => 'span12')); ?>
        </div>   
        <div class ="span3">
            <?php echo $form->labelEx($model, 'Numbers'); ?>
<?php echo $form->textField($model, 'Numbers', array('class' => 'span12',)); ?>
        </div>    
        <div class ="span3">
            <?php echo $form->labelEx($model, 'DateGet'); ?>
<?php echo $form->textField($model, 'DateGet', array('class' => 'span12 datepicker')); ?>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'PersonDocumentsAwardsTypesID'); ?>
            <?php echo $form->dropDownList($model, 'PersonDocumentsAwardsTypesID', CHtml::listData(Persondocumentsawardstypes::model()->findAll("idPersonDocumentsAwardsTypes = 3"), 'idPersonDocumentsAwardsTypes', 'PersonDocumentsAwardsTypesName'), array('empty' => '', 'class' => 'span12', 'style' => "width: 100%;"));
            ?>
        </div>

    </div>
    <div class="row-fluid">
        <div class ="span12">
            <?php echo $form->labelEx($model, 'Issued'); ?>
<?php echo $form->textArea($model, 'Issued', array('class' => 'span12')); ?>
        </div>
    </div>


    <div class="row-fluid">
        <div class ="span2">
            <?php echo $form->labelEx($model, 'AtestatValue'); ?>

            <?php
            if ($model->isNewRecord || Yii::app()->user->checkAccess("editAtestatValue") ) {
                echo $form->textField($model, 'AtestatValue', array('class' => 'span12'));
            } else {
                echo $form->textField($model, 'AtestatValue', array('class' => 'span12', 'readonly' => 'readonly'));
            }
            ?>
        </div>    
        <div class ="span2">
                <?php echo $form->labelEx($model, 'isCopy'); ?>
            <div class="switch" data-on-label="Так" data-off-label="Ні">
<?php echo $form->checkBox($model, 'isCopy'); ?>
            </div>
        </div>  
        <div class ="span2">
                <?php echo $form->labelEx($model, 'isForeinghEntrantDocument'); ?>
            <div class="switch" data-on-label="Так" data-off-label="Ні">
<?php echo $form->checkBox($model, 'isForeinghEntrantDocument'); ?>
            </div>
        </div>
        <div class ="span3">
                <?php echo $form->labelEx($model, 'isNotCheckAttestat'); ?>
            <div class="switch" data-on-label="Так" data-off-label="Ні">
<?php echo $form->checkBox($model, 'isNotCheckAttestat'); ?>
            </div>
        </div>
    </div>

    <p class="help-block"><strong>Попередня освіта</strong></p>
    <hr> 
    <div class="row-fluid" >
        <div class ="span3">
            <?php echo $form->labelEx($model, 'GraduatedYear'); ?>
<?php echo $form->textField($model, 'GraduatedYear', array('class' => 'span12',)); ?>
        </div>  
        <div class ="span3">
            <?php echo $form->labelEx($model, 'SpecKode'); ?>
<?php echo $form->textField($model, 'SpecKode', array('class' => 'span12',)); ?>
        </div>  
        <div class ="span6">
            <?php echo $form->labelEx($model, 'SpecName'); ?>
<?php echo $form->textField($model, 'SpecName', array('class' => 'span12',)); ?>
        </div> 
    </div>

    <div class="row-fluid" >
        <div class ="span12">
            <?php echo $form->labelEx($model, 'SpecQualification'); ?>
<?php echo $form->textArea($model, 'SpecQualification', array('class' => 'span12',)); ?>
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