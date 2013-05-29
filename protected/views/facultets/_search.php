<?php
/* @var $this Facultetscontroller */
/* @var $model Facultets */
/* @var $form CActiveForm */
?>
<div class="well form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    )); 
    ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
	<div class ="span4">
		<?php echo $form->label($model,'idFacultet'); ?>
		<?php echo $form->textField($model,'idFacultet',array('class'=>'span12')); ?>
	</div>
        <div class ="span4">
		<?php echo $form->label($model,'FacultetFullName'); ?>
		<?php echo $form->textField($model,'FacultetFullName',array('class'=>'span12','size'=>60,'maxlength'=>255)); ?>
	</div>
        <div class ="span4">
		<?php echo $form->label($model,'FacultetShortName'); ?>
		<?php echo $form->textField($model,'FacultetShortName',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
	</div>
</div>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?>
<div class="row-fluid">
    <div class ="span4">
		<?php echo $form->label($model,'FacultetKode'); ?>
		<?php echo $form->textField($model,'FacultetKode',array('class'=>'span12','size'=>40,'maxlength'=>40)); ?>
    </div>
    <div class ="span4">
		<?php echo $form->label($model,'FacultetTypeName'); ?>
		<?php echo $form->textField($model,'FacultetTypeName',array('class'=>'span12','size'=>45,'maxlength'=>45)); ?>
    </div>
</div>
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
