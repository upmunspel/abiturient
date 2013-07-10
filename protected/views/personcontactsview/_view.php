<?php
/* @var $this PersoncontactsviewController */
/* @var $data PersonContactsView */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SepcialityID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SepcialityID), array('view', 'id'=>$data->SepcialityID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FIO')); ?>:</b>
	<?php echo CHtml::encode($data->FIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EducationFormID')); ?>:</b>
	<?php echo CHtml::encode($data->EducationFormID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isBudget')); ?>:</b>
	<?php echo CHtml::encode($data->isBudget); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isContract')); ?>:</b>
	<?php echo CHtml::encode($data->isContract); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecName')); ?>:</b>
	<?php echo CHtml::encode($data->SpecName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Contacts')); ?>:</b>
	<?php echo CHtml::encode($data->Contacts); ?>
	<br />


</div>