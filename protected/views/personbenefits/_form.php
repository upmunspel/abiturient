<?php 
/**
 * @var   $form 
 */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'benefit-form-modal',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array("class"=>"form"),
)); 
$form  = new TbActiveForm();
?>

	
        <div class="row-fluid">
            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->hiddenField($model,'PersonID',array('class'=>'span5')); ?>
            <?php echo $form->dropDownListRow($model,'BenefitID', CHtml::listData(Benefit::model()->findAll(),"idBenefit","BenefitName"), array('class'=>'span12')); ?>
        </div>
        <div class="row-fluid">
            <div class ="span1">
                <?php echo $form->labelEx($model,'Series'); ?>
                <?php echo $form->textField($model,'Series',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span2">
                <?php echo $form->labelEx($model,'Numbers'); ?>
                <?php echo $form->textField($model,'Numbers',array('class'=>'span12')); ?>
            </div>
             <div class ="span9">
                <?php echo $form->labelEx($model,'Issued'); ?>
                <?php echo $form->textField($model,'Issued',array('class'=>'span12')); ?>
            </div>
        </div>
        
<!--        <div class="form-actions">
		<?php /* $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); */ ?>
	</div>-->

<?php $this->endWidget(); ?>
