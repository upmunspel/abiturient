<?php
/* @var $this DocumentsController */
/* @var $model Documents */
/* @var $form CActiveForm */
?>
<?php 
$burl = Yii::app()->baseUrl;
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($burl."/js/bootstrap-datepicker.js");
Yii::app()->clientScript->registerScriptFile($burl."/js/person.js");

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'person-form',
    //'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array("class"=>"well"),
));
?>
<div class="row-fluid">
<div class ="span12">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php//------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span4">
		<?php echo $form->label($model,'idDocuments'); ?>
		<?php echo $form->textField($model,'idDocuments', array('class'=>'span12'));?>
	</div>
    <div class="span4">
        <?php echo $form->labelEx($model,'PersonID'); ?>
		<?php echo $form->dropDownList($model,'PersonID', Person::DropDown(), array('class'=>'span12'));?>
	</div>
    <div class="span4">
        <?php echo $form->labelEx($model,'TypeID'); ?>
		<?php echo $form->dropDownList($model,'TypeID', PersonDocumentTypes::DropDown1(), array('class'=>'span12'));?>
	</div>
</div>
<?php//------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class="span4">
		<?php echo $form->label($model,'Series'); ?>
		<?php echo $form->textField($model,'Series',array('class'=>'span12','size'=>10,'maxlength'=>10)); ?>
	</div>
    <div class="span4">
		<?php echo $form->label($model,'Numbers'); ?>
		<?php echo $form->textField($model,'Numbers',array('class'=>'span12','size'=>15,'maxlength'=>15)); ?>
	</div>
    <div class="span4">
		<?php echo $form->label($model,'DateGet'); ?>
		<?php echo $form->textField($model,'DateGet', array('class'=>'span12'));?>
	</div>
</div>
<?php//------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class="span4">
		<?php echo $form->label($model,'ZNOPin'); ?>
		<?php echo $form->textField($model,'ZNOPin', array('class'=>'span12'));?>
	</div>
    <div class="span4">
		<?php echo $form->label($model,'AtestatValue'); ?>
		<?php echo $form->textField($model,'AtestatValue', array('class'=>'span12'));?>
	</div>
    <div class="span4">
		<?php echo $form->label($model,'Issued'); ?>
		<?php echo $form->textField($model,'Issued',array('class'=>'span12','size'=>60,'maxlength'=>250)); ?>
	</div>
 </div>
<div class="row-fluid">
    <div class="span4">
		<?php echo $form->label($model,'isCopy'); ?>
		<?php echo $form->textField($model,'isCopy', array('class'=>'span12'));?>
	</div>
    </div>
 <?php//------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Пошук',
		)); ?>
</div>   
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
</div><!-- search-form -->
</div>