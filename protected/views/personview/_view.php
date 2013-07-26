<?php
/* @var $this PersonviewController */
/* @var $data PersonSpecialityView */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPersonSpeciality')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPersonSpeciality), array('view', 'id'=>$data->idPersonSpeciality)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->CreateDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPerson')); ?>:</b>
	<?php echo CHtml::encode($data->idPerson); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Birthday')); ?>:</b>
	<?php echo CHtml::encode($data->Birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FIO')); ?>:</b>
	<?php echo CHtml::encode($data->FIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isContract')); ?>:</b>
	<?php echo CHtml::encode($data->isContract); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isBudget')); ?>:</b>
	<?php echo CHtml::encode($data->isBudget); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecCodeName')); ?>:</b>
	<?php echo CHtml::encode($data->SpecCodeName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('QualificationID')); ?>:</b>
	<?php echo CHtml::encode($data->QualificationID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CourseID')); ?>:</b>
	<?php echo CHtml::encode($data->CourseID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RequestNumber')); ?>:</b>
	<?php echo CHtml::encode($data->RequestNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonRequestNumber')); ?>:</b>
	<?php echo CHtml::encode($data->PersonRequestNumber); ?>
	<br />

	*/ ?>

</div>