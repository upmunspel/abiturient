<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
    //'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array("class"=>"well"),
)); 

//$form=new TbActiveForm();?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
        <?php echo $form->errorSummary($model); ?>
        <div class="row-fluid">
            <div class ="span4">
            <?php echo $form->label($model,'FirstName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'FirstName',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'MiddleName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'MiddleName',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
            <div class ="span4">
            <?php echo $form->label($model,'FirstName');//,array('class'=>'span3'));?>
            <?php echo $form->textField($model,'LastName',array('class'=>'span12','maxlength'=>50)); ?>
            </div>
        </div>
        <?php echo $form->labelEx($model,'Birthday'); ?>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'Birthday',
    'htmlOptions' => array(
        'size' => '10',         // textField size
        'maxlength' => '10',    // textField maxlength
    ),
));
?>
        /<?//php echo $form->textField($model,'Birthday',array('class'=>'span2')); ?>

	<?php echo $form->textField($model,'PersonSexID',array('class'=>'span2')); ?>

	
	<?php echo $form->textFieldRow($model,'IsResident',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'KOATUUCode',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PersonEducationTypeID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'StreetTypeID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Address',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'HomeNumber',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'PostIndex',array('class'=>'span5','maxlength'=>10)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>
<?php $this->endWidget(); ?>
