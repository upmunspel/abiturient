<?php
/* @var $this PersondocumenttypesController */
/* @var $model PersonDocumentTypes */
/* @var $form CActiveForm */
?>

<div class="form well">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-document-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля з  <span class="required">*</span> є обов'язковими.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'idPersonDocumentTypes'); ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'idPersonDocumentTypes'); ?>
		
		<?php echo $form->error($model,'idPersonDocumentTypes'); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'PersonDocumentTypesName'); ?>
		<?php echo $form->textField($model,'PersonDocumentTypesName',array('size'=>60,'maxlength'=>100, "class"=>"span12")); ?>
		<?php echo $form->error($model,'PersonDocumentTypesName'); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'IsEntrantDocument'); ?>
		<?php echo $form->dropDownList($model,'IsEntrantDocument', array("1"=>"Так", '2'=>"Ні"), array("class"=>"span12")); ?>
		<?php echo $form->error($model,'IsEntrantDocument'); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'display'); ?>
		<?php echo $form->dropDownList($model,'display', array("0"=>"Не показувати у формі редагування документів", "1"=>"Показувати у формі редагування документів"),  array("class"=>"span12","empty"=>"")); ?>
		<?php echo $form->error($model,'display'); ?>
	</div>
         <hr>   
	<div class="row-fluid buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ["class"=>"btn btn-primary btn-large"]); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->