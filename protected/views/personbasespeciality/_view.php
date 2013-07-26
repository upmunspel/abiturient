<?php
/* @var $this PersonbasespecialityController */
/* @var $data Personbasespeciality */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPersonBaseSpeciality')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPersonBaseSpeciality), array('view', 'id'=>$data->idPersonBaseSpeciality)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonBaseSpecialityName')); ?>:</b>
	<?php echo CHtml::encode($data->PersonBaseSpecialityName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonBaseSpecialityClasifierCode')); ?>:</b>
	<?php echo CHtml::encode($data->PersonBaseSpecialityClasifierCode); ?>
	<br />


</div>