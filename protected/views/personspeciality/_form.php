<?php
/* @var $this PersonspecialityController */
/* @var $model Personspeciality */
/* @var $form CActiveForm */
?>

<div class="">

<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'personspeciality-form',
	'enableAjaxValidation'=>false,
)); 
$form= new CActiveForm();
?>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'PersonID'); ?>
        
        <div class="row-fluid">
            <div class="span2">
		<?php echo $form->labelEx($model,'CourseID'); ?>
		<?php echo $form->dropDownList($model,'CourseID', CHtml::listData(Courses::model()->findAll(), 'idCourse', 'CourseName'),array('class'=>'span12')); ?>
		<?php //echo $form->error($model,'CourseID'); ?>
            </div>
            <div class="span4">
                <?php echo CHtml::label("Факультет", "idFacultet")?>
                <?php echo CHtml::dropDownList('idFacultet', "", CHtml::listData(Facultets::model()->findAll(array('order'=>'FacultetFullName')),'idFacultet','FacultetFullName'),
                        array( 'onchange'=>"PSN.onFacChange(this, '#".CHtml::activeId($model, "SepcialityID")."','".CController::createUrl('personspeciality/speciality')."');",
                        'class'=>"span12")
                      );
                ?>
            </div>
            <div class="span2">
                <?php echo $form->labelEx($model,'SepcialityID'); ?>
		<?php echo $form->dropDownList($model,'SepcialityID',  CHtml::listData(Specialities::model()->findAll(), 'idSpeciality', 'SpecialityName'),array( 'class'=>"span12") ); ?>
		<?php echo $form->error($model,'SepcialityID'); ?>
            </div>
             <div class="span2">
		<?php echo $form->labelEx($model,'PaymentTypeID'); ?>
		<?php echo $form->dropDownList($model,'PaymentTypeID', CHtml::listData(Personeducationpaymenttypes::model()->findAll(), 'idEducationPaymentTypes', 'EducationPaymentTypesName'),array( 'class'=>"span12")); ?>
		<?php echo $form->error($model,'PaymentTypeID'); ?>
            </div>
            <div class="span2">
		<?php echo $form->labelEx($model,'EducationFormID'); ?>
		<?php echo $form->dropDownList($model,'EducationFormID',CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm', 'PersonEducationFormName'),array( 'class'=>"span12")); ?>
		<?php echo $form->error($model,'EducationFormID'); ?>
            </div>
        </div>
	
        <div class="row-fluid">
           
            <div class="span2">
		<?php echo $form->labelEx($model,'QualificationID'); ?>
		<?php echo $form->dropDownList($model,'QualificationID',CHtml::listData(Qualifications::model()->findAll(), 'idQualification', 'QualificationName'),array( 'class'=>"span12")); ?>
		<?php echo $form->error($model,'QualificationID'); ?>
            </div>
            
            <div class="span4">
                    <?php echo $form->labelEx($model,'EntranceTypeID'); ?>
                    <?php echo $form->dropDownList($model,'EntranceTypeID',CHtml::listData(Personenterancetypes::model()->findAll(), 'idPersonEnteranceType', 'PersonEnteranceTypeName'),array( 'class'=>"span12")); ?>
                    <?php echo $form->error($model,'EntranceTypeID'); ?>
            </div>
            
            <div class="span6">
                    <?php echo $form->labelEx($model,'CausalityID'); ?>
                    <?php echo $form->dropDownList($model,'CausalityID', CHtml::listData(Causality::model()->findAll(), 'idCausality', 'CausalityName'),array( 'class'=>"span12")); ?>
                    <?php echo $form->error($model,'CausalityID'); ?>
            </div>

		
	</div>
    
        <div class="row-fluid">
            <div class="span2">
                 <?php echo $form->labelEx($model,'isTarget'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isTarget'); ?>
                 </div>
                 <?php echo $form->error($model,'isTarget'); ?>
            </div>

            <div class="span2">
                    <?php echo $form->labelEx($model,'isContact'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isContact'); ?>
                 </div>
                    <?php echo $form->error($model,'isContact'); ?>
            </div>
            <div class="span2">
                    <?php echo $form->labelEx($model,'isCopyEntrantDoc'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isCopyEntrantDoc'); ?>
                 </div>
                    <?php echo $form->error($model,'isCopyEntrantDoc'); ?>
            </div>
            <div class="span2">
                    <?php echo $form->labelEx($model,'AdditionalBall'); ?>
                    <?php echo $form->textField($model,'AdditionalBall'); ?>
                    <?php echo $form->error($model,'AdditionalBall'); ?>
            </div>
        </div>
    <!-- ZNO -->	
    <div class="row-fluid">
        <!-- ZNO -->
        <div class="span7">
           <div class="row-fluid">
               <div class="span12">
		<?php echo $form->labelEx($model,'DocumentSubject1'); ?>
               </div>
           </div>
           
           <div class="row-fluid"> 
            <div class="span12">
		<?php //echo $form->labelEx($model,'DocumentSubject1');    ?>
		<?php echo $form->dropDownList($model, 'DocumentSubject1',  Documents::ZNODropDown($model->PersonID), array('class'=>"span12")); ?>
		<?php echo $form->error($model,'DocumentSubject1'); ?>
            </div>
           </div>
            <div class="row-fluid">
            <div class="span12">
                    <?php //echo $form->labelEx($model,'DocumentSubject2'); ?>
                    <?php echo $form->dropDownList($model, 'DocumentSubject2',  Documents::ZNODropDown($model->PersonID), array('class'=>"span12")); ?>
                    <?php echo $form->error($model,'DocumentSubject2'); ?>
            </div>
            </div>
            <div class="row-fluid">
            <div class="span12">
                    <?php //echo $form->labelEx($model,'DocumentSubject3'); ?>
                   <?php echo $form->dropDownList($model, 'DocumentSubject3',  Documents::ZNODropDown($model->PersonID), array('class'=>"span12")); ?>
                    <?php echo $form->error($model,'DocumentSubject3'); ?>
            </div>
            </div>
        </div>
        <!--Exams -->
        <div class="span5">
           <div class="row-fluid">
                <div class="span6">
                        <?php echo $form->labelEx($model,'Exam1ID'); ?>
                   
                </div>
               <div class="span6">
                        <?php echo $form->labelEx($model,'Exam1Ball'); ?>
                  
                </div>
           </div>
            <div class="row-fluid">
                <div class="span6">
                        <?php //echo $form->labelEx($model,'Exam1ID'); ?>
                        <?php echo $form->textField($model,'Exam1ID',array('class'=>"span12")); ?>
                        <?php echo $form->error($model,'Exam1ID'); ?>
                </div>

                <div class="span6">
                        <?php //echo $form->labelEx($model,'Exam1Ball'); ?>
                        <?php echo $form->textField($model,'Exam1Ball',array('class'=>"span12")); ?>
                        <?php echo $form->error($model,'Exam1Ball'); ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                        <?php //echo $form->labelEx($model,'Exam2ID'); ?>
                        <?php echo $form->textField($model,'Exam2ID',array('class'=>"span12")); ?>
                        <?php echo $form->error($model,'Exam2ID'); ?>
                </div>

                <div class="span6">
                        <?php //echo $form->labelEx($model,'Exam2Ball'); ?>
                        <?php echo $form->textField($model,'Exam2Ball',array('class'=>"span12")); ?>
                        <?php echo $form->error($model,'Exam2Ball'); ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                        <?php //echo $form->labelEx($model,'Exam3ID'); ?>
                        <?php echo $form->textField($model,'Exam3ID',array('class'=>"span12")); ?>
                        <?php echo $form->error($model,'Exam3ID'); ?>
                </div>

                <div class="span6">
                        <?php //echo $form->labelEx($model,'Exam3Ball'); ?>
                        <?php echo $form->textField($model,'Exam3Ball',array('class'=>"span12")); ?>
                        <?php echo $form->error($model,'Exam3Ball'); ?>
                </div>
            </div>

        </div>
    
        
    </div>
	
<!--
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>
   --> 

<?php $this->endWidget(); ?>
    <script>
        $("#personspeciality-form .switch").bootstrapSwitch();
    </script>

</div><!-- form -->