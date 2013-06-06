<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SpecialityID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SubjectID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'LevelID',array('class'=>'span5')); ?>

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
