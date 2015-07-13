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
        <div class="span4">
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


        <?php //if (Yii::app()->user->checkAccess("showFullEntrantForm")):  ?>

        <div class="span8">
            <div class="row-fluid">
                <?php if (Yii::app()->user->checkAccess("showFullEntrantForm")): ?>
                    <div class="span4 line-radio">


                        <?php echo $form->labelEx($model, 'isHigherEducation'); ?>
                        <?php echo $form->dropDownList($model, 'isHigherEducation', array(0 => 'не отримую', 1 => 'отримую', 2 => "є", 3 => 'немає')); ?>  


                    </div>
                    <div class="span2">
                        <?php echo $form->labelEx($model, 'BaseEducationFormID'); ?>
                        <?php echo $form->dropDownList($model, 'BaseEducationFormID', CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm', 'PersonEducationFormName'), array('empty' => '', 'class' => "span12")); ?>
                    </div>
                    <div class="span2">
                        <?php echo $form->labelEx($model, 'BasePaymentTypeID'); ?>
                        <?php echo $form->dropDownList($model, 'BasePaymentTypeID', CHtml::listData(Personeducationpaymenttypes::model()->findAll(), 'idEducationPaymentTypes', 'EducationPaymentTypesName'), array('empty' => '', 'class' => "span12")); ?>
                    </div>
                <?php endif; ?>
                <?php if (Yii::app()->user->checkAccess("showSpecEdboID")): ?>
                    <div class="span2">
                        <?php echo $form->labelEx($model, 'edboID'); ?>
                        <?php echo $form->textField($model, 'edboID', array('class' => "span12")); ?>
                        <?php //echo $form->error($model,'AdditionalBall'); ?>
                    </div>
                <?php endif; ?>

                <?php if (Yii::app()->user->checkAccess("showSpecStatus")): ?>
                    <?php $access = Yii::app()->user->checkAccess("editSpecStatus") ? "" : "disabled"; ?>
                    <div class="span2">
                        <?php echo $form->labelEx($model, 'StatusID'); ?>
                        <?php echo $form->dropDownList($model, 'StatusID', CHtml::listData(Personrequeststatustypes::model()->findAll(), "idPersonRequestStatusType", "PersonRequestStatusTypeName"), array('empty' => "", 'class' => "span12", 'disabled' => $access));
                        ?>

                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="span1 priority-holder">
            <?php echo $form->hiddenField($model,'priority'); ?>
            <?php echo $form->labelEx($model, 'priority'); ?>
            <?php
            $priority_data = array();
            for ($i = 0; $i <= 15; $i++)
                $priority_data[$i] = $i;
            echo $form->dropDownList($model, 'priority', $priority_data, array('class' => 'span12', "id"=>"priority-select",
                'disabled' => !empty($model->edboID)));
            ?>
            <?php //echo $form->error($model,'CourseID');   ?>
        </div>
        <div class="span5">
            <?php echo $form->labelEx($model, 'EntrantDocumentID'); ?>
            <?php
            echo $form->dropDownList($model, 'EntrantDocumentID', Documents::PersonEntrantDocuments($personid), array('class' => 'span12',
                'disabled' => !$model->isNewRecord,));
            ?>
            <?php //echo $form->error($model,'CourseID');   ?>
        </div>
        <div class="span4">
            <div class="row-fluid">
                <div class="span4">
                    <?php echo $form->labelEx($model, 'isCopyEntrantDoc'); ?>
                    <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model, 'isCopyEntrantDoc'); ?>
                    </div>
                    <?php //echo $form->error($model,'isCopyEntrantDoc');   ?>
                </div>

                <?php if (Yii::app()->user->checkAccess("showSpecEmptyBall")): ?>
                    <div class="span4">
                        <?php echo $form->labelEx($model, 'SkipDocumentValue'); ?>
                        <div class="switch" data-on-label="Так" data-off-label="Ні">
                            <?php echo $form->checkBox($model, 'SkipDocumentValue'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (Yii::app()->user->checkAccess("showSpecEdboRequest")): ?>
                    <div class="span4">
                        <?php echo $form->labelEx($model, 'RequestFromEB'); ?>
                        <div class="switch" data-on-label="Так" data-off-label="Ні">
                            <?php echo $form->checkBox($model, 'RequestFromEB'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="span2">
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
        <div class="span2">
            <?php echo $form->labelEx($model, 'CourseID'); ?>
            <?php
            echo $form->dropDownList($model, 'CourseID', CHtml::listData(Courses::model()->findAll(), 'idCourse', 'CourseName'), array('empty' => '', 'class' => 'span12',
                'disabled' => !$model->isNewRecord || Yii::app()->user->isPkSet("CourseID")));
            ?>
            <?php //echo $form->error($model,'CourseID');    ?>
        </div>
        <div class="span2">
            <?php echo $form->labelEx($model, 'EducationFormID'); ?>
            <?php
            echo $form->dropDownList($model, 'EducationFormID', CHtml::listData(Personeducationforms::model()->findAll(""), 'idPersonEducationForm', 'PersonEducationFormName'), array('empty' => '', 'class' => "span12",
                'disabled' => !$model->isNewRecord,
                'onchange' => "PSN.onFacChange(this, '#" . CHtml::activeId($model, "SepcialityID") . "','" . CController::createUrl('personspeciality/speciality') . "');"));
            ?>
            <?php //echo $form->error($model,'EducationFormID');     ?>
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
        <div class="span4">
            <?php
            $url = Yii::app()->createUrl("personspeciality/znosubjects", array("personid" => $personid));
            echo $form->labelEx($model, 'SepcialityID');
            ?>
            <?php
            echo $form->dropDownList($model, 'SepcialityID', Specialities::DropDownMask($idFacultet, $model->EducationFormID, $model->QualificationID), array('empty' => '', 'class' => "span12",
                'disabled' => !$model->isNewRecord,
                'onchange' => "PSN.changeSpeciality(this, '$url')"));
            ?>
            <?php ?>
        </div>

    </div>

    <div class="row-fluid">

        <div class="span2">
            <?php echo $form->labelEx($model, 'QualificationID'); ?>
            <?php
            if ($model->isNewRecord && Yii::app()->user->isPkSet("QualificationID")) {
                $model->QualificationID = Yii::app()->user->isPkSet("QualificationID");
            }
            echo $form->dropDownList($model, 'QualificationID', CHtml::listData(Qualifications::model()->findAll("idQualification = 1"), 'idQualification', 'QualificationName'), array('empty' => '',
                'disabled' => !$model->isNewRecord || Yii::app()->user->isPkSet("QualificationID"),
                'class' => "span12",
                'id' => "QualificationID",
                'onchange' => "PSN.onFacChange(this, '#" . CHtml::activeId($model, "SepcialityID") . "','" . CController::createUrl('personspeciality/speciality') . "');")
            );
            ?>
            <?php //echo $form->error($model,'QualificationID');     ?>
        </div>

        <div class="span4">
            <?php
            if (empty($model->EntranceTypeID)) {
                $model->EntranceTypeID = 1;
            }
            $url1 = Yii::app()->createUrl("personspeciality/entrance");
            echo $form->labelEx($model, 'EntranceTypeID');
            ?>
            <?php echo $form->dropDownList($model, 'EntranceTypeID', CHtml::listData(Personenterancetypes::model()->findAll(), 'idPersonEnteranceType', 'PersonEnteranceTypeName'), array('empty' => '', 'class' => "span12", 'onchange' => "PSN.changeEntranceType(this, '$url', '$url1' )",));
            ?>
            <?php //echo $form->error($model,'EntranceTypeID');      ?>
        </div>

        <div class="span6">
            <?php echo $form->labelEx($model, 'CausalityID'); ?>
            <?php
            echo $form->dropDownList($model, 'CausalityID', CHtml::listData(Causality::model()->findAll("PersonEnteranceTypeID = {$model->EntranceTypeID}"), 'idCausality', 'CausalityName'), array('empty' => '', 'class' => "span12 causality",
                "disabled" => $model->EntranceTypeID == 1 ? "disabled" : ""));
            ?>
            <?php //echo $form->error($model,'CausalityID');     ?>
        </div>


    </div>
    <?php if (Yii::app()->user->checkAccess("showSpecAddBall")): ?>
        <?php $access = Yii::app()->user->checkAccess("editSpecAddBall") ? "" : "disabled"; ?>
        <div class="row-fluid">
            <div class="span2">
                <?php echo $form->labelEx($model, 'AdditionalBall'); ?>
                <?php echo $form->textField($model, 'AdditionalBall', array('class' => "span12", "disabled" => $access)); ?>
                <?php //echo $form->error($model,'AdditionalBall');     ?>
            </div>
            <div class="span10">
                <?php echo $form->labelEx($model, 'AdditionalBallComment'); ?>
                <?php echo $form->textField($model, 'AdditionalBallComment', array('class' => "span12", "disabled" => $access)); ?>
                <?php //echo $form->error($model,'AdditionalBall');      ?>
            </div>
        </div>
    <?php endif; ?>
    <!-- ZNO -->	
    <div class="row-fluid" id="subjects-holder">
        <?php $this->renderPartial("_subjects_holder", array("model" => $model, 'specialityid' => $model->SepcialityID)); ?>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="span6">    

            <div class="row-fluid">
                <div class="span8">
                    <?php echo $form->labelEx($model, 'CoursedpID'); ?>
                    <?php echo $form->dropDownList($model, 'CoursedpID', CHtml::listData(Coursedp::model()->findAll(), "idCourseDP", "CourseDPName"), array('empty' => "", 'class' => "span12")); ?>
                    <?php //echo $form->error($model,'CoursedpID');      ?>
                </div>
                <div class="span4">
                    <?php echo $form->labelEx($model, 'CoursedpBall'); ?>
                    <?php echo $form->textField($model, 'CoursedpBall', array('class' => "span12")); ?>
                    <?php //echo $form->error($model,'AdditionalBall');     ?>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <?php //echo $form->labelEx($model, 'CoursedpDocument'); ?>
                    <?php echo $form->textField($model, 'CoursedpDocument', array('class' => "span12", "placeholder" => $model->getAttributeLabel("CoursedpDocument"))); ?>
                    <?php //echo $form->error($model,'AdditionalBall');     ?>
                </div>
            </div>


            <div class="row-fluid">
                <?php if (Yii::app()->user->checkAccess("showSpecOlimpiada")): ?>
                    <div class="span12">
                        <?php echo $form->labelEx($model, 'OlympiadID'); ?>
                        <?php echo $form->dropDownList($model, 'OlympiadID', Olympiadsawards::DropDown(), array('empty' => "", 'class' => "span12")); ?>
                        <?php //echo $form->error($model,'CoursedpID');   ?>
                    </div>
                <?php endif; ?>
                <!--<div class="span3">
                <?php echo $form->labelEx($model, 'Quota1'); ?>
                     <div class="switch" data-on-label="Так" data-off-label="Ні">
                <?php echo $form->checkBox($model, 'Quota1'); ?>
                     </div>
                <?php //echo $form->error($model,'isContact');       ?>
                </div>
                <div class="span3">
                <?php echo $form->labelEx($model, 'Quota2'); ?>
                     <div class="switch" data-on-label="Так" data-off-label="Ні">
                <?php echo $form->checkBox($model, 'Quota2'); ?>
                     </div>
                <?php //echo $form->error($model,'isContact');      ?>
                </div>-->

            </div> 
            <?php if (Yii::app()->user->checkAccess("showSpecQuota")): ?>
                <div class="row-fluid">
                    <div class="span12">
                        <?php echo $form->labelEx($model, 'QuotaID'); ?>
                        <?php echo $form->dropDownList($model, 'QuotaID', CHtml::listData(Quota::model()->findAll(), "idQuota", "QuotaName"), array('empty' => "", 'class' => "span12")); ?>
                    </div>
                </div>
            <?php endif; ?>


        </div>
        <div class="span6">
            <?php if (Yii::app()->user->checkAccess("showBenefits")): ?>
                <div class="row-fluid">
                    <?php echo $form->labelEx($model, 'benefits'); ?>
                    <?php
                    echo $form->dropDownList($model, 'benefits', CHtml::listData(Personbenefits::model()->findAll("PersonID = {$model->PersonID}"), "idPersonBenefits", "benefit.BenefitName"), array('empty' => "", 'style' => "width: 100%;", "multiple" => "multiple"));
                    ?>
                </div>
            <?php endif; ?>      
        </div>

    </div>    
    <!--
            
            <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
            </div>
    --> 

    <?php $this->endWidget(); ?>
    <script>
        $("#spec-form-modal .switch").bootstrapSwitch();
        $('#<?php echo CHtml::activeId($model, "benefits"); ?>').select2({placeholder: "Выбрать льготу", allowClear: true});
        //PSN.changeEntranceType($('#<?php echo CHtml::activeId($model, 'EntranceTypeID'); ?>').get(0));
    </script>

</div><!-- form -->
