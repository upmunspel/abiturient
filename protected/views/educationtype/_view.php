<?php
/* @var $this Educationtypecontroller */
/* @var $data Educationtype */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEducationType')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idEducationType), array('view', 'id'=>$data->idEducationType)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EducationTypeFullName')); ?>:</b>
	<?php echo CHtml::encode($data->EducationTypeFullName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EducationTypeShortName')); ?>:</b>
	<?php echo CHtml::encode($data->EducationTypeShortName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EducationTypeClassID')); ?>:</b>
	<?php echo CHtml::encode($data->EducationTypeClassID); ?>
	<br />


</div>