<?php
/* @var $this Schoolscontroller */
/* @var $model Schools */
/* @var $form CActiveForm */
?>

<div class="well form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
  <div class="row-fluid">
		<div class ="span4">
		<?php echo $form->label($model,'idSchool'); ?>
		<?php echo $form->textField($model,'idSchool',array('class'=>'span12')); ?>
		</div>

		<div class ="span4">
		<?php echo $form->label($model,'SchoolName'); ?>
		<?php echo $form->textField($model,'SchoolName',array('class'=>'span12','size'=>60,'maxlength'=>250)); ?>
		</div>  
		<div class ="span4">
		<?php echo $form->label($model,'SchoolShortName'); ?>
		<?php echo $form->textField($model,'SchoolShortName',array('class'=>'span12','size'=>60,'maxlength'=>200)); ?>
		</div>
</div>	
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">    
	<div class ="span4">
		<?php echo $form->label($model,'Kode_School'); ?>
		<?php echo $form->textField($model,'Kode_School',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
	</div>
	<div class ="span4">
		<?php echo $form->label($model,'KOATUUCode'); ?>
		<?php echo $form->textField($model,'KOATUUCode',array('class'=>'span12','size'=>10,'maxlength'=>10)); ?>
	</div>
	<div class ="span4">
		<?php echo $form->label($model,'KOATUUFullName'); ?>
		<?php echo $form->textField($model,'KOATUUFullName',array('class'=>'span12','size'=>60,'maxlength'=>150)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>	
<div class="row-fluid">   
	<div class ="span4">
		<?php echo $form->labelEx($model,'EducationTypeID'); ?>
		<?php echo $form->dropDownList($model,'EducationTypeID', PersonEducationTypes::DropDown(), array('class'=>'span12'));?>
	</div>
</div>

<?php //------------------------------------------------------------------------------------------------------------------------------------//?>	
<div class="row-fluid">  
	<div class ="span4">
		<?php echo $form->labelEx($model,'StreetTypeID'); ?>
		<?php echo $form->dropDownList($model,'StreetTypeID', StreetTypes::DropDown(), array('class'=>'span12')); ?>
	</div>
	<div class ="span4">
		<?php echo $form->label($model,'StreetName'); ?>
		<?php echo $form->textField($model,'StreetName',array('class'=>'span12','size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class ="span4">
		<?php echo $form->label($model,'HouceNum'); ?>
		<?php echo $form->textField($model,'HouceNum',array('class'=>'span12','size'=>15,'maxlength'=>15)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>	

<div class="row-fluid">
<div class ="span4">
		<?php echo $form->label($model,'SchoolBossLastName'); ?>
		<?php echo $form->textField($model,'SchoolBossLastName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class ="span4">
		<?php echo $form->label($model,'SchoolBossFirstName'); ?>
		<?php echo $form->textField($model,'SchoolBossFirstName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class ="span4">
		<?php echo $form->label($model,'SchoolBossMiddleName'); ?>
		<?php echo $form->textField($model,'SchoolBossMiddleName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>	

<div class="row-fluid">
	<div class ="span4">
		<?php echo $form->label($model,'SchoolPhone'); ?>
		<?php echo $form->textField($model,'SchoolPhone',array('class'=>'span12','size'=>50,'maxlength'=>50)); ?>
	</div>
	<div class ="span4">
		<?php echo $form->label($model,'SchoolMobile'); ?>
		<?php echo $form->textField($model,'SchoolMobile',array('class'=>'span12','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class ="span4">
		<?php echo $form->label($model,'SchoolEMail'); ?>
		<?php echo $form->textField($model,'SchoolEMail',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
	</div>
</div>  
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>	
    
<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Пошук',
		)); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- search-form -->
