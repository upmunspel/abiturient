<?php
/* @var $this PersonspecialityController */
/* @var $model Personspeciality */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
$personid= $model->PersonID;
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'spec-form-modal',
	'enableAjaxValidation'=>false,
)); 
$form= new TbActiveForm();
?>

	<?php echo $form->errorSummary($model); ?>
        <?php echo CHtml::hiddenField('personid', $personid); ?>
        <?php //echo !$model->isNewRecord ? $form->hiddenField($model,'idSpeciality') : "";
        //debug($model->attributeLabels("isBudget"));
        ?>
        <div class="row-fluid">
            <div class="span2">
                
                <label for="<?php echo CHtml::activeId($model, 'isBudget'); ?>" >
                    <?php echo $form->checkBox($model,'isBudget'); ?>
                    <?php echo $model->getAttributeLabel("isBudget"); ?>
                </label>
            </div>
            <div class="span2">
                
                <label for="<?php echo CHtml::activeId($model, 'isContract'); ?>" >
                    <?php echo $form->checkBox($model,'isContract'); ?>
                    <?php echo $model->getAttributeLabel("isContract"); ?>
                </label>
            </div>
            <div class="span3">
                
                <label for="<?php echo CHtml::activeId($model, 'isNeedHostel'); ?>" >
                    <?php echo $form->checkBox($model,'isNeedHostel'); ?>
                    <?php echo $model->getAttributeLabel("isNeedHostel"); ?>
                </label>
            </div>
            <div class="span5">
                
                <label for="<?php echo CHtml::activeId($model, 'isHigherEducation'); ?>" >
                    <?php echo $form->radioButtonListInlineRow($model,'isHigherEducation',array(0=>'не отримую', 1=>'не вказано', 2=>"є",3=>'немає')); ?>  
                    <?php // Информация о высшем образовании персоны. echo $model->getAttributeLabel("isNeedHostel"); ?>
                </label>
            </div>
        </div>
    <hr>
        <div class="row-fluid">
             <div class="span6">
		<?php echo $form->labelEx($model,'EntrantDocumentID'); ?>
		<?php echo $form->dropDownList($model,'EntrantDocumentID', Documents::PersonEntrantDocuments($personid),array('empty'=>'','class'=>'span12')); ?>
		<?php //echo $form->error($model,'CourseID'); ?>
            </div>
            <div class="span6">
                 <?php echo $form->labelEx($model,'SkipDocumentValue'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'SkipDocumentValue'); ?>
                 </div>
                
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2">
		<?php echo $form->labelEx($model,'CourseID'); ?>
		<?php echo $form->dropDownList($model,'CourseID', CHtml::listData(Courses::model()->findAll(), 'idCourse', 'CourseName'),array('empty'=>'','class'=>'span12')); ?>
		<?php //echo $form->error($model,'CourseID'); ?>
            </div>
            <div class="span4">
                <?php if (empty($model->sepciality)) {
                        $idFacultet = 0;
                      } else {
                         $idFacultet= $model->sepciality->FacultetID;
                      }
                      echo CHtml::label("Факультет", "idFacultet")?>
                <?php echo CHtml::dropDownList('idFacultet', $idFacultet , CHtml::listData(Facultets::model()->findAll(array('order'=>'FacultetFullName')),'idFacultet','FacultetFullName'),
                        array('empty'=>'','onchange'=>"PSN.onFacChange(this, '#".CHtml::activeId($model, "SepcialityID")."','".CController::createUrl('personspeciality/speciality')."');",
                        'class'=>"span12")
                      );
                ?>
            </div>
            <div class="span2">
                <?php $url = Yii::app()->createUrl("personspeciality/znosubjects",array("personid"=>$personid,"specid"=>intval($model->idPersonSpeciality)));
                      echo $form->labelEx($model,'SepcialityID'); ?>
		<?php echo $form->dropDownList($model,'SepcialityID', Specialities::DropDownMask($idFacultet),
                        array( 'empty'=>'','class'=>"span12",
                            'onchange'=>"PSN.changeSpeciality(this, '$url')") ); ?>
		<?php //echo $form->error($model,'SepcialityID'); ?>
            </div>
<!--             <div class="span2">
		<?php //echo $form->labelEx($model,'PaymentTypeID'); ?>
		<?php //echo $form->dropDownList($model,'PaymentTypeID', CHtml::listData(Personeducationpaymenttypes::model()->findAll(), 'idEducationPaymentTypes', 'EducationPaymentTypesName'),
                                //array( 'empty'=>'','class'=>"span12")); ?>
		<?php //echo $form->error($model,'PaymentTypeID'); ?>
            </div>-->
            <div class="span2">
		<?php echo $form->labelEx($model,'EducationFormID'); ?>
		<?php echo $form->dropDownList($model,'EducationFormID',CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm', 'PersonEducationFormName'),array('empty'=>'', 'class'=>"span12")); ?>
		<?php //echo $form->error($model,'EducationFormID'); ?>
            </div>
        </div>
	
        <div class="row-fluid">
           
            <div class="span2">
		<?php echo $form->labelEx($model,'QualificationID'); ?>
		<?php echo $form->dropDownList($model,'QualificationID',CHtml::listData(Qualifications::model()->findAll(), 'idQualification', 'QualificationName'),array('empty'=>'', 'class'=>"span12")); ?>
		<?php //echo $form->error($model,'QualificationID'); ?>
            </div>
            
            <div class="span4">
                    <?php echo $form->labelEx($model,'EntranceTypeID'); ?>
                    <?php echo $form->dropDownList($model,'EntranceTypeID',CHtml::listData(Personenterancetypes::model()->findAll(), 'idPersonEnteranceType', 'PersonEnteranceTypeName'),
                            array('empty'=>'', 'class'=>"span12",'onchange'=>"PSN.changeEntranceType(this)", )); ?>
                    <?php //echo $form->error($model,'EntranceTypeID'); ?>
            </div>
            
            <div class="span6">
                    <?php echo $form->labelEx($model,'CausalityID'); ?>
                    <?php echo $form->dropDownList($model,'CausalityID', CHtml::listData(Causality::model()->findAll(), 'idCausality', 'CausalityName'),
                            array('empty'=>'', 'class'=>"span12 causality",
                                "disabled"=>$model->EntranceTypeID == 1 ? "disabled":"")); ?>
                    <?php //echo $form->error($model,'CausalityID'); ?>
            </div>

		
	</div>
    
        <div class="row-fluid">
            <div class="span2">
                 <?php echo $form->labelEx($model,'isTarget'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isTarget'); ?>
                 </div>
                 <?php //echo $form->error($model,'isTarget'); ?>
            </div>

<!--            <div class="span2">
                    <?php // echo //$form->labelEx($model,'isContact'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php // echo //$form->checkBox($model,'isContact'); ?>
                 </div>
                    <?php //echo $form->error($model,'isContact'); ?>
            </div>-->
            <div class="span2">
                    <?php echo $form->labelEx($model,'isCopyEntrantDoc'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isCopyEntrantDoc'); ?>
                 </div>
                    <?php //echo $form->error($model,'isCopyEntrantDoc'); ?>
            </div>
            <div class="span2">
                    <?php echo $form->labelEx($model,'AdditionalBall'); ?>
                    <?php echo $form->textField($model,'AdditionalBall',array('class'=>"span12")); ?>
                    <?php //echo $form->error($model,'AdditionalBall'); ?>
            </div>
            <div class="span6">
                    <?php echo $form->labelEx($model,'AdditionalBallComment'); ?>
                    <?php echo $form->textField($model,'AdditionalBallComment',array('class'=>"span12")); ?>
                    <?php //echo $form->error($model,'AdditionalBall'); ?>
            </div>
        </div>
    <!-- ZNO -->	
    <div class="row-fluid" id="subjects-holder">
       <?php $this->renderPartial("_subjects_holder", array("model"=>$model,'specialityid'=>$model->SepcialityID)); ?>
    </div>
	
<!--
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>
   --> 

<?php $this->endWidget();?>
    <script>
        $("#spec-form-modal .switch").bootstrapSwitch();
        //PSN.changeEntranceType($('#<?php echo CHtml::activeId($model, 'EntranceTypeID');?>').get(0));
    </script>

</div><!-- form -->
