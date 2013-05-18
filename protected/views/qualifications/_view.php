<?php
/* @var $this Qualificationscontroller */
/* @var $data Qualifications */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idQualification')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idQualification), array('view', 'id'=>$data->idQualification)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('QualificationName')); ?>:</b>
	<?php echo CHtml::encode($data->QualificationName); ?>
	<br />


</div>