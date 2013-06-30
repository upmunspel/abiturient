<?php
/* @var $this Specialitiescontroller */
/* @var $model Specialities */
/* @var $form CActiveForm */
?>
<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
	'enableAjaxValidation'=>false,
));
?>
<div class="form well ">
	<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>

	<?php echo $form->errorSummary($model); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
    <div class ="span4">
		<?php echo $form->labelEx($model,'idSpeciality'); ?>
		<?php echo $form->textField($model,'idSpeciality',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'idSpeciality'); ?>
	</div>
	<div class ="span4">
		<?php echo $form->labelEx($model,'SpecialityName'); ?>
		<?php echo $form->textField($model,'SpecialityName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SpecialityName'); ?>
	</div>
   	<div class ="span4">
		<?php echo $form->labelEx($model,'SpecialityKode'); ?>
		<?php echo $form->textField($model,'SpecialityKode',array('class'=>'span12','size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'SpecialityKode'); ?>
	</div>
 </div>
 <?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
    <div class ="span4">
		<?php// echo $form->labelEx($model,'FacultetID'); ?>
		<?php //echo $form->dropDownList($model,'FacultetID', Facultets::DropDown(), array('class'=>'span12')); ?>
		<?php// echo $form->error($model,'FacultetID'); ?>
	</div>
 </div>
 <?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">   	
       <div class ="span4">
		<?php echo $form->labelEx($model,'SpecialityClasifierCode'); ?>
		<?php echo $form->textField($model,'SpecialityClasifierCode',array('class'=>'span12','size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'SpecialityClasifierCode'); ?>
	</div>
	<div class ="span4">
		<?php echo $form->labelEx($model,'SpecialityBudgetCount'); ?>
		<?php echo $form->textField($model,'SpecialityBudgetCount',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'SpecialityBudgetCount'); ?>
	</div>
    <div class ="span4">
		<?php echo $form->labelEx($model,'SpecialityContractCount'); ?>
		<?php echo $form->textField($model,'SpecialityContractCount',array('class'=>'span12')); ?>
		<?php echo $form->error($model,'SpecialityContractCount'); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
    <div class="span12">
		<?php echo $form->labelEx($model,'isZaoch'); ?>
		 <div class="switch" data-on-label="Так" data-off-label="Ні">
                      <?php echo $form->checkBox($model,'isZaoch'); ?>
                 </div> 
            </div>   
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
    <div class="span12">
		<?php echo $form->labelEx($model,'isPublishIn'); ?>
		 <div class="switch" data-on-label="Так" data-off-label="Ні">
                      <?php echo $form->checkBox($model,'isPublishIn'); ?>
                 </div> 
            </div>   
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
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