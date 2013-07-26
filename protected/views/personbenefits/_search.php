<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'idPersonBenefits',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PersonID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'BenefitID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Series',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'Numbers',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Issued',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'Modified',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SysUserID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
