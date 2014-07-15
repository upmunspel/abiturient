<?php
$burl = Yii::app()->baseUrl;
Yii::app()->clientScript->registerScriptFile($burl . "/js/bootstrap-datepicker.js");
Yii::app()->clientScript->registerScriptFile($burl."/js/person.js");
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'edebo-form',
    'enableAjaxValidation' => false,
        ));
$form = new TbActiveForm();
?>

<?php echo $form->errorSummary($model); ?>
<?php if (Yii::app()->user->hasFlash("message")){
    
} ?>
<b>Заявки які буде змінено:</b>
<hr />
<div class="row-fluid">
    <div class="span4">
        <?php echo $form->labelEx($model, 'StatusID'); ?>
        <?php echo $form->dropDownList($model, 'StatusID', CHtml::listData(Personrequeststatustypes::model()->findAll(), "idPersonRequestStatusType", "PersonRequestStatusTypeName"), array('empty' => "", 'class' => "span12")); ?>

    </div>
    <div class="span6">
        <?php echo $form->labelEx($model, 'QualificationID'); ?>
        <?php
        echo $form->dropDownList($model, 'QualificationID', CHtml::listData(Qualifications::model()->findAll(), 'idQualification', 'QualificationName'), array('class' => "span12", 'id' => "QualificationID",));
        ?>
        <?php //echo $form->error($model,'QualificationID');   ?>
    </div>
     <div class="span2">
        <?php echo $form->labelEx($model, 'Data'); ?>
        <?php
        echo $form->textField($model, 'Data',array('class' => "span12 datepicker", 'id' => "QualificationID",));
        ?>
        <?php //echo $form->error($model,'QualificationID');   ?>
    </div>
</div>
<b>На що буде змінено:</b>
<hr />
<div class="row-fluid">
<div class="span4">
        <?php echo $form->labelEx($model, 'NewStatusID'); ?>
        <?php echo $form->dropDownList($model, 'NewStatusID', CHtml::listData(Personrequeststatustypes::model()->findAll(), "idPersonRequestStatusType", "PersonRequestStatusTypeName"), array('empty' => "", 'class' => "span12")); ?>

    </div>
     <div class="span4">
        <?php echo $form->labelEx($model, 'Protocol'); ?>
        <?php
        echo $form->textField($model, 'Protocol',array('class' => "span12 ", 'id' => "QualificationID",));
        ?>
        <?php //echo $form->error($model,'QualificationID');   ?>
    </div>
     <div class="span4">
        <?php echo $form->labelEx($model, 'ProtocolData'); ?>
        <?php
        echo $form->textField($model, 'ProtocolData',array('class' => "span12 datepicker", 'id' => "QualificationID",));
        ?>
        <?php //echo $form->error($model,'QualificationID');   ?>
    </div>
    
</div>
<div class="row-fluid">
    <?php echo CHtml::submitButton('Знайти заявки'); ?>
</div>


<?php $this->endWidget(); ?>