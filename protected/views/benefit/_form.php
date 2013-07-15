<?php
/* @var $this Benefitcontroller */
/* @var $model Benefit */
/* @var $form CActiveForm */
?>



<div class="well">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'benefit-form',
	'enableAjaxValidation'=>false,
       
)); ?>

<p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення!</p>
	<?php echo $form->errorSummary($model); ?>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'idBenefit'); ?>
		<?php echo $form->textField($model,'idBenefit'); ?>
		<?php echo $form->error($model,'idBenefit'); ?>
	</div>-->

	<div class="row-fluid">
            <div class="span12">
		<?php echo $form->labelEx($model,'BenefitName'); ?>
		<?php echo $form->textField($model,'BenefitName',array('size'=>60,'maxlength'=>250, "class"=>"span12")); ?>
		<?php echo $form->error($model,'BenefitName'); ?>
	    </div>
        </div>
	<!--<div class="row">
		<?php //echo $form->labelEx($model,'BenefitKey'); ?>
		<?php //echo $form->textField($model,'BenefitKey',array('size'=>30,'maxlength'=>30)); ?>
		<?php //echo $form->error($model,'BenefitKey'); ?>
	</div>-->

	<div class="row-fluid">
             <div class="span12">
		<?php echo $form->labelEx($model,'BenefitGroupID'); ?>
		<?php echo $form->dropDownList($model,'BenefitGroupID', Benefitsgroups::DropDowns(),array( "class"=>"span12")); ?>
		<?php echo $form->error($model,'BenefitGroupID'); ?>
             </div>
	</div>

	<div class="row-fluid">
            <div class="span12">
		<?php echo $form->labelEx($model,'Visible'); ?>
		 <div class="switch" data-on-label="Так" data-off-label="Ні">
                    <?php echo $form->checkBox($model,'Visible'); ?>
                 </div> 
            </div>        
		
	</div>
        <div class="row-fluid">
            <div class="span12">
		<?php echo $form->error($model,'Visible'); ?>
            </div>        
        </div>	


<?php //------------------------------------------------------------------------------------------------------------------------------------// ?>
    <div class="row-fluid">
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
