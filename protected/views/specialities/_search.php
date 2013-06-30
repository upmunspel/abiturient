<?php
/* @var $this Specialitiescontroller */
/* @var $model Specialities */
/* @var $form CActiveForm */
?>
<div class="well form">
<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
	'enableAjaxValidation'=>false,
));
?>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
		<div class ="span4">
		<?php echo $form->label($model,'idSpeciality'); ?>
		<?php echo $form->textField($model,'idSpeciality',array('class'=>'span12')); ?>
	</div>
	<div class="span4">
		<?php echo $form->label($model,'SpecialityName'); ?>
		<?php echo $form->textField($model,'SpecialityName',array('class'=>'span12','size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class ="span4">
		<?php echo $form->label($model,'SpecialityKode'); ?>
		<?php echo $form->textField($model,'SpecialityKode',array('class'=>'span12','size'=>40,'maxlength'=>40)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
		<div class ="span4">
        <?php echo $form->labelEx($model,'FacultetID'); ?>
		<?php echo $form->dropDownList($model,'FacultetID', Facultets::DropDown(), array('class'=>'span12','class'=>'span12')); ?>
	</div>
</div>    
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
		<div class ="span4">
		<?php echo $form->label($model,'SpecialityClasifierCode'); ?>
		<?php echo $form->textField($model,'SpecialityClasifierCode',array('class'=>'span12','size'=>12,'maxlength'=>12)); ?>
	</div>
    <div class ="span4">
		<?php echo $form->label($model,'SpecialityBudgetCount'); ?>
		<?php echo $form->textField($model,'SpecialityBudgetCount',array('class'=>'span12')); ?>
	</div>
    <div class ="span4">
		<?php echo $form->label($model,'SpecialityContractCount'); ?>
		<?php echo $form->textField($model,'SpecialityContractCount',array('class'=>'span12')); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
	<?php echo $form->labelEx($model,'isZaoch'); ?>
	       <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model,'isZaoch');?>
                    </div>
                    <script type='text/javascript'>
                        $('#togle_isZaoch').toggleButtons({
                        label: {
                            enabled: 'Так',
                            disabled: 'Ні'
                        }
                    });
                 </script>    
		<?php echo $form->error($model,'isPublishIn'); ?>
	</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
<div class="row-fluid">
        <?php echo $form->label($model,'isPublishIn'); ?>	
                  <div class="switch" data-on-label="Так" data-off-label="Ні">
                        <?php echo $form->checkBox($model,'isPublishIn');?>
                    </div>
                 <script type='text/javascript'>
                    $('#togle_isPublishIn').toggleButtons({
                        //width: 100,
                        label: {
                            enabled: 'Так',
                            disabled: 'Ні'
                        }
                    });
                 </script> 
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Пошук',
		)); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- search-form -->