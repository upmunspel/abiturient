<?php
/* @var $this PersonSexTypesController */
/* @var $data PersonSexTypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPersonSexTypes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPersonSexTypes), array('view', 'id'=>$data->idPersonSexTypes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonSexTypesName')); ?>:</b>
	<?php echo CHtml::encode($data->PersonSexTypesName); ?>
	<br />


</div>