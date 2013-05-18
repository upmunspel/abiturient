<?php
/* @var $this Schoolscontroller */
/* @var $model Schools */
/* @var $form CActiveForm */
?>

<div class="form well">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'schools-form',
'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span4">
        <?php echo $form->labelEx($model,'idSchool'); ?>
        <?php echo $form->textField($model,'idSchool',array('class'=>'span12')); ?>
        <?php echo $form->error($model,'idSchool'); ?>
    </div>
    <div class ="span4">
            <?php echo $form->labelEx($model,'SchoolName'); ?>
            <?php echo $form->textField($model,'SchoolName',array('class'=>'span12','size'=>60,'maxlength'=>250)); ?>
            <?php echo $form->error($model,'SchoolName'); ?>    
    </div>
    <div class ="span4">
            <?php echo $form->labelEx($model,'SchoolShortName'); ?>
            <?php echo $form->textField($model,'SchoolShortName',array('class'=>'span12','size'=>60,'maxlength'=>200)); ?>
            <?php echo $form->error($model,'SchoolShortName'); ?>
    </div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span4">
        <?php echo $form->labelEx($model,'Kode_School'); ?>
        <?php echo $form->textField($model,'Kode_School',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'Kode_School'); ?>   
</div>
    <div class ="span4">
        <?php echo $form->labelEx($model,'KOATUUCode'); ?>
        <?php echo $form->textField($model,'KOATUUCode',array('class'=>'span12','size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'KOATUUCode'); ?>
</div>
    <div class ="span4">
        <?php echo $form->labelEx($model,'KOATUUFullName'); ?>
        <?php echo $form->textField($model,'KOATUUFullName',array('class'=>'span12','size'=>60,'maxlength'=>150)); ?>
        <?php echo $form->error($model,'KOATUUFullName'); ?>
    </div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span4">
		<?php echo $form->labelEx($model,'EducationTypeID'); ?>
		<?php echo $form->dropDownList($model,'EducationTypeID', PersonEducationTypes::DropDown(), array('class'=>'span12'));?>
		<?php echo $form->error($model,'EducationTypeID'); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span4">
        <?php echo $form->labelEx($model,'StreetTypeID'); ?>
		<?php echo $form->dropDownList($model,'StreetTypeID', StreetTypes::DropDown(), array('class'=>'span12')); ?>
		<?php echo $form->error($model,'StreetTypeID'); ?>
	</div>
	<div class ="span4">
		<?php echo $form->labelEx($model,'StreetName'); ?>
		<?php echo $form->textField($model,'StreetName',array('class'=>'span12','size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'StreetName'); ?>
	</div>
	<div class ="span4">
		<?php echo $form->labelEx($model,'HouceNum'); ?>
		<?php echo $form->textField($model,'HouceNum',array('class'=>'span12','size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'HouceNum'); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span4">
		<?php echo $form->labelEx($model,'SchoolBossLastName'); ?>
		<?php echo $form->textField($model,'SchoolBossLastName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SchoolBossLastName'); ?>
	</div>

	<div class ="span4">
		<?php echo $form->labelEx($model,'SchoolBossFirstName'); ?>
		<?php echo $form->textField($model,'SchoolBossFirstName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SchoolBossFirstName'); ?>
	</div>

	<div class ="span4">
		<?php echo $form->labelEx($model,'SchoolBossMiddleName'); ?>
		<?php echo $form->textField($model,'SchoolBossMiddleName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SchoolBossMiddleName'); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span4">
		<?php echo $form->labelEx($model,'SchoolPhone'); ?>
		<?php echo $form->textField($model,'SchoolPhone',array('class'=>'span12','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'SchoolPhone'); ?>
	</div>
	<div class ="span4">
		<?php echo $form->labelEx($model,'SchoolMobile'); ?>
		<?php echo $form->textField($model,'SchoolMobile',array('class'=>'span12','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'SchoolMobile'); ?>
	</div>
	<div class ="span4">
		<?php echo $form->labelEx($model,'SchoolEMail'); ?>
		<?php echo $form->textField($model,'SchoolEMail',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SchoolEMail'); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="form-actions">
<?php $this->widget("bootstrap.widgets.TbButton", array(
			'buttonType'=>'submit',
			'type'=>'primary',
                          "size"=>"null",
			'label'=>$model->isNewRecord ? 'Створити' : 'Зберегти',
                        )); 
                ?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
