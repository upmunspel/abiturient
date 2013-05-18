<?php
/* @var $this Personeducationtypescontroller */
/* @var $data Personeducationtypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPersonEducationTypes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPersonEducationTypes), array('view', 'id'=>$data->idPersonEducationTypes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonEducationTypesName')); ?>:</b>
	<?php echo CHtml::encode($data->PersonEducationTypesName); ?>
	<br />


</div>