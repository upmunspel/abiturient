<?php
/* @var $this PersoneducationformsController */
/* @var $data Personeducationforms */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPersonEducationForm')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPersonEducationForm), array('view', 'id'=>$data->idPersonEducationForm)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonEducationFormName')); ?>:</b>
	<?php echo CHtml::encode($data->PersonEducationFormName); ?>
	<br />


</div>