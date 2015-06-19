<?php
/* @var $this StatementsController */
/* @var $data Statements */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idStatement')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idStatement), array('view', 'id'=>$data->idStatement)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo CHtml::encode($data->number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo CHtml::encode($data->updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecialityID')); ?>:</b>
	<?php echo CHtml::encode($data->SpecialityID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Subjects1ID')); ?>:</b>
	<?php echo CHtml::encode($data->Subjects1ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Subjects2ID')); ?>:</b>
	<?php echo CHtml::encode($data->Subjects2ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Subjects3ID')); ?>:</b>
	<?php echo CHtml::encode($data->Subjects3ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubjectsDate1')); ?>:</b>
	<?php echo CHtml::encode($data->SubjectsDate1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubjectsDate2')); ?>:</b>
	<?php echo CHtml::encode($data->SubjectsDate2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubjectsDate3')); ?>:</b>
	<?php echo CHtml::encode($data->SubjectsDate3); ?>
	<br />

	*/ ?>

</div>