<?php
/* @var $this Educationclasscontroller */
/* @var $data Educationclass */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEducationClass')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idEducationClass), array('view', 'id'=>$data->idEducationClass)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EducationClassName')); ?>:</b>
	<?php echo CHtml::encode($data->EducationClassName); ?>
	<br />


</div>