<?php
/* @var $this SchoolsController */
/* @var $model Schools */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'schools-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idSchool'); ?>
		<?php echo $form->textField($model,'idSchool'); ?>
		<?php echo $form->error($model,'idSchool'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EducationTypeID'); ?>
		<?php echo $form->textField($model,'EducationTypeID'); ?>
		<?php echo $form->error($model,'EducationTypeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Kode_School'); ?>
		<?php echo $form->textField($model,'Kode_School',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Kode_School'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchoolName'); ?>
		<?php echo $form->textField($model,'SchoolName',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'SchoolName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchoolShortName'); ?>
		<?php echo $form->textField($model,'SchoolShortName',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'SchoolShortName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'KOATUUCode'); ?>
		<?php echo $form->textField($model,'KOATUUCode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'KOATUUCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'KOATUUFullName'); ?>
		<?php echo $form->textField($model,'KOATUUFullName',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'KOATUUFullName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StreetTypeID'); ?>
		<?php echo $form->textField($model,'StreetTypeID'); ?>
		<?php echo $form->error($model,'StreetTypeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StreetName'); ?>
		<?php echo $form->textField($model,'StreetName',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'StreetName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HouceNum'); ?>
		<?php echo $form->textField($model,'HouceNum',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'HouceNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchoolBossLastName'); ?>
		<?php echo $form->textField($model,'SchoolBossLastName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SchoolBossLastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchoolBossFirstName'); ?>
		<?php echo $form->textField($model,'SchoolBossFirstName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SchoolBossFirstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchoolBossMiddleName'); ?>
		<?php echo $form->textField($model,'SchoolBossMiddleName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SchoolBossMiddleName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchoolPhone'); ?>
		<?php echo $form->textField($model,'SchoolPhone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'SchoolPhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchoolMobile'); ?>
		<?php echo $form->textField($model,'SchoolMobile',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'SchoolMobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchoolEMail'); ?>
		<?php echo $form->textField($model,'SchoolEMail',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SchoolEMail'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->