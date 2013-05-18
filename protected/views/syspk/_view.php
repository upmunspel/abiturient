<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPk')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPk),array('view','id'=>$data->idPk)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PkName')); ?>:</b>
	<?php echo CHtml::encode($data->PkName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DepartmentID')); ?>:</b>
	<?php echo CHtml::encode($data->DepartmentID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CourseID')); ?>:</b>
	<?php echo CHtml::encode($data->CourseID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('QualificationID')); ?>:</b>
	<?php echo CHtml::encode($data->QualificationID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecMask')); ?>:</b>
	<?php echo CHtml::encode($data->SpecMask); ?>
	<br />


</div>