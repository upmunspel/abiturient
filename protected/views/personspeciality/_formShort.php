<?php
/* @var $this PersonspecialityController */
/* @var $model Personspeciality */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $personid = $model->PersonID;
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'spec-form-modal',
        'enableAjaxValidation' => false,
    ));
    $form = new TbActiveForm();
    ?>

    <?php echo $form->errorSummary($model); ?>
    <?php echo CHtml::hiddenField('personid', $personid); ?>
    <?php
    //echo !$model->isNewRecord ? $form->hiddenField($model,'idSpeciality') : "";
    //debug($model->attributeLabels("isBudget"));
    ?>
    <div class="row-fluid">
        <div class="span5">
            <div class="row-fluid">
                <div class="span4">
                    <?php echo $form->labelEx($model, 'isBudget'); ?>
                    <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model, 'isBudget'); ?>
                    </div>
                </div>
                <div class="span4">
                    <?php echo $form->labelEx($model, 'isContract'); ?>
                    <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model, 'isContract'); ?>
                    </div>
                </div>

                <div class="span4">
                    <?php echo $form->labelEx($model, 'isNeedHostel'); ?>
                    <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model, 'isNeedHostel'); ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="span3">

            <label for="<?php echo CHtml::activeId($model, 'isHigherEducation'); ?>" >
                <?php echo $form->radioButtonListInlineRow($model, 'isHigherEducation', array(0 => 'не отримую', 1 => 'отримую', 2 => "є", 3 => 'немає')); ?>  
                <?php // Информация о высшем образовании персоны. echo $model->getAttributeLabel("isNeedHostel");  ?>
            </label>
        </div>
        <?php if (Yii::app()->user->checkAccess("showSpecStatus")): ?>
            <?php $access = Yii::app()->user->checkAccess("editSpecStatus") ? "" : "disabled"; ?>
            <div class="span2">
                <?php echo $form->labelEx($model, 'StatusID'); ?>
                <?php echo $form->dropDownList($model, 'StatusID', CHtml::listData(Personrequeststatustypes::model()->findAll(), "idPersonRequestStatusType", "PersonRequestStatusTypeName"), array('empty' => "", 'class' => "span12", 'disabled' => $access));
                ?>

            </div>
        <?php endif; ?>
        <?php if (Yii::app()->user->checkAccess("showSpecEdboID")): ?>
            <div class="span2">
                <?php echo $form->labelEx($model, 'edboID'); ?>
                <?php echo $form->textField($model, 'edboID', array('class' => "span12")); ?>
                <?php //echo $form->error($model,'AdditionalBall');  ?>
            </div>
        <?php endif; ?>
    </div>
    <hr>
    <!--     <div class="row-fluid">
                <div class="span12">
    <?php //echo $form->labelEx($model,'GraduatedSpeciality'); ?>
    <?php //echo $form->textField($model,'GraduatedSpeciality',  array('empty'=>'','class'=>'span12')); ?>
    <?php //echo $form->error($model,'CourseID');  ?>
                </div>
                <div class="span6">
    <?php //echo $form->labelEx($model,'GraduatedUniversitieID'); ?>
    <?php //echo $form->dropDownList($model,'GraduatedUniversitieID',  CHtml::listData(Universities::model()->findAll(), 'idUniversity', 'UniversityName'),array('empty'=>'','class'=>'span12')); ?>
    <?php //echo $form->error($model,'CourseID');  ?>
                </div>
                <div class="span6">
    <?php //echo $form->labelEx($model,'GraduatedSpecialitieID'); ?>
    <?php //echo $form->dropDownList($model,'GraduatedSpecialitieID',  Specialities::DropDown(), array('empty'=>'','class'=>'span12')); ?>
    <?php //echo $form->error($model,'CourseID');  ?>
                </div>
            </div>
        <hr>-->


    <div class="row-fluid">
        <div class="span5">
            <?php echo $form->labelEx($model, 'EntrantDocumentID'); ?>
            <?php
            echo $form->dropDownList($model, 'EntrantDocumentID', Documents::PersonEntrantDocuments($personid, 1), array('empty' => '', 'class' => 'span12',
                'disabled' => !$model->isNewRecord,
                'onchange' => "PSN.onFacChange(this, '#" . CHtml::activeId($model, "SepcialityID") . "','" . CController::createUrl('personspeciality/speciality') . "');"));
            ?>
            <?php //echo $form->error($model,'CourseID');  ?>
        </div>
        <div class="span4">
            <div class="row-fluid">
                <div class="span4">
                    <?php echo $form->labelEx($model, 'isCopyEntrantDoc'); ?>
                    <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model, 'isCopyEntrantDoc'); ?>
                    </div>
                    <?php //echo $form->error($model,'isCopyEntrantDoc'); ?>
                </div>
                <?php if (Yii::app()->user->checkAccess("showSpecEdboRequest")): ?>
                    <div class="span4">
                        <?php echo $form->labelEx($model, 'RequestFromEB'); ?>
                        <div class="switch" data-on-label="Так" data-off-label="Ні">
                            <?php echo $form->checkBox($model, 'RequestFromEB'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (Yii::app()->user->checkAccess("showSpecEmptyBall")): ?>
                    <div class="span4">
                        <?php echo $form->labelEx($model, 'SkipDocumentValue'); ?>
                        <div class="switch" data-on-label="Так" data-off-label="Ні">
                            <?php echo $form->checkBox($model, 'SkipDocumentValue'); ?>
                        </div>

                    </div>
                <?php endif; ?>

            </div>
        </div>

        <div class="span3">
            <?php if (Yii::app()->user->checkAccess("showSpecLanguage")): ?>
                <?php echo $form->labelEx($model, 'LanguageExID'); ?>
                <?php
                echo $form->dropDownList(
                        $model, 'LanguageExID', CHtml::listData(Languagesex::model()->findAll(), 'idLanguageEx', 'LanguageExName'), array('empty' => '',
                    'disabled' => !Yii::app()->user->checkAccess("editSpecLanguage") ? "disabled" : "",
                    'class' => 'span12')
                );
                ?>
            <?php endif; ?>
        </div>


    </div>
    <div class="row-fluid">
        <div class="span8">
            <div class="row-fluid">
                <div class="span2">
                    <?php echo $form->labelEx($model, 'CourseID'); ?>
                    <?php
                    echo $form->dropDownList($model, 'CourseID', CHtml::listData(Courses::model()->findAll(), 'idCourse', 'CourseName'), array('empty' => '', 'class' => 'span12',
                        'disabled' => !$model->isNewRecord || Yii::app()->user->isPkSet("CourseID")));
                    ?>
                    <?php //echo $form->error($model,'CourseID'); ?>
                </div>
                <div class="span3">
                    <?php
                    echo $form->hiddenField($model, 'QualificationID');
                    echo $form->labelEx($model, 'QualificationID');
                    ?>
                    <?php
                    echo $form->dropDownList($model, 'QualificationID', CHtml::listData(Qualifications::model()->findAll("idQualification = 2 or idQualification = 3"), 'idQualification', 'QualificationName'), array(//'empty'=>'', 
                        'disabled' => !$model->isNewRecord,
                        'class' => "span12",
                        'id' => "QualificationID",
                        'onchange' => "PSN.changeQType(this ,'" . CController::createUrl('personspeciality/create', array("personid" => $personid, "reload" => 1)) . "');")
                    );
                    ?>
                    <?php //echo $form->error($model,'QualificationID');  ?>
                </div>
                <div class="span3">
                    <?php echo $form->labelEx($model, 'EducationFormID'); ?>
                    <?php
                    echo $form->dropDownList($model, 'EducationFormID', CHtml::listData(Personeducationforms::model()->findAll("idPersonEducationForm in (1,2)"), 'idPersonEducationForm', 'PersonEducationFormName'), array('empty' => '', 'disabled' => !$model->isNewRecord,
                        'class' => "span12", 'onchange' => "PSN.onFacChange(this, '#" . CHtml::activeId($model, "SepcialityID") . "','" . CController::createUrl('personspeciality/speciality') . "');"));
                    ?>
                    <?php //echo $form->error($model,'EducationFormID');  ?>
                </div>
                <div class="span4">
                    <?php
                    if (empty($model->sepciality)) {
                        $idFacultet = 0;
                    } else {
                        $idFacultet = $model->sepciality->FacultetID;
                    }
                    echo CHtml::label("Факультет", "idFacultet")
                    ?>
                    <?php
                    echo CHtml::dropDownList('idFacultet', $idFacultet, CHtml::listData(Facultets::model()->findAll(array('order' => 'FacultetFullName')), 'idFacultet', 'FacultetFullName'), array('empty' => '',
                        'disabled' => !$model->isNewRecord,
                        'onchange' => "PSN.onFacChange(this, '#" . CHtml::activeId($model, "SepcialityID") . "','" . CController::createUrl('personspeciality/speciality') . "');",
                        'class' => "span12")
                    );
                    ?>
                </div>
            </div>
        </div>
        <div class="span4">
            <?php
            $url = Yii::app()->createUrl("personspeciality/znosubjects", array("personid" => $personid, "specid" => intval($model->idPersonSpeciality)));
            echo $form->labelEx($model, 'SepcialityID');
            ?>
            <?php
            if (!empty($model->EducationFormID) && !empty($model->QualificationID)) {
                echo $form->dropDownList($model, 'SepcialityID', Specialities::DropDownMask($idFacultet, $model->EducationFormID, $model->QualificationID), array('empty' => '', 'class' => "span12",
                    'disabled' => !$model->isNewRecord,
                        // 'onchange'=>"PSN.changeSpeciality(this, '$url')"
                ));
            } else {
                echo $form->dropDownList($model, 'SepcialityID', Specialities::DropDown($idFacultet), array('empty' => '', 'class' => "span12",
                    'disabled' => !$model->isNewRecord,
                        // 'onchange'=>"PSN.changeSpeciality(this, '$url')"
                ));
            }
            ?>
            <?php //echo $form->error($model,'SepcialityID');  ?>
        </div>
        <!--             <div class="span2">
        <?php //echo $form->labelEx($model,'PaymentTypeID');   ?>
        <?php
        //echo $form->dropDownList($model,'PaymentTypeID', CHtml::listData(Personeducationpaymenttypes::model()->findAll(), 'idEducationPaymentTypes', 'EducationPaymentTypesName'),
        //array( 'empty'=>'','class'=>"span12")); 
        ?>
        <?php //echo $form->error($model,'PaymentTypeID');   ?>
                    </div>-->

    </div>

    <?php if (Yii::app()->user->checkAccess("showSpecAddBall")): ?>
        <?php $access = Yii::app()->user->checkAccess("editSpecAddBall") ? "" : "disabled"; ?>
        <div class="row-fluid">
            <div class="span2">
                <?php echo $form->labelEx($model, 'AdditionalBall'); ?>
                <?php echo $form->textField($model, 'AdditionalBall', array('class' => "span12", "disabled" => $access)); ?>
                <?php //echo $form->error($model,'AdditionalBall'); ?>
            </div>
            <div class="span10">
                <?php echo $form->labelEx($model, 'AdditionalBallComment'); ?>
                <?php echo $form->textField($model, 'AdditionalBallComment', array('class' => "span12", "disabled" => $access)); ?>
                <?php //echo $form->error($model,'AdditionalBall'); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- ZNO / EXAMS -->	
    <div class="row-fluid" id="subjects-holder">
        <?php
        if (empty($model->Exam1ID)) {
            $model->Exam1ID = 40;
            $model->Exam2ID = 3;
        }
        if (empty($model->SepcialityID)) {
            $model->SepcialityID = 0;
        }
        $this->renderPartial("_subjects_holder_short", array("model" => $model, 'specialityid' => $model->SepcialityID));
        ?>
    </div>



    <?php if (Yii::app()->user->checkAccess("showBenefits")): ?>
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="row-fluid">
                    <?php echo $form->labelEx($model, 'benefits'); ?>
                    <?php
                    echo $form->dropDownList($model, 'benefits', CHtml::listData(Personbenefits::model()->findAll("PersonID = {$model->PersonID}"), "idPersonBenefits", "benefit.BenefitName"), array('empty' => "", 'style' => "width: 100%;", "multiple" => "multiple"));
                    ?>
                </div>

            </div>
        </div>
    <?php endif; ?>





    <!--
    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
    </div>
    --> 

    <?php $this->endWidget(); ?>
    <script>
        $("#spec-form-modal .switch").bootstrapSwitch();

        $('#<?php echo CHtml::activeId($model, "benefits"); ?>').select2({placeholder: "Выбрать льготу", allowClear: true});

    </script>

</div><!-- form -->
