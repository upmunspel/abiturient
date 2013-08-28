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
                 <?php echo $form->labelEx($model,'isBudget'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isBudget'); ?>
                 </div>
                
                
            </div>
            <div class="span2">
                 <?php echo $form->labelEx($model,'isContract'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isContract'); ?>
                 </div>
            </div>
            <div class="span3">
                <?php echo $form->labelEx($model,'isNeedHostel'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isNeedHostel'); ?>
                 </div>
            </div>
            <?php //if (Yii::app()->user->checkAccess("showFullEntrantForm")): ?>
            <div class="span4">
                
                <label for="<?php echo CHtml::activeId($model, 'isHigherEducation'); ?>" >
                    <?php echo $form->radioButtonListInlineRow($model,'isHigherEducation',array(0=>'не отримую', 1=>'отримую' , 2=>"є",3=>'немає')); ?>  
                    <?php // Информация о высшем образовании персоны. echo $model->getAttributeLabel("isNeedHostel"); ?>
                </label>
                
            </div>
            
            <div class="span1">
                    <?php echo $form->labelEx($model,'edboID'); ?>
                    <?php echo $form->textField($model,'edboID',array('class'=>"span12")); ?>
                    <?php //echo $form->error($model,'AdditionalBall'); ?>
            </div>
            <?php //endif; ?>
        </div>
    <hr>
        <div class="row-fluid">
            <div class="span5">
		<?php echo $form->labelEx($model,'EntrantDocumentID'); ?>
		<?php echo $form->dropDownList($model,'EntrantDocumentID', Documents::PersonEntrantDocuments($personid),array('class'=>'span12')); ?>
		<?php //echo $form->error($model,'CourseID'); ?>
            </div>
           
            <div class="span2">
                    <?php echo $form->labelEx($model,'isCopyEntrantDoc'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isCopyEntrantDoc'); ?>
                 </div>
                    <?php //echo $form->error($model,'isCopyEntrantDoc'); ?>
            </div>
            <?php // if (Yii::app()->user->checkAccess("showFullEntrantForm")): ?>
           <div class="span3">
                 <?php echo $form->labelEx($model,'SkipDocumentValue'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'SkipDocumentValue'); ?>
                 </div>
            </div>
            <?php // endif; ?>
            
             <div class="span2">
                 <?php 
                 $model->RequestFromEB=1;
                 echo $form->labelEx($model,'RequestFromEB'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'RequestFromEB'); ?>
                 </div>
            </div>
            
           
            
        </div>
        <div class="row-fluid">
            <div class="span2">
		<?php echo $form->labelEx($model,'CourseID'); ?>
		<?php echo $form->dropDownList($model,'CourseID', CHtml::listData(Courses::model()->findAll(), 'idCourse', 'CourseName'),
                            array(  'empty'=>'','class'=>'span12', 
                                    'disabled'=>!$model->isNewRecord  || Yii::app()->user->isPkSet("CourseID"))); ?>
		<?php //echo $form->error($model,'CourseID'); ?>
            </div>
            <div class="span2">
		<?php echo $form->labelEx($model,'EducationFormID'); ?>
		<?php echo $form->dropDownList($model,'EducationFormID',CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm', 'PersonEducationFormName'),
                        array(  'empty'=>'', 'class'=>"span12", 
                                'disabled'=>!$model->isNewRecord, 
                                'onchange'=>"PSN.onFacChange(this, '#".CHtml::activeId($model, "SepcialityID")."','".CController::createUrl('personspeciality/speciality')."');")); ?>
		<?php //echo $form->error($model,'EducationFormID'); ?>
            </div>
            <div class="span4">
                <?php if (empty($model->sepciality)) {
                        $idFacultet = 0;
                      } else {
                         $idFacultet= $model->sepciality->FacultetID;
                      }
                      echo CHtml::label("Факультет", "idFacultet")?>
                <?php echo CHtml::dropDownList('idFacultet', $idFacultet , CHtml::listData(Facultets::model()->findAll(array('order'=>'FacultetFullName')),'idFacultet','FacultetFullName'),
                        array('empty'=>'',
                            'disabled'=>!$model->isNewRecord, 
                            'onchange'=>"PSN.onFacChange(this, '#".CHtml::activeId($model, "SepcialityID")."','".CController::createUrl('personspeciality/speciality')."');",
                        'class'=>"span12")
                      );
                ?>
            </div>
            <div class="span4">
                <?php $url = Yii::app()->createUrl("personspeciality/znosubjects",array("personid"=>$personid));
                      echo $form->labelEx($model,'SepcialityID'); ?>
		<?php echo $form->dropDownList($model,'SepcialityID', Specialities::DropDown($idFacultet),
                        array(  'empty'=>'','class'=>"span12",
                                'disabled'=>!$model->isNewRecord, 
                                'onchange'=>"PSN.changeSpeciality(this, '$url')") ); ?>
		<?php //echo $form->error($model,'SepcialityID'); ?>
            </div>
<!--             <div class="span2">
		<?php //echo $form->labelEx($model,'PaymentTypeID'); ?>
		<?php //echo $form->dropDownList($model,'PaymentTypeID', CHtml::listData(Personeducationpaymenttypes::model()->findAll(), 'idEducationPaymentTypes', 'EducationPaymentTypesName'),
                                //array( 'empty'=>'','class'=>"span12")); ?>
		<?php //echo $form->error($model,'PaymentTypeID'); ?>
            </div>-->
           
        </div>
	
        <div class="row-fluid">
           
            <div class="span2">
		<?php echo $form->labelEx($model,'QualificationID'); ?>
		<?php echo $form->dropDownList($model,'QualificationID',CHtml::listData(Qualifications::model()->findAll(), 'idQualification', 'QualificationName'),
                        array('empty'=>'', 'class'=>"span12", 
                              'disabled'=>!$model->isNewRecord,
                        //Yii::app()->user->isPkSet("QualificationID")
                        )); ?>
		<?php //echo $form->error($model,'QualificationID'); ?>
            </div>
            
            <div class="span4">
                    <?php echo $form->labelEx($model,'EntranceTypeID'); ?>
                    <?php echo $form->dropDownList($model,'EntranceTypeID',CHtml::listData(Personenterancetypes::model()->findAll(), 'idPersonEnteranceType', 'PersonEnteranceTypeName'),
                            array('empty'=>'', 'class'=>"span12",'onchange'=>"PSN.changeEntranceType(this, '$url')", )); ?>
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
<!--            <div class="span2">
                 <?php //echo $form->labelEx($model,'isTarget'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php //echo $form->checkBox($model,'isTarget'); ?>
                 </div>
                 <?php //echo $form->error($model,'isTarget'); ?>
            </div>-->

<!--            <div class="span2">
                    <?php // echo //$form->labelEx($model,'isContact'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php // echo //$form->checkBox($model,'isContact'); ?>
                 </div>
                    <?php //echo $form->error($model,'isContact'); ?>
            </div>-->
            
<!--            <div class="span2">
                    <?php echo $form->labelEx($model,'AdditionalBall'); ?>
                    <?php echo $form->textField($model,'AdditionalBall',array('class'=>"span12")); ?>
                    <?php //echo $form->error($model,'AdditionalBall'); ?>
            </div>
            <div class="span10">
                    <?php echo $form->labelEx($model,'AdditionalBallComment'); ?>
                    <?php echo $form->textField($model,'AdditionalBallComment',array('class'=>"span12")); ?>
                    <?php //echo $form->error($model,'AdditionalBall'); ?>
            </div>-->
        </div>
    <!-- ZNO -->	
    <div class="row-fluid" id="subjects-holder">
       <?php $this->renderPartial("_subjects_holder", array("model"=>$model,'specialityid'=>$model->SepcialityID)); ?>
    </div>
    <hr>
    <div class="row-fluid">

            
            <div class="span3">
                    <?php echo $form->labelEx($model,'CoursedpID'); ?>
                    <?php echo $form->dropDownList($model,'CoursedpID',  CHtml::listData(Coursedp::model()->findAll(), "idCourseDP", "CourseDPName"), array('empty'=>"",'class'=>"span12")); ?>
                    <?php //echo $form->error($model,'CoursedpID'); ?>
            </div>
            <div class="span3">
                    <?php echo $form->labelEx($model,'CoursedpBall'); ?>
                    <?php echo $form->textField($model,'CoursedpBall',array('class'=>"span12")); ?>
                    <?php //echo $form->error($model,'AdditionalBall'); ?>
            </div>
      </div>
    
    <?php if (Yii::app()->user->checkAccess("showFullEntrantForm")): ?>
      <div class="row-fluid"> 
            <div class="span4">
                    <?php echo $form->labelEx($model,'OlympiadID'); ?>
                    <?php echo $form->dropDownList($model,'OlympiadID', Olympiadsawards::DropDown(), array('empty'=>"",'class'=>"span12")); ?>
                    <?php //echo $form->error($model,'CoursedpID'); ?>
            </div>
        
            <div class="span2">
                    <?php  echo $form->labelEx($model,'Quota1'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php  echo $form->checkBox($model,'Quota1'); ?>
                 </div>
                    <?php //echo $form->error($model,'isContact'); ?>
            </div>
            <div class="span4">
                    <?php  echo $form->labelEx($model,'Quota2'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php  echo $form->checkBox($model,'Quota2'); ?>
                 </div>
                    <?php //echo $form->error($model,'isContact'); ?>
            </div>
        
            <div class="span2">
                    <?php echo $form->labelEx($model,'StatusID'); ?>
                    <?php echo $form->dropDownList($model, 'StatusID', CHtml::listData( Personrequeststatustypes::model()->findAll(), "idPersonRequestStatusType", "PersonRequestStatusTypeName"), array('empty'=>"",'class'=>"span12")); ?>
                    <?php //echo $form->error($model,'CoursedpID'); ?>
            </div>
           
        
        
        </div>
    <? endif; ?>
	
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
