<?php
/* @var $this Languagescontroller */
/* @var $model Languages */
/* @var $form CActiveForm */
?>
<div class="well form">
 
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php   //------------------------------------------------------------------------------------------------------------------------------------//?>
  <div class="row-fluid">
        <div class ="span4">
            <?php echo $form->label($model,'idLanguages'); ?>
            <?php echo $form->textField($model,'idLanguages',array('class'=>'span12')); ?>
	</div>
	<div class ="span4">
            <?php echo $form->label($model,'LanguagesCode'); ?>
            <?php echo $form->textField($model,'LanguagesCode',array('class'=>'span12','size'=>4,'maxlength'=>4)); ?>
	</div>
	<div class ="span4">
            <?php echo $form->label($model,'LanguagesName'); ?>
            <?php echo $form->textField($model,'LanguagesName',array('class'=>'span12','size'=>20,'maxlength'=>20)); ?>
	</div>
</div>
<?php   //------------------------------------------------------------------------------------------------------------------------------------//?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Пошук',
		)); ?>
	</div>
<?php $this->endWidget(); ?>
<?php //------------------------------------------------------------------------------------------------------------------------------------//?> 
</div>
<!-- search-form -->