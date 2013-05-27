<?php
/* @var $this Subjectscontroller */
/* @var $model Subjects */
/* @var $form CActiveForm */
?>
<div class="well form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
  <div class="row-fluid">
		<div class ="span2">
		<?php echo $form->label($model,'idSubjects'); ?>
		<?php echo $form->textField($model,'idSubjects',array('class'=>'span12')); ?>
	</div>
		<div class ="span2">
		<?php echo $form->label($model,'idZNOSubject'); ?>
		<?php echo $form->textField($model,'idZNOSubject',array('class'=>'span12')); ?>
	</div>
		<div class ="span8">
		<?php echo $form->label($model,'SubjectName'); ?>
		<?php echo $form->textField($model,'SubjectName',array('class'=>'span12','size'=>50,'maxlength'=>50)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
  <div class="row-fluid">
		<div class ="span6">
		<?php echo $form->label($model,'ParentSubject'); ?>
		<?php echo $form->textField($model,'ParentSubject',array('class'=>'span12')); ?>
	</div>
		<div class ="span6">
		<?php echo $form->label($model,'SubjectKey'); ?>
		<?php echo $form->textField($model,'SubjectKey',array('class'=>'span12','size'=>15,'maxlength'=>15)); ?>
	</div></div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<hr>
 <div class="row-fluid">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                //'type'=>'info',
                'label'=>'Пошук',
        )); ?>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<?php $this->endWidget(); ?>
</div><!-- search-form -->