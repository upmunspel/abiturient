<?php
/* @var $this PersoncontacttypesController */
/* @var $model Personcontacttypes */
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
		<?php echo $form->label($model,'idPersonContactType'); ?>
		<?php echo $form->textField($model,'idPersonContactType',array('class'=>'span12')); ?>
	</div>
		<div class ="span8">
		<?php echo $form->label($model,'PersonContactTypeName'); ?>
		<?php echo $form->textField($model,'PersonContactTypeName',array('class'=>'span12','size'=>10,'maxlength'=>10)); ?>
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