<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
     'htmlOptions'=>array('class'=>"well"),
)); ?>

	<?php echo $form->textFieldRow($model,'idPk',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PkName',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'DepartmentID',  CHtml::listData(SysDepartments::model()->findAll(),"idDepartment","DepartmentName" ),array('empty'=>'','class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'CourseID', CHtml::listData(Courses::model()->findAll(),"idCourse","CourseName" ), array('empty'=>'', 'class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'QualificationID',CHtml::listData(Qualifications::model()->findAll(),"idQualification","QualificationName" ), array('empty'=>'', 'class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SpecMask',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
