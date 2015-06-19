<?php
/* @var $this StatementsController */
/* @var $model Statements */
/* @var $form CActiveForm */
?>
 <?php
    $burl = Yii::app()->baseUrl;
    Yii::app()->getClientScript()->registerCoreScript('jquery');
    Yii::app()->clientScript->registerScriptFile($burl . "/js/bootstrap-datepicker.js");
    Yii::app()->clientScript->registerScriptFile($burl . "/js/person.js");
    Yii::app()->clientScript->registerPackage('select2');
?>
<div class="form well">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'statements-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Поля з <span class="required">*</span> обов'язкові для заповнення.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row-fluid">
        <?php echo $form->labelEx($model, 'number'); ?>
        <?php echo $form->textField($model, 'number', array("class" => "span12", 'size' => 60, 'maxlength' => 100, 'readonly' => 'readonly')); ?>
        <?php echo $form->error($model, 'number'); ?>
    </div>
    <div class="row-fluid" >
         <div class ="span2">
            <?php echo $form->labelEx($model, 'EducationFormID'); ?>
            <?php echo $form->dropDownList($model, 'EducationFormID', CHtml::listData(Personeducationforms::model()->findAll(), "idPersonEducationForm", "PersonEducationFormName"), 
                    array('class' => 'span12', "id"=>"EducationFormID", 
                        'onchange'=>"PSN.changeFacultet(this,'".Yii::app()->createUrl("personspeciality/speciality")."')")); ?>
        </div>
         <div class ="span4">
            <?php echo $form->labelEx($model, 'FacultetID'); ?>
            <?php echo $form->dropDownList($model, 'FacultetID', CHtml::listData(Facultets::model()->findAll(), "idFacultet", "FacultetFullName"), 
                    array('class' => 'span12', "id"=>"FacultetID", 'empty'=>"",
                        'onchange'=>"PSN.changeFacultet(this,'".Yii::app()->createUrl("personspeciality/speciality")."')")); ?>
        </div>
        <div class ="span6">
            <?php echo $form->labelEx($model, 'SpecialityID'); ?>
            <?php echo $form->dropDownList($model, 'SpecialityID', Specialities::DropDownMask($model->FacultetID, 1, 1, ""), array('class' => 'span12',"id"=>"idPreuniGroup")); ?>
        </div>
    </div>
    

    <div class="row-fluid">

        <div class='span4'>
            <?php echo $form->labelEx($model, 'Subjects1ID'); ?>
            <?php echo $form->dropDownList($model, 'Subjects1ID', Subjects::DropDown(), array("class" => "span12")); ?>
            <?php //echo $form->error($model, 'Subjects1ID'); ?>
        </div>
        <div class='span4'>
            <?php echo $form->labelEx($model, 'Subjects2ID'); ?>
            <?php echo $form->dropDownList($model, 'Subjects2ID', Subjects::DropDown(), array("class" => "span12")); ?>
            <?php //echo $form->error($model, 'Subjects2ID'); ?>
        </div>
        <div class="span4">
            <?php echo $form->labelEx($model, 'Subjects3ID'); ?>
            <?php echo $form->dropDownList($model, 'Subjects3ID', Subjects::DropDown(), array("class" => "span12")); ?>
            <?php //echo $form->error($model, 'Subjects3ID'); ?>
        </div>
    </div>
    <div class="row-fluid">

        <div class='span4'>
            <?php echo $form->labelEx($model, 'SubjectsDate1'); ?>
            <?php echo $form->textField($model, 'SubjectsDate1', array("class" => "span12 datepicker")); ?>
            <?php //echo //$form->error($model, 'SubjectsDate1'); ?>
        </div>
        <div class='span4'>
            <?php echo $form->labelEx($model, 'SubjectsDate2'); ?>
            <?php echo $form->textField($model, 'SubjectsDate2', array("class" => "span12 datepicker")); ?>
            <?php //echo //$form->error($model, 'SubjectsDate2'); ?>
        </div>
        <div class='span4'>
            <?php echo $form->labelEx($model, 'SubjectsDate3'); ?>
            <?php echo $form->textField($model, 'SubjectsDate3',  array("class" => "span12 datepicker")); ?>
            <?php // echo $form->error($model, 'SubjectsDate3'); ?>
        </div>
    </div>
   <hr />

    <div class="row-fluid buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти',array('class'=>"btn btn-primary btn-large")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->