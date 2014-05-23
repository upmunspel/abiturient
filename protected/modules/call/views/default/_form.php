<?php
/* @var $this EdbodataController */
/* @var $model EdboData */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'edbo-data-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля позначені зірочкою <span class="required">*</span> обов'язкові.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
		<?php echo $form->error($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PIB'); ?>
		<?php echo $form->textField($model,'PIB',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'PIB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EZ'); ?>
		<?php echo $form->textField($model,'EZ'); ?>
		<?php echo $form->error($model,'EZ'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
		<?php echo $form->textField($model,'Status',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Created'); ?>
		<?php echo $form->textField($model,'Created',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PersonCase'); ?>
		<?php echo $form->textField($model,'PersonCase',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'PersonCase'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Course'); ?>
		<?php echo $form->textField($model,'Course'); ?>
		<?php echo $form->error($model,'Course'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EduForm'); ?>
		<?php echo $form->textField($model,'EduForm',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'EduForm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EduQualification'); ?>
		<?php echo $form->textField($model,'EduQualification',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'EduQualification'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'B'); ?>
		<?php echo $form->textField($model,'B'); ?>
		<?php echo $form->error($model,'B'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'K'); ?>
		<?php echo $form->textField($model,'K'); ?>
		<?php echo $form->error($model,'K'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RatingPoints'); ?>
		<?php echo $form->textField($model,'RatingPoints'); ?>
		<?php echo $form->error($model,'RatingPoints'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpecCode'); ?>
		<?php echo $form->textField($model,'SpecCode',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'SpecCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Direction'); ?>
		<?php echo $form->textField($model,'Direction',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'Direction'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpecialCode'); ?>
		<?php echo $form->textField($model,'SpecialCode',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'SpecialCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Speciality'); ?>
		<?php echo $form->textField($model,'Speciality',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'Speciality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Specialization'); ?>
		<?php echo $form->textField($model,'Specialization',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'Specialization'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StructBranch'); ?>
		<?php echo $form->textField($model,'StructBranch',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'StructBranch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Changed'); ?>
		<?php echo $form->textField($model,'Changed',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Changed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DetailPoints'); ?>
		<?php echo $form->textField($model,'DetailPoints',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'DetailPoints'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DocType'); ?>
		<?php echo $form->textField($model,'DocType',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'DocType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DocSeria'); ?>
		<?php echo $form->textField($model,'DocSeria',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'DocSeria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DocNumber'); ?>
		<?php echo $form->textField($model,'DocNumber',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'DocNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DocPoint'); ?>
		<?php echo $form->textField($model,'DocPoint'); ?>
		<?php echo $form->error($model,'DocPoint'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DocDate'); ?>
		<?php echo $form->textField($model,'DocDate',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'DocDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Honours'); ?>
		<?php echo $form->textField($model,'Honours',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Honours'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EntranceType'); ?>
		<?php echo $form->textField($model,'EntranceType',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'EntranceType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EntranceReason'); ?>
		<?php echo $form->textField($model,'EntranceReason',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'EntranceReason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Benefit'); ?>
		<?php echo $form->textField($model,'Benefit'); ?>
		<?php echo $form->error($model,'Benefit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PriorityEntry'); ?>
		<?php echo $form->textField($model,'PriorityEntry'); ?>
		<?php echo $form->error($model,'PriorityEntry'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Quota'); ?>
		<?php echo $form->textField($model,'Quota'); ?>
		<?php echo $form->error($model,'Quota'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Language'); ?>
		<?php echo $form->textField($model,'Language',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'Language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OI'); ?>
		<?php echo $form->textField($model,'OI'); ?>
		<?php echo $form->error($model,'OI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Category'); ?>
		<?php echo $form->textField($model,'Category',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Gender'); ?>
		<?php echo $form->textField($model,'Gender',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Citizen'); ?>
		<?php echo $form->textField($model,'Citizen',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Citizen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Country'); ?>
		<?php echo $form->textField($model,'Country',array('size'=>60,'maxlength'=>192)); ?>
		<?php echo $form->error($model,'Country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TH'); ?>
		<?php echo $form->textField($model,'TH',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'TH'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Tel'); ?>
		<?php echo $form->textField($model,'Tel',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MobTel'); ?>
		<?php echo $form->textField($model,'MobTel',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'MobTel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OD'); ?>
		<?php echo $form->textField($model,'OD'); ?>
		<?php echo $form->error($model,'OD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NeedHostel'); ?>
		<?php echo $form->textField($model,'NeedHostel'); ?>
		<?php echo $form->error($model,'NeedHostel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EntranceCodes'); ?>
		<?php echo $form->textField($model,'EntranceCodes',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'EntranceCodes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->