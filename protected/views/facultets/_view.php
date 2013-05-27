<?php
/* @var $this Facultetscontroller */
/* @var $data Facultets */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idFacultet')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idFacultet), array('view', 'id'=>$data->idFacultet)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FacultetFullName')); ?>:</b>
	<?php echo CHtml::encode($data->FacultetFullName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FacultetShortName')); ?>:</b>
	<?php echo CHtml::encode($data->FacultetShortName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FacultetKode')); ?>:</b>
	<?php echo CHtml::encode($data->FacultetKode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FacultetTypeName')); ?>:</b>
	<?php echo CHtml::encode($data->FacultetTypeName); ?>
	<br />


</div>
