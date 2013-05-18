<?php
/* @var $this PersoncontacttypesController */
/* @var $data Personcontacttypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPersonContactType')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPersonContactType), array('view', 'id'=>$data->idPersonContactType)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonContactTypeName')); ?>:</b>
	<?php echo CHtml::encode($data->PersonContactTypeName); ?>
	<br />


</div>