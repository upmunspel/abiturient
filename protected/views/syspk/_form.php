<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'sys-pk-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>"well"),
)); 
//$form = new TbActiveForm();
?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row-fluid">
            <?php echo $form->textFieldRow($model,'PkName',array('class'=>'span12')); ?>
        </div>  
        <div class="row-fluid">
            <div class ="span6" >
                <?php echo $form->dropDownListRow($model,'DepartmentID',  CHtml::listData(SysDepartments::model()->findAll(),"idDepartment","DepartmentName" ),array('class'=>'span12')); ?>
            </div>
             <div class ="span6" >
                 <?php echo $form->dropDownListRow($model,'CourseID', CHtml::listData(Courses::model()->findAll(),"idCourse","CourseName" ), array('empty'=>'Довільний', 'class'=>'span12')); ?>
             </div>
        </div>
        <div class="row-fluid">
            <div class ="span3" >
                <?php echo $form->dropDownListRow($model,'QualificationID',CHtml::listData(Qualifications::model()->findAll(),"idQualification","QualificationName" ), array('empty'=>'Довільний', 'class'=>'span12')); ?>
            </div>
             <div class ="span3" >
                <?php echo $form->dropDownListRow($model,'EducationFormID',CHtml::listData(Personeducationforms::model()->findAll(), 'idPersonEducationForm', 'PersonEducationFormName'), array('empty'=>'Довільний', 'class'=>'span12')); ?>
            </div>
            <div class ="span6" >
                 <?php echo $form->textFieldRow($model,'SpecMask',array('class'=>'span12')); ?>
             </div>
        </div>
        <div class="row-fluid">
            <div class ="span12" >
                 <?php echo $form->textAreaRow($model,'Info',array('class'=>'span12')); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2">
                 <?php echo $form->labelEx($model,'isBudget'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isBudget'); ?>
                 </div>
                 <?php //echo $form->error($model,'isTarget'); ?>
            </div>
             <div class="span2">
                 <?php echo $form->labelEx($model,'isContract'); ?>
                 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'isContract'); ?>
                 </div>
                 <?php //echo $form->error($model,'isTarget'); ?>
            </div>
        </div>

	
        
      

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
