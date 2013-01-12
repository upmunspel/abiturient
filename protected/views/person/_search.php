<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'idPerson',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Birthday',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PersonSexID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'FirstName',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'MiddleName',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'LastName',array('class'=>'span5','maxlength'=>50)); ?>

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
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
