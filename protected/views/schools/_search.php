<?php
/* @var $this SchoolsController */
/* @var $model Schools */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idSchool'); ?>
		<?php echo $form->textField($model,'idSchool'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EducationTypeID'); ?>
		<?php echo $form->textField($model,'EducationTypeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Kode_School'); ?>
		<?php echo $form->textField($model,'Kode_School',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchoolName'); ?>
		<?php echo $form->textField($model,'SchoolName',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchoolShortName'); ?>
		<?php echo $form->textField($model,'SchoolShortName',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'KOATUUCode'); ?>
		<?php echo $form->textField($model,'KOATUUCode',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'KOATUUFullName'); ?>
		<?php echo $form->textField($model,'KOATUUFullName',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StreetTypeID'); ?>
		<?php echo $form->textField($model,'StreetTypeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StreetName'); ?>
		<?php echo $form->textField($model,'StreetName',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HouceNum'); ?>
		<?php echo $form->textField($model,'HouceNum',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchoolBossLastName'); ?>
		<?php echo $form->textField($model,'SchoolBossLastName',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchoolBossFirstName'); ?>
		<?php echo $form->textField($model,'SchoolBossFirstName',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchoolBossMiddleName'); ?>
		<?php echo $form->textField($model,'SchoolBossMiddleName',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchoolPhone'); ?>
		<?php echo $form->textField($model,'SchoolPhone',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchoolMobile'); ?>
		<?php echo $form->textField($model,'SchoolMobile',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchoolEMail'); ?>
		<?php echo $form->textField($model,'SchoolEMail',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->