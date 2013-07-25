<?php
/* @var $this PricesController */
/* @var $model Prices */
/* @var $form CActiveForm */
?>
<div class="form well">
    <?php
    /* ini_set('error_reporting', E_ERROR);
      ini_set('display_errors', 'Off'); */
    $burl = Yii::app()->baseUrl;
    Yii::app()->getClientScript()->registerCoreScript('jquery');
    Yii::app()->clientScript->registerScriptFile($burl . "/js/bootstrap-datepicker.js");
    Yii::app()->clientScript->registerScriptFile($burl . "/js/price.js");
    ?>
    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'prices-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

        <?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
        <div class="row-fluid">

            <div class="span2">
                <?php
                $Qualification = 0;
                echo CHtml::label("Кваліфікація", "QualificationID")
                ?>
                <?php
                echo CHtml::dropDownList('QualificationID', $Qualification, CHtml::listData(Qualifications::model()->findAll(), 'idQualification', 'QualificationName'), array('empty' => '', 'class' => "span12",
                    'disabled' => !$model->isNewRecord,
                    'onchange' => "PSN.onFacChanges(this, '#" . CHtml::activeId($model, "QualificationID") . "','" . CController::createUrl('personspeciality/specialitys') . "');",
                        //Yii::app()->user->isPkSet("QualificationID")
                ));
                ?>
<?php //echo $form->error($model,'QualificationID');  ?>
            </div>
            <div class="span2">
                <?php
                $idEducationForm = 0;
                echo CHtml::label("Форма навчання ", "idEducationForm")
                ?>   
                <?php
                echo CHtml::dropDownList('idEducationForm', $idEducationForm, CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm', 'PersonEducationFormName'), array('empty' => '',
                    'disabled' => !$model->isNewRecord,
                    'onchange' => "PSN.onFacChanges(this, '#" . CHtml::activeId($model, "SpecialityID") . "','" . CController::createUrl('personspeciality/specialitys') . "');",
                    'class' => "span12")
                );
                ?>
            </div>
            <div class ="span3">
                <?php
                if (empty($model->sepciality)) {
                    $idFacultet = 0;
                } else {
                    $idFacultet = $model->sepciality->FacultetID;
                }
                echo CHtml::label("Факультет", "idFacultet")
                ?>
                <?php
                echo CHtml::dropDownList('idFacultet', $idFacultet, CHtml::listData(Facultets::model()->findAll(), 'idFacultet', 'FacultetFullName'), array('empty' => '',
                    'disabled' => !$model->isNewRecord,
                    'onchange' => "PSN.onFacChanges(this, '#" . CHtml::activeId($model, "SpecialityID") . "','" . CController::createUrl('personspeciality/specialitys') . "');",
                    'class' => "span12")
                );
                ?>
            </div>
            <div class ="span5">
                
                <?php 
                $personid=0;
                $url = Yii::app()->createUrl("personspeciality/znosubjects", array($personid));
                echo $form->labelEx($model, 'SpecialityID');
                ?>
            <?php
            echo $form->dropDownList($model, 'SpecialityID', Specialities::DropDown($idFacultet,$Qualification), array('empty' => '', 'class' => "span12",
                'disabled' => !$model->isNewRecord,
                'onchange' => "PSN.changeSpeciality(this, '$url')"));
            ?>
                <?php //echo $form->error($model,'SepcialityID'); ?>
            </div>
        </div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
        <div class="row-fluid">
            <div class ="span3">
                <?php echo $form->labelEx($model, 'PriceYearInNumbers'); ?>
                <?php echo $form->textField($model, 'PriceYearInNumbers', array('class' => 'span12')); ?>
<?php echo $form->error($model, 'PriceYearInNumbers'); ?>
            </div>
            <div class ="span3">
<?php echo $form->labelEx($model, 'PriceSemesterInNumbers'); ?>
                <?php echo $form->textField($model, 'PriceSemesterInNumbers', array('class' => 'span12')); ?>
                <?php echo $form->error($model, 'PriceSemesterInNumbers'); ?>
            </div>
        <div class ="span6">
        <?php echo $form->labelEx($model,'EducationalServices');//,array('class'=>'span3'));?>
        <?php echo $form->textField($model,'EducationalServices',array('class'=>'span12')); ?>
        <?php echo $form->error($model,'EducationalServices'); ?>    
        </div>
        </div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
        <div class="row-fluid">
            <div class ="span12">
            <?php echo $form->labelEx($model, 'PriceYearInWords'); ?>
            <?php echo $form->textField($model, 'PriceYearInWords', array('class' => 'span12', 'size' => 60, 'maxlength' => 250)); ?>
            <?php echo $form->error($model, 'PriceYearInWords'); ?>
            </div>
        </div>
        <hr>    
        <div class="row-fluid">
            <?php
            $this->widget("bootstrap.widgets.TbButton", array(
                'buttonType' => 'submit',
                'type' => 'primary',
                "size" => "null",
                'label' => $model->isNewRecord ? 'Створити' : 'Зберегти',
            ));
            ?>
        </div>

<?php $this->endWidget(); ?>
    </div>
</div><!-- form -->